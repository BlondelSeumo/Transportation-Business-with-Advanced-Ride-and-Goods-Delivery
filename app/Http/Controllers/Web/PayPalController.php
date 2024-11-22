<?php

namespace App\Http\Controllers\Web;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request as ValidatorRequest;
use App\Http\Controllers\Controller;
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
use App\Models\Request\Request as RequestModel;
use App\Models\User;
use Log;
use Kreait\Firebase\Contract\Database;

class PayPalController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function index()
    {
        $amount = request()->input('amount');
        $payment_for = request()->input('payment_for');
        $request_id = request()->input('request_id');
        $currency = $user->countryDetail->currency_code ?? "USD";
        $user = User::find(request()->input('user_id'));

        $user_id = request()->input('user_id');

        if (env('APP_FOR')=='demo') {

        $currency ="USD";
        
        }

        return view('paypal.paypal',['payment_for' => $payment_for, 'request_id' => $request_id, 'user' => $user, 'amount'=>$amount, 'currency' => $currency, 'user_id'=>$user_id]);
    }

    public function payment(ValidatorRequest $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        // Storing data in session
            $amount = $request->amount;
            $payment_for = $request->payment_for;
            $request_id = $request->request_id ?? " ";
            $user_id = $request->user_id;

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.payment.success', [
                                'amount' => $amount,
                                'payment_for' => $payment_for,
                                'request_id' => $request_id,
                                'user_id' => $user_id
                            ]),
                "cancel_url" => route('paypal.payment/cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->amount
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('paypal.payment/cancel')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('paypal.payment')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }

    }

    public function paymentSuccess(ValidatorRequest $request)
    {
        // dd($request);
    // Accessing data from session
        $web_booking_value=0;
        $amount = $request->amount;
        $payment_for = $request->payment_for;
        $request_id = $request->request_id ?? " ";
        $user_id = $request->user_id;

        // dd($user_id);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED')
        {
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

        } else {
            return redirect()
                ->route('paypal')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    public function paymentCancel()
    {
        return redirect()
              ->route('paypal')
              ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
    public function viewServices()
    {
        $page = trans('pages_names.dashboard');
        $main_menu = 'dashboard';
        $sub_menu = null;
        return view('admin.admin.services', compact('page', 'main_menu', 'sub_menu'));
    }


}
