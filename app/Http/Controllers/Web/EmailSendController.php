<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Web\BaseController;
use App\Mail\RidedetailsMail;

use App\Models\User;
use App\Models\Country;

use App\Base\Libraries\SMS\SMSContract;

use App\Helpers\Exception\ExceptionHelpers;

use App\Base\Services\OTP\Handler\OTPHandlerContract;

use App\Base\Services\ImageUploader\ImageUploaderContract;

use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request as HttpRequest;



class EmailSendController extends BaseController
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


    public function index()
    {
        $page = trans('pages_names.email_send');

        $main_menu = 'email_send';
        $sub_menu = '';
        $modules = get_settings('enable_modules_for_applications');
        $show_rental_ride_feature = get_settings('show_rental_ride_feature');
        $user_name = 'User';
        $rideInfo = [];
        $userDetails = null;

        return view('admin.email_send',compact('user_name', 'modules', 'show_rental_ride_feature', 'rideInfo', 'userDetails'));
    }


    public function ridedetails(HttpRequest $request)
    {

        $email = $request->input('email');
        $ridedetailsJson = $request->input('ridedetails');
        $drop_address = $request->input('drop_address');
        $pick_address = $request->input('pick_address');
        $ridedetails = json_decode($ridedetailsJson);


        if (true) {
            Mail::to($email,$ridedetails,$drop_address,$pick_address)->send(new RideDetailsMail($email, $ridedetails, $pick_address, $drop_address));
        }

        return response()->json(['success' => true]);
    }



}
