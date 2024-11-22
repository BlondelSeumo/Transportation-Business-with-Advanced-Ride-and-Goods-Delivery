<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Request\Request as RequestModel;
use Log;
use Kreait\Firebase\Contract\Database;
use Illuminate\Validation\ValidationException;
use App\Base\Constants\Masters\PushEnums;
use App\Models\Payment\OwnerWallet;
use App\Models\Payment\OwnerWalletHistory;
use App\Transformers\Payment\OwnerWalletTransformer;
use App\Jobs\Notifications\SendPushNotification;
use App\Models\Payment\UserWalletHistory;
use App\Models\Payment\DriverWalletHistory;
use App\Transformers\Payment\WalletTransformer;
use App\Transformers\Payment\DriverWalletTransformer;
use App\Http\Requests\Payment\AddMoneyToWalletRequest;
use App\Transformers\Payment\UserWalletHistoryTransformer;
use App\Transformers\Payment\DriverWalletHistoryTransformer;
use App\Models\Payment\UserWallet;
use App\Models\Payment\DriverWallet;
use App\Base\Constants\Masters\WalletRemarks;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Base\Constants\Auth\Role;
use Carbon\Carbon;

class CashfreeController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
    }    

     public function create(Request $request)
     {
        $amount = $request->input('amount');
        $payment_for = $request->input('payment_for');
        $user_id = (int)$request->input('user_id');
        $request_id = $request->input('request_id');

        $user = User::find($user_id);
        $currency = $user->countryDetail->currency_code ?? "INR";

        return view('cashfree.cashfree', compact('amount', 'payment_for', 'currency', 'user_id', 'user', 'request_id'));
    }

      public function store(Request $request)
     {
          $validated = $request->validate([
               'name' => 'required|min:3',
               'email' => 'required',
               'mobile' => 'required',
               'amount' => 'required'
          ]);

            $payment_for = $request->payment_for;
            $request_id = $request->request_id ?? " ";
            $user_id = $request->user_id;

            $currency = $request->currency ?? "INR";

               


          $cashFreeEnvironment = get_settings('cash_free_environment');

          $cashFreeApiKey = get_settings('cash_free_production_app_id');
          $cashFreeApiSecrectKey = get_settings('cash_free_production_secret_key');

          $url = "https://api.cashfree.com/pg/orders";

          if($cashFreeEnvironment=="test")
          {
              $cashFreeApiKey = get_settings('cash_free_app_id');
              $cashFreeApiSecrectKey = get_settings('cash_free_secret_key');
              $url = "https://sandbox.cashfree.com/pg/orders";

          }


          $headers = array(
               "Content-Type: application/json",
               "x-api-version: 2022-01-01",
               "x-client-id: ".$cashFreeApiKey,
               "x-client-secret: ".$cashFreeApiSecrectKey
          );

          $data = json_encode([
               'order_id' =>  'order_'.rand(1111111111,9999999999),
               'order_amount' => $validated['amount'],
               "order_currency" => $currency,
               "customer_details" => [
                    "customer_id" => 'customer_'.rand(111111111,999999999),
                    "customer_name" => $validated['name'],
                    "customer_email" => $validated['email'],
                    "customer_phone" => $validated['mobile'],
               ],
               "order_meta" => [
                                "return_url" => route('cashfree.success', [
                                'amount' => $validated['amount'],
                                'payment_for' => $payment_for,
                                'request_id' => $request_id,
                                'user_id' => $user_id,
                            ]),
               ]
          ]);

          $curl = curl_init($url);

          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_POST, true);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

          $resp = curl_exec($curl);

          curl_close($curl);

          return redirect()->to(json_decode($resp)->payment_link);
     }
     public function success(Request $request)
     {
          // dd($request->all()); // PAYMENT STATUS RESPONSE

        // Accessing data from session
            $web_booking_value=0;
            $amount = $request->amount;
            $payment_for = $request->payment_for;
            $request_id = $request->request_id ?? " ";
            $user_id = $request->user_id;

 
      //Handle the sucess payment  Here
            if ($payment_for=="wallet") {
                 $request_id = null;

                 $user = User::find($user_id);

                if ($user->hasRole('user')) {
                    $wallet_model = new UserWallet();
                    $wallet_add_history_model = new UserWalletHistory();
                    $user_id = $user->id;
                } elseif($user->hasRole('driver')) {
                            $wallet_model = new DriverWallet();
                            $wallet_add_history_model = new DriverWalletHistory();
                            $user_id = $user->driver->id;
                }else {
                            $wallet_model = new OwnerWallet();
                            $wallet_add_history_model = new OwnerWalletHistory();
                            $user_id = $user->owner->id;
                }

                $user_wallet = $wallet_model::firstOrCreate([
                    'user_id'=>$user_id]);
                $user_wallet->amount_added += $amount;
                $user_wallet->amount_balance += $amount;
                $user_wallet->save();
                $user_wallet->fresh();

                $wallet_add_history_model::create([
                    'user_id'=>$user_id,
                    'amount'=>$amount,
                    'transaction_id'=>$request->PayerID,
                    'remarks'=>WalletRemarks::MONEY_DEPOSITED_TO_E_WALLET,
                    'is_credit'=>true]);


                    $title = trans('push_notifications.amount_credited_to_your_wallet_title',[],$user->lang);
                    $body = trans('push_notifications.amount_credited_to_your_wallet_body',[],$user->lang);

                        dispatch(new SendPushNotification($user,$title,$body));

                        if ($user->hasRole(Role::USER)) {
                        $result =  fractal($user_wallet, new WalletTransformer);
                        } elseif($user->hasRole(Role::DRIVER)) {
                            $result =  fractal($user_wallet, new DriverWalletTransformer);
                        }else{
                            $result =  fractal($user_wallet, new OwnerWalletTransformer);

                       }


            }else{

                    $request_id = $request_id;
                    // Log::info($request_id);

                     $request_detail = RequestModel::where('id', $request_id)->first();

                    $web_booking_value = $request_detail->web_booking;

                    $request_detail->update(['is_paid' => true]);
                    $driver_commission = $request_detail->requestBill->driver_commision;

                        $wallet_model = new DriverWallet();
                        $wallet_add_history_model = new DriverWalletHistory();
                        $user_id = $request_detail->driver_id;
                        /*wallet Modal*/
                        $user_wallet = $wallet_model::firstOrCreate([
                        'user_id'=>$user_id]);
                        $user_wallet->amount_added += $amount;
                        $user_wallet->amount_balance += $amount;
                        $user_wallet->save();
                        $user_wallet->fresh();
                        /*wallet history*/
                        $wallet_add_history_model::create([
                        'user_id'=>$user_id,
                        'amount'=>$amount,
                        'transaction_id'=>$request->PayerID,
                        'remarks'=>WalletRemarks::TRIP_COMMISSION_FOR_DRIVER,
                        'is_credit'=>true]);



                    $title = trans('push_notifications.amount_credited_to_your_wallet_title',[],$request_detail->driverDetail->user->lang);
                    $body = trans('push_notifications.amount_credited_to_your_wallet_body',[],$request_detail->driverDetail->user->lang);

                        dispatch(new SendPushNotification($request_detail->driverDetail->user,$title,$body));
                     $this->database->getReference('requests/'.$request_detail->id)->update(['is_paid'=>1]);


            }

            return view('success',['success'],compact('web_booking_value','request_id'));
     }
}
