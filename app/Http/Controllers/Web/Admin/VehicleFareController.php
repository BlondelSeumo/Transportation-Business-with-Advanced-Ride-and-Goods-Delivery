<?php

namespace App\Http\Controllers\Web\Admin;

use App\Base\Constants\Masters\zoneRideType;
use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Zone\AssignZoneTypeRequest;
use App\Models\Admin\VehicleType;
use App\Models\Admin\Zone;
use App\Models\Admin\ZoneType;
use App\Models\Admin\ZoneTypePackagePrice;
use App\Models\Admin\ZoneTypePrice;
use Illuminate\Http\Request;
use App\Base\Constants\Auth\Role as RoleSlug;
use Illuminate\Validation\ValidationException;
use Config;

class VehicleFareController extends Controller
{

    public function zoneIndex(Zone $zone)
    {
        $page = trans('pages_names.owners');
        $main_menu = 'vehicle-fare';
        $sub_menu = $zone->name;
      if((config('app.app_for')=="super") || (config('app.app_for')=="bidding")){

        return view('admin.vehicle_fare.zoneIndex', compact('page', 'main_menu', 'sub_menu', 'zone'));
    }else{
        return view('admin.vehicle_fare.taxi.zoneIndex', compact('page', 'main_menu', 'sub_menu', 'zone'));

    }
    }
    public function getAllPrice(QueryFilterContract $queryFilter,Zone $zone)
    {
        $app_for = config('app.app_for');
        
            $results = ZoneTypePrice::whereHas('zoneType', function ($query) use ($zone) {
            $query->where('zone_id', $zone->id);
            })
            ->orderBy('created_at', 'desc') // Add this line to order by created_at in descending order
            ->paginate();
      if((config('app.app_for')=="super") || (config('app.app_for')=="bidding")){

        return view('admin.vehicle_fare._set_price', compact('results','app_for'))->render();
        }else{
            return view('admin.vehicle_fare.taxi._set_price', compact('results','app_for'))->render();
        }
    }


      public function create() 
    {
        $zones = Zone::active()->get();

        // dd($zones);
        $page = trans('pages_names.add_vehicle_fare');
        $main_menu = 'vehicle-fare';
        $sub_menu = '';


        $vehicle_type = VehicleType::where('active',1)->get();
// dd($vehicle_type);
      if((config('app.app_for')=="super") || (config('app.app_for')=="bidding")){
        return view('admin.vehicle_fare.create', compact('page', 'main_menu', 'sub_menu', 'zones'));
       }else{
        return view('admin.vehicle_fare.taxi.create', compact('page', 'main_menu', 'sub_menu', 'zones', 'vehicle_type'));

       }
    }

    public function fetchVehiclesByZone(Request $request)
    {

        $zone = Zone::whereId($request->_zone)->first();        
        $ids = $zone->zoneType()->pluck('type_id')->toArray();
        $app_for = config('app.app_for');
        $order_nos = $zone->zoneType()->pluck('order_number')->toArray();

        if($request->has('transport_type')&&($request->transport_type!='both')){
            $types = VehicleType::whereNotIn('id', $ids)->active()->where(function($query)use($request){
            $query->where('is_taxi',$request->transport_type);
        })->get();
        $order_nos = $zone->zoneType()->where('transport_type',$request->transport_type)->pluck('order_number')->toArray();
        }else{
            $types = VehicleType::where(function ($query) use ($ids) {
                if (!empty($ids)) {
                    $query->whereNotIn('id', $ids);
                }
            })->active()->get();
        }


        return response()->json(['success' => true, 'data' => $types,'order_nos'=>$order_nos]);
    }

    public function store(AssignZoneTypeRequest $request)
    {
        // dd($request);
        $zone  = Zone::whereId($request->zone)->first();
        $payment = implode(',', $request->payment_type);
        // To save default type
        if ($request->transport_type == 'taxi')
        {
            if ($zone->default_vehicle_type == null) {
                $zone->default_vehicle_type = $request->type;
                $zone->save();
            }
        }else{
            if ($zone->default_vehicle_type_for_delivery == null) {
                $zone->default_vehicle_type_for_delivery = $request->type;
                $zone->save();
            }
        }
        $zoneType = $zone->zoneType()->create([
            'type_id' => $request->type,
            'payment_type' => $payment,
            'transport_type' => $request->transport_type,
            'admin_commision_type' => $request->admin_commision_type,
            'admin_commision' => $request->admin_commision,
            'admin_commission_type_from_owner' => (bool) $request->admin_commission_type_from_owner,
            'admin_commission_from_owner' => $request->admin_commission_from_owner,
            'admin_commission_type_from_driver' => (bool) $request->admin_commission_type_from_driver,
            'admin_commission_from_driver' => $request->admin_commission_from_driver,
            'service_tax' => $request->service_tax,
            'order_number' => $request->order_number,
            'bill_status' => true,
        ]);

        $zoneType->zoneTypePrice()->create([
            'price_type' => zoneRideType::RIDENOW,
            'base_price' => $request->ride_now_base_price,
            'price_per_distance' => $request->ride_now_price_per_distance,
            'cancellation_fee' => $request->ride_now_cancellation_fee,
            'base_distance' => $request->ride_now_base_distance ? $request->ride_now_base_distance : 0,
            'price_per_time' => $request->ride_now_price_per_time ? $request->ride_now_price_per_time : 0.00,
             'waiting_charge' => $request->ride_now_waiting_charge ? $request->ride_now_waiting_charge : 0.00,
            'free_waiting_time_in_mins_before_trip_start' =>  $request->ride_now_free_waiting_time_in_mins_before_trip_start ? $request->ride_now_free_waiting_time_in_mins_before_trip_start:0,
            'free_waiting_time_in_mins_after_trip_start' =>  $request->ride_now_free_waiting_time_in_mins_after_trip_start ? $request->ride_now_free_waiting_time_in_mins_after_trip_start:0,
        ]);


        $message = trans('succes_messages.type_assigned_succesfully');


        return redirect('vehicle_fare/by_zone/'.$zone->id)->with('success', $message);
    }

