<?php

namespace App\Http\Controllers\Web\Dispatcher;

use App\Jobs\NotifyViaMqtt;
use App\Models\Admin\Driver;
use App\Jobs\NotifyViaSocket;
use App\Models\Admin\ZoneType;
use App\Models\Request\Request;
use App\Models\Request\RequestCycles;   
use Salman\Mqtt\MqttClass\Mqtt;
use Illuminate\Support\Facades\DB;
use App\Models\Request\RequestMeta;
use Illuminate\Support\Facades\Log;
use App\Base\Constants\Masters\PushEnums;
use App\Base\Constants\Masters\EtaConstants;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Request\CreateTripRequest;
use Illuminate\Http\Request as ValidatorRequest;
use App\Transformers\Requests\TripRequestTransformer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator; 
use App\Helpers\Rides\FetchDriversFromFirebaseHelpers;
use App\Transformers\User\EtaTransformer;
use Kreait\Firebase\Contract\Database;
use App\Models\User;
use App\Models\Country;


/**
 * @group Dispatcher-trips-apis
 *
 * APIs for Dispatcher-trips apis
 */
class DispatcherCreateRequestController extends BaseController
{
    protected $request;
    use FetchDriversFromFirebaseHelpers;

    public function __construct(Request $request,Database $database,User $user)
    {
        $this->request = $request;
        $this->database = $database;
        $this->user = $user;
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
    * @bodyParam pickup_poc_name string required customer name for the request
    * @bodyParam pickup_poc_mobile string required customer name for the request
    * @responseFile responses/requests/create-request.json
    *
    */
    public function createRequest(ValidatorRequest $request)
    {
    //    dd($request->all());
        
        Log::debug('Received request data:', $request->all());
 
        $rules = [
            'pick_lat'  => 'required',
            'pick_lng'  => 'required',
            'drop_lat'  =>'sometimes|required',
            'drop_lng'  =>'sometimes|required',
            'vehicle_type'=>'sometimes|required|exists:zone_types,id',
            'payment_opt'=>'sometimes|required|in:0,1,2',
            'pick_address'=>'required',
            'drop_address'=>'sometimes|required',
            'drivers'=>'sometimes|required',
            'is_later'=>'sometimes|required|in:1',
            'trip_start_time'=>'sometimes|required',
            'promocode_id'=>'sometimes|required|exists:promo,id'
        ];
        // Create a new validator instance
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Validation failed
            $errors = $validator->errors()->all();
            return response()->json(['status'=>false,"message"=>$errors]);
            // Handle errors
        } 
        // dd($request->all());
        
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
        // dd($request->all());
        // Validate payment option is available.
        if ($request->has('is_later') && $request->is_later) {
            return $this->createRideLater($request);
        }

        $country_data = Country::where('dial_code',$request->dial_code)->first();



        // @TODO
        // get type id
        $zone_type_detail = ZoneType::where('id', $request->vehicle_type)->first();
        $type_id = $zone_type_detail->type_id;

        // Get currency code of Request
        $service_location = $zone_type_detail->zone->serviceLocation;
        $currency_code = $service_location->currency_code;
        $currency_symbol = $service_location->currency_symbol;
        $eta_result = fractal($zone_type_detail, new EtaTransformer);

        $eta_result =json_decode($eta_result->toJson());

         // Calculate ETA
         $request_eta_params=[
            'base_price'=>$eta_result->data->base_price,
            'base_distance'=>$eta_result->data->base_distance,
            'total_distance'=>$eta_result->data->distance,
            'total_time'=>$eta_result->data->time,
            'price_per_distance'=>$eta_result->data->price_per_distance,
            'distance_price'=>$eta_result->data->distance_price,
            'price_per_time'=>$eta_result->data->price_per_time,
            'time_price'=>$eta_result->data->time_price,
            'service_tax'=>$eta_result->data->tax_amount,
            'service_tax_percentage'=>$eta_result->data->tax,
            'promo_discount'=>$eta_result->data->discount_amount,
            'admin_commision'=>$eta_result->data->without_discount_admin_commision,
            'admin_commision_with_tax'=>($eta_result->data->without_discount_admin_commision + $eta_result->data->tax_amount),
            'total_amount'=>$eta_result->data->total,
            'requested_currency_code'=>$currency_code
        ]; 
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
        // $request_number = 'REQ_'.time();

        $request_params = [
            'request_number'=>$request_number,
            'zone_type_id'=>$request->vehicle_type,
            'if_dispatch'=>true,
            'dispatcher_id'=>$user_detail->admin->id,
            'payment_opt'=>$request->payment_opt,
            'unit'=>$unit,
            'transport_type'=>$request->transport_type,
            'requested_currency_code'=>$currency_code,
            'requested_currency_symbol'=>$currency_symbol,
            'service_location_id'=>$service_location->id];
        $request_params['assign_method'] = $request->assign_method;
        $request_params['request_eta_amount'] = $eta_result->data->total;
        if($request->has('rental_package_id') && $request->rental_package_id){

            $request_params['is_rental'] = true; 

            $request_params['rental_package_id'] = $request->rental_package_id;
        }
        if($request->has('goods_type_id') && $request->goods_type_id){
            $request_params['goods_type_id'] = $request->goods_type_id; 
            $request_params['goods_type_quantity'] = $request->goods_type_quantity;
        }
          // store request place details
          $user = $this->user->belongsToRole('user')
          ->where('mobile', $request->pickup_poc_mobile)
          ->first();
          if(!$user)
          {
            $request_params1['name'] = $request->pickup_poc_name;
            $request_params1['mobile'] = $request->pickup_poc_mobile;
            $request_params1['country'] = $country_data->id;
            
            $user = $this->user->create($request_params1);  
            $user->attachRole('user');
          }  
          $request_params['user_id'] = $user->id; 

        // store request details to db
        // DB::beginTransaction();
        // try {
            // Log::info("test1");
        $request_detail = $this->request->create($request_params);
        Log::info("------------requestDetailss----------------");
        Log::info($request_detail);
        Log::info($request_params);
        // request place detail params
        $request_place_params = [
            'pick_lat'=>$request->pick_lat,
            'pick_lng'=>$request->pick_lng,
            'drop_lat'=>$request->drop_lat,
            'drop_lng'=>$request->drop_lng,
            'pick_address'=>$request->pick_address,
            'drop_address'=>$request->drop_address];
      
        $request_detail->requestPlace()->create($request_place_params);
        // $ad_hoc_user_params = $request->only(['name','phone_number']);
        $ad_hoc_user_params['name'] = $request->pickup_poc_name;
        $ad_hoc_user_params['mobile'] = $request->pickup_poc_mobile;

        // Store ad hoc user detail of this request
        // $request_detail->adHocuserDetail()->create($ad_hoc_user_params);
      

        // $request_detail->requestEtaDetail()->create($request_eta_params);

        // Add Request detail to firebase database
         $this->database->getReference('requests/'.$request_detail->id)->update(['request_id'=>$request_detail->id,'request_number'=>$request_detail->request_number,'service_location_id'=>$service_location->id,'user_id'=>$request_detail->user_id,'trnasport_type'=>$request->trnasport_type,'pick_address'=>$request->pick_address,'drop_address'=>$request->drop_address,'assign_method'=>1,'active'=>1,'is_accept'=>0,'date'=>$request_detail->converted_created_at,'updated_at'=> Database::SERVER_TIMESTAMP]); 

        $selected_drivers = [];
        $notification_android = [];
        $notification_ios = [];
        $i = 0; 
        $request_result =  fractal($request_detail, new TripRequestTransformer)->parseIncludes('userDetail');

        $mqtt_object = new \stdClass();
        $mqtt_object->success = true;
        $mqtt_object->success_message  = PushEnums::REQUEST_CREATED;
        $mqtt_object->result = $request_result; 
        DB::commit();
        if($request->assign_method == 0)
        {
            Log::info("test data dispatcher");
            $nearest_drivers =  $this->fetchDriversFromFirebase($request_detail);

            // Send Request to the nearest Drivers
             if ($nearest_drivers==null) {
                    goto no_drivers_available;
             } 
            no_drivers_available:
        }
        Log:info($request_detail->user_id);
        
        $request_datas['request_id'] = $request_detail->id;
        $request_datas['user_id'] = $request_detail->user_id; 
        $request_datas['orderby_status'] = 1; 
        $data[0]['status'] = 1;
        $data[0]['process_type'] = "create_request";
        $data[0]['if_dispatcher'] = true;
        $default_image_path = config('base.default.user.profile_picture');
        $data[0]['user_image'] = env('APP_URL').$default_image_path;
        $data[0]['orderby_status'] = 1;
        $data[0]['dricver_details'] = null; 
        $data[0]['created_at'] = date("Y-m-d H:i:s", time()); 
        $request_datas['request_data'] = base64_encode(json_encode($data)); 
        $insert_request_cycles = RequestCycles::create($request_datas);
        

        return $this->respondSuccess($request_result, 'Request Created Successfully');
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
        })->whereNotIn('id', $meta_drivers)->limit(10)->get();

        if ($drivers->isEmpty()) {
            return $this->respondFailed('all drivers are busy');
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
        $client = new \GuzzleHttp\Client();
        $url = env('NODE_APP_URL').':'.env('NODE_APP_PORT').'/'.$pick_lat.'/'.$pick_lng.'/'.$type_id;

        $res = $client->request('GET', "$url");
        if ($res->getStatusCode() == 200) {
            $fire_drivers = \GuzzleHttp\json_decode($res->getBody()->getContents());
            if (empty($fire_drivers->data)) {
                return $this->respondFailed('no drivers available');
            } else {
                $nearest_driver_ids = [];
                foreach ($fire_drivers->data as $key => $fire_driver) {
                    $nearest_driver_ids[] = $fire_driver->id;
                }

                $driver_search_radius = get_settings('driver_search_radius')?:30;

                $haversine = "(6371 * acos(cos(radians($pick_lat)) * cos(radians(pick_lat)) * cos(radians(pick_lng) - radians($pick_lng)) + sin(radians($pick_lat)) * sin(radians(pick_lat))))";
                // Get Drivers who are all going to accept or reject the some request that nears the user's current location.
                $meta_drivers = RequestMeta::whereHas('request.requestPlace', function ($query) use ($haversine,$driver_search_radius) {
                    $query->select('request_places.*')->selectRaw("{$haversine} AS distance")
                ->whereRaw("{$haversine} < ?", [$driver_search_radius]);
                })->pluck('driver_id')->toArray();

                $nearest_drivers = Driver::where('active', 1)->where('approve', 1)->where('available', 1)->where('vehicle_type', $type_id)->whereIn('id', $nearest_driver_ids)->whereNotIn('id', $meta_drivers)->limit(10)->get();

                if ($nearest_drivers->isEmpty()) {
                    return $this->respondFailed('all drivers are busy');
                }

                return $this->respondSuccess($nearest_drivers, 'drivers_list');
            }
        } else {
            return $this->respondFailed('there is an error-getting-drivers');
        }
    }
    /**
    * Create Ride later trip
    */
    public function createRideLater($request)
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
        $trip_start_time = $request->trip_start_time;
        $secondcarbonDateTime = Carbon::parse($request->trip_start_time, $service_location->timezone)->setTimezone('UTC')->toDateTimeString();
        // $carbonDateTime = Carbon::createFromFormat('d M, Y H:i:s', $trip_start_time, $service_location->timezone);  
        $now = Carbon::now($service_location->timezone)->addHour(); 
        // if (!$carbonDateTime->greaterThanOrEqualTo($now)) { 
        // return response()->json(['status'=>false,"type"=>"date_format","message"=>"The provided time is less than one hour"]);
        // } 
        // fetch unit from zone
        $unit = $zone_type_detail->zone->unit;
        $eta_result = fractal($zone_type_detail, new EtaTransformer);

        $eta_result =json_decode($eta_result->toJson());

         // Calculate ETA
        //  $request_eta_params=[
        //     'base_price'=>$eta_result->data->base_price,
        //     'base_distance'=>$eta_result->data->base_distance,
        //     'total_distance'=>$eta_result->data->distance,
        //     'total_time'=>$eta_result->data->time,
        //     'price_per_distance'=>$eta_result->data->price_per_distance,
        //     'distance_price'=>$eta_result->data->distance_price,
        //     'price_per_time'=>$eta_result->data->price_per_time,
        //     'time_price'=>$eta_result->data->time_price,
        //     'service_tax'=>$eta_result->data->tax_amount,
        //     'service_tax_percentage'=>$eta_result->data->tax,
        //     'promo_discount'=>$eta_result->data->discount_amount,
        //     'admin_commision'=>$eta_result->data->without_discount_admin_commision,
        //     'admin_commision_with_tax'=>($eta_result->data->without_discount_admin_commision + $eta_result->data->tax_amount),
        //     'total_amount'=>$eta_result->data->total,
        //     'requested_currency_code'=>$currency_code
        // ];

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
        $request_number = 'REQ_'.time();

        // Convert trip start time as utc format
        $timezone = auth()->user()->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        
        $trip_start_time = $secondcarbonDateTime; 
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
            'requested_currency_symbol'=>$currency_symbol,
            'service_location_id'=>$service_location->id];

            if($request->has('request_eta_amount') && $request->request_eta_amount){
 
                $request_params['request_eta_amount'] = round($request->request_eta_amount, 2);
     
             }    
     
             if($request->has('rental_package_id') && $request->rental_package_id){
     
                 $request_params['is_rental'] = true; 
     
                 $request_params['rental_package_id'] = $request->rental_package_id;
             }
             if($request->has('goods_type_id') && $request->goods_type_id){
                 $request_params['goods_type_id'] = $request->goods_type_id; 
                 $request_params['goods_type_quantity'] = $request->goods_type_quantity;
             }

            $request_params['assign_method'] = $request->assign_method;
            $request_params['request_eta_amount'] = $eta_result->data->total;
            $user = $this->user->belongsToRole('user')
            ->where('mobile', $request->pickup_poc_mobile)
            ->first();
            if(!$user)
            {
              $country_data = Country::where('dial_code',$request->dial_code)->first();
              $request_params1['name'] = $request->pickup_poc_name;
              $request_params1['mobile'] = $request->pickup_poc_mobile;
              $request_params1['country'] = $country_data->id;
              
              $user = $this->user->create($request_params1);  
              $user->attachRole('user');
            }  
            $request_params['user_id'] = $user->id; 

        // store request details to db
        DB::beginTransaction();
        try {
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

            // $ad_hoc_user_params = $request->only(['name','phone_number']);
            $ad_hoc_user_params['name'] = $request->pickup_poc_name;
            $ad_hoc_user_params['mobile'] = $request->pickup_poc_mobile;

            // Store ad hoc user detail of this request
            // $request_detail->adHocuserDetail()->create($ad_hoc_user_params);

            $request_result =  fractal($request_detail, new TripRequestTransformer)->parseIncludes('userDetail');
            // @TODO send sms & email to the user
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            Log::error('Error while Create new schedule request. Input params : ' . json_encode($request->all()));
            return $this->respondBadRequest('Unknown error occurred. Please try again later or contact us if it continues.');
        }
        DB::commit();

        return $this->respondSuccess($request_result, 'Request Scheduled Successfully');
    }
}
