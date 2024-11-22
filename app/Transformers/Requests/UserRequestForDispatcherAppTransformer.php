<?php

namespace App\Transformers\Requests;

use Carbon\Carbon;
use App\Transformers\Transformer;
use App\Transformers\User\TripUserTransformer;
use App\Transformers\Driver\DriverTransformer;
use App\Models\Request\Request as RequestModel;
use App\Transformers\User\AdHocUserTransformer;
use App\Transformers\Requests\RequestBillTransformer;
use App\Base\Constants\Masters\PaymentType;
use App\Base\Constants\Setting\Settings;

class UserRequestForDispatcherAppTransformer extends Transformer
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected array $availableIncludes = [
        
    ];

    /**
     * A Fractal transformer.
     *
     * @param RequestModel $request
     * @return array
     */
    public function transform(RequestModel $request)
    {
        $params =  [
            'id' => $request->id,
            'request_number' => $request->request_number,
            'ride_otp'=>$request->ride_otp,
            'is_later' => $request->is_later,
            'user_id' => $request->user_id,
            'service_location_id'=>$request->service_location_id,
            'trip_start_time' => $request->converted_trip_start_time,
            'arrived_at' => $request->converted_arrived_at,
            'accepted_at' => $request->converted_accepted_at,
            'completed_at' => $request->converted_completed_at,
            'is_driver_started'=>$request->is_driver_started,
            'is_driver_arrived'=>$request->is_driver_arrived,
            'updated_at'=>$request->converted_updated_at,
            'is_trip_start'=>$request->is_trip_start,
            'total_distance'=>number_format($request->total_distance,2),
            'total_time'=>$request->total_time,
            'is_completed'=>$request->is_completed,
            'is_cancelled' => $request->is_cancelled,
            'cancel_method'=>$request->cancel_method,
            'payment_opt' => $request->payment_opt,
            'is_paid' => $request->is_paid,
            'reason' => $request->reason,
            'request_eta_amount'=>$request->request_eta_amount,
            'user_rated' => $request->user_rated,
            'driver_rated' => $request->driver_rated,
            'unit' => $request->unit==0?'MILES':'KM',
            'zone_type_id'=>$request->zone_type_id,
            'vehicle_type_name'=>$request->vehicle_type_name,
            'vehicle_type_image'=>$request->vehicle_type_image,
            'car_make_name'=>$request->driverDetail?$request->driverDetail->car_make_name:'-',
            'car_model_name'=>$request->driverDetail?$request->driverDetail->car_model_name:'-',
            'pick_lat'=>$request->pick_lat,
            'pick_lng'=>$request->pick_lng,
            'drop_lat'=>$request->drop_lat,
            'drop_lng'=>$request->drop_lng,
            'pick_address'=>$request->pick_address,
            'drop_address'=>$request->drop_address,
            'requested_currency_code'=>$request->requested_currency_code,
            'requested_currency_symbol'=>$request->requested_currency_symbol,
            'user_cancellation_fee'=>0,
            'is_rental'=>(bool)$request->is_rental,
            'rental_package_id'=>$request->rental_package_id,
            'rental_package_name'=>$request->rentalPackage?$request->rentalPackage->name:'-',
            'show_drop_location'=>false,
            'show_otp_feature'=>true,
            'request_eta_amount'=>$request->request_eta_amount,
            'show_request_eta_amount'=>true,
            'if_dispatch'=>$request->if_dispatch

        ];

        return $params;
    }
   
}