    public function getById(ZoneTypePrice $zone_price)
    {
        // dd($zone_price);

        $app_for = config('app.app_for');


        $page = trans('pages_names.edit_vehicle_fare');
        $main_menu = 'vehicle-fare';
        $sub_menu = '';
// dd($zone_price->zoneType->transport_type);
      if((config('app.app_for')=="super") || (config('app.app_for')=="bidding")){
        return view('admin.vehicle_fare.edit', compact('page', 'main_menu', 'sub_menu', 'zone_price'));
        }else{
            return view('admin.vehicle_fare.taxi.edit', compact('page', 'main_menu', 'sub_menu', 'zone_price'));
        }
    }

    public function update(Request $request,ZoneTypePrice $zone_price)
    {
        
        $zone_id = $zone_price->zoneType()->pluck('zone_id')->toArray();

        $zone_price->zoneType()->update([
            'type_id' => $request->type,
            'payment_type' => implode(',', $request->payment_type),
            'transport_type' => $request->transport_type,
            'admin_commision_type' => $request->admin_commision_type,
            'admin_commision' => $request->admin_commision,
            'admin_commission_type_from_owner' => (bool) $request->admin_commission_type_from_owner,
            'admin_commission_from_owner' => $request->admin_commission_from_owner,
            'admin_commission_type_from_driver' => (bool) $request->admin_commission_type_from_driver,
            'admin_commission_from_driver' => $request->admin_commission_from_driver,
            'service_tax' => $request->service_tax,
            'order_number' => $request->order_number,
        
        ]);
        if($zone_price->price_type == 1)
        {
        $zone_price->update([
            'base_price' => $request->ride_now_base_price,
            'price_per_distance' => $request->ride_now_price_per_distance,
            'cancellation_fee' => $request->ride_now_cancellation_fee,
            'base_distance' => $request->ride_now_base_distance ? $request->ride_now_base_distance : 0,
            'price_per_time' => $request->ride_now_price_per_time ? $request->ride_now_price_per_time : 0.00,
             'waiting_charge' => $request->ride_now_waiting_charge ? $request->ride_now_waiting_charge : 0.00,
            'free_waiting_time_in_mins_before_trip_start' =>  $request->ride_now_free_waiting_time_in_mins_before_trip_start ? $request->ride_now_free_waiting_time_in_mins_before_trip_start:0,
            'free_waiting_time_in_mins_after_trip_start' =>  $request->ride_now_free_waiting_time_in_mins_after_trip_start ? $request->ride_now_free_waiting_time_in_mins_after_trip_start:0,
        ]);
        }
        $message = trans('succes_messages.type_fare_updated_succesfully');

        return redirect('vehicle_fare/by_zone/'.$zone_id[0])->with('success', $message);
    }

    public function toggleStatus(ZoneTypePrice $zone_price) {
        $status = $zone_price->zoneType->isActive() ? false : true;
        $zone_price->zoneType->update(['active' => $status]);

        $message = trans('succes_messages.type_fare_status_updated_succesfully');

        return redirect('vehicle_fare/by_zone/'.$zone_price->zoneType->zone->id)->with('success', $message);
    }
    public function delete(ZoneTypePrice $zone_price)
    {
        if(env('APP_FOR')=='demo'){

        $message = 'you cannot delete the Vehicle fare. this is demo version';

        return $message;

        }
       $zone_type_detail = ZoneType::where('id', $zone_price->zone_type_id)->first();

        // $package = ZoneTypePackagePrice::where('zone_type_id', $zone_price->zone_type_id)->get();

        $zone = Zone::where('id', $zone_type_detail->zone_id)->first();

        
        if($zone->default_vehicle_type == $zone_type_detail->vehicleType->id)
        {
                $message = 'you cannot delete the Vehicle Type. This is Default Vehicle Type';

                return $message;
        }


        if($zone->default_vehicle_type_for_delivery == $zone_type_detail->vehicleType->id)
        {
                $message = 'you cannot delete the Vehicle Type. This is Default Vehicle Type';

                return $message;
        }

        $zone_type = ZoneType::where('id', $zone_price->zone_type_id)->get();
        // $package = ZoneTypePackagePrice::where('zone_type_id', $zone_price->zone_type_id)->get();
        
        foreach($zone_type as $type)
        {
          $type->delete();
          $type->zoneTypePrice()->delete();
        //   $package->delete();

        }
        $message = trans('succes_messages.vehicle_fare_deleted_succesfully');

        return $message;
 

    }


    public function getTransportTypes(Request $request)
    {

        $type = ['taxi','delivery','both'];

        return $type;
    }
    public function getUnit(Request $request)
    {

        $zone = Zone::whereId($request->zone)->first();

        return $zone;
    }

}
