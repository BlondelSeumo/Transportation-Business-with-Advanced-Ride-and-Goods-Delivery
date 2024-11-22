<?php

namespace App\Http\Controllers\Api\V1\Driver;

use App\Models\Admin\Driver;
use Illuminate\Support\Carbon;
use App\Transformers\Driver\DriverProfileTransformer;
use App\Http\Controllers\Api\V1\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Contract\Database;

class OnlineOfflineController extends BaseController
{
    protected $driver;

    public function __construct(Driver $driver,Database $database)
    {
        $this->driver = $driver;
        $this->database = $database;

    }


    /**
    * Online-Offline driver
    * @group Driver-trips-apis
    * @return \Illuminate\Http\JsonResponse
    * @responseFile responses/driver/Online-OfflineResponse.json
    * @responseFile responses/driver/DriverOfflineResponse.json
    */
    public function toggle()
    {
        $driver = Driver::where('user_id', auth()->user()->id)->first();

        $status = $driver->active?0:1;
        $current_date = Carbon::now();

        if($driver->vehicle_type!=null){
            if(!$driver->driverVehicleTypeDetail()->where('vehicle_type', $driver->vehicle_type)->exists())
            {
                $driver->driverVehicleTypeDetail()->create(['vehicle_type'=>$driver->vehicle_type]);

             }

             $this->database->getReference('drivers/driver_'.$driver->id)->update(['vehicle_type'=>null,'updated_at'=> Database::SERVER_TIMESTAMP]);

             $driver->vehicle_type=null;

             $driver->save();
          }
        // Log::info($status);
        
        if ($status) {
            // check if any record is exists with same date
            $availability = $driver->driverAvailabilities()->whereDate('online_at', $current_date)->orderBy('online_at', 'desc')->first();

            $created_params['is_online'] = true;
            $created_params['online_at'] = $current_date->toDateTimeString();

            if ($availability) {
                $created_params['duration'] = 0;
            }
            // store record for online
            $driver->driverAvailabilities()->create($created_params);

            // Find Ride for the driver
            



        } else {
            // get last online availability record
            $availability = $driver->driverAvailabilities()->where('is_online', true)->orderBy('online_at', 'desc')->first();


            if ($availability && Carbon::parse($availability->online_at)->toDateString()!=$current_date->toDateString()) {
                // Need to create offline record for last online date
                $created_params['is_online'] = false;
                // Temporary
                $last_offline_date = Carbon::parse($availability->online_at)->addMinutes(30)->toDateTimeString();

                if (Carbon::parse($last_offline_date)->toDateString()==$current_date->toDateString()) {
                    $last_offline_date = Carbon::parse($availability->online_at)->endOfDay()->toDateTimeString();
                }
                // $last_offline_date = Carbon::parse($availability->online_at)->toDateString().' 23:59:59';
                $offline_update_params['offline_at'] = $last_offline_date;
                $last_online_online_at = Carbon::parse($availability->online_at);
                $last_offline_date = Carbon::parse($last_offline_date);
                $duration = $last_offline_date->diffInMinutes($last_online_online_at);
                $offline_update_params['duration'] = $availability->duration+$duration;
                // store offline record
                $availability->update($offline_update_params);
                // store online record
                $online_created_params['is_online'] = true;
                // Temporary
                $to_online_date = $current_date->subMinutes(30)->toDateTimeString();
                if ($current_date->subMinutes(30)->toDateString()!=$current_date->toDateString()) {
                    $to_online_date = $current_date->startOfDay()->toDateTimeString();
                }
                $online_created_params['online_at'] = $to_online_date;
                $online_created_params['duration'] = 0;
                $availability =  $driver->driverAvailabilities()->create($online_created_params);
            }
            // Store offllne record
            $created_params['is_online'] = false;
            $created_params['offline_at'] = $current_date->toDateTimeString();
            $last_online_online_at = Carbon::parse($availability->online_at);
            $duration = $current_date->diffInMinutes($last_online_online_at);
            $created_params['duration'] = $availability->duration+$duration;
            $availability->update($created_params);
        }

        $success_message = $status?'online-success':'offline-success';
        $driver->active = $status;
        $driver->available = true;
        $driver->save();
        $driver->fresh();

        $user = filter()->transformWith(new DriverProfileTransformer)
            ->loadIncludes($driver);

        return $this->respondSuccess($user, $success_message);
    }

     /**
     * Add My route address
     * @bodyParam my_route_lat double required latitude of the address
     * @bodyParam my_route_lng double required longitude of the address
     * @bodyParam my_route_address string required address text of the address
     * 
     * 
     * */
    public function addMyRouteAddress(Request $request){


        $request->validate([
        'my_route_lat' => 'required',
        'my_route_lng' => 'required',
        'my_route_address'=>'required'
        ]);


        auth()->user()->driver->update([
            'my_route_lat'=>$request->my_route_lat,
            'my_route_lng'=>$request->my_route_lng,
            'my_route_address'=>$request->my_route_address
        ]);

        return $this->respondSuccess(null, 'address-updated-successfully');

    }

    /**
     * Enable My Route Booking
     * 
     * 
     * */
    public function enableMyRouteBooking(Request $request){

        $request->validate([
        'is_enable'=>'required|in:1,0',
        'current_lat'=>'required',
        'current_lng'=>'required',
        'current_address'=>'sometimes|required'
        ]);

        $driver_detail = auth()->user()->driver;

        if($request->is_enable==0){
            $driver_detail->update(['enable_my_route_booking'=>$request->is_enable]);
            goto end;
        }

        if($driver_detail->my_route_lat==null){

            $this->throwCustomException('route-address-not-found');
        }

        // @TODO validate how many times they have enabled/disabled per day
        $current_date = Carbon::now();

        if($driver_detail->enabledRoutes()->whereDate('created_at',$current_date)->get()->count()>=get_settings('how_many_times_a_driver_can_enable_the_my_route_booking_per_day')){

            $this->throwCustomException('you-cannot-enable-my-route-booking-morethan-'.get_settings('how_many_times_a_driver_can_enable_the_my_route_booking_per_day').'-times-a-day');

        }
        $route_coordinates = get_line_string($request->current_lat, $request->current_lng, $driver_detail->my_route_lat, $driver_detail->my_route_lng);

        $driver_detail->update(['route_coordinates'=>$route_coordinates,'enable_my_route_booking'=>$request->is_enable]);

        

        $driver_detail->enabledRoutes()->create([
            'current_lat'=>$request->current_lat,
            'current_lng'=>$request->current_lng,
            'current_address'=>$request->current_address
        ]);

        end:
        return $this->respondSuccess(null, 'enabled-my-route-succesfully');


    }

}
