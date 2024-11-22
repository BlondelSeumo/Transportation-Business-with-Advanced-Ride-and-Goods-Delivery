<?php

namespace App\Http\Controllers\Api\V1\Request;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Jobs\NotifyViaMqtt;
use App\Models\Admin\Driver;
use App\Jobs\NotifyViaSocket;
use App\Models\Admin\ZoneType;
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
use Kreait\Firebase\Contract\Database;
use Sk\Geohash\Geohash;
use App\Jobs\Notifications\SendPushNotification;
use App\Helpers\Rides\FetchDriversFromFirebaseHelpers;

/**
 * @group User-trips-apis
 *
 * APIs for User-trips apis
 */
class DeliveryCreateRequestController extends BaseController
{
    use FetchDriversFromFirebaseHelpers;

    protected $request;

    public function __construct(Request $request,Database $database)
    {
        $this->request = $request;
        $this->database = $database;
    }
    /**
    * Create Request
    * @bodyParam pick_lat double required pikup lat of the user
    * @bodyParam pick_lng double required pikup lng of the user
    * @bodyParam drop_lat double required drop lat of the user
    * @bodyParam drop_lng double required drop lng of the user
    * @bodyParam drivers json required drivers json can be fetch from firebase db
    * @bodyParam vehicle_type string required id of zone_type_id
    * @bodyParam payment_opt tinyInteger required type of ride whther cash or card, wallet('0 => card,1 => cash,2 => wallet)
    * @bodyParam pick_address string required pickup address of the trip request
    * @bodyParam pickup_poc_name string optionl pickup poc name of the trip pick address
    * @bodyParam pickup_poc_mobile string optionl pickup poc mobile of the trip pick address
    * @bodyParam drop_poc_name string optionl drop poc name of the trip drop address
    * @bodyParam drop_poc_mobile string optionl drop poc mobile of the trip drop address
    * @bodyParam goods_type_id integer required goods types of the request
    * @bodyParam goods_type_quantity string required goods type's quantity of the request
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


        /**
        * Check if the user has registred a trip already
        * Validate payment option is available.
        * if card payment choosen, then we need to check if the user has added thier card.
        * if the paymenr opt is wallet, need to check the if the wallet has enough money to make the trip request
        * Check if thge user created a trip and waiting for a driver to accept. if it is we need to cancel the exists trip and create new one
        * Find the zone using the pickup coordinates & get the nearest drivers
        * create request along with place details
        * assing driver to the trip depends the assignment method
        * send emails and sms & push notifications to the user& drivers as well.
        */
        // Check whether the trip is schedule ride or not
        if ($request->has('is_later') && $request->is_later) {
            return $this->createRideLater($request);
        }
        // Check if the user has registred a trip already
        // $user_exists_trip = $this->request->where('is_completed', 0)->where('is_cancelled', 0)->where('user_id', auth()->user()->id)->where('is_later', 0)->exists();
        // if ($user_exists_trip) {
        //     $this->throwCustomException('user_already_in_trip');
        // }
        // Validate payment option is available.
        // @TODO
        //Check if thge user created a trip and waiting for a driver to accept. if it is we need to cancel the exists trip and create new one
        $request_meta_with_current_user = RequestMeta::where('user_id', auth()->user()->id);
        $check_request_data_with_user = $request_meta_with_current_user->exists();
        if ($check_request_data_with_user) {
            // get request detail
            $request_with_user = $request_meta_with_current_user->pluck('request_id')->first();
            if ($request_with_user) {
                $this->request->where('id', $request_with_user)->update(['is_cancelled'=>1,'cancel_method'=>1,'cancelled_at'=>date('Y-m-d H:i:s')]);
            }
            // Delete all meta details
            $request_meta_with_current_user->delete();
        }
        // get type id
        $zone_type_detail = ZoneType::where('id', $request->vehicle_type)->first();
        $type_id = $zone_type_detail->type_id;

