<?php

namespace App\Http\Controllers\Web;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Jobs\NotifyViaMqtt;
use App\Models\Admin\Driver;
use App\Jobs\NotifyViaSocket;
use App\Models\Admin\ZoneType;
use App\Models\Master\GoodsType;
use App\Models\Request\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Request\RequestMeta;
use Illuminate\Support\Facades\Log;
use App\Base\Constants\Masters\PushEnums;
use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\Request\CreateTripRequest;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Transformers\Requests\TripRequestTransformer;
use App\Jobs\Notifications\FcmPushNotification;
use App\Base\Constants\Setting\Settings;
use Sk\Geohash\Geohash;
use Kreait\Firebase\Contract\Database;
use App\Jobs\Notifications\SendPushNotification;
use Illuminate\Http\Request as ValidatorRequest;
use App\Helpers\Rides\FetchDriversFromFirebaseHelpers;
use App\Transformers\User\EtaTransformer;
use Illuminate\Http\Request as Httprequest;
use App\Models\User;
use App\Models\Country;
use App\Transformers\Requests\PackagesTransformer;
use App\Models\Master\PackageType;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Base\Constants\Auth\Role;
use App\Base\Constants\Masters\UserType;
use App\Base\Constants\Masters\WalletRemarks;
use App\Base\Constants\Masters\zoneRideType;
use App\Base\Constants\Masters\PaymentType;
use App\Models\Admin\CancellationReason;
use Illuminate\Support\Facades\Artisan;
use App\Models\Request\RequestBill;

/**
 * @group User-trips-apis
 *
 * APIs for User-trips apis
 */
class DetailEmailController extends BaseController
{
    use FetchDriversFromFirebaseHelpers;

    protected $request;

    public function __construct(Request $request,Database $database)
    {
        $this->request = $request;
        $this->database = $database;
    }

    public function web_booking()
    {
        $modules = get_settings('enable_modules_for_applications');
        $show_rental_ride_feature = get_settings('show_rental_ride_feature');
        $user_name = 'User';
        $rideInfo = [];
        $userDetails = null;


            $authUser = auth('web')->user();

            if ($authUser) {
                $user_id = $authUser->id;
                $user_name = $authUser->name;
                $rideInfo = Request::where('user_id', $user_id)->get();
                $userDetails = User::where('id', $user_id)->first();
            }

        return view('web-booking.web_booking', compact('user_name', 'modules', 'show_rental_ride_feature', 'rideInfo', 'userDetails'));
    }

