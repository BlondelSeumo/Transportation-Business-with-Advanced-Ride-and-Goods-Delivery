<?php

namespace App\Http\Controllers\Api\V1\Payment\Cashfree;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Base\Constants\Auth\Role;
use App\Http\Controllers\ApiController;
use App\Models\Payment\UserWalletHistory;
use App\Models\Payment\DriverWalletHistory;
use App\Transformers\Payment\WalletTransformer;
use App\Transformers\Payment\DriverWalletTransformer;
use App\Transformers\Payment\UserWalletHistoryTransformer;
use App\Transformers\Payment\DriverWalletHistoryTransformer;
use Illuminate\Support\Facades\Log;
use App\Models\Payment\DriverWallet;
use App\Http\Requests\Payment\AddBeneficary;
use App\Base\Constants\Masters\WalletRemarks;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Http\Requests\Payment\TransferToBankAccount;
use App\Http\Requests\Payment\GenerateCfTokenRequest;
use App\Traits\BeneficaryTrait;
use App\Base\Constants\Setting\Settings;
use App\Models\User;
use App\Base\Constants\Masters\PushEnums;
use App\Jobs\NotifyViaMqtt;
use App\Models\Payment\UserWallet;
use App\Models\Payment\OwnerWallet;
use App\Models\Payment\OwnerWalletHistory;
use App\Transformers\Payment\OwnerWalletTransformer;
use App\Jobs\Notifications\SendPushNotification;


/**
 * @group Cash-free Paymentgateway
 *
 * Payment-Related Apis
 */
class CashfreePaymentController extends ApiController
{
    use BeneficaryTrait;


    /**
    * Generate Cash free cftoken for request
    * @bodyParam order_amount double required amount of an request
    * @bodyParam order_currency string required currency of an request
    * @response {
    *"status": "OK",
    *"message": "Token generated",
    *"cftoken": "HV9JCN4MzUIJiOicGbhJCLiQ1VKJiOiAXe0Jye.Ak0nIhlDMyYjYwEjNyMDM2IiOiQHbhN3XiwSO3MjNwUjNxYTM6ICc4VmIsIiUOlkI6ISej5WZyJXdDJXZkJ3biwiIwUjLwATNiojI05Wdv1WQyVGZy9mIsIyMFVkUG1CSTF0QiojIklkclRmcvJye.3KQy5TaKbbLDuBc-BNNRBLWPGlLBA94OMov1b7iCVKdQJn8ejEyrvV1Lk3Ad8QNt-B"
    *}
    */
    public function generateCftoken(GenerateCfTokenRequest $request)
    {
        $cash_free_url = 'https://sandbox.cashfree.com/pg/orders';
        $headers = [
            'x-client-id:'.get_settings(Settings::CASH_FREE_TEST_APP_ID),
            'x-client-secret:'.get_settings(Settings::CASH_FREE_SECRET_KEY),
            'x-api-version:"2023-08-01"',
            'Content-Type:application/json'
            ];

        if(get_settings(Settings::CASH_FREE_ENVIRONMENT)=='production'){
            $headers = [
            'x-client-id:'.get_settings(Settings::CASH_FREE_PRODUCTION_APP_ID),
            'x-client-secret:'.get_settings(Settings::CASH_FREE_PRODUCTION_SECRET_KEY),
            'Content-Type:application/json'
            ];

            $cash_free_url = 'https://api.cashfree.com/pg/orders';

        }
      
        $current_timestamp = Carbon::now()->timestamp;

        $orderId = env('APP_NAME').'-'.$current_timestamp.'---'.auth()->user()->id;
        $query = [
            'order_id'=> $orderId,
            'order_amount'=>$request->order_amount,
            'order_currency'=>$request->order_currency
        ];

        // dd($cash_free_url);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $cash_free_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);

        // dd($result);

        if ($result) {
            $result = json_decode($result);
            $result->success = true;
            $result->orderId = $orderId;
            return response()->json($result);
        }

        return $this->respondFailed();

        $braintree_object = new BraintreeTask();
        $gateway = $braintree_object->run();
        $client_token = $gateway->clientToken()->generate();

        return $this->respondSuccess(['client_token'=>$client_token]);
    }


    public function token()
    {
        $token =  $this->getToken();

        return response()->json(['success'=>true,'message'=>'token_generated','token'=>$token
       ]);
    }


    public function addBeneficary(AddBeneficary $request)
    {
        $beneficiary = $request->all();
        $beneficiary['name'] = auth()->user()->name;
        $beneficiary['email'] = (auth()->user()->email)?auth()->user()->email:generateRandomEmail();
        $beneficiary['phone'] = auth()->user()->mobile;

        // https://dev.cashfree.com/bank-account-verification/bank-validation/testing

        // $beneficiary = $request->all();
        // $beneficiary['name'] = 'vicky';
        // $beneficiary['email'] = generateRandomEmail();
        // $beneficiary['phone'] = '9361380603';

        $beneId = $this->addBeneficiary($beneficiary);

        $beneficiaryArray = $request->all();
        $beneficiaryArray['beneId'] = $beneId;
        $beneficiaryArray['user_id'] = auth()->user()->id;

        Benefits::create($beneficiaryArray);

        return response()->json(['success'=>true,'message'=>'beneficary_created_successfully']);
    }

