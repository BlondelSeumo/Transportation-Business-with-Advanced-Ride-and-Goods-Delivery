<?php

namespace App\Http\Controllers\Web\Auth;

use App\Models\User;
use App\Events\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\Auth\UserLogin;
use App\Base\Constants\Auth\Role;
use App\Models\Access\Role as RoleSlug;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\UserLoginRequest;
use Psr\Http\Message\ServerRequestInterface;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Base\Services\OTP\Handler\OTPHandlerContract;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Illuminate\Support\Facades\Log;
use App\Models\MailOtp;
use App\Helpers\Exception\throwCustomValidationException;

/**
 * @group Web-Authentication
 *
 * APIs for Authentication
 */
class LoginController extends ApiController
{
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

    /**
     * The model user identifier field used during login.
     * Can be email or username.
     *
     * @var string
     */
    protected $loginIdentifier = 'email';

    /**
     * LoginController constructor.
     *
     * @param \App\Models\User $user
     * @param \App\Base\Services\OTP\Handler\OTPHandlerContract $otpHandler
     */
    public function __construct(User $user, OTPHandlerContract $otpHandler)
    {
        $this->user = $user;
        $this->otpHandler = $otpHandler;
    }

    /**
     * Login the normal user.
     *
     * @param \App\Http\Requests\Auth\UserLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @response
     * {
     *"success": true,
     *"message": "success"
     *}
     */
    public function loginSpaUser(UserLoginRequest $request)
    {
        return $this->loginUserAccountSPA($request, Role::USER);
    }

    /**
     * Login the Web admin users.
     *
     * @param \App\Http\Requests\Auth\AdminLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @response
     * {
     *"success": true,
     *"message": "success"
     *}
     */
    public function loginWebUsers(AdminLoginRequest $request)
    {
        $web_login_roles = RoleSlug::whereNotIn('slug', array_merge(Role::mobileAppRoles(), Role::dispatchRoles()))
            ->pluck('slug')
            ->toArray(); 
        return $this->loginUserAccountSPA($request, $web_login_roles);
    }

    public function loginDispatchUsers(AdminLoginRequest $request)
    {

        return $this->loginUserAccountSPA($request, Role::dispatchRoles());
    }

    public function loginDispatchDeliveryUsers(AdminLoginRequest $request)
    {
        return $this->loginUserAccountSPA($request, Role::DELIVERY_DISPATCHER);
    }

    /**
     * Logout the user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @response
     * {
     *"success": true,
     *"message": "success"
     *}
     */
    public function logoutSPA(Request $request)
    {
        if (auth()->user()->hasRole(Role::dispatchRoles())) {
            $redirect = 'login-dispatch';
        } 
        else if (auth()->user()->hasRole('owner')) {
            $redirect = 'company-login';
        }else{
            $redirect = 'login';
        }

        auth('web')->logout();

        $request->session()->invalidate();

        return redirect($redirect);
    }

    /**
     * Login the user for SPA and respond accordingly.
     *
     * @param \Illuminate\Foundation\Http\FormRequest $request
     * @param string|array $role
     * @param array $conditions
     * @return \Illuminate\Http\JsonResponse
     */
    protected function loginUserAccountSPA($request, $role, array $conditions = [])
    {
        return $this->loginUserAccount($request, $role, false, $conditions);
    }

    /**
     * Login the user for Mobile App and respond accordingly.
     *
     * @param \Illuminate\Foundation\Http\FormRequest $request
     * @param string|array $role
     * @param array $conditions
     * @return \Illuminate\Http\JsonResponse
     */
    protected function loginUserAccountApp($request, $role, array $conditions = [])
    {
        return $this->loginUserAccount($request, $role, true, $conditions);
    }