    public function web_booking_history()
    {

        $modules = get_settings('enable_modules_for_applications');
        $show_rental_ride_feature = get_settings('show_rental_ride_feature');
        $user_name = 'User';
        $authUser = auth('web')->user();

        if ($authUser) {
            $user_id = $authUser->id;
            $user_name = $authUser->name;
            $rideInfo = Request::where('user_id', $user_id)->get();
            $rideLater = Request::where('user_id', $user_id)->where('is_later', 1)->where('is_cancelled', 0)->where('is_completed', 0)->get();
        } else {

            $rideInfo = [];
            $rideLater = [];
        }



        return view('web-booking.web-booking-history',compact('user_name','modules','show_rental_ride_feature','rideInfo','rideLater'));
    }
    public function web_booking_history_detail(HttpRequest $request,$id)
    {


        $modules = get_settings('enable_modules_for_applications');
        $user_name = 'User';
        $authUser = auth('web')->user();

    if ($authUser) {
        $user_id = $authUser->id;
        $user_name = $authUser->name;
    }

    $request_bill = RequestBill::whereHas('request', function ($query) use ($id) {
        $query->where('user_id', auth()->id())->where('id', $id);
    })->first();

        $rideInfo = Request::where('id', $id)->where('user_id', auth()->id())->get();


        $driverId = $rideInfo[0]['driver_id'];
        $driver = Driver::find($driverId);
        $driverImageId=Driver::where('user_id', $driverId)->first();
        $driverImage=User::where('profile_picture', $driverImageId)->first();
        $driverName = $driver ? $driver->name : 'Unknown';

        return view('web-booking.web-booking-history-details',compact('user_name','modules','rideInfo','request_bill','driverName','driverImage'));
    }
    public function Saveuser(Httprequest $request)
    {

        if($request->mobile)
        {
            $check_user_exist = User::where('mobile',$request->mobile)->first();
            $country_id =  Country::where('dial_code', $request->input('dial_code'))->pluck('id')->first();
            if($check_user_exist)
            {
                $user = $check_user_exist;
            }
            else{
                $user = User::create([
                'name'=>$request->name,
                'mobile' => $request->mobile,
                'country' => $country_id
            ]);
            }

            // Create Empty Wallet to the user
            $user->userWallet()->create(['amount_added'=>0]);

            $user->attachRole(Role::USER);

            auth('web')->login($user, true);
            Session::put('user_id', $user->id);
            Session::put('mobile', $request->mobile);
            Session::put('dial_code', $request->dial_code);

            return response()->json(["status"=>"success","message"=>"user added successfully"]);
        }
        else{
             return response()->json(["status"=>"error","message"=>"something went wrong"]);
        }
    }
    public function Saveuserdemo(Httprequest $request)
    {

        if($request->mobile)
        {
            $check_user_exist = User::where('mobile',$request->mobile)->first();
            $country_id =  Country::where('dial_code', $request->input('dial_code'))->pluck('id')->first();
            if($check_user_exist)
            {
                $user = $check_user_exist;
            }
            else{
                $user = User::create([
                'name'=>$request->name,
                'mobile' => $request->mobile,
                'country' => $country_id
            ]);
            }

            // Create Empty Wallet to the user
            $user->userWallet()->create(['amount_added'=>0]);

            $user->attachRole(Role::USER);

            auth('web')->login($user, true);
            Session::put('user_id', $user->id);
            Session::put('mobile', $request->mobile);
            Session::put('dial_code', $request->dial_code);

            return response()->json(["status"=>"success","message"=>"user added successfully"]);
        }
        else{
             return response()->json(["status"=>"error","message"=>"something went wrong"]);
        }
    }


    /**
     * ETA for web booking
     * @bodyParam pick_lat double required pikup lat of the user
     * @bodyParam pick_lng double required pikup lng of the user
     * @bodyParam drop_lat double required drop lat of the user
     * @bodyParam drop_lng double required drop lng of the user
     * @bodyParam transport_type required transport type of ride
     * @bodyParam promo_code string optional promo code that the user provided
     *
     * */
    public function Eta(ValidatorRequest $request){


        //dd($request->all());

        // Validate Request id
        $request->validate([
            'pick_lat'  => 'required',
            'pick_lng'  => 'required',
            'drop_lat'  =>'sometimes|required',
            'drop_lng'  =>'sometimes|required',
        ]);



        // print_r($request->all());
        // exit;

        $zone_detail = find_zone($request->input('pick_lat'), $request->input('pick_lng'));
        if (!$zone_detail) {
            $this->throwCustomException('service not available with this location');
        }

        if($request->has('transport_type')){

                $type = $zone_detail->zoneType()->where(function($query)use($request){
                    $query->where('transport_type',$request->transport_type)->orWhere('transport_type','both');
                })->active()->get();


        }else{

                $type = $zone_detail->zoneType()->active()->get();

        }


        if ($request->has('vehicle_type')) {

            if($request->has('transport_type')){

                $type = $zone_detail->zoneType()->where(function($query)use($request){
                    $query->where('transport_type',$request->transport_type)->orWhere('transport_type','both');
                })->where('id', $request->input('vehicle_type'))->active()->get();


        }else{

                $type = $zone_detail->zoneType()->where('id', $request->input('vehicle_type'))->active()->get();

        }

        }

        $result = fractal($type, new EtaTransformer);

        if(isset($request->html_type))
        {
            $goods_type = GoodsType::where('active',1)->get();
            $response = $this->respondSuccess($result);
            $result_data = $response->getData();
            $booking_data = $result_data->data;
            $transport_type = $request->transport_type;
            $email=$request->email;


            return view('admin.emaildetails',compact('booking_data','goods_type','transport_type','request','email','response'));
        }
        return $this->respondSuccess($result);

    }