    /**
    * Get beneficiary
    * @hideFromAPIDocumentation
    * 
    */
    public function getBeneficary()
    {
        $beneficiary = Benefits::where('user_id', auth()->user()->id)->first();

        return response()->json(['success'=>true,'message'=>'beneficary_list','beneficary'=>$beneficiary ]);
    }


    /**
     * @bodyParam orderId string required order id of the request
     * @bodyParam orderAmount double required order amount of the request
     * @bodyParam referenceId string required reference id of the request
     * @bodyParam txStatus string required txStatus of the request
     * @bodyParam paymentMode string required paymentMode of the request
     * @bodyParam txMsg string required txMsg of the request
     * @bodyParam txTime string required txTime of the request
     * @bodyParam signature string required signature of the request
     * 
     * */
    public function addMoneyToWalletwebHooks(Request $request)
    {
        try {
            $response = $request->all();


            $secretkey = get_settings(Settings::CASH_FREE_SECRET_KEY);

            if(get_settings(Settings::CASH_FREE_ENVIRONMENT)=='production'){

                $secretkey = get_settings(Settings::CASH_FREE_PRODUCTION_SECRET_KEY);

            }

        $orderId = $request->orderId;//$_POST["orderId"];
        $orderAmount = $request->orderAmount;//$_POST["orderAmount"];
        $referenceId = $request->referenceId;//$_POST["referenceId"];
        $txStatus = $request->txStatus;//$_POST["txStatus"];
        $paymentMode = $request->paymentMode;//$_POST["paymentMode"];
        $txMsg = $request->txMsg;//$_POST["txMsg"];
        $txTime = $request->txTime;//$_POST["txTime"];
        $signature = $request->signature;//$_POST["signature"];
        $data = $orderId.$orderAmount.$referenceId.$txStatus.$paymentMode.$txMsg.$txTime;
            $hash_hmac = hash_hmac('sha256', $data, $secretkey, true) ;
            $computedSignature = base64_encode($hash_hmac);

            $id = explode('---', $orderId);
            $user = User::find($id[1]);


            if ($signature == $computedSignature) {
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

                $user_wallet = $wallet_model::firstOrCreate(['user_id'=>$user_id]);
                $user_wallet->amount_added += $orderAmount;
                $user_wallet->amount_balance += $orderAmount;
                $user_wallet->save();
                $user_wallet->fresh();

                $wallet_add_history_model::create([
                'user_id'=>$user_id,
                'card_id'=>null,
                'amount'=>$orderAmount,
                'transaction_id'=>$referenceId,
                'conversion'=>null,
                'merchant'=>null,
                'remarks'=>WalletRemarks::MONEY_DEPOSITED_TO_E_WALLET,
                'is_credit'=>true
            ]);

                $pus_request_detail = json_encode($request->all());
                $push_data = ['notification_enum'=>PushEnums::AMOUNT_CREDITED,'result'=>(string)$pus_request_detail];

                $socket_data = new \stdClass();
                $socket_data->success = true;
                $socket_data->success_message  = PushEnums::AMOUNT_CREDITED;
                $socket_data->result = $request->all();

                // $title = trans('push_notifications.amount_credited_to_your_wallet_title');
                // $body = trans('push_notifications.amount_credited_to_your_wallet_body');

                $title = trans('push_notifications.amount_credited_to_your_wallet_title', [], $user->lang);

                $body = trans('push_notifications.amount_credited_to_your_wallet_body', [], $user->lang);

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

            } else {
                if ($user) {
                    $pus_request_detail = json_encode($request->all());
                    $push_data = ['notification_enum'=>PushEnums::CARD_TO_WALLET_TRANSACTION_FAILED,'result'=>(string)$pus_request_detail];

                    $socket_data = new \stdClass();
                    $socket_data->success = true;
                    $socket_data->success_message  = PushEnums::CARD_TO_WALLET_TRANSACTION_FAILED;
                    $socket_data->result = $request->all();

                    // $title = trans('push_notifications.transaction_failed_title');
                    // $body = trans('push_notifications.transaction_failed_body');

                    $title = trans('push_notifications.transaction_failed_title', [], $user->lang);
                    $body = trans('push_notifications.transaction_failed_body', [], $user->lang);

                    dispatch(new SendPushNotification($user,$title,$body));

                    return $this->respondFailed();

                }
            }
        } catch (\Exception $e) {
            Log::error($e);
            Log::error('Error while Add money to wallet. Input params : ' . json_encode($request->all()));
            return $this->respondBadRequest('Unknown error occurred. Please try again later or contact us if it continues.');
        }
    }


}