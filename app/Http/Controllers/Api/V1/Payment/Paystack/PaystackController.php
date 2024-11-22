<?php

namespace App\Http\Controllers\Api\V1\Payment\Paystack;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Base\Constants\Auth\Role;
use App\Http\Controllers\ApiController;
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
use App\Base\Constants\Setting\Settings;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Jobs\NotifyViaMqtt;
use App\Base\Constants\Masters\PushEnums;
use App\Models\Payment\OwnerWallet;
use App\Models\Payment\OwnerWalletHistory;
use App\Transformers\Payment\OwnerWalletTransformer;
use App\Models\Request\Request as RequestModel;
use Kreait\Firebase\Contract\Database;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Jobs\Notifications\SendPushNotification;

/**
 * @group Paystack Payment Gateway
 *
 * Payment-Related Apis
 */
class PaystackController extends ApiController
{

     public function __construct(Database $database)
    {
        $this->database = $database;
    }
    /**
     * Initialize Payment
     * 
     * 
     * 
     * */
    public function initialize(Request $request){

        $paystack_initialize_url = 'https://api.paystack.co/transaction/initialize';

        if(get_settings(Settings::PAYSTACK_ENVIRONMENT)=='test'){

            $secret_key = get_settings(Settings::PAYSTACK_TEST_SECRET_KEY);

        }else{

            $secret_key = get_settings(Settings::PAYSTACK_PRODUCTION_SECRET_KEY);

        }
        $headers = [
            'Authorization:Bearer '.$secret_key,
            'Content-Type:application/json'
            ];

        $customer_email = auth()->user()->email;

        $amount = $request->amount;

        $request_for = 'add-money-to-wallet';

        $current_timestamp = Carbon::now()->timestamp;

        $reference = auth()->user()->id;


        if($request->has('payment_for')){

        $request_for = $request->payment_for;

        }
        $query = [
            'email'=> $customer_email,
            'amount'=>$request->amount,
            'reference'=>$current_timestamp.'-----'.$reference.'-----'.$request_for

            ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $paystack_initialize_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);


        if ($result) {
            $result = json_decode($result);  

            return response()->json($result);
        }
        
        return $this->respondFailed();



    }



    /**
     *
     *
     *
     * */
    public function webHook(Request $request)
    {
        $response = $request->all();
        if($response == null){
            goto end;
        }
        $results = json_decode(json_encode($request->all()));
        
        // $transaction_id = $request->data['id'];
        
        $exploded_reference = explode('-----', $results->reference);

        if(count($exploded_reference)<2){
            goto end;
        }
        $user_id = $exploded_reference[1];

        
        if(get_settings(Settings::PAYSTACK_ENVIRONMENT)=='test'){

            $secret_key = get_settings(Settings::PAYSTACK_TEST_SECRET_KEY);

        }else{

            $secret_key = get_settings(Settings::PAYSTACK_PRODUCTION_SECRET_KEY);

        }
        $headers = [
            'Authorization:Bearer '.$secret_key,
            'Content-Type:application/json'
            ];
        $curl = curl_init(); 
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$results->reference,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => $headers
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        if ($err) {
            return $this->respondFailed();
        }
        curl_close($curl);
        $result = json_decode($response);
        $requested_amount = ($result->data->amount/100);
        $transaction_id = $result->data->id; 
        $user = User::find($user_id);
        $user->authorization_code = $result->data->authorization->authorization_code;
        $user->save();

        if($exploded_reference[2]!='add-money-to-wallet'){

            $this->makePaymentForRide($exploded_reference[2],$transaction_id);

            goto end;
        }
        if($user==null){
            goto end;
        }
        if ($user->hasRole('user')) {
        $wallet_model = new UserWallet();
        $wallet_add_history_model = new UserWalletHistory();
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
        $user_wallet->amount_added += $requested_amount;
        $user_wallet->amount_balance += $requested_amount;
        $user_wallet->save();
        $user_wallet->fresh();

        $wallet_add_history_model::create([
            'user_id'=>$user_id,
            'amount'=>$requested_amount,
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

                end:

               $result = $this->respondSuccess(null,'money_added_successfully');


    }



    /**
     * Make Payment At end of the ride
     * 
     * */
    public function makePaymentForRide($request_id,$transaction_id){

        $request_detail = RequestModel::find($request_id); 
        
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

        dispatch(new SendPushNotification($driver->user,$title,$body));

        return;

    }
    public function make_recurring_charges(Request $request)
    { 
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $url = "https://api.paystack.co/transaction/charge_authorization";
        if($user->authorization_code == null)
        {
            goto end;
        }
        $fields = [
          'authorization_code' => $user->authorization_code,
          'email' => $user->email,
          'amount' => $request->amount
        ]; 
        $fields_string = json_encode($fields);

        if(get_settings(Settings::PAYSTACK_ENVIRONMENT)=='test'){

            $secret_key = get_settings(Settings::PAYSTACK_TEST_SECRET_KEY);

        }else{

            $secret_key = get_settings(Settings::PAYSTACK_PRODUCTION_SECRET_KEY);

        }
        $headers = [
            'Authorization:Bearer '.$secret_key,
            'Content-Type:application/json'
            ];
      
        //open connection
        $ch = curl_init();
        
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        
        //execute post
        $response = curl_exec($ch);
        $result = json_decode($response);
        $requested_amount = ($result->data->amount/100);
        $transaction_id = $result->data->id;
        $request_for = 'add-money-to-wallet'; 
        $current_timestamp = Carbon::now()->timestamp; 
        $reference = auth()->user()->id; 
        if($request->has('payment_for')){ 
        $request_for = $request->payment_for; 
        }
        if($request_for != 'add-money-to-wallet'){  
            $this->makePaymentForRide($request_for,$transaction_id); 
            goto end;
        }
        if($user==null){
            goto end;
        }
        if ($user->hasRole('user')) {
        $wallet_model = new UserWallet();
        $wallet_add_history_model = new UserWalletHistory();
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
        $user_wallet->amount_added += $requested_amount;
        $user_wallet->amount_balance += $requested_amount;
        $user_wallet->save();
        $user_wallet->fresh();

        $wallet_add_history_model::create([
            'user_id'=>$user_id,
            'amount'=>$requested_amount,
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

                end:

                $response = [
                    "status"=>true,
                    "message"=>"money_added_successfully"
                ];
                return response()->json($response);
    }


    
}
