<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Base\Constants\Auth\Role;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Auth\SendLoginOTPRequest;
use App\Http\Requests\Auth\App\GenericAppLoginRequest;
use App\Http\Controllers\Web\Auth\LoginController as BaseLoginController;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use App\Models\MobileOtp;
use App\Http\Requests\Auth\Registration\ValidateMobileOTPRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
/**
 * @group Authentication
 *
 * APIs for Authentication
 */
class LoginController extends BaseLoginController
{
    /**
     * Login user and respond with access token and refresh token.
     * @group User-Login
     *
     * @param \App\Http\Requests\Auth\App\GenericAppLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @bodyParam email string optional email of the user entered
     * @bodyParam mobile string optional mobile of the user entered
     * @bodyParam password string optional password of the user entered
     * @bodyParam device_token string required fcm_token of the user entered

     * @response {
    "token_type": "Bearer",
    "expires_in": 1296000,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjM4ZTE2N2YyNzlkM2UzZWEzODM5ZGNlMmY4YjdiNDQxYjMwZDQ0YmVlYjAzOWNmZjMzMmE2ZTc0ZDY1MDRiNmE3NjhhZWQzYWU5ZjE5MGUwIn0.eyJhdWQiOiIyIiwianRpIjoiMzhlMTY3ZjI3OWQzZTNlYTM4MzlkY2UyZjhiN2I0NDFiMzBkNDRiZWViMDM5Y2ZmMzMyYTZlNzRkNjUwNGI2YTc2",
    "refresh_token": "def5020045b028faaca5890136e3a8d7c850fb6b95cf2f78698b2356e544ee567cef1efa4099eaea3e3738ba11c9baabb1188a3d49de316e4451f32cdaa6017ebb9ff748fdf43d84b4e796a0456c4125ebaeca7930491fe315e4b86adf787999250966"
}
     */
    public function loginUser(GenericAppLoginRequest $request)
    {

        return $this->loginUserAccountApp($request, Role::USER);
    }

    /**
     * Login driver and respond with access token and refresh token.
     * @group User-Login
     *
     * @param \App\Http\Requests\Auth\App\GenericAppLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
      * @bodyParam email string optional email of the user entered
     * @bodyParam mobile string optional mobile of the user entered
     * @bodyParam social_unique_id string optional mobile of the user entered
     * @bodyParam password string optional password of the user entered
     * @bodyParam device_token string optional fcm_token for push notification
     * @bodyParam apn_token string optional fcm_token for ios push notification
     * @bodyParam login_by string required i.e android,ios

     * @response {
    "token_type": "Bearer",
    "expires_in": 1296000,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjM4ZTE2N2YyNzlkM2UzZWEzODM5ZGNlMmY4YjdiNDQxYjMwZDQ0YmVlYjAzOWNmZjMzMmE2ZTc0ZDY1MDRiNmE3NjhhZWQzYWU5ZjE5MGUwIn0.eyJhdWQiOiIyIiwianRpIjoiMzhlMTY3ZjI3OWQzZTNlYTM4MzlkY2UyZjhiN2I0NDFiMzBkNDRiZWViMDM5Y2ZmMzMyYTZlNzRkNjUwNGI2YTc2",
    "refresh_token": "def5020045b028faaca5890136e3a8d7c850fb6b95cf2f78698b2356e544ee567cef1efa4099eaea3e3738ba11c9baabb1188a3d49de316e4451f32cdaa6017ebb9ff748fdf43d84b4e796a0456c4125ebaeca7930491fe315e4b86adf787999250"
}*/
    public function loginDriver(GenericAppLoginRequest $request)
    {

        if($request->has('role') && $request->role=='driver'){
            return $this->loginUserAccountApp($request, Role::DRIVER);
        }

        if($request->has('role') && $request->role=='owner'){
            return $this->loginUserAccountApp($request, Role::OWNER);
        }
            
        return $this->loginUserAccountApp($request, Role::DRIVER);

    }


