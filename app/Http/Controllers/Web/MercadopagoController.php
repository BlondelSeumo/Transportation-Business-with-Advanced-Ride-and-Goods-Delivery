<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Base\Constants\Masters\WalletRemarks;
use App\Models\Payment\UserWallet;
use App\Models\Payment\DriverWallet;
use App\Models\Payment\OwnerWallet;
use App\Models\Payment\OwnerWalletHistory;
use App\Models\Payment\UserWalletHistory;
use App\Models\Payment\DriverWalletHistory;
use App\Base\Constants\Masters\PushEnums;
use App\Jobs\Notifications\SendPushNotification;
use Kreait\Firebase\Contract\Database;
use App\Base\Constants\Auth\Role;
use Carbon\Carbon;
use App\Models\Request\Request as RequestModel;

class MercadopagoController extends BaseController
{
    

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function mercadepago(Request $request)
    {


        $environment =  get_settings('mercadopago_environment');

        if ($environment=="test") {
            $public_key =  get_settings('mercadopago_test_public_key');
            $token =  get_settings('mercadopago_test_access_token');
        }else{
            $public_key =  get_settings('mercadopago_live_public_key');
            $token =  get_settings('mercadopago_live_access_token');
        }

// dd($token);
        $user = User::find(request()->input('user_id'));

        // Extract parameters from the request
        $amount = $request->input('amount');
        $name = $user->name ?? 'bala';
        $email = $user->email ?? 'balathemask@gmail.com';
        $mobile = $user->mobile ?? '9790200663';
        $currency = $user->countryDetail->currency_code ?? "INR";

        $payment_for = $request->input('payment_for');
        $request_id = $request->input('request_id') ?? "test";


        // Ensure that the order ID is passed correctly to the view
        return view('mercadopago.checkout', compact('public_key', 'payment_for', 'request_id', 'user', 'amount', 'currency','token'))->render();
    }


    public function mercadopagoCheckout(Request $request){

        // dd($request->all());

        $exploded_reference = explode('----', $request->external_reference);
// dd($exploded_reference);
        $request_id = $exploded_reference[4];
        $web_booking_value = 0;
        $payment_for = $exploded_reference[2];
        $user_id = $exploded_reference[1];
        $user = User::find($user_id);
        $amount = $exploded_reference[3];

    if ($payment_for=="wallet") {

        $amount = $exploded_reference[3];

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
        $user_wallet->amount_added += $amount;
        $user_wallet->amount_balance += $amount;
        $user_wallet->save();
        $user_wallet->fresh();

        $wallet_add_history_model::create([
            'user_id'=>$user_id,
            'amount'=>$amount,
            'transaction_id'=>$request->payment_id,
            'remarks'=>WalletRemarks::MONEY_DEPOSITED_TO_E_WALLET,
            'is_credit'=>true]);


                $pus_request_detail = json_encode($request->all());


                $title = trans('push_notifications.amount_credited_to_your_wallet_title',[],$user->lang);
                $body = trans('push_notifications.amount_credited_to_your_wallet_body',[],$user->lang);

                // dispatch(new NotifyViaMqtt('add_money_to_wallet_status'.$user_id, json_encode($socket_data), $user_id));

                dispatch(new SendPushNotification($user,$title,$body));

            }else{

                $request_id =  $exploded_reference[4];
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
