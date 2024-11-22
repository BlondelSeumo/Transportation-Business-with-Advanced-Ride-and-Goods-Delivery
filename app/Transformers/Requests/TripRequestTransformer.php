<?php

namespace App\Transformers\Requests;

use App\Transformers\Transformer;
use App\Transformers\User\UserTransformer;
use App\Transformers\Driver\DriverTransformer;
use App\Models\Request\Request as RequestModel;
use App\Transformers\User\AdHocUserTransformer;
use App\Transformers\Requests\RequestBillTransformer;
use Carbon\Carbon;
use App\Base\Constants\Masters\PaymentType;
use App\Base\Constants\Setting\Settings;
use App\Transformers\Requests\RequestStopsTransformer;
use App\Transformers\Requests\RequestProofsTransformer;
use Log;

class TripRequestTransformer extends Transformer
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected array $availableIncludes = [
        'driverDetail','userDetail','requestBill','requestStops','requestProofs'
    ];

    /**
     * Resources that can be included in default.
     *
     * @var array
     */
    protected array $defaultIncludes = [
       'requestStops'
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
            'user_rated' => $request->user_rated,
            'driver_rated' => $request->driver_rated,
            'unit' => $request->unit==2?'MILES':'KM',
            'zone_type_id'=>$request->zone_type_id,
            'vehicle_type_id'=>$request->vehicle_type_id??'-',
            'vehicle_type_name'=>$request->vehicle_type_name??'-',
            'vehicle_type_image'=>$request->vehicle_type_image??'-',
            'car_make_name'=>$request->driverDetail?$request->driverDetail->car_make_name:'-',
            'car_model_name'=>$request->driverDetail?$request->driverDetail->car_model_name:'-',
            'car_color'=>$request->driverDetail?$request->driverDetail->car_color:'-',
            'car_number'=>$request->driverDetail?$request->driverDetail->car_number:'-',
            'pick_lat'=>$request->pick_lat,
            'pick_lng'=>$request->pick_lng,
            'drop_lat'=>$request->drop_lat,
            'drop_lng'=>$request->drop_lng,
            'pick_address'=>$request->pick_address,
            'drop_address'=>$request->drop_address,
            'pickup_poc_name'=>$request->requestPlace->pickup_poc_name,
            'pickup_poc_mobile'=>$request->requestPlace->pickup_poc_mobile,
            'drop_poc_name'=>$request->requestPlace->drop_poc_name,
            'drop_poc_mobile'=>$request->requestPlace->drop_poc_mobile,
            'pickup_poc_instruction'=>$request->requestPlace->pickup_poc_instruction,
            'drop_poc_instruction'=>$request->requestPlace->drop_poc_instruction,
            'requested_currency_code'=>$request->requested_currency_code,
            'requested_currency_symbol'=>$request->requested_currency_symbol,
            'user_cancellation_fee'=>0,
            'is_rental'=>(bool)$request->is_rental,
            'rental_package_id'=>$request->rental_package_id,
            'is_out_station'=>$request->is_out_station,
            'return_time'=>$request->converted_return_time,
            'is_round_trip'=>$request->is_round_trip,
            'rental_package_name'=>$request->rentalPackage?$request->rentalPackage->name:'-',
            'show_drop_location'=>false,
            'request_eta_amount'=> $request->requestBill ? $request->requestBill->total_amount : $request->request_eta_amount,
            'show_request_eta_amount'=>true,
            'offerred_ride_fare'=>$request->offerred_ride_fare,
            'accepted_ride_fare'=>$request->accepted_ride_fare,
            'is_bid_ride'=>$request->is_bid_ride,
            'ride_user_rating'=>0,
            'ride_driver_rating'=>0,
            'if_dispatch'=>false,
            'goods_type'=>$request->goodsTypeDetail?$request->goodsTypeDetail->goods_type_name:'-',
            'goods_type_quantity'=>$request->goods_type_quantity,
            'converted_trip_start_time'=>$request->converted_trip_start_time,
            'converted_arrived_at'=>$request->converted_arrived_at,
            'converted_accepted_at'=>$request->converted_accepted_at,
            'converted_completed_at'=>$request->converted_completed_at,
            'converted_cancelled_at'=>$request->converted_cancelled_at,
            'converted_created_at'=>$request->converted_created_at,
            'payment_type'=>$request->zoneType->payment_type,
            'discounted_total'=>$request->discounted_total,
            'poly_line' => $request->poly_line,
            'is_pet_available' => $request->is_pet_available??0,
            'is_luggage_available' => $request->is_luggage_available??0,
            'instant_ride' => $request->instant_ride,

        ];
        if(!$request->if_dispatch){
            $params['show_otp_feature'] = true;
        }else{
            $params['show_otp_feature'] = false;
        }
            $params['completed_ride'] =false;
            $params['later_ride'] =false;
            $params['cancelled_ride'] =false;

            $params['ongoing_ride'] = true;

            if(request()->has('is_completed') && request()->is_completed){

                $params['completed_ride'] =true;
                $params['ongoing_ride'] = false;


            }
            if(request()->has('is_later') && request()->is_later){

                $params['later_ride'] =true;
                $params['ongoing_ride'] = false;


            }
             if(request()->has('is_cancelled') && request()->is_cancelled){

                $params['cancelled_ride'] =true;
                $params['ongoing_ride'] = false;


            }
            $params['trip_start_time_with_date'] = $request->getConvertedTripStartTimeDateAttribute();
            $params['arrived_at__with_date'] = $request->getConvertedArrivedAtDateAttribute();
            $params['accepted_at__with_date'] = $request->getConvertedAcceptedAtDateAttribute();
            $params['completed_at_with_date'] = $request->getConvertedCompletedAtDateAttribute();
            $params['cancelled_at_with_date'] = $request->getConvertedCancelledAtDateAttribute();
            $params['createded_at_with_date'] = $request->getConvertedCreatedAtDateAttribute();
            $params['bidding_low_percentage'] = get_settings('bidding_low_percentage');
            $params['bidding_high_percentage'] = get_settings('bidding_high_percentage');







        $maximum_time_for_find_drivers_for_regular_ride = (get_settings(Settings::MAXIMUM_TIME_FOR_FIND_DRIVERS_FOR_REGULAR_RIDE) * 60);

        $current_time = $current_time = Carbon::now();

        $trip_requested_time = Carbon::parse($request->updated_at);

        $difference_request_duration = $trip_requested_time->diffInMinutes($current_time);

        $difference_request_duration = $difference_request_duration * 60;

        $final_interval = ($maximum_time_for_find_drivers_for_regular_ride - $difference_request_duration);

        if($final_interval<0){
            $final_interval =1;
        }
        $params['maximum_time_for_find_drivers_for_regular_ride'] = $final_interval;


            $ride_type = 1;


        if ($request->zoneType) {
            // Fetch zone type price only once if it exists
            $zone_type_price = $request->zoneType->zoneTypePrice()->where('price_type', $ride_type)->first();

            if ($zone_type_price) {
                $params['free_waiting_time_in_mins_before_trip_start'] = $zone_type_price->free_waiting_time_in_mins_before_trip_start;
                $params['free_waiting_time_in_mins_after_trip_start'] = $zone_type_price->free_waiting_time_in_mins_after_trip_start;
                $params['waiting_charge'] = $zone_type_price->waiting_charge;
            } else {
                // Handle case where zone type price is not found
                Log::warning('Zone type price not found for ride type: ' . $ride_type);
                // Set default values or return an error message
                // Example: Set default waiting charge to 0
                $params['waiting_charge'] = 0;
            }
        } else {
            // Handle case where zone type is not found in the request
            Log::error('Zone type not found in the request');
            // You might want to throw an exception or return an error response
        }


        if($request->requestRating()->exists()){

          $params['ride_user_rating'] = $request->requestRating()->where('user_rating',1)->pluck('rating')->first();

            $params['ride_driver_rating'] = $request->requestRating()->where('driver_rating',1)->pluck('rating')->first();
        }
        if($request->if_dispatch){

            $params['if_dispatch'] = true;
            $params['show_request_eta_amount'] = false;
            $params['show_otp_feature'] = false;
        }

        if(get_settings('show_ride_otp_feature')=='0'){
            $params['show_otp_feature'] = false;
        }

        if($request->instant_ride==true)
        {
            $params['show_otp_feature'] = false;
        }


        if($request->payment_opt ==PaymentType::CARD){

            $params['payment_type_string'] = 'card';

        }elseif($request->payment_opt ==PaymentType::CASH){

            $params['payment_type_string'] = 'cash';
        }else{

            $params['payment_type_string'] = 'wallet';

        }

        if ($request->trip_start_time==null) {
            $params['cv_trip_start_time'] = null;
        }

        $timezone = $request->serviceLocationDetail->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        if ($request->trip_start_time==null) {
            $params['cv_trip_start_time'] = null;
        }else{
            $params['cv_trip_start_time'] = Carbon::parse($request->trip_start_time)->setTimezone($timezone)->format('h:i A');
        }

        if ($request->completed_at==null) {
            $params['cv_completed_at'] = null;
        }else{
        $params['cv_completed_at'] = Carbon::parse($request->completed_at)->setTimezone($timezone)->format('h:i A');

        }

        if ($request->created_at==null) {
            $params['cv_created_at'] = null;
        }else{
        $params['cv_created_at'] = Carbon::parse($request->created_at)->setTimezone($timezone)->format('h:i A');

        }


        if($request->is_cancelled){

            if($request->requestCancellationFee()->exists()){

                $params['user_cancellation_fee'] = $request->requestCancellationFee()->where('user_id',$request->user_id)->pluck('cancellation_fee')->first()?:0;

                $params['driver_cancellation_fee'] = $request->requestCancellationFee()->where('driver_id',$request->driver_id)->pluck('cancellation_fee')->first()?:0;
            }

        }

        $app_for = config('app.app_for');

        $transportType = $request->transport_type ?? $app_for;

        $params['transport_type'] =  $transportType;


        if ($transportType==="delivery") {
            $params['enable_shipment_load_feature'] = get_settings(Settings::ENABLE_SHIPMENT_LOAD_FEATURE);
            $params['enable_shipment_unload_feature'] = get_settings(Settings::ENABLE_SHIPMENT_UNLOAD_FEATURE);
            $params['enable_digital_signature'] = get_settings(Settings::ENABLE_DIGITAL_SIGNATURE);
        }

        return $params;
    }

    /**
     * Include the driver of the request.
     *
     * @param RequestModel $request
     * @return \League\Fractal\Resource\Item|\League\Fractal\Resource\NullResource
     */
    public function includeDriverDetail(RequestModel $request)
    {
        $driverDetail = $request->driverDetail;

        return $driverDetail
        ? $this->item($driverDetail, new DriverTransformer)
        : $this->null();
    }
    /**
     * Include the user of the request.
     *
     * @param RequestModel $request
     * @return \League\Fractal\Resource\Item|\League\Fractal\Resource\NullResource
     */
    public function includeUserDetail(RequestModel $request)
    {
        if ($request->user_id==null) {
            // @TODO need to redirect with adhoc user transformer
            $userDetail = $request->adHocuserDetail;
            return $userDetail
        ? $this->item($userDetail, new AdHocUserTransformer)
        : $this->null();
        } else {
            $userDetail = $request->userDetail;
            return $userDetail
        ? $this->item($userDetail, new UserTransformer)
        : $this->null();
        }
    }

    /**
    * Include the stops of the request.
    *
    * @param RequestModel $request
    * @return \League\Fractal\Resource\Item|\League\Fractal\Resource\NullResource
    */
    public function includeRequestStops(RequestModel $request)
    {
        $requestStops = $request->requestStops;

        return $requestStops
        ? $this->collection($requestStops, new RequestStopsTransformer)
        : $this->null();
    }

    /**
    * Include the proof of the request.
    *
    * @param RequestModel $request
    * @return \League\Fractal\Resource\Item|\League\Fractal\Resource\NullResource
    */
    public function includeRequestProofs(RequestModel $request)
    {
        $requestProofs = $request->requestProofs;

        return $requestProofs
        ? $this->collection($requestProofs, new RequestProofsTransformer)
        : $this->null();
    }


    /**
    * Include the calculated bill of the request.
    *
    * @param RequestModel $request
    * @return \League\Fractal\Resource\Item|\League\Fractal\Resource\NullResource
    */
    public function includeRequestBill(RequestModel $request)
    {
        $requestBill = $request->requestBillDetail;

        return $requestBill
        ? $this->item($requestBill, new RequestBillTransformer)
        : $this->null();
    }
}
