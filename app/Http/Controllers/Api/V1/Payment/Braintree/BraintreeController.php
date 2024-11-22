<?php

namespace App\Http\Controllers\Api\V1\Payment\Braintree;

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
use App\Base\Constants\Setting\Settings;

/**
 * @group Braintree Payment Gateway
 *
 * Payment-Related Apis
 */
class BraintreeController extends ApiController
{


    
    /**
    * Get Client token for brain tree
    * @response {
    "success": true,
    "message": "success",
    "data": {
        "client_token": "eyJ2ZXJzaW9uIjoyLCJhdXRob3JpemF0aW9uRmluZ2VycHJpbnQiOiJleUowZVhBaU9pSktWMVFpTENKaGJHY2lPaUpGVXpJMU5pSXNJbXRwWkNJNklqSXdNVGd3TkRJMk1UWXRjMkZ1WkdKdmVDSXNJbWx6Y3lJNklrRjFkR2g1SW4wLmV5SmxlSEFpT2pFMU9URTBOalE1TnpZc0ltcDBhU0k2SWpGbFpUZG1aREExTFRJNU1qRXRORGt4TWkxaFlXSmpMVEJtTTJVMVpUVXlPVEkzWVNJc0luTjFZaUk2SW5CM1l6Sm9aRFEyWnpremN6UjZlVElpTENKcGMzTWlPaUpCZFhSb2VTSXNJb"
    }
    }
    */
    public function getClientToken()
    {
        $braintree_object = new BraintreeTask();
        $gateway = $braintree_object->run();
        $client_token = $gateway->clientToken()->generate();

        return $this->respondSuccess(['client_token'=>$client_token],'braintree_token_listed_success');
    }

    /**
    * Add money to wallet
    * @bodyParam amount double required  amount entered by user
    * @bodyParam payment_nonce string required  payment nonce added by by user
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
        
        $user_currency_code = get_settings('currency_code');
        
        // Convert the amount to USD to any currency
        $converted_amount_array =  convert_currency_to_usd($user_currency_code, $request->input('amount'));

        $converted_amount = $converted_amount_array['converted_amount'];
        $converted_type = $converted_amount_array['converted_type'];

        // Transaction
        $braintree_object = new BraintreeTask();
        $gateway = $braintree_object->run();

         $tranfer = $gateway->transaction()->sale([
           'amount' => number_format($converted_amount, 2),
           'paymentMethodNonce' => $request->input('payment_nonce'),
           'options' => [
               'submitForSettlement' => true
           ]
        ]);


        if ($tranfer->success) {
            
            $merchant  = $tranfer->transaction->merchantAccountId;
            $conversion = $converted_type.':'.$request->amount.'-'.$converted_amount;
            $transaction_id = $tranfer->transaction->id;

            if (access()->hasRole('user')) {
            $wallet_model = new UserWallet();
            $wallet_add_history_model = new UserWalletHistory();
            $user_id = auth()->user()->id;
        } else {
            $wallet_model = new DriverWallet();
            $wallet_add_history_model = new DriverWalletHistory();
            $user_id = auth()->user()->driver->id;
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
            'conversion'=>$conversion,
            'merchant'=>$merchant,
            'remarks'=>WalletRemarks::MONEY_DEPOSITED_TO_E_WALLET,
            'is_credit'=>true]);


        } else {

            $this->throwCustomException('unable to detect amount from this card');
            
        }

        if (access()->hasRole(Role::USER)) {
            $result =  fractal($user_wallet, new WalletTransformer);
        } else {
            $result =  fractal($user_wallet, new DriverWalletTransformer);
        }

        return $this->respondSuccess($result, 'money_added_successfully');
    }

    
}
