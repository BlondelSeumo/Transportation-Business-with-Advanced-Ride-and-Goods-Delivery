<?php

namespace App\Http\Controllers\Api\V1\Payment;

use App\Models\User;
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
use App\Transformers\Payment\WalletWithdrawalRequestsTransformer;
use App\Models\Payment\WalletWithdrawalRequest;
use App\Http\Controllers\Api\V1\BaseController;
use App\Base\Constants\Masters\WithdrawalRequestStatus;
use App\Base\Constants\Setting\Settings;
use App\Models\Payment\OwnerWalletHistory;
use App\Transformers\Payment\OwnerWalletHistoryTransformer;
use App\Models\Payment\UserWallet;
use App\Models\Payment\DriverWallet;
use App\Models\Payment\OwnerWallet;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Jobs\Notifications\SendPushNotification;
use Illuminate\Support\Facades\Log;

/**
 * @group Payment
 *
 * Payment-Related Apis
 */
class PaymentController extends BaseController
{
    protected $gateway;

    protected $callable_gateway_class;


    public function __construct()
    {
        $this->gateway = env('PAYMENT_GATEWAY');
        $this->callable_gateway_class = app(config('base.payment_gateway.' . $this->gateway . '.class'));
    }

    /**
     * User-Add Card
     * @bodyParam payment_nonce string required  Payment nonce fron entered value
     * @return \Illuminate\Http\JsonResponse
     * @response {
     *"success": true,
     *"message": "card_added_succesfully",
     *"data": [
     *{
     *"id": "33f6a61d-4ddc-47dc-a601-250672dbc405",
     *"customer_id": "customer_765_6",
     *"merchant_id": "pwc2hd46g93s4zy2",
     *"card_token": "79dhmq",
     *"last_number": 521,
     *"card_type": "VISA",
     *"valid_through":"12/2021",
     *"user_id": 6,
     *"is_default": 0,
     *"user_role": "driver",
     *"created_at": "2019-05-06 13:17:40",
     *"updated_at": "2019-05-06 13:17:40",
     *"deleted_at": null
     *}
     *]
     *}
     */
    public function addCard(Request $request)
    {
        $result = $this->callable_gateway_class->addCard($request);

        return $this->respondSuccess($result, 'card_added_succesfully');
    }

    /**
     * List cards
     * @return \Illuminate\Http\JsonResponse
     * @response {
     * "success": true,
     * "message": "card_listed_succesfully",
     * "data": [
     * {
     * "id": "33f6a61d-4ddc-47dc-a601-250672dbc405",
     * "customer_id": "customer_765_6",
     * "merchant_id": "pwc2hd46g93s4zy2",
     * "card_token": "79dhmq",
     * "last_number": 521,
     * "card_type": "VISA",
     * "user_id": 6,
     * "is_default": 0,
     * "user_role": "driver",
     * "valid_through":"12/2021",
     * "created_at": "2019-05-06 13:17:40",
     * "updated_at": "2019-05-06 13:17:40",
     * "deleted_at": null
     * }
     * ]
     * }
     */
    public function listCards()
    {
        $result = $this->callable_gateway_class->listCards();

        return $this->respondSuccess($result, 'card_listed_succesfully');
    }

    /**
     * Make card as default card
     * @bodyParam card_id uuid required card id choosen by user
     * @response {
     * "success": true,
     * "message": "card_made_default_succesfully"
     * }
     */
    public function makeDefaultCard(Request $request)
    {
        $this->callable_gateway_class->makeDefaultCard($request);

        return $this->respondSuccess($data = null, 'card_made_default_succesfully');
    }


    /**
     * Delete Card
     * @response {
     * "success": true,
     * "message": "card_deleted_succesfully"
     * }
     */
    public function deleteCard(CardInfo $card)
    {
        $this->callable_gateway_class->deleteCard($card);

        return $this->respondSuccess($data = null, 'card_deleted_succesfully');
    }

