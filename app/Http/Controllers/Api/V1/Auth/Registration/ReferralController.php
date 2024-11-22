<?php

namespace App\Http\Controllers\Api\V1\Auth\Registration;

use App\Models\User;
use Illuminate\Http\Request;
use App\Base\Constants\Auth\Role;
use App\Transformers\User\UserTransformer;
use App\Base\Constants\Masters\WalletRemarks;
use App\Transformers\User\ReferralTransformer;
use App\Http\Controllers\Api\V1\BaseController;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Jobs\Notifications\SendPushNotification;

/**
 * @group SignUp-And-Otp-Validation
 *
 * APIs for User-Management
 */
class ReferralController extends BaseController
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
    * Get Referral code
    * @responseFile responses/auth/get-referral.json
    */
    public function index()
    {
        $user = fractal(auth()->user(), new ReferralTransformer);

        return $this->respondOk($user);
    }
    /**
    * Update User Referral
    * @bodyParam refferal_code string required refferal_code of the another user
    * @response {"success":true,"message":"success"}
    */
    public function updateUserReferral(Request $request)
    {
        // Validate Referral code
        $reffered_user = $this->user->where('refferal_code', $request->refferal_code)->first();
        if (!$reffered_user) {
            $this->throwCustomException('Provided Referral code is not valid', 'refferal_code');
        }

        auth()->user()->update(['referred_by'=>$reffered_user->id]);

        if($reffered_user->hasRole('user')){

        // Update referred user's id to the users table
        $user_wallet = $reffered_user->userWallet;
        $referral_commision = get_settings('referral_commision_for_user')?:0;

        $user_wallet->amount_added += $referral_commision;
        $user_wallet->amount_balance += $referral_commision;
        $user_wallet->save();

        // Add the history
        $reffered_user->userWalletHistory()->create([
            'amount'=>$referral_commision,
            'transaction_id'=>str_random(6),
            'remarks'=>WalletRemarks::REFERRAL_COMMISION,
            'refferal_code'=>$reffered_user->refferal_code,
            'is_credit'=>true]);

        }else{

        // Add referral commission to the referred user
        $reffered_user = $reffered_user->driver;

        $driver_wallet = $reffered_user->driverWallet;
        $referral_commision = get_settings('referral_commision_for_driver')?:0;

        $driver_wallet->amount_added += $referral_commision;
        $driver_wallet->amount_balance += $referral_commision;
        $driver_wallet->save();

        // Add the history
        $reffered_user->driverWalletHistory()->create([
            'amount'=>$referral_commision,
            'transaction_id'=>str_random(6),
            'remarks'=>WalletRemarks::REFERRAL_COMMISION,
            'refferal_code'=>$reffered_user->refferal_code,
            'is_credit'=>true]);


        }
        
        // Notify user
        $title = trans('push_notifications.referral_earnings_notify_title',[],$reffered_user->lang);
        $body = trans('push_notifications.referral_earnings_notify_body',[],$reffered_user->lang);

        dispatch(new SendPushNotification($reffered_user,$title,$body));

        return $this->respondSuccess();
    }

    /**
    * Update Driver Referral code
    * @bodyParam refferal_code string required refferal_code of the another user
    * @response {"success":true,"message":"success"}
    */
    public function updateDriverReferral(Request $request)
    {
        $reffered_user = $this->user->where('refferal_code', $request->refferal_code)->first();

        if (!$reffered_user) {
            $this->throwCustomException('Provided Referral code is not valid', 'refferal_code');
        }

        // Update referred user's id to the users table
        auth()->user()->update(['referred_by'=>$reffered_user->id]);


        if($reffered_user->hasRole('driver')){

            // Add referral commission to the referred user
        $reffered_user = $reffered_user->driver;

        $driver_wallet = $reffered_user->driverWallet;
        $referral_commision = get_settings('referral_commision_for_driver')?:0;

        $driver_wallet->amount_added += $referral_commision;
        $driver_wallet->amount_balance += $referral_commision;
        $driver_wallet->save();

        // Add the history
        $reffered_user->driverWalletHistory()->create([
            'amount'=>$referral_commision,
            'transaction_id'=>str_random(6),
            'remarks'=>WalletRemarks::REFERRAL_COMMISION,
            'refferal_code'=>$reffered_user->refferal_code,
            'is_credit'=>true]);
    
        }else{

            // Update referred user's id to the users table
        $user_wallet = $reffered_user->userWallet;
        $referral_commision = get_settings('referral_commision_for_user')?:0;

        $user_wallet->amount_added += $referral_commision;
        $user_wallet->amount_balance += $referral_commision;
        $user_wallet->save();

        // Add the history
        $reffered_user->userWalletHistory()->create([
            'amount'=>$referral_commision,
            'transaction_id'=>str_random(6),
            'remarks'=>WalletRemarks::REFERRAL_COMMISION,
            'refferal_code'=>$reffered_user->refferal_code,
            'is_credit'=>true]);


        }
        
        // Notify user
         $title = trans('push_notifications.referral_earnings_notify_title',[],$reffered_user->lang);
        $body = trans('push_notifications.referral_earnings_notify_body',[],$reffered_user->lang);

        dispatch(new SendPushNotification($reffered_user->user,$title,$body));

        return $this->respondSuccess();
    }
}
