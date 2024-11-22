<?php

namespace App\Base\Services\DriverPaymentWallet;

use Validator;
use Braintree\Gateway;
use Illuminate\Http\Request;
use App\Models\Admin\Driver;
use App\Models\Payment\CardInfo;
use App\Base\Constants\Auth\Role;
use App\Models\Payment\UserWallet;
use App\Models\Payment\DriverWallet;
// use App\Base\Services\DriverPaymentWallet\DriverPaymentContract;
use App\Models\Payment\UserWalletHistory;
use App\Helpers\Exception\ExceptionHelpers;
use App\Models\Payment\DriverWalletHistory;
use App\Base\Constants\Masters\WalletRemarks;
use App\Base\Payment\BrainTreeTasks\BraintreeTask;
use Exception;
use App\Base\Constants\Setting\Settings;


class DriverPayment implements DriverPaymentContract {
	/**
	 * The ImageManager instance.
	 *
	 * @var \Intervention\Image\ImageManager
	 */

	 use ExceptionHelpers;
    public static $gateway;

    protected $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
    * Add money to wallet
    *
    */
    public function addDriverMoneyToWallet(Request $request,Driver $driver)
    {
        $user_currency_code = get_settings('currency_code');

        // dd($user_currency_code);

        // Convert the amount to USD to any currency
        $converted_amount_array =  convert_currency_to_usd($user_currency_code, $request->input('amount'));

        // dd($converted_amount_array);
        $converted_amount = $converted_amount_array['converted_amount'];
        $converted_type = $converted_amount_array['converted_type'];

        // get card detail
        // $card = CardInfo::find($request->input('card_id'));

        // Transfer money to admin account
        // $tranfer = $this->transferToAdminAccount($converted_amount, $card);
        // $merchant  = $tranfer->transaction->merchantAccountId;
        $conversion = $converted_type.':'.$request->amount.'-'.$converted_amount;
        $transaction_id = str_rand(7);

       
            $wallet_model = new DriverWallet();
            $wallet_add_history_model = new DriverWalletHistory();
            $user_id = $driver->id;
       

        $user_wallet = $wallet_model::firstOrCreate([
            'user_id'=>$user_id]);
        $user_wallet->amount_added += $request->amount;
        $user_wallet->amount_balance += $request->amount;
        $user_wallet->save();
        $user_wallet->fresh();

        $wallet_add_history_model::create([
            'user_id'=>$user_id,
            'card_id'=>null,
            'amount'=>$request->amount,
            'transaction_id'=>null,
            'conversion'=>$conversion,
            'merchant'=>null,
            'remarks'=>WalletRemarks::MONEY_DEPOSITED_TO_E_WALLET_FROM_ADMIN,
            'is_credit'=>true]);

        return $user_wallet;
    }

	
}
