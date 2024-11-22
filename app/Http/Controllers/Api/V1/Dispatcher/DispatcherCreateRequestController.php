<?php

namespace App\Http\Controllers\Api\V1\Dispatcher;

use Ramsey\Uuid\Uuid;
use App\Jobs\NotifyViaMqtt;
use App\Models\Admin\Driver;
use App\Jobs\NotifyViaSocket;
use App\Models\Admin\ZoneType;
use Illuminate\Http\Request as ValidatorRequest;
use App\Models\Request\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Request\RequestMeta;
use Illuminate\Support\Facades\Log;
use App\Base\Constants\Masters\PushEnums;
use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\Request\CreateTripRequest;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Transformers\Requests\TripRequestTransformer;
use App\Models\User;
use App\Transformers\Requests\UserRequestForDispatcherAppTransformer;
use Sk\Geohash\Geohash;
use Kreait\Firebase\Contract\Database;
use App\Base\Constants\Auth\Role;
use Carbon\Carbon;
use App\Transformers\Dispatcher\UserForDispatcherRideTransformer;
use App\Jobs\Notifications\SendPushNotification;


/**
 * @group Dispatcher-trips-apis
 *
 * APIs for Dispatcher-trips apis
 */
class DispatcherCreateRequestController extends BaseController
{
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
    * @bodyParam vehicle_type string required id of zone_type_id
    * @bodyParam payment_opt tinyInteger required type of ride whther cash or card, wallet('0 => card,1 => cash,2 => wallet)
    * @bodyParam pick_address string required pickup address of the trip request
    * @bodyParam drop_address string required drop address of the trip request
    * @responseFile responses/requests/create-request.json
    *
    */
    public function createRequest(CreateTripRequest $request)
    {
        /**
        * Validate payment option is available.
        * if card payment choosen, then we need to check if the user has added thier card.
        * if the paymenr opt is wallet, need to check the if the wallet has enough money to make the trip request
        * Check if thge user created a trip and waiting for a driver to accept. if it is we need to cancel the exists trip and create new one
        * Find the zone using the pickup coordinates & get the nearest drivers
        * create request along with place details
        * assing driver to the trip depends the assignment method
        * send emails and sms & push notifications to the user& drivers as well.
        */

        // Validate payment option is available.
        
        if ($request->has('is_later') && $request->is_later) {
            return $this->createRideLater($request);
        }

        // get type id
        $zone_type_detail = ZoneType::where('id', $request->vehicle_type)->first();

        $type_id = $zone_type_detail->type_id;

        // Get currency code of Request
        $service_location = $zone_type_detail->zone->serviceLocation;
        $currency_code = $service_location->currency_symbol;
        //Find the zone using the pickup coordinates & get the nearest drivers
        // $nearest_drivers =  $this->getDrivers($request, $type_id);
        $nearest_drivers =  $this->getFirebaseDrivers($request, $type_id);

        if ($nearest_drivers->getData()->success == false) {
            return $nearest_drivers;
        }

        $nearest_drivers = $nearest_drivers->getData()->data;

        // fetch unit from zone
        $unit = $zone_type_detail->zone->unit;
        // Fetch user detail
        $user_detail = auth()->user();

        $country= $user_detail->admin->serviceLocationDetail->country;

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

        $user_params= [
            'name'=>$request->customer_name,
            'mobile'=>$request->phone_number,
            'country'=>$country,
            'refferal_code'=>str_random(6),
            'mobile_confirmed'=>true
        ];

        $request_params = [
            'request_number'=>$request_number,
            'zone_type_id'=>$request->vehicle_type,
            'if_dispatch'=>true,
            'dispatcher_id'=>$user_detail->admin->id,
            'payment_opt'=>$request->payment_opt,
            'unit'=>$unit,
            'requested_currency_code'=>$currency_code,
            'service_location_id'=>$service_location->id,
            'goods_type_id'=>$request->goods_type_id,
            'goods_type_quantity'=>$request->goods_type_quantity,
            'transport_type'=>$request->transport_type
        ];

        if($request->has('rental_pack_id') && $request->rental_pack_id){

            $request_params['is_rental'] = true;
            
            $request_params['rental_package_id'] = $request->rental_pack_id;
        }

        if($request->has('goods_type_id') && $request->goods_type_id){

            $request_params['goods_type_id'] = $request->goods_type_id;
            $request_params['goods_type_quantity'] = $request->goods_type_quantity;
        }

        // store request details to db
        // DB::beginTransaction();
        // try {

            $user = User::where('mobile',$request->phone_number)->belongsTorole('user')->first();
            if(!$user){
                $user = User::create($user_params); 
                $user->attachRole(Role::USER);
            }
        
        $request_params['user_id'] = $user->id;

        $request_detail = $this->request->create($request_params);
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
         $this->database->getReference('requests/'.$request_detail->id)->update(['request_id'=>$request_detail->id,'request_number'=>$request_detail->request_number,'service_location_id'=>$service_location->id,'user_id'=>$request_detail->user_id,'pick_address'=>$request->pick_address,'active'=>1,'date'=>$request_detail->converted_created_at,'updated_at'=> Database::SERVER_TIMESTAMP]);
         
        $ad_hoc_user_params = $request->only(['customer_name','phone_number']);
        // Store ad hoc user detail of this request
        // $request_detail->adHocuserDetail()->create($ad_hoc_user_params);

        


        $selected_drivers = [];
        $notification_android = [];
        $notification_ios = [];
        $i = 0;
        foreach ($nearest_drivers as $driver) {
            // $selected_drivers[$i]["request_id"] = $request_detail->id;
            $selected_drivers[$i]["driver_id"] = $driver->id;
            $selected_drivers[$i]["active"] = $i == 0 ? 1 : 0;
            $selected_drivers[$i]["assign_method"] = 1;
            $selected_drivers[$i]["created_at"] = date('Y-m-d H:i:s');
            $selected_drivers[$i]["updated_at"] = date('Y-m-d H:i:s');
            $i++;
        }

        // Send notification to the very first driver
        $first_meta_driver = $selected_drivers[0]['driver_id'];

        // Add first Driver into Firebase Request Meta
        $this->database->getReference('request-meta/'.$request_detail->id)->set(['driver_id'=>$first_meta_driver,'request_id'=>$request_detail->id,'user_id'=>$request_detail->user_id,'active'=>1,'updated_at'=> Database::SERVER_TIMESTAMP]);

        $request_result =  fractal($request_detail, new TripRequestTransformer)->parseIncludes('userDetail');

        // $title = trans('push_notifications.new_request_title');
        // $body = trans('push_notifications.new_request_body');
     
        $title = trans('push_notifications.new_request_title',[],$driver->user->lang);
        $body = trans('push_notifications.new_request_body',[],$driver->user->lang);

        $push_data = ['title' => $title,'message' => $body,'push_type'=>'meta-request'];


        $socket_data = new \stdClass();
        $socket_data->success = true;
        $socket_data->success_message  = PushEnums::REQUEST_CREATED;
        $socket_data->result = $request_result;

        $driver = Driver::find($first_meta_driver);

        $notifable_driver = $driver->user;
        dispatch(new SendPushNotification($notifable_driver,$title,$body,$push_data));

        foreach ($selected_drivers as $key => $selected_driver) {
            $request_detail->requestMeta()->create($selected_driver);
        }

        // @TODO send sms & email to the user
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     Log::error($e);
        //     Log::error('Error while Create new request. Input params : ' . json_encode($request->all()));
        //     return $this->respondBadRequest('Unknown error occurred. Please try again later or contact us if it continues.');
        // }
        DB::commit();

        return $this->respondSuccess($request_result);
    }


    /**
    * Get nearest Drivers using requested co-ordinates
    *  @param request
    */
    public function getDrivers($request, $type_id)
    {
        $driver_detail = [];
        $driver_ids = [];


        $pick_lat = $request->pick_lat;
        $pick_lng = $request->pick_lng;
        $driver_search_radius = get_settings('driver_search_radius')?:30;

        $haversine = "(6371 * acos(cos(radians($pick_lat)) * cos(radians(pick_lat)) * cos(radians(pick_lng) - radians($pick_lng)) + sin(radians($pick_lat)) * sin(radians(pick_lat))))";

        // Get Drivers who are all going to accept or reject the some request that nears the user's current location.

        $driver_ids = Driver::whereHas('requestDetail.requestPlace', function ($query) use ($haversine,$driver_search_radius) {
            $query->select('request_places.*')->selectRaw("{$haversine} AS distance")
                ->whereRaw("{$haversine} < ?", [$driver_search_radius]);
        })->pluck('id')->toArray();

        $meta_drivers = RequestMeta::whereIn('driver_id', $driver_ids)->pluck('driver_id')->toArray();

        $driver_haversine = "(6371 * acos(cos(radians($pick_lat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($pick_lng)) + sin(radians($pick_lat)) * sin(radians(latitude))))";
        // get nearest driver exclude who are all struck with request meta
        $drivers = Driver::whereHas('driverDetail', function ($query) use ($driver_haversine,$driver_search_radius,$type_id) {
            $query->select('driver_details.*')->selectRaw("{$driver_haversine} AS distance")
                ->whereRaw("{$driver_haversine} < ?", [$driver_search_radius]);
        })->whereNotIn('id', $meta_drivers)->orderByRaw(DB::raw("FIELD(id, " . implode(',', $nearest_driver_ids) . ")"))->limit(10)->get();

        if ($drivers->isEmpty()) {
            $this->throwCustomException('all drivers are busy');
        }
        return $drivers;
    }

    /**
    * Get Drivers from firebase
    */
    public function getFirebaseDrivers($request, $type_id)
    {
       $pick_lat = $request->pick_lat;
        $pick_lng = $request->pick_lng;

        // NEW flow
        $pick_lat = $request->pick_lat;
        $pick_lng = $request->pick_lng;

        // NEW flow        
        $driver_search_radius = get_settings('driver_search_radius')?:30;

        $radius = kilometer_to_miles($driver_search_radius);

        $calculatable_radius = ($radius/2);

        $calulatable_lat = 0.0144927536231884 * $calculatable_radius;
        $calulatable_long = 0.0181818181818182 * $calculatable_radius;

        $lower_lat = ($pick_lat - $calulatable_lat);
        $lower_long = ($pick_lng - $calulatable_long);

        $higher_lat = ($pick_lat + $calulatable_lat);
        $higher_long = ($pick_lng + $calulatable_long);

        $g = new Geohash();

        $lower_hash = $g->encode($lower_lat,$lower_long, 12);
        $higher_hash = $g->encode($higher_lat,$higher_long, 12);

        $conditional_timestamp = Carbon::now()->subMinutes(7)->timestamp;

        $vehicle_type = $type_id;

        $fire_drivers = $this->database->getReference('drivers')->orderByChild('g')->startAt($lower_hash)->endAt($higher_hash)->getValue();
        
        $firebase_drivers = [];

        $i=-1;

        foreach ($fire_drivers as $key => $fire_driver) {
            $i +=1; 
            $driver_updated_at = Carbon::createFromTimestamp($fire_driver['updated_at'] / 1000)->timestamp;

            if(array_key_exists('vehicle_type',$fire_driver) && $fire_driver['vehicle_type']==$vehicle_type && $fire_driver['is_active']==1 && $fire_driver['is_available']==1 && $conditional_timestamp < $driver_updated_at){

                $distance = distance_between_two_coordinates($pick_lat,$pick_lng,$fire_driver['l'][0],$fire_driver['l'][1],'K');

                $firebase_drivers[$fire_driver['id']]['distance']= $distance;

            }      

        }

        asort($firebase_drivers);

        if (!empty($firebase_drivers)) {
           
                $nearest_driver_ids = [];

                foreach ($firebase_drivers as $key => $firebase_driver) {
                    
                    $nearest_driver_ids[]=$key;
                }

                $driver_search_radius = get_settings('driver_search_radius')?:30;

                $haversine = "(6371 * acos(cos(radians($pick_lat)) * cos(radians(pick_lat)) * cos(radians(pick_lng) - radians($pick_lng)) + sin(radians($pick_lat)) * sin(radians(pick_lat))))";
                // Get Drivers who are all going to accept or reject the some request that nears the user's current location.
                $meta_drivers = RequestMeta::whereHas('request.requestPlace', function ($query) use ($haversine,$driver_search_radius) {
                    $query->select('request_places.*')->selectRaw("{$haversine} AS distance")
                ->whereRaw("{$haversine} < ?", [$driver_search_radius]);
                })->pluck('driver_id')->toArray();

                $nearest_drivers = Driver::where('active', 1)->where('approve', 1)->where('available', 1)->where('vehicle_type', $type_id)->where(function($query)use($request){
                    $query->where('transport_type',$request->transport_type)->orWhere('transport_type','both');
                })->whereIn('id', $nearest_driver_ids)->whereNotIn('id', $meta_drivers)->limit(10)->get();


                if ($nearest_drivers->isEmpty()) {
                    return $this->respondFailed('all drivers are busy');
                }

                return $this->respondSuccess($nearest_drivers, 'drivers_list');
            
        } else {
            return $this->respondFailed('no drivers available');
        }
    }


    /**
     * Find User Data
     * 
     * 
     * */
    public function findUserData(ValidatorRequest $request){

        $request->validate([
        'mobile' => 'required',
        ]);

        $user = User::belongsToRole('user')->where('mobile',$request->mobile)->first();

        $message = 'user_doesnt_exists';

        $request_result = null;

        if($user){
            
            $request_result =  fractal($user, new UserForDispatcherRideTransformer);

            $message = 'user_exists';
        }

        return $this->respondSuccess($request_result, $message);


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
        $currency_code = $service_location->currency_symbol;

        // $currency_code = get_settings('currency_code');

        // fetch unit from zone
        $unit = $zone_type_detail->zone->unit;
        // Fetch user detail
        $user_detail = auth()->user();

        $country= $user_detail->admin->serviceLocationDetail->country;

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
        $timezone = auth()->user()->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');

        $trip_start_time = Carbon::parse($request->trip_start_time, $timezone)->setTimezone('UTC')->toDateTimeString();


        $request_params = [
            'request_number'=>$request_number,
            'is_later'=>true,
            'zone_type_id'=>$request->vehicle_type,
            'trip_start_time'=>$trip_start_time,
            'if_dispatch'=>true,
            'dispatcher_id'=>$user_detail->admin->id,
            'payment_opt'=>$request->payment_opt,
            'unit'=>$unit,
            'requested_currency_code'=>$currency_code,
            'service_location_id'=>$service_location->id];

        if($request->has('rental_pack_id') && $request->rental_pack_id){

            $request_params['is_rental'] = true;
            
            $request_params['rental_package_id'] = $request->rental_pack_id;
        }


        // store request details to db
        // DB::beginTransaction();
        // try {

            $user_params= [
            'name'=>$request->customer_name,
            'mobile'=>$request->phone_number,
            'country'=>$country,
            'refferal_code'=>str_random(6),
            'mobile_confirmed'=>true
            ];

            $user = User::where('mobile',$request->phone_number)->belongsTorole('user')->first();
            if(!$user){
                $user = User::create($user_params); 
                $user->attachRole(Role::USER);
            }
        

            $request_params['user_id'] = $user->id;

            $request_detail = $this->request->create($request_params);
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

            $this->database->getReference('requests/'.$request_detail->id)->update(['request_id'=>$request_detail->id,'request_number'=>$request_detail->request_number,'service_location_id'=>$service_location->id,'user_id'=>$request_detail->user_id,'pick_address'=>$request->pick_address,'active'=>1,'date'=>$request_detail->converted_trip_start_time,'updated_at'=> Database::SERVER_TIMESTAMP]);

            // $ad_hoc_user_params = $request->only(['name','phone_number']);
            $ad_hoc_user_params['name'] = $request->pickup_poc_name;
            $ad_hoc_user_params['mobile'] = $request->pickup_poc_mobile;

            // Store ad hoc user detail of this request
            // $request_detail->adHocuserDetail()->create($ad_hoc_user_params);


            $request_result =  fractal($request_detail, new TripRequestTransformer)->parseIncludes('userDetail');
            // @TODO send sms & email to the user
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     Log::error($e);
        //     Log::error('Error while Create new schedule request. Input params : ' . json_encode($request->all()));
        //     return $this->respondBadRequest('Unknown error occurred. Please try again later or contact us if it continues.');
        // }
        // DB::commit();

        return $this->respondSuccess($request_result, 'Request Scheduled Successfully');
    }

    /** 
     * Find Request Detail
     * 
     * 
     * */
    public function requestDetail(Request $request){

        $includes = ['driverDetail','requestBill','userDetail'];

        $request_result = fractal($request, new TripRequestTransformer)->parseIncludes($includes);

        return $this->respondSuccess($request_result, 'Request Listed Successfully');


    }
}