    /**
    * Create Request
    * @bodyParam country_code country code required country code of the user
    * @bodyParam mobile integer required mobile of the user
    * @bodyParam pick_lat double required pikup lat of the user
    * @bodyParam pick_lng double required pikup lng of the user
    * @bodyParam drop_lat double required drop lat of the user
    * @bodyParam drop_lng double required drop lng of the user
    * @bodyParam vehicle_type string required id of zone_type_id
    * @bodyParam payment_opt tinyInteger required type of ride whther cash or card, wallet('0 => card,1 => cash,2 => wallet)
    * @bodyParam pick_address string required pickup address of the trip request
    * @bodyParam drop_address string required drop address of the trip request
    * @bodyParam is_later tinyInteger sometimes it represent the schedule rides param must be 1.
    * @bodyParam trip_start_time timestamp sometimes it represent the schedule rides param must be datetime format:Y-m-d H:i:s.
    * @bodyParam promocode_id uuid optional id of promo table
    * @bodyParam rental_pack_id integer optional id of package type
    * @responseFile responses/requests/create-request.json
    *
    */
    public function createRequest(CreateTripRequest $request)
    {
        // print_r($request->all());
        // exit;

        $zone_type_detail = ZoneType::where('id', $request->vehicle_type)->first();
        $type_id = $zone_type_detail->type_id;
         // Get currency code of Request
        $service_location = $zone_type_detail->zone->serviceLocation;

        $currency_code = $service_location->currency_code;
        $currency_symbol = $service_location->currency_symbol;

        // $currency_code = get_settings('currency_code');
        //Find the zone using the pickup coordinates & get the nearest drivers


        // fetch unit from zone
        $unit = $zone_type_detail->zone->unit;

        $user_detail = User::belongsTorole('user')->where('mobile', $request->mobile)->first();

        $country_id =  Country::where('dial_code', $request->input('country_code'))->pluck('id')->first();

        if(!$user_detail){

            $user_detail = User::create([
                'country'=>$country_id,
                'refferal_code'=>str_random(6),
                'mobile' => $request->mobile,
                'timezone'=>$service_location->timezone
            ]);
        }

        $user_detail->timezone = $service_location->timezone;
        $user_detail->save();
        // print_r($user_detail);
        // exit;

        // Get last request's request_number
        $request_number = $this->request->orderBy('created_at', 'DESC')->pluck('request_number')->first();
        if ($request_number) {
            $request_number = explode('_', $request_number);
            $request_number = $request_number[1]?:000000;
        } else {
            $request_number = 000000;
        }
        // Generate request number
        $request_number = 'REQ_'.sprintf("%06d", $request_number+1);
        $checking_payment=$request->payment_opt;
        if($checking_payment== null){
            $checking_payment='1';
        }
        else{
            $checking_payment=$request->payment_opt;
        }

        $request_params = [
            'request_number'=>$request_number,
            'user_id'=>$user_detail->id,
            'zone_type_id'=>$request->vehicle_type,
            'unit'=>(string)$unit,
            'promo_id'=>$request->promocode_id,
            'requested_currency_code'=>$currency_code,
            'requested_currency_symbol'=>$currency_symbol,
            'service_location_id'=>$service_location->id,
            'ride_otp'=>rand(1111, 9999),
            'payment_opt'=>$checking_payment,
            'goods_type_id'=>$request->goods_type_id,
            'goods_type_quantity'=>$request->goods_type_quantity,
            'transport_type'=>$request->transport_type,
            'web_booking'=>$request->web_booking,

        ];

        if($request->has('is_bid_ride') && $request->input('is_bid_ride')==1){

            $request_params['is_bid_ride']=1;
            $request_params['offerred_ride_fare']=$request->offerred_ride_fare;
        }

        if($request->input('is_later') == 1 && $request->has('trip_start_time')){
             $request_params['is_later']=1;
            $request_params['trip_start_time'] = Carbon::parse($request->trip_start_time, $user_detail->timezone)->setTimezone('UTC')->toDateTimeString();

        }
        if($request->has('rental_package_id') && $request->rental_package_id){

            $request_params['is_rental'] = true;

            $request_params['rental_package_id'] = $request->rental_package_id;
        }

        if($request->has('request_eta_amount') && $request->request_eta_amount){

           $request_params['request_eta_amount'] = $request->request_eta_amount;

        }




        $request_detail = $this->request->create($request_params);

        // To Store Request stops along with poc details
        if ($request->has('stops')) {

            // Log::info($request->stops);

            foreach (json_decode($request->stops) as $key => $stop) {
                $request_detail->requestStops()->create([
                'address'=>$stop->address,
                'latitude'=>$stop->latitude,
                'longitude'=>$stop->longitude,
                'order'=>$stop->order]);

            }
        }

        // request place detail params
        $request_place_params = [
            'pick_lat'=>$request->pick_lat,
            'pick_lng'=>$request->pick_lng,
            'drop_lat'=>$request->drop_lat,
            'drop_lng'=>$request->drop_lng,
            'pick_address'=>$request->pick_address,
            'drop_address'=>$request->drop_address,
            'drop_poc_instruction'=>$request->drop_poc_instruction,
            'drop_poc_name'=>$request->drop_poc_name,
            'drop_poc_mobile'=>$request->drop_poc_mobile];
        // store request place details
        $request_detail->requestPlace()->create($request_place_params);

        // Add Request detail to firebase database
         $this->database->getReference('requests/'.$request_detail->id)->update(['request_id'=>$request_detail->id,'request_number'=>$request_detail->request_number,'service_location_id'=>$service_location->id,'user_id'=>$request_detail->user_id,'pick_address'=>$request->pick_address,'active'=>1,'date'=>$request_detail->converted_created_at,'updated_at'=> Database::SERVER_TIMESTAMP]);

        $request_result =  fractal($request_detail, new TripRequestTransformer)->parseIncludes('userDetail');

         if($request->is_later){


            goto no_drivers_available;
         }




        if ($request->has('is_bid_ride') && $request->input('is_bid_ride')==1) {
                goto no_drivers_available;
        }

        $nearest_drivers =  $this->fetchDriversFromFirebase($request_detail);

        // Send Request to the nearest Drivers
         if ($nearest_drivers==null) {
                goto no_drivers_available;
        }

        no_drivers_available:

         return $this->respondSuccess($request_result, 'created_request_successfully');


    }