    /**
     * Get Client token for brain tree
     * @response {
     * "success": true,
     * "message": "success",
     * "data": {
     * "client_token": "eyJ2ZXJzaW9uIjoyLCJhdXRob3JpemF0aW9uRmluZ2VycHJpbnQiOiJleUowZVhBaU9pSktWMVFpTENKaGJHY2lPaUpGVXpJMU5pSXNJbXRwWkNJNklqSXdNVGd3TkRJMk1UWXRjMkZ1WkdKdmVDSXNJbWx6Y3lJNklrRjFkR2g1SW4wLmV5SmxlSEFpT2pFMU9URTBOalE1TnpZc0ltcDBhU0k2SWpGbFpUZG1aREExTFRJNU1qRXRORGt4TWkxaFlXSmpMVEJtTTJVMVpUVXlPVEkzWVNJc0luTjFZaUk2SW5CM1l6Sm9aRFEyWnpremN6UjZlVElpTENKcGMzTWlPaUpCZFhSb2VTSXNJb"
     * }
     * }
     */
    public function getClientToken()
    {
        $braintree_object = new BraintreeTask();
        $gateway = $braintree_object->run();
        $client_token = $gateway->clientToken()->generate();

        return $this->respondSuccess(['client_token' => $client_token]);
    }

    /**
     * Add money to wallet
     * @bodyParam amount double required  amount entered by user
     * @bodyParam card_id uuid required  card_id choosed by user
     * @response {
     * "success": true,
     * "message": "money_added_successfully",
     * "data": {
     * "id": "1195a787-ba13-4a74-b56c-c48ba4ca0ca0",
     * "user_id": 15,
     * "amount_added": 2500,
     * "amount_balance": 2500,
     * "amount_spent": 0,
     * "currency_code": "INR",
     * "created_at": "1st Sep 10:45 PM",
     * "updated_at": "1st Sep 10:51 PM"
     * }
     * }
     */
    public function addMoneyToWallet(AddMoneyToWalletRequest $request)
    {
        $user_wallet = $this->callable_gateway_class->addMoneyToWallet($request);

        if (access()->hasRole(Role::USER)) {
            $result = fractal($user_wallet, new WalletTransformer);
        } else {
            $result = fractal($user_wallet, new DriverWalletTransformer);
        }

        return $this->respondSuccess($result, 'money_added_successfully');
    }