    /**
     * Login Admin user and respond with access token and refresh token.
     * @group User-Login
     *@hideFromAPIDocumentation
     *
     * @param \App\Http\Requests\Auth\App\GenericAppLoginRequest $request
     * @return \Illuminate\Http\JsonResponse

     * @response {
    "token_type": "Bearer",
    "expires_in": 1296000,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjM4ZTE2N2YyNzlkM2UzZWEzODM5ZGNlMmY4YjdiNDQxYjMwZDQ0YmVlYjAzOWNmZjMzMmE2ZTc0ZDY1MDRiNmE3NjhhZWQzYWU5ZjE5MGUwIn0.eyJhdWQiOiIyIiwiacaP8zkCWTpzh8ZtWBUYVrPkYRWbwz-L5x6dx2d901Aq_7-LwlzPMtP0N93kVfFuLwK2RCzlVtcCTxZaUW9S7x3Y",
    "refresh_token": "def5020045b028faaca5890136e3a8d7c850fb6b95cf2f78698b2356e544ee567cef1efa4099eaea3e3738ba11c9baabb1188a3d49de316e4451f32cdaa6017ebb9ff748fdf43d84b4e796a0456c4125ebaeca7930491fe315e4b86adf7879992509667dd68eacc488bddb2cc005357cdab1da5f0582659eef11e06bf2447c1209f6c17c83453cd6fa6dd6d5d98ff7129a6d3f3509c6c99fba379ea4aee85c0eb89b5f648682484452219d1c592d80c3165657a519f790ba19ad347774c0a199"
}*/
    public function loginAdmin(GenericAppLoginRequest $request)
    {
        return $this->loginUserAccountApp($request, Role::adminRoles());
    }

    /**
    * Social auth
    * @bodyParam device_token string optional fcm_token for push notification
    * @bodyParam login_by string required i.e android,ios
    * @bodyParam oauth_token string required from social provider
    * @return \Illuminate\Http\JsonResponse

     * @response {
    "token_type": "Bearer",
    "expires_in": 1296000,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjM4ZTE2N2YyNzlkM2UzZWEzODM5ZGNlMmY4YjdiNDQxYjMwZDQ0YmVlYjAzOWNmZjMzMmE2ZTc0ZDY1MDRiNmE3NjhhZWQzYWU5ZjE5MGUwIn0.eyJhdWQiOiIyIiwiacaP8zkCWTpzh8ZtWBUYVrPkYRWbwz-L5x6dx2d901Aq_7-LwlzPMtP0N93kVfFuLwK2RCzlVtcCTxZaUW9S7x3Y",
    "refresh_token": "def5020045b028faaca5890136e3a8d7c850fb6b95cf2f78698b2356e544ee567cef1efa4099eaea3e3738ba11c9baabb1188a3d49de316e4451f32cdaa6017ebb9ff748fdf43d84b4e796a0456c4125ebaeca7930491fe315e4b86adf7879992509667dd68eacc488bddb2cc005357cdab1da5f0582659eef11e06bf2447c1209f6c17c83453cd6fa6dd6d5d98ff7129a6d3f3509c6c99fba379ea4aee85c0eb89b5f648682484452219d1c592d80c3165657a519f790ba19ad347774c0a199"
}*/
    public function socialAuth(Request $request, $provider)
    {
        $oauth_token = $request->oauth_token;
        $social_user = Socialite::driver($provider)->userFromToken($oauth_token);

        $user = User::where('social_provider', $provider)->where('social_id', $social_user->id)->first();

        if (!$user) {
            $this->throwCustomException('user-not-found');
        }
        // Update User data with social provider
        $user->social_id = $social_user->id;
        $user->social_token = $social_user->token;
        $user->social_refresh_token = $social_user->refreshToken;
        $user->social_expires_in = $social_user->expiresIn;
        $user->social_avatar = $social_user->avatar;
        $user->social_avatar_original = $social_user->avatar_original;
        $user->login_by = $request->input('login_by');
        $user->fcm_token = $request->input('device_token')?:null;
        $user->save();
        $client_tokens = DB::table('oauth_clients')->where('personal_access_client', 1)->first();

        return $this->issueToken([
                'grant_type' => 'personal_access',
                'client_id' => $client_tokens->id,
                'client_secret' => $client_tokens->secret,
                'user_id' => $user->id,
                'scope' => [],
            ]);
    }


    /**
     * Login Dispatcher user and respond with access token and refresh token.
     * @group User-Login
     *
     * @param \App\Http\Requests\Auth\App\GenericAppLoginRequest $request
     * @return \Illuminate\Http\JsonResponse

     * @response {
    "token_type": "Bearer",
    "expires_in": 1296000,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjM4ZTE2N2YyNzlkM2UzZWEzODM5ZGNlMmY4YjdiNDQxYjMwZDQ0YmVlYjAzOWNmZjMzMmE2ZTc0ZDY1MDRiNmE3NjhhZWQzYWU5ZjE5MGUwIn0.eyJhdWQiOiIyIiwiacaP8zkCWTpzh8ZtWBUYVrPkYRWbwz-L5x6dx2d901Aq_7-LwlzPMtP0N93kVfFuLwK2RCzlVtcCTxZaUW9S7x3Y",
    "refresh_token": "def5020045b028faaca5890136e3a8d7c850fb6b95cf2f78698b2356e544ee567cef1efa4099eaea3e3738ba11c9baabb1188a3d49de316e4451f32cdaa6017ebb9ff748fdf43d84b4e796a0456c4125ebaeca7930491fe315e4b86adf7879992509667dd68eacc488bddb2cc005357cdab1da5f0582659eef11e06bf2447c1209f6c17c83453cd6fa6dd6d5d98ff7129a6d3f3509c6c99fba379ea4aee85c0eb89b5f648682484452219d1c592d80c3165657a519f790ba19ad347774c0a199"
}*/
    public function loginDispatcher(GenericAppLoginRequest $request)
    {
        return $this->loginUserAccountApp($request, Role::DISPATCHER);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
    * Obtain the user information from GitHub.
    *
    * @return \Illuminate\Http\Response
    */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        // $user->token;
    }


