<?php

namespace App\Http\Controllers\Api\V1\Auth\Registration;

use DB;
use Twilio;
use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Events\Auth\UserLogin;
use App\Base\Constants\Auth\Role;
use App\Events\Auth\UserRegistered;
use Illuminate\Support\Facades\Log;
use App\Base\Libraries\SMS\SMSContract;
use App\Http\Controllers\ApiController;
use Laravel\Socialite\Facades\Socialite;
use App\Helpers\Exception\ExceptionHelpers;
use App\Jobs\Notifications\OtpNotification;
use Psr\Http\Message\ServerRequestInterface;
use App\Base\Constants\Masters\WalletRemarks;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Base\Services\OTP\Handler\OTPHandlerContract;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Helpers\Exception\throwCustomValidationException;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use App\Http\Requests\Auth\Registration\UserRegistrationRequest;
use App\Http\Requests\Auth\Registration\SendRegistrationOTPRequest;
use App\Http\Requests\Auth\Registration\ValidateRegistrationOTPRequest;
use App\Jobs\Notifications\Auth\Registration\UserRegistrationNotification;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Jobs\Notifications\SendPushNotification;
use App\Models\Master\MailTemplate;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\Mails\SendMailNotification;
use App\Models\MailOtp;
use App\Mail\OtpMail;
use App\Http\Requests\Auth\Registration\ValidateEmailOTPRequest;
use App\Http\Requests\Auth\Registration\SendRegistrationMailOTPRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\Driver;

/**
 * @group SignUp-And-Otp-Validation
 *
 * APIs for User-Management
 */
class UserRegistrationController extends LoginController
{
    use ExceptionHelpers;
    /**
     * The OTP handler instance.
     *
     * @var \App\Base\Services\OTP\Handler\OTPHandlerContract
     */
    protected $otpHandler;