    /**
     * Login the user for SPA or Mobile App and respond accordingly.
     *
     * @param \Illuminate\Foundation\Http\FormRequest $request
     * @param string|array $role
     * @param bool $needsToken
     * @param array $conditions
     * @return \Illuminate\Http\JsonResponse
     */
    protected function loginUserAccount($request, $role, $needsToken = true, array $conditions = [])
    {
        

        if ($request->has('social_id')) {
            return $this->setLoginIdentifier('social_id')
                ->loginUserWithSocialUniqueId($request, $role, $needsToken, $conditions);
        }

        if ($request->has(['mobile', 'password'])) {
            return $this->setLoginIdentifier('mobile')
                ->loginUserWithPassword($request, $role, $needsToken, $conditions);
        }
        if (!$request->has(['password'])) {
            if ($request->has(['mobile'])) {

                return $this->setLoginIdentifier('mobile')
                    ->loginUserWithMobile($request, $role, $needsToken, $conditions);
            }
        }


        if ($request->has(['email', 'password'])) {
            return $this->setLoginIdentifier('email')
                ->loginUserWithPassword($request, $role, $needsToken, $conditions);
        }

        if ($request->has('social_unique_id')) {
            return $this->setLoginIdentifier('social_unique_id')
                ->loginUserWithSocialUniqueId($request, $role, $needsToken, $conditions);
        }

        if ($request->has(['mobile', 'password'])) {
            return $this->setLoginIdentifier('mobile')
                ->loginUserWithPassword($request, $role, $needsToken, $conditions);
        }

        if ($request->has(['username', 'password']) && $this->roleAllowedUsernameLogin($role)) {
            return $this->setLoginIdentifier('username')
                ->loginUserWithPassword($request, $role, $needsToken, $conditions);
        }

        if ($needsToken && $request->has(['mobile', 'otp']) && $this->roleAllowedOTPLogin($role)) {
            return $this->loginUserWithOTP($request, $role, $needsToken, $conditions);
        }
        
        if ($needsToken && $request->has(['email', 'otp']) && $this->roleAllowedOTPLogin($role)) {
            return $this->loginUserWithEmailOtp($request, $role, $needsToken, $conditions);
        }

        return $this->respondBadRequest('Missing login credentials');
    }

    /**
     * Login the user using their mobile and otp.
     *
     * @param \Illuminate\Foundation\Http\FormRequest $request
     * @param string|array $role
     * @param bool $needsToken
     * @param array $conditions
     * @return \Illuminate\Http\JsonResponse
     */
    protected function loginUserWithEmailOtp($request, $role, $needsToken = true, array $conditions = [])
    {


        $request->validate([
        'otp' => 'sometimes|required|exists:mail_otp_verifications,otp',
        ]);

        $email = $request->input('email');
        $otp = $request->input('otp');
        $user = null;
        $identifier = $this->getLoginIdentifier();



        $verify_otp = MailOtp::where('email' ,$email)->where('otp', $otp)->exists();
            // dd($verify_otp);


        if ($verify_otp == false) 
        {
            $this->throwCustomValidationException(['message' => "The otp provided has Invaild" ]);
        }
       
       if (method_exists($this, $method = 'resolveUserFrom' . Str::studly($identifier))) {

            $user = $this->{$method}($email, $role);
           
        }

        if (!$user) {
            $this->throwInvalidCredentialsException($identifier);
        }

        MailOtp::where('email' ,$email)->where('otp', $otp)->update(['verified' => true]);

        return $this->authenticateAndRespond($user, $request, $needsToken);

    }

        /**
     * Login the user using their email and password.
     *
     * @param \Illuminate\Foundation\Http\FormRequest $request
     * @param string|array $role
     * @param bool $needsToken
     * @param array $conditions
     * @return \Illuminate\Http\JsonResponse
     */
    protected function loginUserWithMobile($request, $role, $needsToken = true, array $conditions = [])
    {
        $user = null;

        $identifier = $this->getLoginIdentifier();


        $emailOrUsername = $request->input($identifier);


        if (method_exists($this, $method = 'resolveUserFrom' . Str::studly($identifier))) {
        
            $user = $this->{$method}($emailOrUsername, $role);
            
        }

        if (!$user) {
             
            $this->throwInvalidCredentialsException($identifier);
        }

        // if (!$user->isActive() || !$this->validateChecks($user, $conditions, $identifier)) {

        //     $this->throwAccountDisabledException($identifier);
        // }
       
        return $this->authenticateAndRespond($user, $request, $needsToken);
    }


    /**
     * Login the user using their email and password.
     *
     * @param \Illuminate\Foundation\Http\FormRequest $request
     * @param string|array $role
     * @param bool $needsToken
     * @param array $conditions
     * @return \Illuminate\Http\JsonResponse
     */
    protected function loginUserWithPassword($request, $role, $needsToken = true, array $conditions = [])
    {
        $user = null;

        $identifier = $this->getLoginIdentifier();

        $emailOrUsername = $request->input($identifier);

        $password = $request->input('password');

        if (method_exists($this, $method = 'resolveUserFrom' . Str::studly($identifier))) {
            $user = $this->{$method}($emailOrUsername, $role);
        }
        if (!$user || !hash_check($password, $user->password)) {
            $this->throwInvalidCredentialsException($identifier);
        }

        if (!$user->isActive() || !$this->validateChecks($user, $conditions, $identifier)) {
            $this->throwAccountDisabledException($identifier);
        }

        return $this->authenticateAndRespond($user, $request, $needsToken);
    }


