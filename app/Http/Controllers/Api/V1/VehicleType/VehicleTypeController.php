<?php

namespace App\Http\Controllers\Api\V1\VehicleType;

use Carbon\Carbon;
use App\Models\User;
use App\Events\Event;
use App\Models\Admin\Driver;
use Illuminate\Http\Request;
use App\Models\Admin\VehicleType;
use App\Base\Constants\Auth\Role;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\ServiceLocation;
use App\Http\Controllers\ApiController;
use App\Jobs\Notifications\PhpToNodeJob;
use App\Base\Constants\Masters\DateOptions;
use App\Transformers\User\ZoneTypeTransformer;
use App\Http\Controllers\Api\V1\BaseController;
use App\Transformers\User\ZoneTypeTransformerOld;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Http\Requests\Admin\VehicleTypes\CreateVehicleTypeRequest;
use Log;
use Config;

/**
 * @group Vehicle Management
 *
 * APIs for Vehicle-Types
 */
class VehicleTypeController extends BaseController
{
    /**
     * The VehicleType model instance.
     *
     * @var \App\Models\Admin\VehicleType
     */
    protected $vehicle_type;


    /**
     * VehicleTypeController constructor.
     *
     * @param \App\Models\Admin\VehicleType $vehicle_type
     */
    public function __construct(VehicleType $vehicle_type, ImageUploaderContract $imageUploader)
    {
        $this->vehicle_type = $vehicle_type;
        $this->imageUploader = $imageUploader;
    }

    /**
    * Get all vehicle types by geo location
    * @urlParam lat required double  latitude provided by user
    * @urlParam lng required double  longitude provided by user
    * @response {
    "success": true,
    "message": "success",
    "data": [
        {
            "id": "9ea6f9a0-6fd2-4962-9d81-645e6301096f",
            "name": "Mini",
            "icon": null,
            "capacity": 4,
            "is_accept_share_ride": 0,
            "active": 1,
            "created_at": "2020-02-13 09:06:39",
            "updated_at": "2020-02-13 09:06:39",
            "deleted_at": null
        }
    ]
}
    */
    public function getTypesByLocationOld($lat, $lng)
    {
        $zone = find_zone($lat, $lng);

        if (!$zone) {
            $this->throwCustomException('zone does not exists');
        }

        $response = $zone->zoneType;

        $result =  fractal($response, new ZoneTypeTransformerOld);

        return $this->respondSuccess($result);
    }

    /**
    * Get all vehicle types by geo location along with prcing detail
    * @urlParam lat required double  latitude provided by user
    * @urlParam lng required double  longitude provided by user
    * @responseFile responses/user/trips/types-along-price.json
    */
    public function getTypesByLocationAlongPrice($lat, $lng)
    {
        $zone = find_zone($lat, $lng);

        if (!$zone) {
            $this->throwCustomException('zone does not exists');
        }

        $response = $zone->zoneType;

        $result =  fractal($response, new ZoneTypeTransformer)->parseIncludes('zoneTypePrice');

        return $this->respondSuccess($result);
    }

    /**
    * Get Vehcile Types by Service location
    * @urlParam service_location_id required string service location's id
    * @response {"success":true,"message":"success","data":[{"id":"9ea6f9a0-6fd2-4962-9d81-645e6301096f","name":"Mini","icon":null,"capacity":4,"is_accept_share_ride":0,"active":1,"created_at":"2020-02-13 09:06:39","updated_at":"2020-02-13 09:06:39","deleted_at":null}]}
    */
    public function getVehicleTypesByServiceLocation(ServiceLocation $service_location)
    {
        // DB::enableQueryLog();
        if(config('app.app_for') !== 'taxi' && config('app.app_for') !== "delivery")
        {
            $query = $this->vehicle_type->whereActive(true)
                ->whereHas('zoneType.zone', function ($query) use ($service_location) {
                    $query->where('service_location_id', $service_location->id);
                })
                ->where(function($query) {
                    $query->where('is_taxi', request()->transport_type)
                          ->orWhere('is_taxi', 'both');
                });

            $response = $query->get();
        }else{
        $query = $this->vehicle_type->whereActive(true)->whereHas('zoneType.zone', function ($query) use ($service_location) {
            $query->where('service_location_id', $service_location->id);
        });

        $response = $query->get();
        // dd(DB::getQueryLog());
        }

        return $this->respondSuccess($response);
    }
    /**
    * Report test
    */
    public function report(Request $request)
    {
        $date_option = $request->date_option;
        $current_date = Carbon::now();
        $driver = $request->driver;

        if ($date_option == DateOptions::TODAY) {
            $date_array = [$current_date->format("Y-m-d"),$current_date->format("Y-m-d"),$driver];
        } elseif ($date_option == DateOptions::YESTERDAY) {
            $yesterday_date = Carbon::yesterday()->format('Y-m-d');
            $date_array = [$yesterday_date,$yesterday_date,$driver];
        } elseif ($date_option == DateOptions::CURRENT_WEEK) {
            $date_array = [$current_date->startOfWeek()->toDateString(),$current_date->endOfWeek()->toDateString(),$driver];
        } elseif ($date_option == DateOptions::LAST_WEEK) {
            $date_array = [$current_date->subWeek()->toDateString(), $current_date->startOfWeek()->toDateString(),$driver];
        } elseif ($date_option == DateOptions::CURRENT_MONTH) {
            $date_array = [$current_date->startOfMonth()->toDateString(), $current_date->endOfMonth()->toDateString(),$driver];
        } elseif ($date_option == DateOptions::PREVIOUS_MONTH) {
            $date_array = [$current_date->startOfMonth()->toDateString(), $current_date->endOfMonth()->toDateString(),$driver];
        } elseif ($date_option == DateOptions::CURRENT_YEAR) {
            $date_array = [$current_date->startOfYear()->toDateString(), $current_date->endOfYear()->toDateString(),$driver];
        } else {
            $date_array = [];
        }

        // $date_array =['2020-11-11','2020-11-20',6];

        // dd($date_array);
        $data = DB::select('CALL get_driver_duration_report(?,?,?)', $date_array);

        if (count($data)==1) {
            $data = (object) array();
        }
    }
}
