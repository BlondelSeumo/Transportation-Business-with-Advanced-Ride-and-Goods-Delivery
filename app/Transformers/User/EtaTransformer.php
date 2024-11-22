<?php

namespace App\Transformers\User;

use Carbon\Carbon;
use App\Models\Admin\Zone;
use App\Models\Admin\Promo;
use App\Models\Admin\Driver;
use App\Models\Admin\ZoneType;
use App\Models\Admin\PromoCodeUser;
use App\Models\Admin\PromoUser;
use App\Transformers\Transformer;
use App\Models\Admin\ZoneSurgePrice;
use App\Models\Master\DistanceMatrix;
use Illuminate\Support\Facades\Redis;
use App\Helpers\Exception\ExceptionHelpers;
use App\Base\Constants\Masters\EtaConstants;
use App\Base\Constants\Masters\zoneRideType;
use App\Transformers\Access\RoleTransformer;
use App\Base\Constants\Auth\Role;
use Illuminate\Support\Facades\Log;
use App\Helpers\Rides\RidePriceCalculationHelpers;

class EtaTransformer extends Transformer
{
    use ExceptionHelpers,RidePriceCalculationHelpers;
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
     * @return array
     */
    public function transform(ZoneType $zone_type)
    {
        $pick_lat = request()->pick_lat;
        $pick_lng = request()->pick_lng;
        $drop_lat = request()->drop_lat;
        $drop_lng = request()->drop_lng;

        $response =  [
            'zone_type_id' => $zone_type->id,
            'name' => $zone_type->vehicleType->name,
            'vehicle_icon' => $zone_type->vehicleType->icon,
            'description'=> $zone_type->vehicleType->description,
            'short_description'=> $zone_type->vehicleType->short_description,
            'supported_vehicles'=> $zone_type->vehicleType->supported_vehicles,
            'size'=> $zone_type->vehicleType->size,
            'capacity'=> $zone_type->vehicleType->capacity,
            'payment_type'=>$zone_type->payment_type,
            'is_default'=>false,
            'enable_bidding'=>false,

        ];

        if($zone_type->transport_type=='taxi'){
            if ($zone_type->zone->default_vehicle_type==$zone_type->type_id) {
            $response['is_default'] = true;
        }
        }else{
            if ($zone_type->zone->default_vehicle_type_for_delivery==$zone_type->type_id) {
            $response['is_default'] = true;
        }
        }


        if (!request()->has('vehicle_type')) {
            $response['icon'] = $zone_type->icon;
            $response['type_id']=$zone_type->type_id;
        }
        /**
         * get prices from zone type
         */
            $ride_type = zoneRideType::RIDENOW;

        $coupon_detail = null;

        if (request()->has('promo_code') && request()->input('promo_code')) {
            $coupon_detail = $this->validate_promo_code($zone_type->zone->service_location_id,$zone_type);
        }
        $type_prices = $zone_type->zoneTypePrice()->where('price_type', $ride_type)->first();

        $distance_in_unit = 0;
        $dropoff_time_in_seconds = 0;

        if (request()->has('drop_lat') && request()->has('drop_lng') && request()->drop_lat) {


            if(env('APP_FOR')=='demo'){

                $distance = distance_between_two_coordinates($pick_lat,$pick_lng,$drop_lat,$drop_lng,'K');

                $dropoff_distance_in_meters = $distance * 1000;

                if($distance<2){
                    $dropoff_time_in_seconds = 180;
                }elseif ($distance > 2 && $distance <5) {
                    $dropoff_time_in_seconds = 480;
                }else{
                    $dropoff_time_in_seconds=600;
                }

            if(request()->has('stops') && request()->stops){

            $requested_stops = json_decode(request()->stops);


            foreach ($requested_stops as $key => $stop) {

        if($key==0){

                $distance = distance_between_two_coordinates($pick_lat,$pick_lng,$stop->latitude, $stop->longitude,'K');
                $dropoff_distance_in_meters+= $distance * 1000;

            if ($dropoff_distance_in_meters) {

                $stop_distance_in_unit = $dropoff_distance_in_meters / 1000;
                if ($zone_type->zone->unit==2) {
                    $distance_in_unit+= kilometer_to_miles($stop_distance_in_unit);

                }else{
                    $distance_in_unit+=$stop_distance_in_unit;
                }
            }


            }else{

                $distance = distance_between_two_coordinates($requested_stops[$key-1]->latitude, $requested_stops[$key-1]->longitude, $stop->latitude, $stop->longitude,'K');

                $dropoff_distance_in_meters+= $distance * 1000;

            if ($dropoff_distance_in_meters) {

                $stop_distance_in_unit = $dropoff_distance_in_meters / 1000;
                if ($zone_type->zone->unit==2) {
                    $distance_in_unit+= kilometer_to_miles($stop_distance_in_unit);

                }else{
                    $distance_in_unit+=$stop_distance_in_unit;
                }
            }

            }

            }

            }

            }else{


                if(get_settings('map_type')=='open_street'){

                       $distance_and_duration = getDistanceMatrixByOpenstreetMap($pick_lat,$pick_lng,$drop_lat,$drop_lng);

                $dropoff_distance_in_meters=$distance_and_duration['distance_in_meters'];

                $dropoff_time_in_seconds=$distance_and_duration['duration_in_secs'];


            if(request()->has('stops') && request()->stops){

            $requested_stops = json_decode(request()->stops);


            foreach ($requested_stops as $key => $stop) {

        if($key==0){

                $distance_and_duration = getDistanceMatrixByOpenstreetMap($pick_lat,$pick_lng,$stop->latitude, $stop->longitude);

                $dropoff_distance_in_meters+=$distance_and_duration['distance_in_meters'];

                $dropoff_time_in_seconds+=$distance_and_duration['duration_in_secs'];


            if ($dropoff_distance_in_meters) {
                if ($zone_type->zone->unit==2) {
                    $distance_in_unit+=$distance_and_duration['distance_in_miles'];

                }else{
                    $distance_in_unit+=$distance_and_duration['distance_in_km'];
                }
            }


            }else{


                $distance_and_duration = getDistanceMatrixByOpenstreetMap($requested_stops[$key-1]->latitude, $requested_stops[$key-1]->longitude, $stop->latitude, $stop->longitude,);

                $dropoff_distance_in_meters+=$distance_and_duration['distance_in_meters'];

                $dropoff_time_in_seconds+=$distance_and_duration['duration_in_secs'];

            if ($dropoff_distance_in_meters) {

                if ($zone_type->zone->unit==2) {
                    $distance_in_unit+=$distance_and_duration['distance_in_miles'];

                }else{
                    $distance_in_unit+=$distance_and_duration['distance_in_km'];
                }
            }

            }

            }

            }

         }else
         {

                // get previous place json or store current one
                $previous_pickup_dropoff = $this->db_query_previous_pickup_dropoff($pick_lat, $pick_lng, $drop_lat, $drop_lng);

                $place_details = json_decode($previous_pickup_dropoff->json_result);

                $dropoff_distance_in_meters = get_distance_value_from_distance_matrix($place_details);

                $dropoff_time_in_seconds = get_duration_value_from_distance_matrix($place_details);


                  if(request()->has('stops') && request()->stops)
                  {

                        $requested_stops = json_decode(request()->stops);


                    foreach ($requested_stops as $key => $stop) 
                    {

                        if($key==0){
                            $previous_pickup_dropoff = $this->db_query_previous_pickup_dropoff($pick_lat, $pick_lng, $stop->latitude, $stop->longitude);

                        $place_details = json_decode($previous_pickup_dropoff->json_result);

                        $dropoff_distance_in_meters+= get_distance_value_from_distance_matrix($place_details);

                        if ($dropoff_distance_in_meters) {

                            $stop_distance_in_unit = $dropoff_distance_in_meters / 1000;
                            if ($zone_type->zone->unit==2) {
                                $distance_in_unit+= kilometer_to_miles($stop_distance_in_unit);

                            }else{
                                $distance_in_unit+=$stop_distance_in_unit;
                            }
                        }
                        }else
                        {

                        $previous_pickup_dropoff = $this->db_query_previous_pickup_dropoff($requested_stops[$key-1]->latitude, $requested_stops[$key-1]->longitude, $stop->latitude, $stop->longitude);

                        $place_details = json_decode($previous_pickup_dropoff->json_result);

                        $dropoff_distance_in_meters+= get_distance_value_from_distance_matrix($place_details);

                         if ($dropoff_distance_in_meters) 
                         {
                            $stop_distance_in_unit = $dropoff_distance_in_meters / 1000;
                            if ($zone_type->zone->unit==2) {
                                $distance_in_unit+= kilometer_to_miles($stop_distance_in_unit);

                            }else{
                                $distance_in_unit+=$stop_distance_in_unit;
                            }
                         }

                        }

                     }//foreach
                  }//request stops
                }//else
            }
            if ($dropoff_distance_in_meters) {
                $distance_in_unit = $dropoff_distance_in_meters / 1000;
                if ($zone_type->zone->unit==2) {
                    $distance_in_unit = kilometer_to_miles($distance_in_unit);

                }
            }
        }


        $near_driver_status = 0; //its means there is no driver available

        $driver_lat = $pick_lat;
        $driver_lng = $pick_lng;
        $near_driver = null;
        if (request()->has('drivers')) {
            $driver_data_with_distance = [];
            $driver_distance = [];
            foreach (json_decode(request()->drivers) as $key => $driver) {
                $driver_data = new \stdClass();
                $driver_data->id = $driver->driver_id;
                $driver_data->lat = $driver->driver_lat;
                $driver_data->lng = $driver->driver_lng;
                $driver_data->distance = self::calculate_distance(request()->pick_lat, request()->pick_lng, $driver->driver_lat, $driver->driver_lng, 'K');
                $driver_data_with_distance []= $driver_data;
                $driver_distance[] = $driver_data->distance;
            }

            $min_distance_driver = min($driver_distance);

            foreach ($driver_data_with_distance as $key => $driver_data) {
                if ($min_distance_driver==$driver_data->distance) {
                    $near_driver = $driver_data;
                    break;
                }
            }

            if ($near_driver==null) {
                $driver_lat = $pick_lat;
                $driver_lng = $pick_lng;
            } else {
                $driver_lat = $near_driver->lat;
                $driver_lng = $near_driver->lng;
                $near_driver_status=1;
            }
        }
        $user_balance = 0;


// userWallet
$user = auth()->user();
    if($user!=null)
    {
        if(!auth()->user()->hasRole(Role::DRIVER))
        {



        $user_balance = $user->userWallet ? $user->userWallet->amount_balance : 0;

        //$user_balance =  $user->userWallet->amount_balance;
        }

    }


        $response['user_wallet_balance'] = $user_balance;


        // $driver_to_pickup = $this->db_query_previous_pickup_dropoff($driver_lat, $driver_lng, $pick_lat, $pick_lng);

        // $driver_to_pickup_response = json_decode($driver_to_pickup->json_result);
        if ($zone_type->zone->unit==1) {
            $unit_in_words = 'KM';
        } else {
            $unit_in_words = 'MILES';
        }
        // $unit_in_words = EtaConstants::ENGLISH_UNITS[$zone_type->zone->unit];
        $translated_unit_in_words = $unit_in_words;
         $airport_surge = find_airport($pick_lat,$pick_lng);
        if($airport_surge==null){
            $airport_surge = find_airport($drop_lat,$drop_lng);
        }

        $airport_surge_fee = 0;

        if($airport_surge){

            $airport_surge_fee = $airport_surge->airport_surge_fee?:0;
         

        }

        // $ride = $this->calculateRideFares($distance_in_unit, $dropoff_time_in_seconds, $zone_type, $type_prices, $coupon_detail,$airport_surge_fee);

        $total_duration = ($dropoff_time_in_seconds / 60);

        $timezone = $zone_type->zone->serviceLocation->timezone;

        $ride = $this->calculateBillForARide($pick_lat,$pick_lng,$drop_lat,$drop_lng,$distance_in_unit, $total_duration, $zone_type, $type_prices, $coupon_detail,$timezone,null,0,null,null);


        if ($near_driver_status != 0) {
            if ($ride->pickup_duration != 0) {
                $driver_arival_estimation = "{$ride->pickup_duration} min";
            } else {
                $driver_arival_estimation = "1 min";
            }
        } else {
            $driver_arival_estimation = "--";
        }

        
        $app_for = config('app.app_for');

        if($app_for=='taxi' || $app_for=='delivery')
        {
            if(request()->has('transport_type') && request()->transport_type == "taxi") {
                $response['transport_type'] = "taxi";
            }
            if(request()->has('transport_type') && request()->transport_type == "delivery") {
                $response['transport_type'] = "delivery";
            }
        }
        $response['has_discount'] = false;
        if ($ride->discount_amount > 0) {
            $response['has_discount'] = true;
            $response['discounted_totel'] = round($ride->discounted_total_price, 2);
            $response['discount_total_tax_amount'] = $ride->discount_total_tax_amount;
            $response['promocode_id'] = $coupon_detail->id;
        }
        $response['discount_amount'] = $ride->discount_amount;
        $response['distance'] = $ride->distance;
        $response['time'] = $ride->duration;
        $response['base_distance'] = $ride->base_distance;
        $response['base_price'] = $ride->base_price;
        $response['price_per_distance'] = $ride->price_per_distance;
        $response['price_per_time'] = $ride->price_per_time;
        $response['distance_price'] = $ride->distance_price;
        $response['time_price'] = $ride->time_price;
        $response['ride_fare'] = round($ride->subtotal_price,2);
        $response['tax_amount'] = $ride->tax_amount;
        $response['without_discount_admin_commision'] = round($ride->without_discount_admin_commision,2);
        $response['discount_admin_commision'] = round($ride->discount_admin_commision,2);
        $response['tax'] = $ride->tax_percent;
        $response['total'] = $ride->total_price;
        $response['approximate_value'] = 1;
        $response['min_amount'] = $ride->total_price;
        $maxamount=$ride->total_price * 1.05;
        $response['max_amount'] = round($maxamount,2);
        $response['currency'] = $zone_type->zone->serviceLocation->currency_symbol;
        $response['currency_name'] = $zone_type->zone->serviceLocation->currency_code;
        $response['type_name'] = $zone_type->vehicleType->name;
        $response['unit'] = $zone_type->zone->unit;
        $response['unit_in_words_without_lang'] = $unit_in_words;
        $response['unit_in_words'] = $translated_unit_in_words;
        $response['airport_surge_fee'] = $ride->airport_surge_fee;
        $response['bidding_low_percentage'] = get_settings('bidding_low_percentage');
        $response['bidding_high_percentage'] = get_settings('bidding_high_percentage');
        // dd($ride);

        // dd($previous_pickup_dropoff);
        // $response['trip_dispatch_type'] = $zone_type->vehicleType->trip_dispatch_type;

                if($zone_type->vehicleType->trip_dispatch_type=='bidding'){

                    $response['enable_bidding'] = true;

                }

        return $response;
    }