    /**
     * Login the user using social unique id
     *
     * @param \Illuminate\Foundation\Http\FormRequest $request
     * @param string|array $role
     * @param bool $needsToken
     * @param array $conditions
     * @return \Illuminate\Http\JsonResponse
     */
    protected function loginUserWithSocialUniqueId($request, $role, $needsToken = true, array $conditions = [])
    {
        $user = null;
        $identifier = $this->getLoginIdentifier();
        $social_unique_id = $request->input($identifier);

        if (method_exists($this, $method = 'resolveUserFrom' . Str::studly($identifier))) {
            $user = $this->{$method}($social_unique_id, $role);
        }

        if (!$user) {
            $this->throwInvalidCredentialsException($identifier);
        }

        if (!$user->isActive() || !$this->validateChecks($user, $conditions, $identifier)) {
            $this->throwAccountDisabledException($identifier);
        }

        return $this->authenticateAndRespond($user, $request, $needsToken);
    }

    /**
     * Login the user using their mobile and otp.
     *
     * @param \Illuminate\Foundation\Http\FormRequest $request
     * @param string|array $role
     * @param bool $needsToken
     * @param array $conditions
     * @return \Illuminate\Http\JsonResponse
     */
    protected function loginUserWithOTP($request, $role, $needsToken = true, array $conditions = [])
    {
        $mobile = $request->input('mobile');
        $otp = $request->input('otp');

        $user = $this->resolveUserFromMobile($mobile, $role);

        if (!$user) {
            $this->throwCustomValidationException("User with that mobile number doesn't exist.", 'otp');
        }

        if (!$this->otpHandler->setMobile($mobile)->validate($otp)) {
            $this->throwCustomValidationException('The otp provided is invalid.', 'otp');
        }

        if (!$user->isActive() || !$this->validateChecks($user, $conditions, 'otp')) {
            $this->throwAccountDisabledException('otp');
        }

        $this->otpHandler->delete();

        return $this->authenticateAndRespond($user, $request, $needsToken);
    }


    /**
     * Resolve the user from their email for a particular role.
     *
     * @param string $email
     * @param string|array $role
     * @return \App\Models\User|null
     */
    protected function resolveUserFromEmail($email, $role)
    {
         
        return $this->user->belongsToRole($role)
            ->where('email', $email)
            ->first();
    }

    /**
     * Resolve the user from their social_unique_id for a particular role.
     *
     * @param string $social_unique_id
     * @param string|array $role
     * @return \App\Models\User|null
     */
    protected function resolveUserFromSocialUniqueId($social_unique_id, $role)
    {
        return $this->user->belongsToRole($role)
            ->where('social_unique_id', $social_unique_id)
            ->first();
    }

    /**
     * Resolve the user from their social_unique_id for a particular role.
     *
     * @param string $social_unique_id
     * @param string|array $role
     * @return \App\Models\User|null
     */
    protected function resolveUserFromSocialId($social_unique_id, $role)
    {

        return $this->user->belongsToRole($role)
            ->where('social_id', $social_unique_id)
            ->first();
    }


    /**
     * Resolve the user from their username for a particular role.
     *
     * @param $username $email
     * @param string|array $role
     * @return \App\Models\User|null
     */
    protected function resolveUserFromUsername($username, $role)
    {
        
        return $this->user->belongsToRole($role)
            ->where('username', $username)
            ->first();
    }

    /**
     * Resolve the user from their mobile for a particular role.
     *
     * @param string $mobile
     * @param string|array $role
     * @return \App\Models\User|null
     */
    protected function resolveUserFromMobile($mobile, $role)
    {

        return get_or_check_if_exists_user($mobile,$role,false);

        // return $this->user->belongsToRole($role)
            // ->where('mobile', $mobile)
            // ->first();
    }

