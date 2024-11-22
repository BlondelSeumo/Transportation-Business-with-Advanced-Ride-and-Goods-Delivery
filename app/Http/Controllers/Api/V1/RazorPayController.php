<?php
  
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
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
  
class RazorPayController extends Controller
{
    protected $api;


    public function __construct(Database $database)
    {
        $environment =  get_settings('razor_pay_environment');
       
        if ($environment=="test") {
            $keySecret =  get_settings('razor_pay_test_secrect_key');
            $keyId =  get_settings('razor_pay_test_api_key');
        }else{
            $keySecret =  get_settings('razor_pay_secrect_key');
            $keyId =  get_settings('razor_pay_live_api_key');
        }

        $this->database = $database;

        $this->api = new Api($keyId, $keySecret);
    }
      
    public function razorpay(Request $request)
    {
        // Log::info("test api v1");
        // Log::info($request->all());

        // $keyId = "rzp_test_b444CSYRGAtdnV";  // Replace with your test key ID
        // $keySecret = "Q8ABpY18WPsyJ8LGvqGZR70l"; // Replace with your test key secret
       
        $environment =  get_settings('razor_pay_environment');
       
        if ($environment=="test") {
            $keySecret =  get_settings('razor_pay_test_secrect_key');
            $keyId =  get_settings('razor_pay_test_api_key');
        }else{
            $keySecret =  get_settings('razor_pay_secrect_key');
            $keyId =  get_settings('razor_pay_live_api_key');
        }

// dd($keyId);

        $user = User::find(request()->input('user_id'));

        // Extract parameters from the request
        $amount = ($request->input('amount') * 100 );
        $name = $user->name ?? 'bala';
        $email = $user->email ?? 'balathemask@gmail.com';
        $mobile = $user->mobile ?? '9790200663';
        $currency = $user->countryDetail ? $user->countryDetail->currency_code : 'INR';

        $payment_for = $request->input('payment_for');
        $request_id = $request->input('request_id') ?? "test";


        // Create an order
        $order = $this->api->order->create([
            'amount' => $amount, // amount in paisa
            'currency' => $currency,
            'receipt' => 'order_' . time(),
            'payment_capture' => 1 // auto capture
        ]);

        // Ensure that the order ID is passed correctly to the view
        return view('Razorpay.razorpay', ['order' => $order, 'key' => $keyId, 'payment_for' => $payment_for, 'request_id' => $request_id, 'user' => $user, 'amount'=>$request->input('amount'), 'currency' => $currency]);
    }


    public function razorpay_success()
    {
// Log::info("razor pay sucess from api/v1");

// Log::info(request()->all());
// dd(request()->all());
       $payment_for = request()->input('payment_for');

        if ($payment_for=="wallet") {

         $user = User::find(request()->input('user_id'));
            
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
        $user_wallet->amount_added += request()->input('amount');
        $user_wallet->amount_balance += request()->input('amount');
        $user_wallet->save();
        $user_wallet->fresh();

        $wallet_add_history_model::create([
            'user_id'=>$user_id,
            'amount'=>request()->input('amount'),
            'transaction_id'=>request()->input('order_id'),
            'remarks'=>WalletRemarks::MONEY_DEPOSITED_TO_E_WALLET,
            'is_credit'=>true]);

        
                // $title = trans('push_notifications.amount_credited_to_your_wallet_title');
                // $body = trans('push_notifications.amount_credited_to_your_wallet_body');
                
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

            $request_id = request()->input('request_id');
            // Log::info($request_id);

             $request_detail = RequestModel::where('id', $request_id)->first();

            $request_detail->update(['is_paid' => true]);     
             
             $this->database->getReference('requests/'.$request_detail->id)->update(['is_paid'=>1]);   


        }


        return view('success',['success']);

    }
  
} 