    /**
     * Wallet history
     * @responseFile responses/payment/wallet_added_history.json
     */
    public function walletHistory()
    {
        if (access()->hasRole(Role::USER)) {
            $query = UserWalletHistory::where('user_id', auth()->user()->id);
            // $result = fractal($query, new UserWalletHistoryTransformer);
            $result = filter($query, new UserWalletHistoryTransformer)->defaultSort('-created_at')->paginate();

            $user_wallet = auth()->user()->userWallet;

            $wallet_balance = number_format($user_wallet->amount_balance ?? 0,2);
            
            $currency_code = auth()->user()->countryDetail->currency_code;
            $currency_symbol = auth()->user()->countryDetail->currency_symbol;

            // $currency_code = get_settings('currency_code');
            // $currency_symbol = get_settings('currency_symbol');
            $default_card = CardInfo::where('user_id', auth()->user()->id)->where('is_default', true)->first();
            $default_card_id = null;
            if ($default_card) {
                $default_card_id = $default_card->id;
            }

        } elseif (access()->hasRole(Role::DRIVER)) {
            $query = DriverWalletHistory::where('user_id', auth()->user()->driver->id)->orderBy('created_at', 'desc');
            $result = filter($query, new DriverWalletHistoryTransformer)->defaultSort('-created_at')->paginate();

            $driver_wallet = auth()->user()->driver->driverWallet;

            $wallet_balance = $driver_wallet->amount_balance;

            $currency_code = auth()->user()->countryDetail->currency_code;
            $currency_symbol = auth()->user()->countryDetail->currency_symbol;

            // $currency_code = get_settings('currency_code');
            // $currency_symbol = get_settings('currency_symbol');

            $default_card = CardInfo::where('user_id', auth()->user()->id)->where('is_default', true)->first();
            $default_card_id = null;
            if ($default_card) {
                $default_card_id = $default_card->id;
            }
        } else {

            $query = OwnerWalletHistory::where('user_id', auth()->user()->owner->id)->orderBy('created_at', 'desc');
            $result = filter($query, new OwnerWalletHistoryTransformer)->defaultSort('-created_at')->paginate();

            $owner_wallet = auth()->user()->owner->ownerWalletDetail;

            if (!$owner_wallet) {

                $wallet_balance = 0;

            } else {
                $wallet_balance = $owner_wallet->amount_balance;

            }

            $currency_code = auth()->user()->countryDetail->currency_code;
            $currency_symbol = auth()->user()->countryDetail->currency_symbol;

            // $currency_code = get_settings('currency_code');
            // $currency_symbol = get_settings('currency_symbol');

            $default_card = CardInfo::where('user_id', auth()->user()->id)->where('is_default', true)->first();
            $default_card_id = null;
            if ($default_card) {
                $default_card_id = $default_card->id;
            }
        }

        $bank_info_exists = false;

        if (auth()->user()->bankInfo()->exists()) {

            $bank_info_exists = true;
        }

        $enable_brain_tree = false;

        if (get_settings(Settings::ENABLE_BRAIN_TREE) == 1) {

            $enable_brain_tree = true;
        }

        $enable_mercadopago = false;

        if (get_settings(Settings::ENABLE_MERCADOPAGO) == 1) {

            $enable_mercadopago = true;
        }


        $enable_khalti = false;

        if (get_settings(Settings::ENABLE_KHALTI_PAY) == 1) {

            $enable_khalti = true;
        }

        $enable_stripe = false;

        if (get_settings(Settings::STRIPE_ENVIRONMENT) == 'test') {

            $stripe_environment = 'test';

        } else {

            $stripe_environment = 'production';

        }
        if (get_settings(Settings::ENABLE_STRIPE) == 1) {
            $enable_stripe = true;
        }

        $enable_paystack = false;

        if (get_settings(Settings::ENABLE_PAYSTACK) == 1) {

            $enable_paystack = true;
        }

        $enable_flutter_wave = false;

        if (get_settings(Settings::ENABLE_FLUTTER_WAVE) == 1) {

            $enable_flutter_wave = true;
        }

        $enable_cashfree = false;

        if (get_settings(Settings::ENABLE_CASH_FREE) == 1) {

            $enable_cashfree = true;
        }

        $enable_razor_pay = false;

        if (get_settings(Settings::ENABLE_RAZOR_PAY) == 1) {

            $enable_razor_pay = true;
        }

        $enable_paymob = false;

        if (get_settings(Settings::ENABLE_PAYMOB) == 1) {

            $enable_paymob = true;
        }
      
        $enable_paypal = false;

        if (get_settings(Settings::ENABLE_PAYPAL) == 1) {

            $enable_paypal = true;
        }

        $stripe_test_publishable_key = get_settings(Settings::STRIPE_TEST_PUBLISHABLE_KEY);
        $stripe_live_publishable_key = get_settings(Settings::STRIPE_LIVE_PUBLISHABLE_KEY);
        //Razor pay api keys
        $razorpay_test_api_key = get_settings(Settings::RAZOR_PAY_TEST_API_KEY);
        $razorpay_live_api_key = get_settings(Settings::RAZOR_PAY_LIVE_API_KEY);

        //Paystack keys
        $paystack_test_publishable_key = get_settings(Settings::PAYSTACK_TEST_PUBLISHABLE_KEY);
        $paystack_live_publishable_key = get_settings(Settings::PAYSTACK_PRODUCTION_PUBLISHABLE_KEY);

        //KHALTI
        $khalti_test_api_key = get_settings(Settings::KHALTI_PAY_TEST_API_KEY);
        $khalti_live_api_key = get_settings(Settings::KHALTI_PAY_LIVE_API_KEY);


        $cashfree_image = asset('assets/payment_gateway/cashfree.jpeg');
     
        $flutterwave_image = asset('assets/payment_gateway/flutterwave.jpeg');
        $mercadepago_image = asset('assets/payment_gateway/mercadepago.png');
        $paypal_image = asset('assets/payment_gateway/paypal.png');
        $paystack_image = asset('assets/payment_gateway/paystack.jpeg');
        $Razor_image = asset('assets/payment_gateway/Razor.jpeg');
        $stripe_image = asset('assets/payment_gateway/stripe.jpeg');
        $khalti_image = asset('assets/payment_gateway/khalti.png');
        $cashfree_image = asset('assets/payment_gateway/cashfree.jpeg');


        $url = env('APP_URL');

            $payment_gateways = array(
                'flutter_wave' => array('enabled' => $enable_flutter_wave,
                'image' => $flutterwave_image,
                'url' => $url."flutterwave"),

                'mercadepago' => array('enabled' => $enable_mercadopago,
                'image' => $mercadepago_image,
                'url' => $url."mercadopago"),

                'paypal' => array('enabled' => $enable_paypal,
                'image' => $paypal_image,
                'url' => $url."paypal"),

                'paystack' => array('enabled' => $enable_paystack,
                'image' => $paystack_image,
                'url' => $url."paystack"),

                'razorpay' => array('enabled' => $enable_razor_pay,
                'image' => $Razor_image,
                'url' => $url."razorpay"),

                'stripe' => array('enabled' => $enable_stripe,
                'image' => $stripe_image,
                'url' => $url."stripe"),

                'khalti' => array('enabled' => $enable_khalti,
                'image' => $khalti_image,
                'url' => $url."khalti"),
/*cashfree*/

                'cashfree' => array('enabled' => $enable_cashfree,
                'image' => $cashfree_image,
                'url' => $url."cashfree"),



            );

        return response()->json(['success' => true,
            'message' => 'wallet_history_listed',
            'wallet_balance' => $wallet_balance,
            'default_card_id' => $default_card_id,
            'currency_code' => $currency_code,
            'currency_symbol' => $currency_symbol,
            'wallet_history' => $result,
            'braintree_tree' => $enable_brain_tree,
            'mercadopago' => $enable_mercadopago,
            'stripe' => $enable_stripe,
            'razor_pay' => $enable_razor_pay,
            'paystack' => $enable_paystack,
            'khalti_pay' => $enable_khalti,            
            'cash_free' => $enable_cashfree,
            'flutter_wave' => $enable_flutter_wave,
            'paymob' => $enable_paymob,
            'bank_info_exists' => $bank_info_exists,
            'stripe_environment' => $stripe_environment,
            'stripe_test_publishable_key' => $stripe_test_publishable_key,
            'stripe_live_publishable_key' => $stripe_live_publishable_key,
            'razor_pay_environment' => get_settings(Settings::RAZOR_PAY_ENVIRONMENT),
            'razorpay_test_api_key' => $razorpay_test_api_key,
            'razorpay_live_api_key' => $razorpay_live_api_key,
            'paystack_environment' => get_settings(Settings::PAYSTACK_ENVIRONMENT),
            'khalti_pay_environment' => get_settings(Settings::KHALTI_PAY_ENVIRONMENT),
            'khalti_test_api_key' => $khalti_test_api_key,
            'khalti_live_api_key' => $khalti_live_api_key,
            'paystack_test_publishable_key' => $paystack_test_publishable_key,
            'paystack_live_publishable_key' => $paystack_live_publishable_key,
            'flutterwave_environment' => get_settings(Settings::FLUTTER_WAVE_ENVIRONMENT),
            'flutter_wave_test_secret_key' => get_settings(Settings::FLUTTER_WAVE_TEST_SECRET_KEY),
            'flutter_wave_live_secret_key' => get_settings(Settings::FLUTTER_WAVE_PRODUCTION_SECRET_KEY),
            'cashfree_environment' => get_settings(Settings::CASH_FREE_ENVIRONMENT),
            'payment_gateways' => $payment_gateways,
        ]);

        // return $this->respondSuccess($result, 'wallet_history_listed');
    }