    /**
     * The user model instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    protected $smsContract;

    protected $imageUploader;

    protected $country;

    /**
     * UserRegistrationController constructor.
     *
     * @param \App\Models\User $user
     * @param \App\Base\Services\OTP\Handler\OTPHandlerContract $otpHandler
     */
    public function __construct(User $user, OTPHandlerContract $otpHandler, Country $country, SMSContract $smsContract,ImageUploaderContract $imageUploader)
    {
        $this->user = $user;
        $this->otpHandler = $otpHandler;
        $this->country = $country;
        $this->smsContract = $smsContract;
        $this->imageUploader = $imageUploader;

    }
    public function sendMailOTP(SendRegistrationMailOTPRequest $request)
    {

        $email = $request->input('email');

        $mail_otp_exists =  MailOtp::where('email', $email)->exists();

        if($mail_otp_exists == false)
        {
        $otp = mt_rand(100000, 999999);

        $newOTP = MailOtp::create([
            'email' => $email,
            'otp' => $otp,
            'verified' => false,
        ]);


          Mail::to($email)->send(new OtpMail($otp));

        }else{

           $mailOtp = MailOtp::where('email', $email)->first();

           $otp = mt_rand(100000, 999999);

           $mailOtp->update(['otp' => $otp,'verified'=>false]);

           Mail::to($email)->send(new OtpMail($otp));

        }
        return response()->json(['success'=>true]);

    }
    /**
     * Validate the mobile number verification OTP during registration.
     * @bodyParam otp string required Provided otp
     * @bodyParam uuid uuid required uuid comes from sen otp api response
     *
     * @param \App\Http\Requests\Auth\Registration\ValidateRegistrationOTPRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @response {"success":true,"message":"success"}
     */
    public function validateEmailOTP(ValidateEmailOTPRequest $request)
    {
        $otp = $request->otp;
        $email = $request->email;

        $verify_otp = MailOtp::where('email' ,$email)->where('otp', $otp)->exists();


        if ($verify_otp == false)
        {
            $this->throwCustomValidationException(['message' => "The otp provided has Invaild" ]);
        }

        MailOtp::where('email' ,$email)->where('otp', $otp)->update(['verified' => true]);

        return response()->json(['success'=>true]);
    }
    /**
     * Register the user and send welcome email.
     * @bodyParam name string required name of the user
    * @bodyParam company_key string optional company key of demo
     * @bodyParam mobile integer required mobile of user
     * @bodyParam email email required email of the user
     * @bodyParam password password required password provided user
     * @bodyParam oauth_token string optional from social provider
     * @bodyParam password_confirmation password required  confirmed password provided user
     * @bodyParam device_token string required device_token of the user
     * @bodyParam refferal_code string optional refferal_code of the another user
     * @bodyParam login_by string required from which device the user registered. the input should be 'android',or 'ios'
     * @param \App\Http\Requests\Auth\Registration\UserRegistrationRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @responseFile responses/auth/register.json
     */
    public function register(UserRegistrationRequest $request)
    {
        $mobileUuid = $request->input('uuid');

        $country_id =  $this->country->where('dial_code', $request->input('country'))->pluck('id')->first();

        $validate_exists_email = $this->user->belongsTorole(Role::USER)->where('email', $request->email)->exists();

        if ($validate_exists_email) {

             if($request->is_web){

                $user = $this->user->belongsTorole(Role::USER)->where('email', $request->email)->first();

                return $this->authenticateAndRespond($user, $request, $needsToken=true);

            }
            $this->throwCustomException('Provided email has already been taken');
        }

        // $mobile = $this->otpHandler->getMobileFromUuid($mobileUuid);
        $mobile = $request->mobile;

        $validate_exists_mobile = get_or_check_if_exists_user($mobile,'user',true);

        if ($validate_exists_mobile) {

            if($request->is_web){

                $user = get_or_check_if_exists_user($mobile,'user',false);

                return $this->authenticateAndRespond($user, $request, $needsToken=true);

            }
            $this->throwCustomException('Provided mobile has already been taken');
        }

        if (!$country_id) {
            $this->throwCustomException('unable to find country');
        }


        if ($request->has('refferal_code')) {
            // Validate Referral code
            $referred_user_record = $this->user->belongsTorole(Role::USER)->where('refferal_code', $request->refferal_code)->first();
            if (!$referred_user_record) {
                $this->throwCustomException('Provided Referral code is not valid', 'refferal_code');
            }
            // Add referral commission to the referred user
            $this->addCommissionToRefferedUser($referred_user_record);
        }

        $profile_picture = null;

        if ($uploadedFile = $this->getValidatedUpload('profile_picture', $request)) {
            $profile_picture = $this->imageUploader->file($uploadedFile)
                ->saveProfilePicture();
        }
        if ($request->has('email_confirmed') == true)
        {
            $user_params['email_confirmed']= true;
        }
        // DB::beginTransaction();
        // try {
        $user_params = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'gender' => $request->input('gender'),
            'mobile' => $mobile,
            'mobile_confirmed' => true,
            'fcm_token'=>$request->input('device_token'),
            'login_by'=>$request->input('login_by'),
            'country'=>$country_id,
            'refferal_code'=>str_random(6),
            'profile_picture'=>$profile_picture,
            'lang'=>$request->input('lang')
        ];

        if($request->has('is_bid_app')){

            $user_params['is_bid_app']=1;
        }

        if (env('APP_FOR')=='demo' && $request->has('company_key') && $request->input('company_key')) {
            $user_params['company_key'] = $request->input('company_key');
        }
        if ($request->has('password') && $request->input('password')) {
            $user_params['password'] = bcrypt($request->input('password'));
        }
        $user = $this->user->create($user_params);

        // $this->otpHandler->delete($mobileUuid);

        // Create Empty Wallet to the user
        $user->userWallet()->create(['amount_added'=>0]);

        $user->attachRole(Role::USER);

        // $this->dispatch(new UserRegistrationNotification($user));

        event(new UserRegistered($user));

        if ($request->has('oauth_token') & $request->input('oauth_token')) {
            $oauth_token = $request->oauth_token;
            $social_user = Socialite::driver($provider)->userFromToken($oauth_token);
            // Update User data with social provider
            $user->social_id = $social_user->id;
            $user->social_token = $social_user->token;
            $user->social_refresh_token = $social_user->refreshToken;
            $user->social_expires_in = $social_user->expiresIn;
            $user->social_avatar = $social_user->avatar;
            $user->social_avatar_original = $social_user->avatar_original;
            $user->save();
        }
        //     DB::commit();
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     Log::error($e);
        //     Log::error('Error while Registering a user account. Input params : ' . json_encode($request->all()));
        //     return $this->respondBadRequest('Unknown error occurred. Please try again later or contact us if it continues.');
        // }
   if(($user->email_confirmed) == true){

        /*mail Template*/
            $user_name = $user->name;
            $mail_template = MailTemplate::where('mail_type', 'welcome_mail')->first();

            $description = $mail_template->description;

            $description = str_replace('$user_name', $user_name, $description);

            $mail_template->description = $description;

            $mail_template = $mail_template->description;

            $user_mail = $user->email;

        //dispatch(new SendMailNotification($mail_template, $user_mail));

    /*mail Template*/
}
        if ($user) {
            return $this->authenticateAndRespond($user, $request, $needsToken=true);
        }
        return $this->respondBadRequest('Unknown error occurred. Please try again later or contact us if it continues.');