    /**
     * Logout the user based on their access token.
     * @group User-Login
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @response {"success":true,"message":"success"}
     */
    public function logout(Request $request)
    {   
        $user = auth()->user();

        $user->fcm_token=null;
        $user->save();
        
        auth()->user()->token()->revoke();

        return $this->respondSuccess();
    }

    /**
     * Send the OTP for user login.
     * @group User-Login
     * @param \App\Http\Requests\Auth\SendLoginOTPRequest $request
     * @bodyParam mobile string required mobile of the user entered
     * @return \Illuminate\Http\JsonResponse
     * @response {"success":true,"message":"success","uuid":"54e4ebe54er5e45re5ber54r5r5rr"}
     */
    public function sendUserLoginOTP(SendLoginOTPRequest $request)
    {
        $field = 'mobile';

        $mobile = $request->input($field);

        $user = $this->resolveUserFromMobile($mobile, Role::USER);

        $this->validateUser($user, "User with that mobile number doesn't exist.", $field);

        if (!$user->createOTP()) {
            $this->throwSendOTPErrorException($field);
        }

        $otp = $user->getCreatedOTP();
        /**
        * Send OTP here
        * Temporary logger
        */
        \Log::info("Login OTP for {$mobile} is : {$otp}");

        return $this->respondSuccess(['uuid' => $user->getCreatedOTPUuid()]);
    }

    /**
     * Validate the user model and their account status.
     *
     * @param \App\Models\User|null $user
     * @param string $message
     * @param string|null $field
     */
    protected function validateUser($user, $message, $field = null)
    {
        if (!$user) {
            $this->throwCustomException($message, $field);
        }

        if (!$user->isActive()) {
            $this->throwAccountDisabledException($field);
        }
    }



public function mobileOtp(Request $request)
{
    $mobile = $request->mobile;


    // dd();

    $otp = rand(100000, 999999);
    $country_code = $request->country_code;

// Log::info("Sms Api Calls");

    // Check if an OTP already exists for the given mobile number
    $existingOtp = MobileOtp::where('mobile', $mobile)->first();

    if ($existingOtp) {
        // Update the existing record with the new OTP
        $existingOtp->otp = $otp;
        $existingOtp->updated_at = now();
        $existingOtp->save();
    } else {
        // Create a new record if no existing record is found
        MobileOtp::create(['mobile' => $mobile, 'otp' => $otp]);
    }

    $active_sms_gateway = get_active_sms_settings();


// Log::info("Active sms gatway".$active_sms_gateway);
    if (method_exists($this, $method = $active_sms_gateway)) {
         return $user = $this->{$method}($mobile, $otp, $country_code);
    }

    return $this->respondFailed();
}

//sms India Hub
    public function enable_sms_india_hub($mobile,$otp,$country_code)
    {
// Log::info("sms India Hub");

        $apiKey = get_sms_settings('sms_india_hub_api_key');
        $sid = get_sms_settings('sms_india_hub_sid');
        // dd($apiKey);
        $msisdn = $country_code.$mobile; // Replace with the recipient's phone number
        
        $msg = "Dear User, your wait is finally over! Your account OTP is $otp.";
        $fl = '0';
        $gwid = '2';


        $response = Http::get('http://cloud.smsindiahub.in/vendorsms/pushsms.aspx', [
            'APIKey' => $apiKey,
            'msisdn' => $msisdn,
            'sid' => $sid,
            'msg' => $msg,
            'fl' => $fl,
            'gwid' => $gwid,
        ]);

        return $this->respondSuccess();
     } 
//sparrow
    public function enable_sparrow($mobile,$otp,$country_code)
    {
        /*Note
        #make sure you updated server Ip addres in saprrow sms gateway  portal
        */
        $msg = "Dear User, your wait is finally over! Your account OTP is $otp.";

        $token = get_sms_settings('sparrow_sender_id');
        $id = get_sms_settings('sparrow_token');
        // dd($id);

        // @TODO implement send sms
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://api.sparrowsms.com/v2/sms/');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "token=$token.M4Wm&from=$id&to=".$mobile."&text=".$msg);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $server_output = curl_exec($ch);

        curl_close($ch); 
// dd($ch);
        $status = json_decode($response);
            // dd($status->status);

        if($status->status!=200)
        {

          return response()->json(['success'=>false,'message'=>$status->message]);

        }else{

           return $this->respondSuccess();  
        }    }
//twilio
//twilio
    public function enable_twilio($mobile,$otp,$country_code)
    {


        $msg = "Dear User, your wait is finally over! Your account OTP is $otp.";

        $twilioSid = get_sms_settings('twilio_sid');
        $twilioToken = get_sms_settings('twilio_token');
        $twilioPhoneNumber = get_sms_settings('twilio_from_number');


        $url = "https://api.twilio.com/2010-04-01/Accounts/{$twilioSid}/Messages.json";

        $postData = [
            'From' => $twilioPhoneNumber,
            'To' => $country_code.$mobile,
            'Body' => $msg,
        ];
        

        $postFields = http_build_query($postData);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_USERPWD, "{$twilioSid}:{$twilioToken}");

