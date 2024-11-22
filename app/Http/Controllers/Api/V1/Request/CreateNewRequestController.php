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
use Sk\Geohash\Geohash;
use Kreait\Firebase\Contract\Database;
use App\Jobs\Notifications\SendPushNotification;
use Illuminate\Http\Request as ValidatorRequest;
use App\Helpers\Rides\FetchDriversFromFirebaseHelpers;
use App\Models\Request\RequestCycles;
use App\Models\Admin\Promo;
use App\Models\Admin\PromoUser;

/**
 * @group User-trips-apis
 *
 * APIs for User-trips apis
 */
class CreateNewRequestController extends BaseController
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
Log::info("create-request");

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

        // $currency_code = get_settings('currency_code');
        //Find the zone using the pickup coordinates & get the nearest drivers


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
            'timezone'=>$service_location->timezone,
            'ride_otp'=>rand(1111, 9999),
            'poly_line'=>$request->poly_line,
        ];

        if($request->has('is_pet_available')){

            $request_params['is_pet_available'] = $request->is_pet_available;
        }


        if($request->has('is_luggage_available')){

            $request_params['is_luggage_available'] = $request->is_luggage_available;
        }

        $request_params['offerred_ride_fare']=0;

        $app_for = config('app.app_for');


        if($app_for!='taxi' || $app_for!='delivery')
         {
            $request_params['transport_type']='taxi';
            
         }


        if($request->has('is_bid_ride') && $request->input('is_bid_ride')==1){

            $request_params['is_bid_ride']=1;
            $request_params['offerred_ride_fare']=$request->offerred_ride_fare;
        }


        if($request->has('rental_pack_id') && $request->rental_pack_id){

            $request_params['is_rental'] = true;

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
        if($request->has('discounted_total') && $request->discounted_total){

            $request_params['discounted_total'] = $request->discounted_total;

            $request_params['rental_package_id'] = $request->rental_pack_id;
        }

        // store request details to db
        // DB::beginTransaction();
        // try {
        $request_detail = $this->request->create($request_params);

        if($request->promocode_id) {
            $promo = Promo::find($request->promocode_id);
            $promo->update([
                'total_uses' => $promo->total_uses+1,
            ]);
            $promo_params = [
                'promo_code_id' => $request->promocode_id,
                'request_id' => $request_detail->id,
                'user_id' => $user_detail->id,
            ];
            PromoUser::create($promo_params);
        }
          // To Store Request stops along with poc details
        if ($request->has('stops')) {


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
            'drop_address'=>$request->drop_address];
        // store request place details
        $request_detail->requestPlace()->create($request_place_params);

        // Add Request detail to firebase database
         $this->database->getReference('requests/'.$request_detail->id)->update(['request_id'=>$request_detail->id,'request_number'=>$request_detail->request_number,'service_location_id'=>$service_location->id,'user_id'=>$request_detail->user_id,'pick_address'=>$request->pick_address,'drop_address'=>$request->drop_address,'active'=>1,'date'=>$request_detail->converted_created_at,'updated_at'=> Database::SERVER_TIMESTAMP]);

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

        $request_datas['request_id'] = $request_detail->id;
         $request_datas['user_id'] = $request_detail->user_id; 
         $data[0]['status'] = 1;
         $data[0]['process_type'] = "create_request";
         $data[0]['orderby_status'] = 1;
         $data[0]['if_dispatcher'] = false;
         $data[0]['user_image'] = auth()->user()->profile_picture;
         $data[0]['dricver_details'] = null;
         $data[0]['created_at'] = date("Y-m-d H:i:s", time());
         $request_datas['request_data'] =  base64_encode(json_encode($data));
         $request_datas['orderby_status'] = 1;
         $insert_request_cycles = RequestCycles::create($request_datas);

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
        // $currency_code = get_settings('currency_code');

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
            'timezone'=>$service_location->timezone,
            'ride_otp'=>rand(1111, 9999),
            // 'transport_type'=>'taxi',
            'on_search'=>false,
            'poly_line'=>$request->poly_line,
            
            
        ];

        if($request->has('is_pet_available')){

            $request_params['is_pet_available'] = $request->is_pet_available;
        }


        if($request->has('is_luggage_available')){

            $request_params['is_luggage_available'] = $request->is_luggage_available;
        }


        $app_for = config('app.app_for');

        if($app_for!='taxi' || $app_for!='delivery')
         {
            $request_params['transport_type']='taxi';
            
         }
        if($request->has('discounted_total') && $request->discounted_total){

            $request_params['discounted_total'] = $request->discounted_total;

            $request_params['rental_package_id'] = $request->rental_pack_id;
        }

        if($request->has('is_out_station')){
        $request_params['is_bid_ride']=1;
        $request_params['is_out_station'] = $request->is_out_station;
        $request_params['offerred_ride_fare']= $request->offerred_ride_fare;

        if($request->has('is_round_trip'))
        {
        $return_time = Carbon::parse($request->return_time, $timezone)->setTimezone('UTC')->toDateTimeString();

        $request_params['return_time'] = $return_time;
        $request_params['is_round_trip'] = true;


        }


        }

        $request_params['company_key'] = auth()->user()->company_key;


        if($request->has('request_eta_amount') && $request->request_eta_amount){

           $request_params['request_eta_amount'] = $request->request_eta_amount;

        }



        if($request->has('rental_pack_id') && $request->rental_pack_id){

            $request_params['is_rental'] = true;

            $request_params['rental_package_id'] = $request->rental_pack_id;
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
            'drop_address'=>$request->drop_address];
            // store request place details
            $request_detail->requestPlace()->create($request_place_params);

            // Add Request detail to firebase database
         $this->database->getReference('requests/'.$request_detail->id)->update(['request_id'=>$request_detail->id,'request_number'=>$request_detail->request_number,'service_location_id'=>$service_location->id,'user_id'=>$request_detail->user_id,'pick_address'=>$request->pick_address,'drop_address'=>$request->drop_address,'active'=>1,'date'=>$request_detail->converted_trip_start_time,'updated_at'=> Database::SERVER_TIMESTAMP]);

            $request_result =  fractal($request_detail, new TripRequestTransformer)->parseIncludes('userDetail');
            // @TODO send sms & email to the user
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     Log::error($e);
        //     Log::error('Error while Create new schedule request. Input params : ' . json_encode($request->all()));
        //     return $this->respondBadRequest('Unknown error occurred. Please try again later or contact us if it continues.');
        // }
        // DB::commit();


        $request_datas['request_id'] = $request_detail->id;
        $request_datas['user_id'] = $request_detail->user_id;
        $request_datas['orderby_status'] = 1;
        $data[0]['process_type'] = "create_request";
        $data[0]['status'] = 1;
        $data[0]['if_dispatcher'] = false;
        $data[0]['user_image'] = auth()->user()->profile_picture;
        $data[0]['orderby_status'] = 1;
        $data[0]['dricver_details'] = null;
        $data[0]['created_at'] = date("Y-m-d H:i:s", time());
        $request_datas['request_data'] =  base64_encode(json_encode($data));
        $insert_request_cycles = RequestCycles::create($request_datas);

        return $this->respondSuccess($request_result,'created_request_successfully');
    }



    /**
     * Respond For Bid ride
     *
     *
     * */
    public function respondForBid(ValidatorRequest $request){
        // Get Request Detail
        $request_detail = $this->request->where('id', $request->input('request_id'))->where('user_id',auth()->user()->id)->first();
        // Validate the request i,e the request is already accepted by some one and it is a valid request for accept or reject state.

        if($request_detail==null){
            $this->throwCustomException('unauthorized request');
        }

        $this->validateRequestDetail($request_detail);

        $driver = Driver::where('id',$request->driver_id)->first();

        $accepted_fare = $request->accepted_ride_fare;
        $offered_fare = $request->offerred_ride_fare;

        $updated_params = [
            'driver_id'=>$driver->id,
            'accepted_at'=>date('Y-m-d H:i:s'),
            // 'is_driver_started'=>true,
            'accepted_ride_fare'=>$accepted_fare,
            'offerred_ride_fare'=>$offered_fare,
        ];

        if($request_detail->is_out_station==0)
        {
            $updated_params['is_driver_started'] = true;
        }



        if($driver->owner_id){

                $updated_params['owner_id'] = $driver->owner_id;

                $updated_params['fleet_id'] = $driver->fleet_id;
            }

        $request_detail->update($updated_params);
        $request_detail->fresh();


        $driver->available = false;
            $driver->save();

        $notifable_driver = $driver->user;

        $title = trans('push_notifications.ride_confirmed_by_user_title',[],$notifable_driver->lang);
        $body = trans('push_notifications.ride_confirmed_by_user_body',[],$notifable_driver->lang);

        dispatch(new SendPushNotification($notifable_driver,$title,$body));

        return $this->respondSuccess();


    }



    /**
    * Validate the request detail
    */
    public function validateRequestDetail($request_detail)
    {

        if ($request_detail->is_completed) {
            $this->throwCustomException('request completed already');
        }
        if ($request_detail->is_cancelled) {
            $this->throwCustomException('request cancelled');
        }
    }

//outstation Rides outstationRides
    public function outstationRides()
    {

    $user = auth()->user();

    if($user->hasRole('user'))
    {
    $request_detail =  $this->request->where('user_id', $user->id)->where('is_completed', false)->where('is_cancelled', false)->where('is_out_station', true)->where('is_trip_start',false)->get();
// dd($request_detail);

    }

    if($user->hasRole('driver'))
    {
     $request_detail =  $this->request->where('driver_id', $user->driver->id)->where('is_completed', false)->where('is_cancelled', false)->where('is_out_station', true)->get();
    }

      $request_result =  fractal($request_detail, new TripRequestTransformer)->parseIncludes(['userDetail','driverDetail','requestStops ']);

    return $this->respondSuccess($request_result,'out_station_ride_list');


    }



}