        // return $this->respondSuccess();
    }

    /**
    * Validate Mobile-For-User
    * @bodyParam mobile integer required mobile of user
     * @response {
     * "success":true,
     * "message":"mobile_validated",
     * }
    *
    */
    public function validateUserMobile(Request $request)
    {
  if ($request->has('mobile'))
    {
        $mobile = $request->mobile;

        // $validate_exists_mobile = $this->user->belongsTorole(Role::USER)->where('mobile', $mobile)->exists();

        $validate_exists_mobile = get_or_check_if_exists_user($mobile,'user',true);

        if ($validate_exists_mobile) {
            $this->throwCustomException('Provided mobile has already been taken');
        }

        return $this->respondSuccess(null, 'mobile_validated');
      }
      if ($request->has('email'))
         {
            $email = $request->input('email');

            $validate_exists_email = $this->user->belongsTorole(Role::USER)->where('email', $email)->exists();
            if ($validate_exists_email)
            {
                return $this->respondFailed('email_exists');
            }

         return $this->respondSuccess('email_does_not_exists');

        }


    }
    /**
    * Validate Mobile-For-User-Login
    * @bodyParam mobile integer required mobile of user
    * @response {
    * "success":true,
    * "message":"mobile_exists",
    * }
    *
    */
     public function validateUserMobileForLogin(Request $request)
    {


    if ($request->has('mobile') && $request->has('email')) {
        $mobile = $request->mobile;
        $email = $request->email;

        // $existsMobile = $this->user->belongsTorole(Role::USER)->where('mobile', $mobile)->exists();

        $existsMobile = get_or_check_if_exists_user($mobile,'user',true);


        $existsEmail = $this->user->belongsTorole(Role::USER)->where('email', $email)->exists();

        if ($existsMobile && $existsEmail) {
            // Both mobile and email exist
            return $this->respondSuccess(null, 'mobile_and_email_exist');
        } elseif ($existsMobile) {
            // Only mobile exists
            return $this->respondSuccess(null, 'mobile_exists');
        } elseif ($existsEmail) {
            // Only email exists
            return $this->respondSuccess(null, 'email_exists');
        } else {
            // Neither mobile nor email exist
           return $this->respondFailed('email_does_not_exists');

        }

      }

      if ($request->has('mobile'))
        {

        $mobile = $request->mobile;

        // $validate_exists_mobile = $this->user->belongsTorole(Role::USER)->where('mobile', $mobile)->exists();

        $validate_exists_mobile = get_or_check_if_exists_user($mobile,'user',true);
        

        if($request->has('role') && $request->role=='user'){

        $validate_exists_mobile = get_or_check_if_exists_user($mobile,'user',true);
        
        // $validate_exists_mobile = $this->user->belongsTorole(Role::USER)->where('mobile', $mobile)->exists();

        }

        if ($validate_exists_mobile) {
            return $this->respondSuccess(null, 'mobile_exists');
        }

        return $this->respondFailed('email_does_not_exists');

       }
      if ($request->has('email'))
        {

        $email = $request->email;

        $validate_exists_email = $this->user->belongsTorole(Role::USER)->where('email', $email)->exists();

        if($request->has('role') && $request->role=='user'){

        $validate_exists_email = $this->user->belongsTorole(Role::USER)->where('email', $email)->exists();

        }

        if ($validate_exists_email) {
            return $this->respondSuccess(null, 'email_exists');
        }

        return $this->respondFailed('email_does_not_exists');
      }


    }

    /**
    * Add Commission to the referred user
    *
    */
    public function addCommissionToRefferedUser($reffered_user)
    {
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

        // Notify user
        // $title = trans('push_notifications.referral_earnings_notify_title');
        // $body = trans('push_notifications.referral_earnings_notify_body');

        $title = trans('push_notifications.referral_earnings_notify_title',[],$reffered_user->user->lang);
        $body = trans('push_notifications.referral_earnings_notify_body',[],$reffered_user->user->lang);

        dispatch(new SendPushNotification($reffered_user,$title,$body));

    }


    /**
     * Send the mobile number verification OTP during registration.
     * @bodyParam country string required dial_code of the country
     * @bodyParam mobile int required Mobile of the user
     * @bodyParam email string required Email of the user
     * @param \App\Http\Requests\Auth\Registration\SendRegistrationOTPRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @response {
     * "success":true,
     * "message":"success",
     * "data":{
     * "uuid":"6ffa38d1-d2ca-434a-8695-701ca22168b1"
     * }
     * }
     */
    public function sendOTP(SendRegistrationOTPRequest $request)
    {
        // dd(ceil(600.01 / 50) * 50);

        $field = 'mobile';

        $mobile = $request->input($field);

        DB::beginTransaction();
        try {
            $country_code = $this->country->where('dial_code', $request->input('country'))->exists();
            if (!$country_code) {
                $this->throwCustomValidationException('unable to find country', 'dial_code');
            }
            $mobileForOtp = $request->input('country') . $mobile;

            if (!$this->otpHandler->setMobile($mobile)->create()) {
                $this->throwSendOTPErrorException($field);
            }

            $otp = $this->otpHandler->getOtp();
            // Generate sms from template
            $sms = sms_template('generic-otp', ['otp'=>$otp,'mobile'=>$mobileForOtp], 'en');
            // Send sms by providers
            $this->smsContract->queueOn('default', $mobile, $sms);
            // $this->dispatch(new OtpNotification($mobile, $otp, $sms));

            /**
             * Send OTP here
             * Temporary logger
             */
            // Twilio::message($mobileForOtp, $message);

            \Log::info($sms);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            Log::error('Error while Registering a user account. Input params : ' . json_encode($request->all()));
            return $this->respondBadRequest('Unknown error occurred. Please try again later or contact us if it continues.');
        }
        DB::commit();

        // return $this->respondSuccess(['uuid' => $this->otpHandler->getUuid()]);

        return response()->json(['success'=>true,'message'=>'success','message_keyword'=>'otp_sent_successfuly','data'=>['uuid' => $this->otpHandler->getUuid()]]);
    }

    /**
     * Validate the mobile number verification OTP during registration.
     * @bodyParam otp string required Provided otp
     * @bodyParam uuid uuid required uuid comes from sen otp api response
     *
     * @param \App\Http\Requests\Auth\Registration\ValidateRegistrationOTPRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @response {"success":true,"message":"success"}
     */
    public function validateOTP(ValidateRegistrationOTPRequest $request)
    {
        $otpField = 'otp';
        $uuidField = 'uuid';

        $otp = $request->input($otpField);
        $uuid = $request->input($uuidField);

        if (!$this->otpHandler->validate($otp, $uuid)) {
            $message = $this->otpHandler->isExpired() ?
            'The otp provided has expired.' :
            'The otp provided is invalid.';

            $this->throwCustomValidationException($message, $otpField);
        }

        // return $this->respondSuccess();
        return response()->json(['success'=>true,'message'=>'success','message_keyword'=>'otp_validated_successfuly']);
    }
    public function updatePassword(Request $request)
    {

/*Email*/
        if($request->has('email')) {
            $user = User::where('email', $request->email)->first();

            if($user) {
                $password = $request->password;

                // Hash the password
                $hashedPassword = Hash::make($password);

                // Update the password
                $user->update(['password' => $hashedPassword]);

            return response()->json(['success'=>true,'message'=>'success','message'=>'password_updated_successfuly']);

            }
         }
/*mobile*/
        if($request->has('mobile')) {
            $user = User::where('mobile', $request->mobile)->first();

            if($user) {
                $password = $request->password;

                // Hash the password
                $hashedPassword = Hash::make($password);

                // Update the password
                $user->update(['password' => $hashedPassword]);

             return response()->json(['success'=>true,'message'=>'success','message'=>'password_updated_successfuly']);

            }
          }
/*mobile Ends*/

    }
}