    /**
     * Wallet Withdrawal Requests LIst
     *
     * */
    public function withDrawalRequests()
    {
        if (access()->hasRole(Role::USER)) {

            $user = auth()->user();

            $query = WalletWithdrawalRequest::where('user_id', $user->id);

            $result = filter($query, new WalletWithdrawalRequestsTransformer)->defaultSort('-created_at')->paginate();

            // $result = fractal($query, new WalletWithdrawalRequestsTransformer);

            $user_wallet = auth()->user()->userWallet;
            $wallet_balance = $user_wallet->amount_balance;


        } elseif (access()->hasRole(Role::DRIVER)) {

            $user = auth()->user()->driver;

            $query = WalletWithdrawalRequest::where('driver_id', $user->id);

            $result = filter($query, new WalletWithdrawalRequestsTransformer)->defaultSort('-created_at')->paginate();


            // $result = fractal($query, new WalletWithdrawalRequestsTransformer);

            $driver_wallet = auth()->user()->driver->driverWallet;

            $wallet_balance = $driver_wallet->amount_balance;

        } else {

            $user = auth()->user()->owner;

            $query = WalletWithdrawalRequest::where('owner_id', $user->id);

            $result = filter($query, new WalletWithdrawalRequestsTransformer)->defaultSort('-created_at')->paginate();


            // $result = fractal($query, new WalletWithdrawalRequestsTransformer);

            $owner_wallet = auth()->user()->owner->ownerWalletDetail;

            $wallet_balance = $owner_wallet->amount_balance;
        }

        return response()->json(['success' => true, 'message' => 'withdrawal-requests-listed', 'withdrawal_history' => $result, 'wallet_balance' => $wallet_balance]);

    }


