<?php

namespace App\Helpers\Rides;

use Kreait\Firebase\Contract\Database;
use Sk\Geohash\Geohash;
use Carbon\Carbon;
use App\Models\Request\RequestMeta;
use Illuminate\Support\Facades\DB;
use App\Models\Request\Request;
use Illuminate\Support\Facades\Log;
use App\Base\Constants\Setting\Settings;
use App\Models\Admin\Driver;
use App\Jobs\Notifications\SendPushNotification;
use App\Models\Request\DriverRejectedRequest;
use App\Models\Request\RequestCycles;
use App\Jobs\NoDriverFoundNotifyJob;

trait FetchDriversFromFirebaseHelpers
{


    public function __construct(Database $database)
    {
        
        $this->database = $database;

    }

    /**
     * Respond with drivers data.
     * Status code = 200
     *
     * @param mixed|null $data
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    //
    protected function fetchDriversFromFirebase($request_detail)
    {

        if ($request_detail->requestMeta()->exists()) {
             
             return null;   
        }

        $pick_lat = $request_detail->pick_lat;
        $pick_lng = $request_detail->pick_lng;
        $drop_lat = $request_detail->drop_lat;
        $drop_lng = $request_detail->drop_lng;
        $user_detail = $request_detail->userDetail;
        $type_id = $request_detail->zoneType->type_id;

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

                if($distance <= $driver_search_radius){

                    $firebase_drivers[$fire_driver['id']]['distance']= $distance;

                }

            }elseif(array_key_exists('vehicle_types',$fire_driver)  && in_array($vehicle_type, $fire_driver['vehicle_types']) && $fire_driver['is_active']==1 && $fire_driver['is_available']==1 && $conditional_timestamp < $driver_updated_at)
                {


                $distance = distance_between_two_coordinates($pick_lat,$pick_lng,$fire_driver['l'][0],$fire_driver['l'][1],'K');

                if($distance <= $driver_search_radius){

                    $firebase_drivers[$fire_driver['id']]['distance']= $distance;

                }

            }

        }

        asort($firebase_drivers);

        $current_date = Carbon::now();

         if (!empty($firebase_drivers)) {

            $nearest_driver_ids = [];

            $removable_driver_ids=[];

                foreach ($firebase_drivers as $key => $firebase_driver) {
                    
                    $nearest_driver_ids[]=$key;



                if($drop_lat==null){
                    goto for_each_end;
                }
                $app_for = config('app.app_for');
                if($app_for=='taxi' || $app_for=='delivery')
                {
               $has_enabled_my_route_drivers=Driver::where('id',$key)->where('active', 1)->where('approve', 1)->where('available', 1)->where('enable_my_route_booking',1)->first();
                }else{
                $has_enabled_my_route_drivers=Driver::where('id',$key)->where('active', 1)->where('approve', 1)->where('available', 1)->where(function($query)use($request_detail){
                    $query->where('transport_type', $request_detail->transport_type);
                })->where('enable_my_route_booking',1)->whereNotNull('my_route_address')->whereNotNull('my_route_lat')->first();

               }
                $route_coordinates=null;

                if($has_enabled_my_route_drivers){


                    //get line string from helper
                    $route_coordinates = get_line_string($pick_lat, $pick_lng, $drop_lat, $drop_lng);

                }       
                        if($has_enabled_my_route_drivers!=null &$route_coordinates!=null){

                            $enabled_route_matched = $has_enabled_my_route_drivers->intersects('route_coordinates',$route_coordinates)->first();
                            
                            if(!$enabled_route_matched){

                                $removable_driver_ids[]=$key;
                            }

                            $current_location_of_driver = $has_enabled_my_route_drivers->enabledRoutes()->whereDate('created_at',$current_date)->orderBy('created_at','desc')->first();

                            if($current_location_of_driver){

                         $distance_between_drop_to_my_route = distance_between_two_coordinates($drop_lat, $drop_lng, $has_enabled_my_route_drivers->my_route_lat, $has_enabled_my_route_drivers->my_route_lng,'K');

                        if($distance_between_drop_to_my_route > 5){

                                $removable_driver_ids[]=$key;

                        }
                            
    
                            }
                            
                        }

                        for_each_end:
                }

            
            $rejected_driver_ids = DriverRejectedRequest::where('request_id',$request_detail->id)->pluck('driver_id')->toArray();

            $nearest_driver_ids = array_diff($nearest_driver_ids,$removable_driver_ids);
            $nearest_driver_ids = array_diff($nearest_driver_ids,$rejected_driver_ids);

            if(count($nearest_driver_ids)==0){

                $request_detail->attempt_for_schedule += 1;
                $request_detail->save();

                $no_of_attempts = get_settings('maximum_time_for_find_drivers_for_regular_ride');

                $no_of_attempts +=3;

                if ($request_detail->attempt_for_schedule>$no_of_attempts) {
                        
                        // Update cancel param in firebase
                        $this->database->getReference('requests/'.$request_detail->id)->update(['is_cancel' => 1]);
                     
                        $this->database->getReference('request-meta/'.$request_detail->id)->remove();
                        $this->database->getReference('requests/'.$request_detail->id)->remove();

                        $get_request_datas = RequestCycles::where('request_id', $request_detail->id)->first();
                        if($get_request_datas)
                        {  
                            $request_data = json_decode(base64_decode($get_request_datas->request_data), true);
                            $request_datas['request_id'] = $request_detail->id;
                            $request_datas['user_id'] = $request_detail->user_id; 
                            $request_datas['driver_id'] = null;   
                            $data[0]['dricver_details'] = null; 
                            $data[0]['process_type'] = "auto_cancelled";
                            $request_datas['orderby_status'] = intval($get_request_datas->orderby_status) + 1;
                            
                            if ($request_data === null) { 
                                $request_data = [];
                            }
                            $request_data1 = array_merge($request_data, $data);
                            $request_datas['request_data'] = base64_encode(json_encode($request_data1));   
                            $insert_request_cycles = RequestCycles::where('id',$get_request_datas->id)->update($request_datas);

                        }
                        $no_driver_request_ids = [];
                        $no_driver_request_ids[0] = $request_detail->id;
                        dispatch(new NoDriverFoundNotifyJob($no_driver_request_ids,$this->database));
                }

                return null; 


                }

            $driver_search_radius = get_settings('driver_search_radius')?:30;

                $haversine = "(6371 * acos(cos(radians($pick_lat)) * cos(radians(pick_lat)) * cos(radians(pick_lng) - radians($pick_lng)) + sin(radians($pick_lat)) * sin(radians(pick_lat))))";
                // Get Drivers who are all going to accept or reject the some request that nears the user's current location.

                $meta_drivers = RequestMeta::whereHas('request.requestPlace', function ($query) use ($haversine,$driver_search_radius) {
                    $query->select('request_places.*')->selectRaw("{$haversine} AS distance")
                ->whereRaw("{$haversine} < ?", [$driver_search_radius]);
                })->pluck('driver_id')->toArray();


                $nearest_drivers = Driver::where('active', 1)->where('approve', 1)->where('available', 1)->whereIn('id', $nearest_driver_ids)->whereNotIn('id', $meta_drivers)->orderByRaw(DB::raw("FIELD(id, " . implode(',', $nearest_driver_ids) . ")"))->limit(10)->get();

                if ($nearest_drivers->count()==0) {
                    
                $request_detail->attempt_for_schedule += 1;
                $request_detail->save();

                $no_of_attempts = get_settings('maximum_time_for_find_drivers_for_regular_ride');

                $no_of_attempts +=3;

                if ($request_detail->attempt_for_schedule>$no_of_attempts) {

                        $this->database->getReference('requests/'.$request_detail->id)->update(['is_cancel' => 1]);
                        $this->database->getReference('request-meta/'.$request_detail->id)->remove();
 
                        $no_driver_request_ids = [];
                        $no_driver_request_ids[0] = $request_detail->id;
                        dispatch(new NoDriverFoundNotifyJob($no_driver_request_ids,$this->database));
                }

                    return null; 
                }
        //Create Meta & Send Ride Request to the Nearest Drivers
        $selected_drivers = [];
        $i = 0;
        foreach ($nearest_drivers as $driver_key => $driver) {

            // $selected_drivers[$i]["request_id"] = $request_detail->id;
            foreach ($firebase_drivers as $key => $firebase_driver) {

                    if($driver->id==$key){
                        $selected_drivers[$i]["distance_to_pickup"] = $firebase_driver['distance'];
                    }
            }
            
            if(!$request_detail->if_dispatch){
                $selected_drivers[$i]["user_id"] = $user_detail->id;                
            }
            $selected_drivers[$i]["driver_id"] = $driver->id;
            $selected_drivers[$i]["active"] = 1;
            $selected_drivers[$i]["assign_method"] = 1;
            $selected_drivers[$i]["created_at"] = date('Y-m-d H:i:s');
            $selected_drivers[$i]["updated_at"] = date('Y-m-d H:i:s');


        // Add Driver into Firebase Request Meta
        $this->database->getReference('request-meta/'.$request_detail->id)->set(['driver_id'=>$driver->id,'request_id'=>$request_detail->id,'user_id'=>$request_detail->user_id,'active'=>1,'updated_at'=> Database::SERVER_TIMESTAMP]);

        
        $driver = Driver::find($driver->id);

        $notifable_driver = $driver->user;

        $title = trans('push_notifications.new_request_title',[],$notifable_driver->lang);
        $body = trans('push_notifications.new_request_body',[],$notifable_driver->lang);
        $push_data = ['title' => $title,'message' => $body,'push_type'=>'meta-request'];

        dispatch(new SendPushNotification($notifable_driver,$title,$body,$push_data));


        if(get_settings('trip_dispatch_type')==0){
            $selected_drivers[$i]["active"] = 1;
        }else{
            if($driver_key==0){
                break;                
            }
        }

            $i++;
        }

       
        foreach ($selected_drivers as $key => $selected_driver) {
            $request_detail->requestMeta()->create($selected_driver);
        }

        return "success";

            
        } else {

            $request_detail->attempt_for_schedule += 1;
                $request_detail->save();

                $no_of_attempts = get_settings('maximum_time_for_find_drivers_for_regular_ride');

                $no_of_attempts +=3;

                if ($request_detail->attempt_for_schedule>$no_of_attempts) {

                    $this->database->getReference('requests/'.$request_detail->id)->update(['is_cancel' => 1]);
                    $this->database->getReference('request-meta/'.$request_detail->id)->remove();
                    $this->database->getReference('requests/'.$request_detail->id)->remove();

                        $no_driver_request_ids = [];
                        $no_driver_request_ids[0] = $request_detail->id;
                        dispatch(new NoDriverFoundNotifyJob($no_driver_request_ids,$this->database));
            }
            return null;

        }

    }

 
    
}
