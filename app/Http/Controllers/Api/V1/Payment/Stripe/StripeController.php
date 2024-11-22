<?php

namespace App\Http\Controllers\Api\V1\Payment\Stripe;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Payment\CardInfo;
use App\Base\Constants\Auth\Role;
use App\Http\Controllers\ApiController;
use App\Models\Payment\UserWalletHistory;
use App\Models\Payment\DriverWalletHistory;
use App\Transformers\Payment\WalletTransformer;
use App\Base\Payment\BrainTreeTasks\BraintreeTask;
use App\Transformers\Payment\DriverWalletTransformer;
use App\Http\Requests\Payment\AddMoneyToWalletRequest;
use App\Transformers\Payment\UserWalletHistoryTransformer;
use App\Transformers\Payment\DriverWalletHistoryTransformer;
use App\Models\Payment\UserWallet;
use App\Models\Payment\DriverWallet;
use App\Base\Constants\Masters\WalletRemarks;
use App\Models\Payment\DriverSubscription;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Jobs\NotifyViaMqtt;
use App\Base\Constants\Masters\PushEnums;
use App\Base\Constants\Setting\Settings;
use App\Models\Payment\OwnerWallet;
use App\Models\Payment\OwnerWalletHistory;
use App\Transformers\Payment\OwnerWalletTransformer;
use App\Models\Request\Request as RequestModel;
use Kreait\Firebase\Contract\Database;
use App\Jobs\Notifications\SendPushNotification;


/**
 * @group Stripe Payment Gateway
 *
 * Payment-Related Apis
 */
class StripeController extends ApiController
{


