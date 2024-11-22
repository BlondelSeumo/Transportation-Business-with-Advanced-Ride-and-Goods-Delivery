<?php

namespace App\Http\Controllers\Api\V1\Request;

use App\Jobs\NotifyViaMqtt;
use App\Jobs\NotifyViaSocket;
use App\Base\Constants\Masters\UserType;
use App\Base\Constants\Masters\PushEnums;
use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\Request\CancelTripRequest;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Transformers\Requests\TripRequestTransformer;
use App\Models\Admin\CancellationReason;
use App\Base\Constants\Masters\zoneRideType;
use App\Base\Constants\Masters\WalletRemarks;
use App\Models\Request\DriverRejectedRequest;
use App\Models\Request\RequestMeta;
use App\Models\Admin\Driver;
use Carbon\Carbon;
use Kreait\Firebase\Contract\Database;
use Sk\Geohash\Geohash;
use Illuminate\Support\Facades\Log;
use App\Jobs\Notifications\SendPushNotification;
use Illuminate\Support\Facades\DB;
use App\Helpers\Rides\FetchDriversFromFirebaseHelpers;



/**
 * @group Driver-trips-apis
 *
 * APIs for Driver-trips apis
 */
class DriverCancelRequestController extends BaseController
{
    use FetchDriversFromFirebaseHelpers;
    

    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    /**
    * Driver Cancel Trip Request
    * @bodyParam request_id uuid required id of request
    * @bodyParam reason string optional reason provided by user
    * @bodyParam custom_reason string optional custom reason provided by user
    *@response {
    "success": true,
    "message": "driver_cancelled_trip"}
    */
    public function cancelRequest(CancelTripRequest $request)
    {

        
        /**
        * Validate the request which is authorised by current authenticated user
        * Cancel the request by updating is_cancelled true with reason if there is any reason
        * Notify the user that is cancelled the trip request by driver
        */
        // Validate the request which is authorised by current authenticated user
        $driver = auth()->user()->driver;
        // Update the availble status
        $driver->available = true;
        $driver->save();
        $driver->fresh();

        $request_detail = $driver->requestDetail()->where('id', $request->request_id)->first();
        // Throw an exception if the user is not authorised for this request
        if (!$request_detail) {
            $this->throwAuthorizationException();
        }
        
        // Existing Flow
        // $request_detail->update([
        //     'is_cancelled'=>true,
        //     'reason'=>$request->reason,
        //     'custom_reason'=>$request->custom_reason,
        //     'cancel_method'=>UserType::DRIVER,
        // ]);

        DriverRejectedRequest::create([
            'request_id'=>$request_detail->id,
            'is_after_accept'=>true,
            'driver_id'=>$driver->id,'reason'=>$request->reason,
            'custom_reason'=>$request->custom_reason]);

        /**
        * Apply Cancellation Fee
        */
        $charge_applicable = false;
        if ($request->custom_reason) {
            $charge_applicable = true;
        }
        if ($request->reason) {
            $reason = CancellationReason::where('reason',$request->reason)->first();

            if ($reason->payment_type=='free') {
                $charge_applicable=false;
            } else {
                $charge_applicable=true;
            }
        }

          /**
         * get prices from zone type
         */

            $ride_type = zoneRideType::RIDENOW;


        if ($charge_applicable) {
            
            $zone_type_price = $request_detail->zoneType->zoneTypePrice()->where('price_type', $ride_type)->first();

            $cancellation_fee = $zone_type_price->cancellation_fee;

            $requested_driver = $request_detail->driverDetail;

            if($request_detail->driverDetail->owner()->exists()){

            $owner_wallet = $request_detail->driverDetail->owner->ownerWalletDetail;
            $owner_wallet->amount_spent += $cancellation_fee;
            $owner_wallet->amount_balance -= $cancellation_fee;
            $owner_wallet->save();

            // Add the history
            $owner_wallet_history = $request_detail->driverDetail->owner->ownerWalletHistoryDetail()->create([
                'amount'=>$cancellation_fee,
                'transaction_id'=>$request_detail->id,
                'remarks'=>WalletRemarks::CANCELLATION_FEE,
                'request_id'=>$request_detail->id,
                'is_credit'=>false
            ]);


            }else{

                $driver_wallet = $requested_driver->driverWallet;
            $driver_wallet->amount_spent += $cancellation_fee;
            $driver_wallet->amount_balance -= $cancellation_fee;
            $driver_wallet->save();

            // Add the history
            $requested_driver->driverWalletHistory()->create([
            'amount'=>$cancellation_fee,
            'transaction_id'=>$request_detail->id,
            'remarks'=>WalletRemarks::CANCELLATION_FEE,
            'request_id'=>$request_detail->id,
            'is_credit'=>false]);

            }
            

            $request_detail->requestCancellationFee()->create(['driver_id'=>$request_detail->driver_id,'is_paid'=>true,'cancellation_fee'=>$cancellation_fee,'paid_request_id'=>$request_detail->id]);
        }

        // Get the user detail
        $user = $request_detail->userDetail;

        /**
         * Find New drivers for this Ride
         * 
         * */

        // New Flow

        if($request_detail->is_bid_ride){

            $request_detail->update([
            'is_cancelled'=>true,
            'reason'=>$request->reason,
            'custom_reason'=>$request->custom_reason,
            'cancel_method'=>UserType::DRIVER,
        ]);
          $this->database->getReference('bid-meta/'.$request->id)->remove();

            goto no_drivers_available;
        }

        if ($request_detail->if_dispatch==true) {
        $request_detail->update([
            'is_cancelled'=>true,
            'cancel_method'=>2,
            'cancelled_at'=>Carbon::now()->setTimezone('UTC')->toDateTimeString()
        ]);
        }else{

/*old*/
            //    $request_detail->update([
            //     'driver_id'=>null,
            //     'arrived_at'=>null,
            //     'accepted_at'=>null,
            //     'is_driver_started'=>0,
            //     'is_driver_arrived'=>0,
            //     'updated_at'=>Carbon::now()->setTimezone('UTC')->toDateTimeString()
            // ]);  
/*new*/             
            $request_detail->update([
                'is_cancelled'=>true,
                'cancel_method'=>2,
                'cancelled_at'=>Carbon::now()->setTimezone('UTC')->toDateTimeString()
            ]);
          }
/*old*/
            // $this->database->getReference('requests/'.$request_detail->id)->update(['is_accept' => 0,'driver_id'=>null]);

        // $this->fetchDriversFromFirebase($request_detail);
        // 
/*new*/
        // Delete from Firebase
        $this->database->getReference('requests/' . $request_detail->id)->update(['is_cancelled' => true, 'cancelled_by_driver' => true]);    
        $this->database->getReference('request-meta/' . $request_detail->id)->remove();

        $this->database->getReference('requests/' . $request_detail->id)->remove();
        no_drivers_available:

        // Notify the user that the driver is cancelled the trip request
        if ($user) {
            $request_result =  fractal($request_detail, new TripRequestTransformer)->parseIncludes('driverDetail');

            $push_request_detail = $request_result->toJson();
            $title = trans('push_notifications.trip_cancelled_by_driver_title',[],$user->lang);
            $body = trans('push_notifications.trip_cancelled_by_driver_body',[],$user->lang);

            $push_data = ['success'=>true,'success_message'=>PushEnums::REQUEST_CANCELLED_BY_DRIVER,'result'=>(string)$push_request_detail];

            
            dispatch(new SendPushNotification($user,$title,$body));
        }


        return $this->respondSuccess(null, 'driver_cancelled_trip');
    }


    
   
}
