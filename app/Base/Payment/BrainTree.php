<?php

namespace App\Base\Payment;

use Validator;
use Braintree\Gateway;
use Illuminate\Http\Request;
use App\Models\Payment\CardInfo;
use App\Base\Constants\Auth\Role;
use App\Models\Payment\UserWallet;
use App\Models\Payment\DriverWallet;
use App\Base\Payment\PaymentInterface;
use App\Models\Payment\UserWalletHistory;
use App\Helpers\Exception\ExceptionHelpers;
use App\Models\Payment\DriverWalletHistory;
use App\Base\Constants\Masters\WalletRemarks;
use App\Base\Payment\BrainTreeTasks\BraintreeTask;
use App\Base\Constants\Setting\Settings;

/**
 * Class BrainTree
 *
 */
class BrainTree implements PaymentInterface
{
    use ExceptionHelpers;
    public static $gateway;

    protected $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function addCard($request)
    {
        $user = auth()->user();

        try {
            $create_customer_data = [
                'firstName' => $user->name,
                'lastName' => null,
                'email' => $user->email,
                'phone' => $user->mobile,
                'paymentMethodNonce' => $request->payment_nonce,
                'id' => "customer_" . rand(100, 1000) . "_" . $user->id];

            $result = $this->createCustomerForUser($create_customer_data, $request);

            if (!CardInfo::where('user_id', $user->id)->exists()) {
                $result['is_default']= true;
            }
            $created_card = CardInfo::create($result);

            $cards = CardInfo::where('user_id', $user->id)->get();

            return $cards;
        } catch (Exception $e) {
            return $this->respondBadRequest('Unknown error occurred. Please try again later or contact us if it continues.');
            // @TODO send an exceptipon
        }
    }

    /**
    * Create customer in braintree for user
    *
    */
    public function createCustomerForUser(array $create_customer_data, $request)
    {
        $braintree_object = new BraintreeTask();
        $gateway = $braintree_object->run();

        $result = $gateway->customer()->create($create_customer_data);

        $exist_card = CardInfo::where('user_id', $this->user->id)->where('last_number', $result->customer->creditCards[0]->last4)->exists();

        if ($exist_card) {
            $this->throwCustomValidationException("Added card is already exists.", 'last_number');
        }


        $valid_through = $result->customer->creditCards[0]->expirationMonth.'/'.$result->customer->creditCards[0]->expirationYear;

        $count = CardInfo::where('user_id', $this->user->id)->where('is_default', true)->count();

        $user_role = $this->user->hasRole(Role::USER)?'user':'driver';

        $create_card_data = [
            'customer_id' => $result->customer->id,
            'merchant_id' => $result->customer->merchantId,
            'card_token' =>  $result->customer->creditCards[0]->token,
            'last_number' => $result->customer->creditCards[0]->last4,
            'card_type' => $result->customer->creditCards[0]->cardType,
            'user_id' => $this->user->id,
            'is_default' => $count == 0 ? true : false,
            'user_role' => $user_role,
            'valid_through'=>$valid_through
        ];

        return $create_card_data;
    }

    /**
    * List Payment Cards
    *
    */
    public function listCards()
    {
        return $card_details = CardInfo::where('user_id', $this->user->id)->get();
    }

    /**
    * Make Card as Default
    *
    */
    public function makeDefaultCard(Request $request)
    {
        $card_info = CardInfo::where('user_id', $this->user->id)->where('is_default', true)->first();

        if ($card_info) {
            $card_info->is_default = false;

            $card_info->save();
        }

        CardInfo::where('id', $request->card_id)->where('user_id', $this->user->id)->update(['is_default'=>true]);

        return;
    }

    /**
    * Delete card
    *
    */
    public function deleteCard(CardInfo $card)
    {
        if ($card->is_default) {
            $this->throwCustomException('you cannot delete your default card');
        }

        $card->delete();
    }

    /**
    * Add money to wallet
    *
    */
    public function addMoneyToWallet(Request $request)
    {
        $user_currency_code = get_settings('currency_code');

        // dd($user_currency_code);

        // Convert the amount to USD to any currency
        $converted_amount_array =  convert_currency_to_usd($user_currency_code, $request->input('amount'));

        // dd($converted_amount_array);
        $converted_amount = $converted_amount_array['converted_amount'];
        $converted_type = $converted_amount_array['converted_type'];

        // get card detail
        $card = CardInfo::find($request->input('card_id'));

        // Transfer money to admin account
        $tranfer = $this->transferToAdminAccount($converted_amount, $card);
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
            'card_id'=>$card->id,
            'amount'=>$request->amount,
            'transaction_id'=>$transaction_id,
            'conversion'=>$conversion,
            'merchant'=>$merchant,
            'remarks'=>WalletRemarks::MONEY_DEPOSITED_TO_E_WALLET,
            'is_credit'=>true]);

        return $user_wallet;
    }

    /**
    * Transfer money to admin account
    *
    */
    public function transferToAdminAccount($converted_amount, $card)
    {
        $braintree_object = new BraintreeTask();
        $gateway = $braintree_object->run();

        $result = $gateway->transaction()->sale([
           'amount' => number_format($converted_amount, 2),
           'paymentMethodToken' => $card->card_token,
           'options' => [
               'submitForSettlement' => true
           ]
       ]);
        if ($result->success) {
            return $result;
        } else {
            $this->throwCustomException('unable to detect amount from this card');
        }
    }
}