    /**
     * Request for withdrawal
     * @bodyParam requested_amount double required  amount entered by user
     *
     *
     * */
    public function requestForWithdrawal(Request $request)
    {

        $created_params = $request->all();

        if (access()->hasRole(Role::USER)) {

            $user_info = auth()->user();

            $currency_code = auth()->user()->countryDetail->currency_code;
            $currency_symbol = auth()->user()->countryDetail->currency_symbol;

            // $currency_code = get_settings('currency_code');

            $created_params['requested_currency'] = $currency_code;
            $created_params['user_id'] = auth()->user()->id;

            $user_wallet = auth()->user()->userWallet;
            $wallet_balance = $user_wallet->amount_balance;

            if ($wallet_balance <= 0) {

                $this->throwCustomException('Your wallet balance is too low');

            }
            if ($wallet_balance < $request->requested_amount) {

                $this->throwCustomException('Your wallet balance is too low than your requested amount');

            }

            $user_info->withdrawalRequestsHistory()->where('status', WithdrawalRequestStatus::REQUESTED)->exists();
            if ($user_info) {
                $this->throwCustomException('You cannot make multiple request. please wait for your existing request approval');
            }

        } elseif (access()->hasRole(Role::DRIVER)) {

            $user_info = auth()->user()->driver;

            // $currency_code = get_settings('currency_symbol');
            $currency_code = auth()->user()->countryDetail->currency_code;
            $currency_symbol = auth()->user()->countryDetail->currency_symbol;

            $created_params['requested_currency'] = $currency_code;
            $created_params['driver_id'] = auth()->user()->driver->id;

            $driver_wallet = auth()->user()->driver->driverWallet;

            $wallet_balance = $driver_wallet->amount_balance;

            if ($wallet_balance <= 0) {

                $this->throwCustomException('Your wallet balance is too low');

            }

            if ($wallet_balance < $request->requested_amount) {

                $this->throwCustomException('Yout wallet balance is too low than your requested amount');

            }

            // $user_info->withdrawalRequestsHistory()->where('status',0)->exists();

            $exists_request = WalletWithdrawalRequest::where('driver_id', $user_info->id)->where('status', 0)->exists();

            if ($exists_request == true) {
                $this->throwCustomException('You cannot make multiple request. please wait for your existing request approval');
            }

        } else {

            $user_info = auth()->user()->owner;

            // $currency_code = get_settings('currency_symbol');
            $currency_code = auth()->user()->countryDetail->currency_code;
            $currency_symbol = auth()->user()->countryDetail->currency_symbol;

            $created_params['requested_currency'] = $currency_code;
            $created_params['owner_id'] = auth()->user()->owner->id;

            $owner_wallet = auth()->user()->owner->ownerWalletDetail;

            $wallet_balance = $owner_wallet->amount_balance;

            if ($wallet_balance <= 0) {

                $this->throwCustomException('Your wallet balance is too low');

            }

            if ($wallet_balance < $request->requested_amount) {

                $this->throwCustomException('Yout wallet balance is too low than your requested amount');

            }

            // $user_info->withdrawalRequestsHistory()->where('status',0)->exists();

            $exists_request = WalletWithdrawalRequest::where('driver_id', $user_info->id)->where('status', 0)->exists();

            if ($exists_request == true) {
                $this->throwCustomException('You cannot make multiple request. please wait for your existing request approval');
            }

        }


        WalletWithdrawalRequest::create($created_params);

        return $this->respondSuccess(null, 'wallet_withdrawal_requested');


    }
   /**
     * Transfer money from wallet
     * @bodyParam mobile mobile required mobile of the user
     * @bodyParam role role required role of the user
     * @bodyParam amount amount required role of the user
     *
     * */
   public function transferMoneyFromWallet(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
            'role' => 'required',
            'amount' => 'required'
        ]);
        $user = auth()->user();
        
        $invalid_mobile = false;

        if($user->hasRole('user') && $request->role=='user'){
            
            $invalid_mobile = true;

        }
        if($user->hasRole('driver') && $request->role=='driver'){
            
            $invalid_mobile = true;

        }
         if($user->hasRole('owner') && $request->role=='owner'){
            
            $invalid_mobile = true;

        }
        if ($request->mobile == $user->mobile && $invalid_mobile) {

            //Throw exception
            $this->throwCustomException('Invalid Mobile Number');

        }
        if (access()->hasRole('user')) {
            $wallet_model = new UserWallet();
            $wallet_history_model = new UserWalletHistory();
            $user_id = auth()->user()->id;
        } elseif ($user->hasRole('driver')) {
            $wallet_model = new DriverWallet();
            $wallet_history_model = new DriverWalletHistory();
            $user_id = $user->driver->id;
        } else {
            $wallet_model = new OwnerWallet();
            $wallet_history_model = new OwnerWalletHistory();
            $user_id = $user->owner->id;
        }

        $user_wallet = $wallet_model::whereUserId($user_id)->first();

        $minimum_wallet_amount = get_settings(Settings::MINIMUM_WALLET_AMOUNT_FOR_TRANSFER);

        if ($user_wallet && $user_wallet->amount_balance < $minimum_wallet_amount) {

            //Throw exception
            $this->throwCustomException('Insufficient balance to transfer money to wallet');

        }

        $mobile_number = $request->mobile;
        $role = $request->role;
        $amount_to_transfer = $request->amount;

        // Validate requested amount with current balance

        if ($user_wallet->amount_balance < $amount_to_transfer) {
            // Throw exception
            $this->throwCustomException('Insufficient Balance');
        }

        // Find Receiver Wallet

        $receiver_user = User::belongsTorole($role)->where('mobile', $mobile_number)->first();

        if (!$receiver_user) {
            $this->throwCustomException('Mobile Number Does Not Exists');
        }

        $transaction_id = str_random(6);

        if ($role == 'user') {

            $receiver_wallet = $receiver_user->userWallet;
            if($receiver_wallet==null){
                $this->throwCustomException('This user Does Not have an E-Wallet');
            }
            $receiver_wallet_history_model = new UserWalletHistory();
            $receiver_wallet->amount_added += $amount_to_transfer;
            $receiver_wallet->amount_balance += $amount_to_transfer;
            $receiver_wallet->save();

            $receiver_user->userWalletHistory()->create([
                'transaction_id' => $transaction_id,
                'amount' => $amount_to_transfer,
                'is_credit' => true,
                'remarks' => 'transferred-from-' . $user->name
            ]);

        } elseif ($role == 'driver') {

            $receiver_wallet = $receiver_user->driver->driverWallet;
            if($receiver_wallet==null){
                $this->throwCustomException('This user Does Not have an E-Wallet');
            }
            $receiver_wallet_history_model = new DriverWalletHistory();
            $receiver_wallet->amount_added += $amount_to_transfer;
            $receiver_wallet->amount_balance += $amount_to_transfer;
            $receiver_wallet->save();

            $receiver_user->driver->driverWalletHistory()->create([
                'transaction_id' => $transaction_id,
                'amount' => $amount_to_transfer,
                'is_credit' => true,
                'remarks' => 'transferred-from-' . $user->name
            ]);

        } elseif ($role == 'owner') {

            $receiver_wallet = $receiver_user->owner->ownerWalletDetail;
            if($receiver_wallet==null){
                $this->throwCustomException('This user Does Not have an E-Wallet');
            }
            $receiver_wallet_history_model = new OwnerWalletHistory();
            $receiver_wallet->amount_added += $amount_to_transfer;
            $receiver_wallet->amount_balance += $amount_to_transfer;
            $receiver_wallet->save();

            $receiver_user->owner->ownerPaymentWalletHistoryDetail()->create([
                'transaction_id' => str_random(6),
                'amount' => $amount_to_transfer,
                'is_credit' => true,
                'remarks' => 'transferred-from-' . $user->name
            ]);

        }

        $title = trans('push_notifications.you_have_received_a_money_from_title', [], $receiver_user->lang);

        $body = trans('push_notifications.you_have_received_a_money_from_body', [], $receiver_user->lang);

        dispatch(new SendPushNotification($receiver_user,$title,$body));

        $user_wallet->amount_spent -= $amount_to_transfer;
        $user_wallet->amount_balance -= $amount_to_transfer;
        $user_wallet->save();

        $wallet_history_model::create([
            'user_id' => $user_id,
            'amount' => $request->amount,
            'transaction_id' => $transaction_id,
            'remarks' => 'transfered-to-' . $receiver_user->name,
            'is_credit' => false]);
        $transfer_remarks = $wallet_history_model->update(['remarks']);
        $receiver_remarks = $receiver_wallet_history_model->update(['remarks']);
//        return $this->respondSuccess($remarks, 'transferred');
        return response()->json(['success' => true, 'transfer_remarks' => $transfer_remarks, 'receiver_remarks' => $receiver_remarks]);
    }
}