        $response = curl_exec($ch);
       
        curl_close($ch);

        $status = json_decode($response);
     
        if($status->status==400){

            $this->throwCustomException($status->message);
        }
          

          
        if($status->status==401){

            $this->throwCustomException($status->message);
        }        
        if($status->error_message!=null)
        {

          return response()->json(['success'=>false,'message'=>$status->error_message]);

        }else{

           return $this->respondSuccess();  
        }




    } 
//smsala
    public function enable_smsala($mobile,$otp,$country_code)
    {
        $country_code = explode('+', $country_code);

        $country_code = $country_code[1];

        $apiKey = get_sms_settings('smsala_api_key');
        $apiPassword = get_sms_settings('smsala_secrect_key');
        $smsType = "T";  
        $encoding = "T";  
        $senderId = get_sms_settings('smsala_token');

        $phoneNumber =$country_code.$mobile;  

        $msg = "Dear User, your wait is finally over! Your OTP is. $otp"; // Replace with the message you want to send

        $client = new Client();

            $response = $client->get('https://api.smsala.com/api/SendSMS', [
                'query' => [
                    'api_id' => $apiKey,
                    'api_password' => $apiPassword,
                    'sms_type' => $smsType,
                    'encoding' => $encoding,
                    'sender_id' => $senderId,
                    'phonenumber' => $phoneNumber,
                    'textmessage' => $msg,
                ]
            ]);

            $body = $response->getBody();
            $content = $body->getContents();

            if(json_decode($content)->status=="S"){
                return $this->respondSuccess();    
            }else{
                return response()->json(["error" => 'configurations-mis-match'], 500);
            }

    }

//msg91    
    public function enable_msg91($mobile, $otp ,$country_code)
    {
        // MSG91 API details
        
        $template_id = get_sms_settings('msg91_sender_id'); 
        $auth_key = get_sms_settings('msg91_auth_key'); 

        // Ensure the mobile number is prefixed with the country code
        $mobile = $country_code. $mobile;

        // Initialize cURL session
        $curl = curl_init();

        // Prepare the data to be sent in the POST request
        $postData = [
            "template_id" => $template_id,
            "short_url" => "0",
            "recipients" => [
                [
                    "mobiles" => $mobile,
                    "var" => $otp  // Ensure 'var' matches the placeholder in the template
                ]
            ]
        ];

        // Set the cURL options
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.msg91.com/api/v5/flow/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($postData),
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authkey: $auth_key",
                "content-type: application/json"
            ],
        ]);

        // Execute the cURL request
        $response = curl_exec($curl);
        $err = curl_error($curl);

        // Close the cURL session
        curl_close($curl);

        // Return the response or the error
        if ($err) {
            return response()->json(["error" => $err], 500);
        } else {
            return response()->json(json_decode($response, true));
        }
    }


//validate-OTP
   public function validateSmsOtp(ValidateMobileOTPRequest $request)
   {
        $otp = $request->otp;
        $mobile = $request->mobile;


        //  Log::info($otp);
        // Log::info($mobile);

        $verify_otp = MobileOtp::where('mobile' ,$mobile)->where('otp', $otp)->first();

           
            // Log::info($verify_otp);

        if (!$verify_otp) 
        {
            // Log::info($otp);
            // Log::info($mobile);

            $this->throwCustomValidationException(['message' => "The otp provided has Invaild" ]);
        }

        $verify_otp ->update(['verified' => true]);

        return $this->respondSuccess(['otp' => $verify_otp]);

   }

 




}