        // Get currency code of Request
        $service_location = $zone_type_detail->zone->serviceLocation;
        $currency_code = $service_location->currency_code;
        $currency_symbol = $service_location->currency_symbol;

       
        // fetch unit from zone
        $unit = $zone_type_detail->zone->unit;
        // Fetch user detail
        $user_detail = auth()->user();

        $user_detail->timezone = $service_location->timezone;
        $user_detail->save();

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


        $request_params = [
            'request_number'=>$request_number,
            'user_id'=>$user_detail->id,
            'zone_type_id'=>$request->vehicle_type,
            'payment_opt'=>$request->payment_opt,
            'unit'=>(string)$unit,
            'promo_id'=>$request->promocode_id,
            'requested_currency_code'=>$currency_code,
            'requested_currency_symbol'=>$currency_symbol,
            'service_location_id'=>$service_location->id,
            'ride_otp'=>rand(1111, 9999),
            'goods_type_id'=>$request->goods_type_id,
            'goods_type_quantity'=>$request->goods_type_quantity,
            'transport_type'=>'delivery',
            'poly_line'=>$request->poly_line,
        ];

        if($request->has('is_bid_ride') && $request->input('is_bid_ride')==1){

            $request_params['is_bid_ride']=1;
            $request_params['offerred_ride_fare']=$request->offerred_ride_fare;
        }

        if($request->has('rental_pack_id') && $request->rental_pack_id){

            $request_params['is_rental'] = true;
            
            $request_params['rental_package_id'] = $request->rental_pack_id;
        }
        if($request->has('discounted_total') && $request->discounted_total){

            $request_params['discounted_total'] = $request->discounted_total;

            $request_params['rental_package_id'] = $request->rental_pack_id;
        }
        if($request->has('myself') && $request->input('myself')==0){

            $request_params['book_for_other'] = 1;

            if(!$request->has('contact_no_other') || $request->input('contact_no_other')==null){
                
                $this->throwCustomException('please provide the valid contact');

            }
            $request_params['book_for_other_contact'] = $request->input('contact_no_other');

        }

        $request_params['company_key'] = auth()->user()->company_key;

        if($request->has('request_eta_amount') && $request->request_eta_amount){

           $request_params['request_eta_amount'] = $request->request_eta_amount;

        }
        // store request details to db
        // DB::beginTransaction();
        // try {
        $request_detail = $this->request->create($request_params);