    /**
    * List Packages
    * @bodyParam pick_lat double required pikup lat of the user
    * @bodyParam pick_lng double required pikup lng of the user
    *
    */
    public function listPackages(Httprequest $request){

        $request->validate([
            'pick_lat'  => 'required',
            'pick_lng'  => 'required',
        ]);


        $type = PackageType::where('transport_type',$request->transport_type)->orWhere('transport_type', 'both')->active()->get();


        $result = fractal($type, new PackagesTransformer);

        return $this->respondSuccess($result);

    }



    /**
     * Adhoc Cancel Booking
     * @bodyParam request_id uuid required id of request
     * @bodyParam reason string optional reason provided by user
     * @bodyParam custom_reason string optional custom reason provided by
     *
     * */
    public function cancelRide(ValidatorRequest $request){

        // Validate Request id
        $request->validate([
            'request_id'=>'required|exists:requests,id',
            'reason'=>'sometimes|required',
            'custom_reason'=>'sometimes|required|min:2|max:100',
        ]);

        $user = auth('web')->user();
        $request_detail = $user->requestDetail()->where('id', $request->request_id)->first();
        // Throw an exception if the user is not authorised for this request
        if (!$request_detail) {
            $this->throwAuthorizationException();
        }
        $request_detail->update([
            'is_cancelled'=>true,
            'reason'=>$request->reason,
            'custom_reason'=>$request->custom_reason,
            'cancel_method'=>UserType::USER,
            'cancelled_at'=>date('Y-m-d H:i:s')
        ]);

        $request_detail->fresh();
        /**
        * Apply Cancellation Fee
        */
        $charge_applicable = false;

        if ($request->custom_reason) {
            $charge_applicable = true;
        }
        if ($request->reason) {
            $reason = CancellationReason::find($request->reason);
            if($reason){

            if ($reason->payment_type=='free') {
                $charge_applicable=false;
            } else {
                $charge_applicable=true;
            }

            }else{

                $charge_applicable = false;
            }

        }

        /**
         * get prices from zone type
         */

            $ride_type = zoneRideType::RIDENOW;


        if ($charge_applicable) {
            $zone_type_price = $request_detail->zoneType->zoneTypePrice()->where('price_type', $ride_type)->first();

            $cancellation_fee = $zone_type_price->cancellation_fee;
            if ($request_detail->payment_opt==PaymentType::WALLET) {
                $requested_user = $request_detail->userDetail;
                $user_wallet = $requested_user->userWallet;
                $user_wallet->amount_spent += $cancellation_fee;
                $user_wallet->amount_balance -= $cancellation_fee;
                $user_wallet->save();
                // Add the history
                $requested_user->userWalletHistory()->create([
                    'amount'=>$cancellation_fee,
                    'transaction_id'=>$request_detail->id,
                    'remarks'=>WalletRemarks::CANCELLATION_FEE,
                    'request_id'=>$request_detail->id,
                    'is_credit'=>false]);
                $request_detail->requestCancellationFee()->create(['user_id'=>$request_detail->user_id,'is_paid'=>true,'cancellation_fee'=>$cancellation_fee,'paid_request_id'=>$request_detail->id]);
            } else {
                $request_detail->requestCancellationFee()->create(['user_id'=>$request_detail->user_id,'is_paid'=>false,'cancellation_fee'=>$cancellation_fee]);
            }
        }

        // Available the driver who belongs to the request
        $request_driver = $request_detail->driverDetail;
        if ($request_driver) {
            $driver = $request_driver;
        } else {
            $request_meta_driver = $request_detail->requestMeta()->where('active', true)->first();
            if($request_meta_driver){
            $driver = $request_meta_driver->driver;

            }else{
                $driver=null;
            }
        }

        // Delete Meta Driver From Firebase
            $this->database->getReference('request-meta/'.$request_detail->id)->remove();


        if ($driver) {

            // $this->database->getReference('request-meta/'.$request_detail.'/'.$driver->id)->remove();

            $driver->available = true;
            $driver->save();
            $driver->fresh();
            // Notify the driver that the user is cancelled the trip request
            $notifiable_driver = $driver->user;
            $request_result =  fractal($request_detail, new TripRequestTransformer)->parseIncludes('userDetail');

            $push_request_detail = $request_result->toJson();
            // $title = trans('push_notifications.trip_cancelled_by_user_title');
            // $body = trans('push_notifications.trip_cancelled_by_user_body');
            $title = trans('push_notifications.trip_cancelled_by_user_title',[],$notifiable_driver->lang);
            $body = trans('push_notifications.trip_cancelled_by_user_body',[],$notifiable_driver->lang);

            dispatch(new SendPushNotification($notifiable_driver,$title,$body));;
        }
        // Delete meta records
        // RequestMeta::where('request_id', $request_detail->id)->delete();

        $request_detail->requestMeta()->delete();

        Artisan::call('assign_drivers:for_regular_rides');

        return $this->respondSuccess();


    }
    public function delete($id, Request $request)
    {
        $requestRecord = Request::findOrFail($id);
        $requestRecord->update([
            'is_cancelled' => 1,
            'cancelled_at' => now()
        ]);

        $message = trans('succes_messages.ride_cancelled_successful');

        return redirect('web-booking-history')->with('success', $message);
    }
}