    /**
     * Validate the user model conditions.
     *
     * @param $user
     * @param array $conditions
     * @param string $field
     * @return bool
     * @internal param $ \App\Models\User|null
     */
    protected function validateChecks($user, array $conditions, $field)
    {
        foreach ($conditions as $key => $value) {
            if ($user->$key != $value) {
                if (mb_strtolower($key) === 'email_confirmed') {
                    /*
                                             * This validation message will be used in the frontend to display
                                             * the 'Resend confirmation email' button/link. Do not alter it!
                    */
                    $this->throwCustomValidationException('Account email confirmation pending.', $field);
                }

                return false;
            }
        }

        return true;
    }

    /**
     * Authenticate the user and respond accordingly.
     * SPA login will authenticate the user using sessions which will create the cookie on refresh.
     * First party apps (Mobile App) will get the access token and refresh token.
     *
     * @param \App\Models\User $user
     * @param \Illuminate\Foundation\Http\FormRequest $request
     * @param bool $needsToken
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    protected function authenticateAndRespond(User $user, $request, $needsToken = false)
    {

        event(new UserLogin($user));

        DB::table('oauth_access_tokens')->where('user_id',$user->id)->delete();
        
        if ($needsToken) { 
            $client_tokens = DB::table('oauth_clients')->where('password_client', 1)->first();
            // dd($client_tokens);
            // @TODO Store login by,fcm,apn tokens

            if ($request->has('device_token')) {
                $user->fcm_token = $request->input('device_token')?:null;
            }

             if($request->has('is_bid_app')){
                $user->is_bid_app=true;

            }
            $user->login_by = $request->input('login_by');
            $user->apn_token = $request->input('apn_token')?:null;
            $user->save();
            $user->fresh();

            if ($request->has('password')) {
            //     return $this->issueToken([
            //     'grant_type' => 'password',
            //     'client_id' => $client_tokens->id,
            //     'client_secret' => $client_tokens->secret,
            //     'username' => $request->input($this->getLoginIdentifier()),
            //     'password' => $request->input('password'),
            // ]);
                $client_tokens = DB::table('oauth_clients')->where('personal_access_client', 1)->first();

                $token = $user->createToken('personal_access', [])->accessToken;

                if($request->has('new_flow') && $request->new_flow){
                    return response()->json(['success'=>true,'message'=>'success','access_token'=>$token]);
                }


                return $this->issueToken([
                'grant_type' => 'personal_access',
                'client_id' => $client_tokens->id,
                'client_secret' => $client_tokens->secret,
                'user_id' => $user->id,
                'scope' => [],
                ]);
                
            } else {
                $client_tokens = DB::table('oauth_clients')->where('personal_access_client', 1)->first();

                $token = $user->createToken('personal_access', [])->accessToken;

                if($request->has('new_flow') && $request->new_flow){
                    return response()->json(['success'=>true,'message'=>'success','access_token'=>$token]);
                }


                return $this->issueToken([
                'grant_type' => 'personal_access',
                'client_id' => $client_tokens->id,
                'client_secret' => $client_tokens->secret,
                'user_id' => $user->id,
                'scope' => [],
                ]);



            }
        }


        return $this->authenticateUser($user, $request->has('remember'));
    }

    /**
     * Generate and issue the Password Grant Token for the user.
     *
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    protected function issueToken(array $data)
    {
        return app(AccessTokenController::class)
            ->issueToken(app(ServerRequestInterface::class)->withParsedBody($data));
    }

    /**
     * Login user using standard auth method and respond success.
     *
     * @param \App\Models\User $user
     * @param bool $remember
     * @return \Illuminate\Http\JsonResponse
     */
    protected function authenticateUser(User $user, $remember = false)
    {
        auth('web')->login($user, $remember);
        // return view('admin.index');
        return $this->respondSuccess();
    }

    /**
     * Login user using standard auth method and respond success.
     *
     * @param \App\Models\User $user
     * @param bool $remember
     * @return \Illuminate\Http\JsonResponse
     */
    protected function set(User $user, $remember = false)
    {
        auth('web')->login($user, $remember);

        return $this->respondSuccess();
    }

    /**
     * Get the default login identifier.
     *
     * @return string
     */
    protected function getLoginIdentifier()
    {
        return $this->loginIdentifier;
    }

    /**
     * Set the default login identifier.
     * Can be email or username.
     *
     * @param string $loginIdentifier
     * @return $this
     */
    protected function setLoginIdentifier($loginIdentifier)
    {
        $this->loginIdentifier = $loginIdentifier;

        return $this;
    }
}