        // To Store Request stops along with poc details
        if ($request->has('stops')) {
            foreach (json_decode($request->stops) as $key => $stop) {
                $request_detail->requestStops()->create([
                'address'=>$stop->address,
                'latitude'=>$stop->latitude,
                'longitude'=>$stop->longitude,
                'poc_name'=>$stop->poc_name,
                'poc_mobile'=>$stop->poc_mobile,
                'poc_instruction'=>$stop->poc_instruction,
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
            'pickup_poc_name'=>$request->pickup_poc_name,
            'pickup_poc_mobile'=>$request->pickup_poc_mobile,
            'pickup_poc_instruction'=>$request->pickup_poc_instruction,
            'drop_poc_instruction'=>$request->drop_poc_instruction,
            'drop_poc_name'=>$request->drop_poc_name,
            'drop_poc_mobile'=>$request->drop_poc_mobile
        ];
        // store request place details
        $request_detail->requestPlace()->create($request_place_params);
        $request_result =  fractal($request_detail, new TripRequestTransformer)->parseIncludes('userDetail');
        
         if ($request->has('is_bid_ride') && $request->input('is_bid_ride')==1) {
                goto no_drivers_available;
        }

        $nearest_drivers =  $this->fetchDriversFromFirebase($request_detail);

        // Send Request to the nearest Drivers
         if ($nearest_drivers==null) {
                goto no_drivers_available;
            }

        no_drivers_available:

        // @TODO send sms & email to the user
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     Log::error($e);
        //     Log::error('Error while Create new request. Input params : ' . json_encode($request->all()));
        //     return $this->respondBadRequest('Unknown error occurred. Please try again later or contact us if it continues.');
        // }
        // DB::commit();

        return $this->respondSuccess($request_result, 'created_request_successfully');
    }

    /**
    * Create Ride later trip
    */
    public function createRideLater(CreateTripRequest $request)
    {
        /**
        * @TODO validate if the user has any trip with same time period
        *
        */
        // get type id
        $zone_type_detail = ZoneType::where('id', $request->vehicle_type)->first();
        $type_id = $zone_type_detail->type_id;

        // Get currency code of Request
        $service_location = $zone_type_detail->zone->serviceLocation;
        $currency_code = $service_location->currency_code;
        $currency_symbol = $service_location->currency_symbol;

        // fetch unit from zone
        $unit = $zone_type_detail->zone->unit;
        // Fetch user detail
        $user_detail = auth()->user();
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

        // Convert trip start time as utc format
        $timezone = $service_location->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');

        // Update timezone for user
        $user_detail->timezone = $service_location->timezone;

        $user_detail->save();

        $trip_start_time = Carbon::parse($request->trip_start_time, $timezone)->setTimezone('UTC')->toDateTimeString();

        $request_params = [
            'request_number'=>$request_number,
            'user_id'=>$user_detail->id,
            'is_later'=>true,
            'trip_start_time'=>$trip_start_time,
            'zone_type_id'=>$request->vehicle_type,
            'payment_opt'=>$request->payment_opt,
            'unit'=>(string)$unit,
            'requested_currency_code'=>$currency_code,
            'requested_currency_symbol'=>$currency_symbol,
            'service_location_id'=>$service_location->id,
            'ride_otp'=>rand(1111, 9999),
            'goods_type_id'=>$request->goods_type_id,
            'goods_type_quantity'=>$request->goods_type_quantity,
            'transport_type'=>'delivery'
        ];

        if($request->has('is_out_station')){

        $request_params['is_bid_ride']=1;
        $request_params['is_out_station'] = $request->is_out_station;
        $request_params['offerred_ride_fare'] = $request->offerred_ride_fare;

        if($request->has('is_round_trip')){
        $return_time = Carbon::parse($request->return_time, $timezone)->setTimezone('UTC')->toDateTimeString();

        $request_params['return_time'] = $return_time;

        }

       
        }

        $request_params['company_key'] = auth()->user()->company_key;
        
        if($request->has('rental_pack_id') && $request->rental_pack_id){

            $request_params['is_rental'] = true;
            
            $request_params['rental_package_id'] = $request->rental_pack_id;
        }
        if($request->has('discounted_total') && $request->discounted_total)
        {

            $request_params['discounted_total'] = $request->discounted_total;

            $request_params['rental_package_id'] = $request->rental_pack_id;
        }

        // store request details to db
        DB::beginTransaction();
        try {
            $request_detail = $this->request->create($request_params);
            
            // To Store Request stops along with poc details
        if ($request->has('stops')) {
            foreach (json_decode($request->stops) as $key => $stop) {
                $request_detail->requestStops()->create([
                'address'=>$stop->address,
                'latitude'=>$stop->latitude,
                'longitude'=>$stop->longitude,
                'poc_name'=>$stop->poc_name,
                'poc_mobile'=>$stop->poc_mobile,
                'poc_instruction'=>$stop->poc_instruction,
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
            'pickup_poc_name'=>$request->pickup_poc_name,
            'pickup_poc_mobile'=>$request->pickup_poc_mobile,
            'pickup_poc_instruction'=>$request->pickup_poc_instruction,
            'drop_poc_instruction'=>$request->drop_poc_instruction,
            'drop_poc_name'=>$request->drop_poc_name,
            'drop_poc_mobile'=>$request->drop_poc_mobile
        ];
        
            // store request place details
            $request_detail->requestPlace()->create($request_place_params);

            $request_result =  fractal($request_detail, new TripRequestTransformer)->parseIncludes('userDetail');
            // @TODO send sms & email to the user
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            Log::error('Error while Create new schedule request. Input params : ' . json_encode($request->all()));
            return $this->respondBadRequest('Unknown error occurred. Please try again later or contact us if it continues.');
        }
        DB::commit();

        return $this->respondSuccess($request_result,'created_request_successfully');
    }
}