    public function __construct(Database $database)
    {
        $this->database = $database;
    }
     /**
     * Setup a client secret
     * @response {
    "success": true,
    "success_message": "Client_token",
    "client_token": "seti_1IudOHSBCHfacuRq1epLsfPl_secret_JXipcwKp89e20po0gexe23CyoZIiDCp"
    }
     *
     */
    public function createStripeIntent(Request $request){

           if(get_settings(Settings::STRIPE_ENVIRONMENT)=='test'){

            $secret_key = get_settings(Settings::STRIPE_TEST_SECRET_KEY);

            $test_environment = true;


            \Stripe\Stripe::setApiKey($secret_key);
        }else{

            $secret_key = get_settings(Settings::STRIPE_LIVE_SECRET_KEY);

            \Stripe\Stripe::setApiKey($secret_key);

            $test_environment = false;



        }

        $user = auth()->user();

        $create_customer_data = [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->mobile,
                'address' => [
                'line1' => '510 Townsend St',
                'postal_code' => '98140',
                'city' => 'San Francisco',
                'state' => 'CA',
                'country' => 'US',
                ],
                // 'payment_method' => $request->payment_nonce,
                // 'source' => "tok_visa"
            ];

        $customer = \Stripe\Customer::create($create_customer_data);


            $user_currency_code = auth()->user()->countryDetail->currency_code;
            // $user_currency_code = get_settings('currency_code');

            $setup_intent = \Stripe\PaymentIntent::create([
                'amount' => $request->amount *100,
                'currency'=> strtolower($user_currency_code),
                'description' => 'Add Money To Wallet',
                'shipping' => [
      'name' => $user->name,
      'address' => [
        'line1' => '510 Townsend St',
        'postal_code' => '98140',
        'city' => 'San Francisco',
        'state' => 'CA',
        'country' => 'US',
      ],
    ],
            ]);
        
        // $setup_intent = SetupIntent::create();
        $obj = new \stdClass;
        $obj->message = "Client_token";
        $obj->token = $setup_intent->client_secret;


        return $this->respondSuccess([
                "client_token" => $obj->token,
                "customer_id"=>$customer->id,
                "test_environment"=>$test_environment,
            ],'stripe_key_listed_success');

    }
    /**
    * Add money to wallet
    * @bodyParam amount double required  amount entered by user
    * @bodyParam payment_id string required  payment_id from transaction
    * @response {
    "success": true,
    "message": "money_added_successfully",
    "data": {
        "id": "1195a787-ba13-4a74-b56c-c48ba4ca0ca0",
        "user_id": 15,
        "amount_added": 2500,
        "amount_balance": 2500,
        "amount_spent": 0,
        "currency_code": "INR",
        "created_at": "1st Sep 10:45 PM",
        "updated_at": "1st Sep 10:51 PM"
    }
}
    */
    public function addMoneyToWallet(AddMoneyToWalletRequest $request)
    {
            $transaction_id = $request->payment_id;
            $user = auth()->user();
        
            if (access()->hasRole('user')) {
            $wallet_model = new UserWallet();
            $wallet_add_history_model = new UserWalletHistory();
            $user_id = auth()->user()->id;
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
        $user_wallet->amount_added += $request->amount;
        $user_wallet->amount_balance += $request->amount;
        $user_wallet->save();
        $user_wallet->fresh();

        $wallet_add_history_model::create([
            'user_id'=>$user_id,
            'amount'=>$request->amount,
            'transaction_id'=>$transaction_id,
            'remarks'=>WalletRemarks::MONEY_DEPOSITED_TO_E_WALLET,
            'is_credit'=>true]);


                $pus_request_detail = json_encode($request->all());
        
                $socket_data = new \stdClass();
                $socket_data->success = true;
                $socket_data->success_message  = PushEnums::AMOUNT_CREDITED;
                $socket_data->result = $request->all();

                $title = trans('push_notifications.amount_credited_to_your_wallet_title',[],$user->lang);
                $body = trans('push_notifications.amount_credited_to_your_wallet_body',[],$user->lang);

                // dispatch(new NotifyViaMqtt('add_money_to_wallet_status'.$user_id, json_encode($socket_data), $user_id));
                
                dispatch(new SendPushNotification($user,$title,$body));

                if (access()->hasRole(Role::USER)) {
                $result =  fractal($user_wallet, new WalletTransformer);
                } elseif(access()->hasRole(Role::DRIVER)) {
                $result =  fractal($user_wallet, new DriverWalletTransformer);
                }else{
                $result =  fractal($user_wallet, new OwnerWalletTransformer);

                }

        return $this->respondSuccess($result, 'money_added_successfully');
    }

    /**
     * Make payment at end of the ride
     * @bodyParam amount double required  amount of the invoice
     * @bodyParam request_id string required  request_id of invoice
     * @bodyParam payment_id string required  payment_id from transaction
     * 
     * */
    public function makePaymentForRide(Request $request){

        $request->validate([
        'request_id' => 'required|exists:requests,id',
        ]);

        $transaction_id = $request->payment_id;
        $user = auth()->user();

        $request_detail = RequestModel::find($request->request_id); 

        $driver = $request_detail->driverDetail;    

        //  Update payement status
        $request_detail->is_paid = 1;

        $request_detail->save();

        $driver_commision = $request_detail->requestBill->driver_commision;

        $user_wallet = DriverWallet::firstOrCreate([
            'user_id'=>$driver->id]);

        $user_wallet->amount_added += $driver_commision;
        $user_wallet->amount_balance += $driver_commision;
        $user_wallet->save();
        $user_wallet->fresh();

        DriverWalletHistory::create([
            'user_id'=>$driver->id,
            'amount'=>$driver_commision,
            'transaction_id'=>$transaction_id,
            'remarks'=>WalletRemarks::TRIP_COMMISSION_FOR_DRIVER,
            'is_credit'=>true]);

        $this->database->getReference('requests/'.$request_detail->id)->update(['is_paid'=>1,'updated_at'=> Database::SERVER_TIMESTAMP]);

        $title = trans('push_notifications.payment_completed_by_user_title',[],$driver->user->lang);
        $body = trans('push_notifications.payment_completed_by_user_body',[],$driver->user->lang);

        dispatch(new SendPushNotification($driver->user,$title,$body));;


        return $this->respondSuccess(null,'payment_completed_successfully');


    }

    /**
     * Add/update Subscription
     * 
     * */
    public function addOrUpdateSubscription(Request $request)
    {

        $driver_id = auth()->user()->driver->id;

        $driver_subscription = DriverSubscription::create([
            'driver_id'=>$driver_id,
            'subscription_type'=>$request->subscription_type,
            'paid_amount'=>$request->paid_amount,
            'expired_at'=>$request->expired_at,
            'transaction_id'=>$request->transaction_id]);

        $result =  fractal($user_wallet, new DriverSubscriptionTransformer);

        return $this->respondSuccess($result, 'subscription_added_successfully');


    }

    
}
