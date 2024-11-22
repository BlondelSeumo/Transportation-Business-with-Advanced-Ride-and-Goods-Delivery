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
use Sk\Geohash\Geohash;
use Kreait\Firebase\Contract\Database;
use App\Base\Constants\Auth\Role;
use Carbon\Carbon;
use App\Http\Requests\Request\CancelTripRequest;
use App\Base\Constants\Masters\UserType;
use App\Jobs\Notifications\SendPushNotification;

/**
 * @group Dispatcher-trips-apis
 *
 * APIs for Dispatcher-trips apis
 */
class DispatcherRequestStateController extends BaseController
{
    protected $request;

    public function __construct(Request $request,Database $database)
    {
        $this->request = $request;
        $this->database = $database;
    }
    
    /**
    * Cancel Request
    * @bodyParam request_id uuid required id of request
    * @bodyParam reason string optional reason provided by user
    * @bodyParam custom_reason string optional custom reason provided by user
    *
    */
    public function cancelRide(CancelTripRequest $request)
    {

        $request_detail = $this->request->where('id', $request->request_id)->first();

        $request_detail->update([
            'is_cancelled'=>true,
            'reason'=>$request->reason,
            'custom_reason'=>$request->custom_reason,
            'cancel_method'=>UserType::DISPATCHER,
            'cancelled_at'=>date('Y-m-d H:i:s'),
        ]);

        $request_detail->fresh();


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
        $request_detail->requestMeta()->delete();
    }
}
