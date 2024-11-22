<?php

namespace App\Http\Controllers\Api\V1\Request;

use App\Models\User;
use App\Jobs\NotifyViaMqtt;
use Illuminate\Http\Request;
use App\Jobs\NotifyViaSocket;
use App\Base\Constants\Masters\PushEnums;
use App\Http\Controllers\Api\V1\BaseController;
use App\Models\Request\Request as RequestModel;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Transformers\Requests\TripRequestTransformer;
use App\Jobs\Notifications\SendPushNotification;
use App\Models\Request\RequestCycles;
use Log;


/**
 * @group Driver-trips-apis
 *
 * APIs for Driver-trips apis
 */
class DriverTripStartedController extends BaseController
{
    protected $request;

    public function __construct(RequestModel $request)
    {
        $this->request = $request;
    }

    /**
    * Driver Trip started
    * @bodyParam request_id uuid required id of request
    * @bodyParam pick_lat double required pikup lat of the user
    * @bodyParam pick_lng double required pikup lng of the user
    * @bodyParam pick_address string optional pickup address of the trip request
    * @response {
    "success": true,
    "message": "driver_trip_started"}
    */
    public function tripStart(Request $request)
    {
        $request->validate([
        'request_id' => 'required|exists:requests,id',
        'pick_lat'  => 'required',
        'pick_lng'  => 'required',
        'ride_otp'=>'sometimes|required'
        ]);
        // Get Request Detail
        $request_detail = $this->request->where('id', $request->input('request_id'))->first();

        if($request->has('ride_otp')){

        if($request_detail->ride_otp != $request->ride_otp){

          $this->throwCustomException('provided otp is invalid');
        }

        }


        // Validate Trip request data
        $this->validateRequest($request_detail);
        // Update the Request detail with arrival state
        $request_detail->update(['is_trip_start'=>true,'trip_start_time'=>date('Y-m-d H:i:s')]);
        // Update pickup detail to the request place table
        $request_place = $request_detail->requestPlace;
        $request_place->pick_lat = $request->input('pick_lat');
        $request_place->pick_lng = $request->input('pick_lng');
        $request_place->save();
        if ($request_detail->if_dispatch) {
            goto dispatch_notify;
        }
        // Send Push notification to the user
        // $title = trans('push_notifications.trip_started_title');
        // $body = trans('push_notifications.trip_started_body');


        if($request_detail->user_id){
            $user = User::find($request_detail->user_id);
            $title = trans('push_notifications.trip_started_title',[],$user->lang);
            $body = trans('push_notifications.trip_started_body',[],$user->lang);        
            dispatch(new SendPushNotification($user,$title,$body));
        }
        dispatch_notify:
            $get_request_datas = RequestCycles::where('request_id', $request_detail->id)->first();
            if($get_request_datas)
            { 
                $user_data = User::find(auth()->user()->driver->user_id);
    
                $request_data = json_decode(base64_decode($get_request_datas->request_data), true);
    // Log::info($request_data);
    
                $request_datas['request_id'] = $request_detail->id;
                $request_datas['user_id'] = $request_detail->user_id; 
                $request_datas['driver_id'] = auth()->user()->driver->id; 
                $driver_details['name'] = auth()->user()->driver->name;
                $driver_details['mobile'] = auth()->user()->driver->mobile;
                $driver_details['image'] = $user_data->profile_picture;
                $rating = number_format(auth()->user()->rating, 2);
                $data[0]['rating'] = $rating; 
                $data[0]['status'] = 5; 
                $data[0]['orderby_status'] = intval($get_request_datas->orderby_status) + 1;
                $request_datas['orderby_status'] =  $data[0]['orderby_status']; 
                $data[0]['process_type'] =  "trip_start"; 
                $data[0]['dricver_details'] = $driver_details;
                $data[0]['created_at'] = date("Y-m-d H:i:s", time());  
                $request_data1 = array_merge($request_data, $data);
                $request_datas['request_data'] = base64_encode(json_encode($request_data1)); 
                // Log::info($get_request_datas->orderby_status);
                // Log::info($request_data1); 
                // Log::info("Data checking");
                $insert_request_cycles = RequestCycles::where('id',$get_request_datas->id)->update($request_datas);
    
    
            }
        return $this->respondSuccess(null, 'driver_trip_started');
    }
    /**
     * Ready to pickup
     * 
     * */
    public function readyToPickup(Request $request)
    {
        $request->validate([
        'request_id' => 'required|exists:requests,id',
        ]);

        $request_detail = $this->request->where('id', $request->input('request_id'))->first();

        $driver = auth()->user()->driver;

        $request_detail->update(['is_driver_started'=>true]);

        $driver->available = false;
        $driver->save();

        $user = User::find($request_detail->user_id);

        // $title = trans('push_notifications.driver_is_on_the_way_to_pickup_title');
        // $body = trans('push_notifications.driver_is_on_the_way_to_pickup_body');

        $title = trans('push_notifications.driver_is_on_the_way_to_pickup_title',[],$user->lang);
        $body = trans('push_notifications.driver_is_on_the_way_to_pickup_body',[],$user->lang);
            
        dispatch(new SendPushNotification($user,$title,$body));

        return $this->respondSuccess(null, 'driver_started_to_pickup');


    }

    /**
    * Validate Request
    */
    public function validateRequest($request_detail)
    {
        if ($request_detail->driver_id!=auth()->user()->driver->id) {
            $this->throwAuthorizationException();
        }

        if ($request_detail->is_trip_start) {
            $this->throwCustomException('trip started already');
        }

        if ($request_detail->is_completed) {
            $this->throwCustomException('request completed already');
        }
        if ($request_detail->is_cancelled) {
            $this->throwCustomException('request cancelled');
        }
    }
}