    public function calculate_distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } elseif ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }

    private function calculateRideFares($distance_in_unit, $dropoff_time_in_seconds, $zone_type, $type_prices, $coupon_detail,$airport_surge_fee)
    {
        // $pickup_time_in_seconds = get_duration_value_from_distance_matrix($driver_to_pickup_response);
        $pickup_time_in_seconds = 0;
        $wait_time_in_seconds = 180; // can be change

        $calculatable_distance = ($distance_in_unit - $type_prices->base_distance);

        if($calculatable_distance < 0 ){

            $calculatable_distance = 0;
        }

        $price_per_distance = $type_prices->price_per_distance;

        // Validate if the current time in surge timings

        $timezone = $zone_type->zone->serviceLocation->timezone;

        $current_time = Carbon::now()->setTimezone($timezone);
        $day = $current_time->dayName;
        $current_time = $current_time->toTimeString();

        $zone_surge_price = ZoneSurgePrice::whereZoneId($zone_type->zone_id)->where('day',$day)->whereTime('start_time','<=',$current_time)->whereTime('end_time','>=',$current_time)->first();
        if($zone_surge_price){
            
            $surge_percent = $zone_surge_price->value;

            $surge_price_additional_cost = ($price_per_distance * ($surge_percent / 100));

            $price_per_distance += $surge_price_additional_cost;

        }



        $distance_price = ($calculatable_distance * $price_per_distance);



        $time_price = ($dropoff_time_in_seconds / 60) * $type_prices->price_per_time;

        if(request()->has('is_out_station')){

            $distance_price = ($distance_price *2);
            $time_price = ($time_price *2);

        }

        $base_price = $type_prices->base_price;
        // additon of base and distance price
        $base_and_distance_price = ($base_price + $distance_price);
        $base_distance = $type_prices->base_distance;
        // if ($distance_in_unit < $base_distance) {
        //     $base_and_distance_price = $base_price;
        // }
        $subtotal_price = $base_and_distance_price + $time_price;
        $discount_amount = 0;
        $coupon_applied_sub_total = $base_and_distance_price + $time_price;

        if ($coupon_detail) {
            if ($coupon_detail->minimum_trip_amount < $subtotal_price) {
                $discount_amount = $subtotal_price * ($coupon_detail->discount_percent/100);
                if ($coupon_detail->maximum_discount_amount>0 && $discount_amount > $coupon_detail->maximum_discount_amount) {
                    $discount_amount = $coupon_detail->maximum_discount_amount;
                }
                $coupon_applied_sub_total = $subtotal_price - $discount_amount;
            }
        }
        // if trip distace is lessthan base distance, no need to calculate time price

        // Get Admin Commision
        // $service_fee = get_settings('admin_commission');
        $service_fee = $zone_type->admin_commision;
        
        // Admin commision
        $without_discount_admin_commision = ($subtotal_price * ($service_fee / 100));
        // $tax_percent = get_settings('service_tax');
        $tax_percent = $zone_type->service_tax;


        $with_out_discount_tax_amount = ($subtotal_price * ($tax_percent / 100));

        $total_price = $subtotal_price + $with_out_discount_tax_amount + $without_discount_admin_commision+$airport_surge_fee;

        $discount_admin_commision = ($coupon_applied_sub_total * ($service_fee / 100));
        $discount_tax_amount = $coupon_applied_sub_total * ($tax_percent / 100);
        $discounted_total_price = $coupon_applied_sub_total + $discount_tax_amount + $discount_admin_commision;

        // if (!request()->has('drop_lat') && !request()->has('drop_lng')) {
        //     $total_price = 0;
        // }
        $pickup_duration = 0;
        $dropoff_duration = $dropoff_time_in_seconds / 60;
        $wait_duration = 0;
        $duration = $pickup_duration + $dropoff_duration + $wait_duration;

        return (object)[
                'distance' => round($distance_in_unit, 2),
                'base_distance' => $base_distance,
                'base_price' => $base_price,
                'price_per_distance' => $type_prices->price_per_distance,
                'price_per_time' => $type_prices->price_per_time,
                'distance_price' => round($distance_price, 2),
                'time_price' => round($time_price, 2),
                'subtotal_price' => round($subtotal_price,2),
                'tax_percent' => $tax_percent,
                'tax_amount' => $with_out_discount_tax_amount,
                'discount_total_tax_amount'=>round($discount_tax_amount,2),
                'without_discount_admin_commision'=>round($without_discount_admin_commision, 2),
                'discount_admin_commision'=>round($discount_admin_commision, 2),
                'total_price' => round($total_price, 2),
                'discounted_total_price'=>round($discounted_total_price, 2),
                'discount_amount'=>$discount_amount,
                'pickup_duration' => round($pickup_duration, 2),
                'dropoff_duration' => round($dropoff_duration, 2),
                'wait_duration' => round($wait_duration, 2),
                'duration' => round($duration, 2),
            ];
    }


    //vehicle type id should be zone_type id
    private function findNearestDriver($pick_lat, $pick_lng, $vehicle_type)
    {
        // $settings = json_decode(Redis::get('settings'));

        $driver_search_radius = get_settings('driver_search_radius')?:30;

        $haversine = "(6371 * acos(cos(radians($pick_lat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($pick_lng)) + sin(radians($pick_lat)) * sin(radians(latitude))))";

        $driver = Driver::whereHas('driverDetail', function ($query) use ($haversine,$driver_search_radius) {
            $query->select('driver_details.*')->selectRaw("{$haversine} AS distance")
                ->whereRaw("{$haversine} < ?", [$driver_search_radius]);
        })->where('active', 1)->where('approve', 1)->where('available', 1)->first();

        return $driver?:null;
    }

    private function db_query_previous_pickup_dropoff($pick_lat, $pick_lng, $drop_lat, $drop_lng)
    {
        return $this->db_query_nearest_distance_matrix(
            $pick_lat,
            $pick_lng,
            $drop_lat,
            $drop_lng,
            EtaConstants::PICKUP_RADIUS_IN_METERS,
            EtaConstants::DROPOFF_RADIUS_IN_METERS
        );
    }

    private function db_query_nearest_distance_matrix($pick_lat, $pick_lng, $drop_lat, $drop_lng, $radius1, $radius2)
    {
        $earth_radius = EtaConstants::EARTH_RADIUS_IN_METERS;
        $update_after = Carbon::now()->subMinute(EtaConstants::LOCATION_CACHE_TIME_IN_MINUTES)->toDateTimeString();

        // uses haversine formula for calculating distance
        $nearest_distance_matrix = DistanceMatrix::selectRaw("
      id,
      origin_addresses,
      ROUND($earth_radius *
        IFNULL(ACOS(
          COS( RADIANS(?) ) *
          COS( RADIANS(origin_lat) ) *
          COS( RADIANS(origin_lng) - RADIANS(?) ) +
          SIN( RADIANS(?) ) *
          SIN( RADIANS(origin_lat) )
        ), 0), 8) AS origin_distance,
      destination_addresses,
      ROUND($earth_radius *
        IFNULL(ACOS(
          COS( RADIANS(?) ) *
          COS( RADIANS(destination_lat) ) *
          COS( RADIANS(destination_lng) - RADIANS(?) ) +
          SIN( RADIANS(?) ) *
          SIN( RADIANS(destination_lat) )
        ), 0), 8) AS destination_distance,
      json_result", [
            $pick_lat,
            $pick_lng,
            $pick_lat,
            $drop_lat,
            $drop_lng,
            $drop_lat
        ])
            ->where("updated_at", ">=", $update_after)
            ->having("origin_distance", "<=", $radius1)
            ->having("destination_distance", "<=", $radius2)
            ->orderBy("origin_distance")
            ->orderBy("destination_distance")
            ->first();

        if (!$nearest_distance_matrix) {
            $nearest_distance_matrix =  $this->save_distance_matrix_from_google($pick_lat, $pick_lng, $drop_lat, $drop_lng, true);
        }
        return $nearest_distance_matrix;
    }
    public function save_distance_matrix_from_google($pick_lat, $pick_lng, $drop_lat, $drop_lng, $traffic)
    {
        $distance_matrix = get_distance_matrix($pick_lat, $pick_lng, $drop_lat, $drop_lng, $traffic);

        $carbonNow = Carbon::now()->toDateTimeString();

        if ($distance_matrix && $distance_matrix->status == 'OK') {
            $distance_matrix_params = [
                'origin_addresses'=>$distance_matrix->origin_addresses[0],
                'origin_lat'=>$pick_lat,
                'origin_lng'=>$pick_lng,
                'destination_addresses'=>$distance_matrix->destination_addresses[0],
                'destination_lat'=>$drop_lat,
                'destination_lng'=>$drop_lng,
                'distance'=> get_distance_text_from_distance_matrix($distance_matrix)==null?0:get_distance_text_from_distance_matrix($distance_matrix),
                'duration'=> get_duration_text_from_distance_matrix($distance_matrix)==null?0:get_duration_text_from_distance_matrix($distance_matrix),
                'json_result'=> \GuzzleHttp\json_encode($distance_matrix)
                ];

            return $stored_distance_matrix_details = DistanceMatrix::create($distance_matrix_params);
        } else {
            $this->throwCustomException('Unable to calculate distance between coordinates');
        }
    }

    public function validate_promo_code($service_location)
    {
        $app_for = config('app.app_for');


        $user = auth()->user();
        if (!request()->has('promo_code')) {
            return $coupon_detail = null;
        }
        $promo_code = request()->input('promo_code');
        // Validate if the promo is expired
        $current_date = Carbon::today()->toDateTimeString();

        if($app_for=='taxi' || $app_for=='delivery')
        {      
        $expired = Promo::where('code', $promo_code)->where('to', '>', $current_date)->first();
        }else{
            $transport_type = request()->transport_type;
            $expired = Promo::where('code', $promo_code)->where(function($query)use($transport_type){
            $query->where('transport_type',$transport_type)->orWhere('transport_type','both');
            })->where('to', '>', $current_date)->where('active',true)->first();

        }
        // Log::info("Promo");
        // Log::info($expired);
        if (!$expired) {
            $this->throwCustomException('provided promo code expired or invalid');
        }
        $validate_promo_code = PromoCodeUser::where('promo_code_id', $expired->id)->where('service_location_id', $service_location)->first();
        // Log::info($validate_promo_code);
        if(!$validate_promo_code)
        {
            $this->throwCustomException('provided promo code expired or invalid');
        }

        $exceed_usage = PromoUser::where('promo_code_id', $expired->id)->where('user_id', $user->id)->count();
        // Log::info($user);
        // Log::info($exceed_usage);
        // Log::info("testt");
        // Log::info(json_encode($expired));
        if ($exceed_usage >= $expired->uses_per_user) {
            $this->throwCustomException('provided promo code expired or invalid');
        }

        return $expired;
    }
}