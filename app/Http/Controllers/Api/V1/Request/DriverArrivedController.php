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
use Kreait\Firebase\Contract\Database;
use App\Models\Request\RequestCycles; 

/**
 * @group Driver-trips-apis
 *
 * APIs for Driver-trips apis
 */
class DriverArrivedController extends BaseController
{
    protected $request;

    public function __construct(RequestModel $request,Database $database)
    {
        $this->request = $request;
        $this->database = $database;

    }
    /**
    * Driver Arrived
    * @bodyParam request_id uuid required id request
    * @response {
    "success": true,
    "message": "driver_arrived"}
    */
    public function arrivedRequest(Request $request)
    {
        // Validate Request id
        $request->validate([
        'request_id' => 'required|exists:requests,id',
        ]);
        // Get Request Detail
        $request_detail = $this->request->where('id', $request->input('request_id'))->first();
        // Validate Trip request data
        $this->validateRequest($request_detail);
        // Update the Request detail with arrival state
        $request_detail->update(['is_driver_arrived'=>true,'arrived_at'=>date('Y-m-d H:i:s')]);
        if ($request_detail->if_dispatch) {
            goto dispatch_notify;
        }
        // Send Push notification to the user
        $user = User::find($request_detail->user_id);
        // $title = trans('push_notifications.driver_arrived_title');
        // $body = trans('push_notifications.driver_arrived_body');

        $title = trans('push_notifications.driver_arrived_title', [], $user->lang);
        $body = trans('push_notifications.driver_arrived_body', [], $user->lang);

        $request_result =  fractal($request_detail, new TripRequestTransformer)->parseIncludes('driverDetail');

        $pus_request_detail = $request_result->toJson();
        $push_data = ['notification_enum'=>PushEnums::DRIVER_ARRIVED,'result'=>(string)$pus_request_detail];

        dispatch(new SendPushNotification($user,$title,$body));
        dispatch_notify:

            $get_request_datas = RequestCycles::where('request_id', $request_detail->id)->first();
        if($get_request_datas)
        { 
            $user_data = User::find(auth()->user()->driver->user_id);
            $request_data = json_decode(base64_decode($get_request_datas->request_data), true);
            $request_datas['request_id'] = $request_detail->id;
            $request_datas['user_id'] = $request_detail->user_id; 
            $request_datas['driver_id'] = auth()->user()->driver->id; 
            $driver_details['name'] = auth()->user()->driver->name;
            $driver_details['mobile'] = auth()->user()->driver->mobile;
            $driver_details['image'] = $user_data->profile_picture;
            $rating = number_format(auth()->user()->rating, 2);
            $data[0]['rating'] = $rating; 
            $data[0]['status'] = 4;
            $data[0]['process_type'] = "trip_arrived";
            $data[0]['orderby_status'] = intval($get_request_datas->orderby_status) + 1;
            $data[0]['dricver_details'] = $driver_details;
            $data[0]['created_at'] = date("Y-m-d H:i:s", time());  
            $request_data1 = array_merge($request_data, $data);
            $request_datas['orderby_status'] = intval($get_request_datas->orderby_status) + 1;
            $request_datas['request_data'] = base64_encode(json_encode($request_data1)); 
            $insert_request_cycles = RequestCycles::where('id',$get_request_datas->id)->update($request_datas);


        }
        
        $this->database->getReference('bid-meta/'.$request->id)->remove();
        
        return $this->respondSuccess(null, 'driver_arrived');
    }


    /**
    * Validate Request
    */
    public function validateRequest($request_detail)
    {
        if ($request_detail->driver_id!=auth()->user()->driver->id) {
            $this->throwAuthorizationException();
        }

        if ($request_detail->is_driver_arrived) {
            $this->throwCustomException('arrived already');
        }

        if ($request_detail->is_completed) {
            $this->throwCustomException('request completed already');
        }
        if ($request_detail->is_cancelled) {
            $this->throwCustomException('request cancelled');
        }
    }
}
