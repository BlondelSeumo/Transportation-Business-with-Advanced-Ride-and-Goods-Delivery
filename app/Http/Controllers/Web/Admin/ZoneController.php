<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\User;
use App\Models\Admin\Zone;
use App\Models\Admin\ZoneType;
use App\Models\Admin\VehicleType;
use App\Models\Admin\ServiceLocation;
use App\Models\Admin\ZoneTypePackagePrice;
use App\Http\Controllers\ApiController;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Base\Constants\Masters\zoneRideType;
use App\Models\Master\PackageType;
use App\Base\Constants\Auth\Role as RoleSlug;
use App\Base\Exceptions\CustomValidationException;
use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use App\Http\Controllers\Api\V1\BaseController;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
use Grimzy\LaravelMysqlSpatial\Types\MultiPolygon;
use App\Http\Requests\Admin\Zone\AssignZoneRequest;
use App\Http\Requests\Admin\Zone\CreateZoneRequest;
use App\Http\Requests\Admin\Zone\AssignZoneTypeRequest;
use App\Http\Requests\Admin\Zone\ZoneTypePackagePriceRequest;
use App\Models\Request\Request;
use Carbon\Carbon;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Prewk\XmlStringStreamer;
use Prewk\XmlStringStreamer\Stream;
use Prewk\XmlStringStreamer\Parser;
use App\Models\Admin\ZoneTypePrice;


/**
 * @resource Zone
 *
 * Zone CRUD Apis
 */
class ZoneController extends BaseController
{
    /**
     * The Zone model instance.
     *
     * @var \App\Models\Admin\Zone
     */
    protected $zone;

    /**
     * ZoneController constructor.
     *
     * @param \App\Models\Admin\Zone $zone
     */
    public function __construct(Zone $zone)
    {
        $this->zone = $zone;
    }

    /**
    * Get all zones
    * @return \Illuminate\Http\JsonResponse
    */
    public function index()
    {
        $page = trans('pages_names.zone');

        $main_menu = 'map';
        $sub_menu = 'zone';

        return view('admin.zone.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function getAllZone(QueryFilterContract $queryFilter)
    {
        $query = Zone::companyKey();
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

        return view('admin.zone._zone', compact('results'));
    }

    /**
    * Create Zone view
    */
    public function create()
    {
        // if (env('APP_FOR')=='demo') {
        //     $message = trans('succes_messages.you_are_not_authorised');

        //     return redirect('zone')->with('warning', $message);
        // }

        $page = trans('pages_names.add_zone');

        $main_menu = 'map';
        $sub_menu = 'zone';

        $services = ServiceLocation::companyKey()->whereActive(true)->get();
        $cities = $this->getCityBySearch();

        return view('admin.zone.create', compact('page', 'services', 'main_menu', 'sub_menu','cities'));
    }


    public function createopen(){
    // {
    //     if (env('APP_FOR')=='demo') {
    //         $message = trans('succes_messages.you_are_not_authorised');

    //         return redirect('zone')->with('warning', $message);
    //     }

        $page = trans('pages_names.add_zone');

        $main_menu = 'map';
        $sub_menu = 'zone';

        $services = ServiceLocation::companyKey()->whereActive(true)->get();
        $cities = $this->getCityBySearch();

        return view('admin.zone.create-open', compact('page', 'services', 'main_menu', 'sub_menu','cities'));
    }

    /**
    * Zone Edit
    *
    */
    public function zoneEdit($id)
    {


        $zone = $this->zone->where('id', $id)->first();
        $page = trans('pages_names.add_zone');
        $main_menu = 'map';
        $sub_menu = 'zone';

        $services = ServiceLocation::companyKey()->active()->get();

        $coordinates = $zone->coordinates->toArray();

        $multi_polygon = [];

        foreach ($coordinates as $key => $coordinate) {
            $polygon = [];
            foreach ($coordinate[0] as $key => $point) {
                $pp = new \stdClass;
                $pp->lat = $point->getLat();
                $pp->lng = $point->getLng();
                $polygon [] = $pp;
            }
            $multi_polygon[] = $polygon;
        }

        $default_lat = $polygon[0]->lat;
        $default_lng = $polygon[0]->lng;

        $zone_coordinates = json_encode($multi_polygon);


        return view('admin.zone.edit', compact('page', 'zone', 'zone_coordinates', 'services', 'main_menu', 'sub_menu', 'default_lat', 'default_lng'));
    }

    /**
     * Get Zone By ID
     * @param id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById($id)
    {
        $zone = $this->zone->where('id', $id)->first();

        return $this->respondSuccess($zone);
    }

    /**
     * Create Zone.
     *
     * @param \App\Http\Requests\Admin\Zone\CreateZoneRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateZoneRequest $request)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('zone')->with('warning', $message);
        }

        $created_params = $request->only(['unit']);
        $created_params['service_location_id'] = $request->admin_id;
        $set = [];

        if($request->coordinates==null){
            throw ValidationException::withMessages(['zone_name' => __('Please Complete the shape before submit')]);
        }

        foreach (json_decode($request->coordinates) as $key => $coordinates) {
            $points = [];
            $lineStrings = [];
            foreach ($coordinates as $key => $coordinate) {
                if ($key == 0) {
                    $created_params['lat'] = $coordinate->lat;
                    $created_params['lng'] = $coordinate->lng;
                }
                $point = new Point($coordinate->lat, $coordinate->lng);
                $check_if_exists = $this->zone->companyKey()->contains('coordinates', $point)->exists();
                if ($check_if_exists) {
                    throw ValidationException::withMessages(['zone_name' => __('Coordinates already exists with our exists zone')]);
                }
                $points []= new Point($coordinate->lat, $coordinate->lng);
            }
            array_push($points, $points[0]);
            $lineStrings[] = new LineString($points);
            $polygon = new Polygon($lineStrings);

            $set[] = $polygon;
        }

        $multi_polygon = new MultiPolygon($set);

        $created_params['name'] = $request->input('zone_name');

        $created_params['coordinates'] = $multi_polygon;

        $created_params['company_key'] = auth()->user()->company_key;

        $zone = $this->zone->create($created_params);


        $message = trans('succes_messages.zone_added_succesfully');

        return redirect('zone')->with('success', $message);
    }
    /**
    * Create Zone.
    *
    * @param \App\Http\Requests\Admin\Zone\CreateZoneRequest $request
    * @return \Illuminate\Http\JsonResponse
    */
    public function update(Zone $zone, CreateZoneRequest $request)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('zone')->with('warning', $message);
        }

        // dd($request->coordinates);
        $updated_params = $request->only(['unit']);
        $updated_params['service_location_id'] = $request->admin_id;
        $set = [];

        if($request->coordinates==null){
            throw ValidationException::withMessages(['zone_name' => __('Please Complete the shape before submit')]);
        }

        foreach (json_decode($request->coordinates) as $key => $coordinates) {
            $points = [];
            $lineStrings = [];
            foreach ($coordinates as $key => $coordinate) {
                if ($key == 0) {
                    $updated_params['lat'] = $coordinate->lat;
                    $updated_params['lng'] = $coordinate->lng;
                }
                $point = new Point($coordinate->lat, $coordinate->lng);
                $check_if_exists = $this->zone->companyKey()->contains('coordinates', $point)->where('id', '!=', $zone->id)->exists();
                if ($check_if_exists) {
                    throw ValidationException::withMessages(['zone_name' => __('Coordinates already exists with our exists zone')]);
                }
                $points []= new Point($coordinate->lat, $coordinate->lng);
            }
            array_push($points, $points[0]);
            $lineStrings[] = new LineString($points);
            $polygon = new Polygon($lineStrings);

            $set[] = $polygon;
        }

        $multi_polygon = new MultiPolygon($set);

        $updated_params['name'] = $request->input('zone_name');

        $updated_params['coordinates'] = $multi_polygon;

        $zone = $zone->update($updated_params);

        // return true;
        $message = trans('succes_messages.zone_updated_succesfully');

        return redirect('zone')->with('success', $message);
    }

    /**
    * zone map view
    */
    public function zoneMapView($id)
    {
        $zone = $this->zone->find($id);

        $coordinates = $zone->coordinates->toArray();

        $multi_polygon = [];

        foreach ($coordinates as $key => $zone) {
            $polygon = [];
            foreach ($zone[0] as $key => $point) {
                $pp = new \stdClass;
                $pp->lat = $point->getLat();
                $pp->lng = $point->getLng();
                $polygon [] = $pp;
            }
            $multi_polygon[] = $polygon;
        }

        $default_lat = $polygon[0]->lat;
        $default_lng = $polygon[0]->lng;

        $zones = json_encode($multi_polygon);
        $page = trans('pages_names.zone_map_view');

        $main_menu = 'map';
        $sub_menu = 'zone';

        return view('admin.zone.mapview', compact('page', 'main_menu', 'sub_menu', 'zones', 'default_lat', 'default_lng'));
    }




    public function zoneMapViewOpen($id)
    {
        $zone = $this->zone->find($id);

        $coordinates = $zone->coordinates->toArray();

        $multi_polygon = [];

        foreach ($coordinates as $key => $zone) {
            $polygon = [];
            foreach ($zone[0] as $key => $point) {
                $pp = new \stdClass;
                $pp->lat = $point->getLat();
                $pp->lng = $point->getLng();
                $polygon [] = $pp;
            }
            $multi_polygon[] = $polygon;
        }

        $default_lat = $polygon[0]->lat;
        $default_lng = $polygon[0]->lng;

        $zones = json_encode($multi_polygon);
        $page = trans('pages_names.zone_map_view');

        $main_menu = 'map';
        $sub_menu = 'zone';

        return view('admin.zone.mapview-open', compact('page', 'main_menu', 'sub_menu', 'zones', 'default_lat', 'default_lng'));
    }

    /**
    * Assign Types
    *
    */
    public function assignTypesView(Zone $zone)
    {
        $results = $zone->zoneType()->paginate();

        $page = trans('pages_names.assign_types');

        $main_menu = 'map';
        $sub_menu = 'zone';

        return view('admin.zone.assignTypesView', compact('results', 'page', 'main_menu', 'sub_menu', 'zone'));
    }


    /**
    * Assign Types
    *
    */
    public function assignTypesCreateView(Zone $zone)
    {
        $ids = $zone->zoneType()->pluck('type_id')->toArray();
        $types = VehicleType::whereNotIn('id', $ids)->active()->get();

        $page = trans('pages_names.assign_types');

        $main_menu = 'map';
        $sub_menu = 'zone';

        return view('admin.zone.assignTypes', compact('types', 'page', 'main_menu', 'sub_menu', 'zone'));
    }

    /**
    * Store Assigned type with corresponsing zone
    *
    */
    public function assignTypesStore(AssignZoneTypeRequest $request, Zone $zone)
    {

        // dd($request);

        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('zone/assigned/types/'.$zone->id)->with('warning', $message);
        }

        $payment = implode(',', $request->payment_type);

        if($request->transport_type=='taxi'){

            // To save default type
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
            'transport_type' => $request->transport_type,
            'payment_type' => $payment,
            'bill_status' => true
        ]);

        $zoneType->zoneTypePrice()->create([
            'price_type' => zoneRideType::RIDENOW,
            'base_price' => $request->ride_now_base_price,
            'price_per_distance' => $request->ride_now_price_per_distance,
            'free_waiting_time_in_mins_before_trip_start' => $request->ride_now_free_waiting_time_in_mins_before_trip_start,
            'free_waiting_time_in_mins_after_trip_start' => $request->ride_now_free_waiting_time_in_mins_after_trip_start,
            'waiting_charge' => $request->ride_now_waiting_charge,
            'cancellation_fee' => $request->ride_now_cancellation_fee,
            'base_distance' => $request->ride_now_base_distance ? $request->ride_now_base_distance : 0,
            'price_per_time' => $request->ride_now_price_per_time ? $request->ride_now_price_per_time : 0.00,
            // 'admin_service_fee' => $request->ride_now_admin_service_fee ? $request->ride_now_admin_service_fee : 0.00,
            // 'admin_service_fee_type' => $request->ride_now_admin_service_fee_type ? $request->ride_now_admin_service_fee_type : 0
        ]);

        $zoneType->zoneTypePrice()->create([
            'price_type' => zoneRideType::RIDELATER,
            'base_price' => $request->ride_later_base_price,
            'price_per_distance' => $request->ride_later_price_per_distance,
            'free_waiting_time_in_mins_before_trip_start' => $request->ride_later_free_waiting_time_in_mins_before_trip_start,
            'free_waiting_time_in_mins_after_trip_start' => $request->ride_later_free_waiting_time_in_mins_after_trip_start,
            'waiting_charge' => $request->ride_later_waiting_charge,
            'cancellation_fee' => $request->ride_later_cancellation_fee,
            'base_distance' => $request->ride_later_base_distance ? $request->ride_later_base_distance : 0,
            'price_per_time' => $request->ride_later_price_per_time ? $request->ride_later_price_per_time : 0.00,
            // 'admin_service_fee' => $request->ride_later_admin_service_fee ? $request->ride_later_admin_service_fee : 0.00,
            // 'admin_service_fee_type' => $request->ride_later_admin_service_fee_type ? $request->ride_later_admin_service_fee_type : 0
        ]);

        $message = trans('succes_messages.type_assigned_succesfully');

        return redirect('zone/assigned/types/'.$zone->id)->with('success', $message);    }

    /**
    * Zone Delete
    *
    */
    public function delete(Zone $zone)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('zone')->with('warning', $message);
        }

        $zone->delete();
        $message = trans('succes_messages.zone_deleted_succesfully');
        return $message;
    }


    /**
     * Edit Price
     *
     */
    public function typesEditPriceView(ZoneType $zone_type)
    {
        $types = VehicleType::whereId($zone_type->type_id)->active()->get();
        $ride_now = $zone_type->zoneTypePrice()->where('price_type', zoneRideType::RIDENOW)->first();
        $ride_later = $zone_type->zoneTypePrice()->where('price_type', zoneRideType::RIDELATER)->first();

        $page = trans('pages_names.types_edit');
        $main_menu = 'map';
        $sub_menu = 'zone';
        $unit = $zone_type->zone->unit == 1 ? 'kilometer' : 'miles';

        return view('admin.zone.typesEditPrice', compact('types', 'page', 'main_menu', 'sub_menu', 'zone_type', 'ride_now', 'ride_later', 'unit'));
    }

    /**
     * Update Price
     *
     */
    public function typesPriceUpdate(AssignZoneTypeRequest $request, ZoneType $zone_type)
    {

        // dd($request);

        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('zone/assigned/types/'.$zone->id)->with('warning', $message);
        }

         $zone_type->update([
            'payment_type' => implode(',', $request->payment_type),
            'transport_type' => $request->transport_type,
            'bill_status' => true
        ]);

        $zone_type->zoneTypePrice()->where('price_type', zoneRideType::RIDENOW)->update([
            'base_price' => $request->ride_now_base_price,
            'price_per_distance' => $request->ride_now_price_per_distance,
             'free_waiting_time_in_mins_before_trip_start' => $request->ride_now_free_waiting_time_in_mins_before_trip_start,
            'free_waiting_time_in_mins_after_trip_start' => $request->ride_now_free_waiting_time_in_mins_after_trip_start,
            'waiting_charge' => $request->ride_now_waiting_charge,
            'cancellation_fee' => $request->ride_now_cancellation_fee,
            'base_distance' => $request->ride_now_base_distance ? $request->ride_now_base_distance : 0,
            'price_per_time' => $request->ride_now_price_per_time ? $request->ride_now_price_per_time : 0.00,
            // 'admin_service_fee' => $request->ride_now_admin_service_fee ? $request->ride_now_admin_service_fee : 0.00,
            // 'admin_service_fee_type' => $request->ride_now_admin_service_fee_type ? $request->ride_now_admin_service_fee_type : 0
        ]);

        $zone_type->zoneTypePrice()->where('price_type', zoneRideType::RIDELATER)->update([
            'base_price' => $request->ride_later_base_price,
            'price_per_distance' => $request->ride_later_price_per_distance,
            'free_waiting_time_in_mins_before_trip_start' => $request->ride_later_free_waiting_time_in_mins_before_trip_start,
            'free_waiting_time_in_mins_after_trip_start' => $request->ride_later_free_waiting_time_in_mins_after_trip_start,
            'waiting_charge' => $request->ride_later_waiting_charge,
            'cancellation_fee' => $request->ride_later_cancellation_fee,
            'base_distance' => $request->ride_later_base_distance ? $request->ride_later_base_distance : 0,
            'price_per_time' => $request->ride_later_price_per_time ? $request->ride_later_price_per_time : 0.00,
            // 'admin_service_fee' => $request->ride_later_admin_service_fee ? $request->ride_later_admin_service_fee : 0.00,
            // 'admin_service_fee_type' => $request->ride_later_admin_service_fee_type ? $request->ride_later_admin_service_fee_type : 0
        ]);

        $message = trans('succes_messages.type_assigned_succesfully');

        return redirect('zone/assigned/types/'.$zone_type->zone_id)->with('success', $message);

    }


    public function toggleZoneStatus(Zone $zone)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('zone')->with('warning', $message);
        }

        $status = $zone->isActive() ? false : true;
        $zone->update(['active' => $status]);

        $message = trans('succes_messages.zone_status_changed_succesfully');
        return redirect('zone')->with('success', $message);
    }
    public function toggleStatus(ZoneType $zone_type)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('zone')->with('warning', $message);
        }

        $status = $zone_type->isActive() ? false : true;
        $zone_type->update(['active' => $status]);

        $message = trans('succes_messages.zone_type_status_changed_succesfully');
        return redirect('zone/assigned/types/'.$zone_type->zone_id)->with('success', $message);
    }

    /**
    * Zone Type Delete
    *
    */
    public function deleteZoneType(ZoneType $zone_type)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('zone/assigned/types/'.$zone->id)->with('warning', $message);
        }

        $zone_type->delete();

        $message = trans('succes_messages.zone_type_deleted_succesfully');
        return redirect('zone/assigned/types/'.$zone_type->zone_id)->with('success', $message);
    }


    public function surgeView(Zone $zone)
    {
        $main_menu = 'map';
        $sub_menu = 'zone';
        $page = trans('pages_names.surge');

        return view('admin.zone.surgeprice', compact('page', 'main_menu', 'sub_menu', 'zone'));
    }

    public function updateSurgePrice(HttpRequest $request, Zone $zone)
    {
        DB::beginTransaction();
        try {
            if ($request->has('start_time')) {
                $zone->zoneSurge()->delete();

                foreach ($request->start_time as $key => $surge) {
                    $startTime = now()->parse($request->start_time[$key])->toTimeString();
                    $endTime = now()->parse($request->end_time[$key])->toTimeString();

                    $condition = [$startTime,$endTime];

                    $data = [
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'value' => $request->price[$key],
                    ];

                    // $surgePriceExists = $zone->zoneSurge()
                    //                     ->whereBetween('start_time', $condition)
                    //                     ->orWhereBetween('end_time', $condition)
                    //                     ->exists();

                    // if ($surgePriceExists) {
                    //     return redirect()->back()->withInput()->with('failure', 'You have entered the same value too many times');
                    // }

                    $zone->zoneSurge()->create($data);
                }
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->withInput()->with('failure', 'Something Went Wrong..Please try again...');
        }

        DB::commit();

        $message = trans('succes_messages.zone_surge_price_added_succesfully');

        return redirect('zone')->with('success', $message);
    }

    public function setDefaultType(ZoneTypePrice $zone_price)
    {
        if($zone_price->zoneType->transport_type=='taxi'){
            // dd($zone_price->zoneType->zone);

            $zone_price->zoneType->zone->default_vehicle_type = $zone_price->zoneType->type_id;

            $zone_price->zoneType->zone->save();

        }elseif($zone_price->zoneType->transport_type=='delivery'){

            $zone_price->zoneType->zone->default_vehicle_type_for_delivery = $zone_price->zoneType->type_id;
            $zone_price->zoneType->zone->save();
        }else{

            $zone_price->zoneType->zone->default_vehicle_type_for_delivery = $zone_price->zoneType->type_id;
            $zone_price->zoneType->zone->default_vehicle_type = $zone_price->zoneType->type_id;
            $zone_price->zoneType->zone->save();

        }

        $message = trans('succes_messages.default_type_set_successfully');
        // return redirect('vehicle_fare')->with('success', $message);

        return redirect('vehicle_fare/by_zone/'. $zone_price->zoneType->zone->id)->with('success', $message);

    }


    public function getCityBySearch(){
        return $cities=[];

        if(request()->has('search')) $search = request()->search; else $search = 'ra';

        $filePath = env('COORDINATES_PATH');
        // Prepare our stream to be read with a 1kb buffer
        $stream = new Stream\File($filePath, 1024);
        ini_set('memory_limit', '-1');
        // Construct the default parser (StringWalker)
        $parser = new Parser\StringWalker();
        // Create the streamer
        $streamer = new XmlStringStreamer($parser, $stream);
        // Iterate through the `<customer>` nodes
        $cities = [];
        while ($node = $streamer->getNode()) {
            $simpleXmlNode = simplexml_load_string($node);
            foreach ($simpleXmlNode->Folder->Placemark as $key => $value) {
                if ( stripos($value->ExtendedData->SchemaData->SimpleData[3], $search) !== false ){
                    $cities[] = $value->ExtendedData->SchemaData->SimpleData[3];
                }
            }
        }

        return $cities;
    }


    /**
    *get polygon coordinates by city
    */
    public function getCoordsByKeyword($keyword)
    {
        $multi_polygons = [];
        return json_encode($multi_polygons);

        // Prepare our stream to be read with a 1kb buffer
        $filePath = env('COORDINATES_PATH');
        $stream = new Stream\File($filePath, 1024);
        ini_set('memory_limit', '-1');

        // Construct the default parser (StringWalker)
        $parser = new Parser\StringWalker();

        // Create the streamer
        $streamer = new XmlStringStreamer($parser, $stream);
        $multi_polygons= [];
        $polygons = [];
        $Placemarks = [];
        // Iterate through the `<customer>` nodes
        while ($node = $streamer->getNode()) {
            $simpleXmlNode = simplexml_load_string($node);
            foreach ($simpleXmlNode->Folder->Placemark as $key => $value) {
                $i = 0;
                if ($value->ExtendedData->SchemaData->SimpleData[3]==$keyword) {
                    // print_r("Rat");
                    foreach ($value->MultiGeometry->Polygon as $key => $MultiGeometry) {
                        $polygons[$i] = $MultiGeometry->outerBoundaryIs->LinearRing->coordinates;
                        $i++;
                    }
                    foreach ($polygons as $key => $polygon) {
                        $final_polygons = [];
                        $splited_coordinates = explode(' ', $polygon);
                        foreach ($splited_coordinates as $key => $splited_coordinate) {
                            $lat_lngs = explode(',', $splited_coordinate);
                            $pp = new \stdClass;
                            $pp->lat = (float)$lat_lngs[1];
                            $pp->lng = (float)$lat_lngs[0];
                            $final_polygons [] = $pp;
                        }
                        $multi_polygons[] = $final_polygons;
                    }
                }
            }
        }
        return json_encode($multi_polygons);
    }


     public function packageIndex(ZoneType $zone_type)
    {
       // dd($zone_type);
        $results = $zone_type->zoneTypePackage()->paginate();

        $page = trans('pages_names.zone_type_package');

        $main_menu = 'vehicle_fare';
        $sub_menu = '';

        return view('admin.zone_type_package.index', compact('results', 'page', 'main_menu', 'sub_menu', 'zone_type'));

    }


     public function packageCreate(ZoneType $zone_type)
    {
        $page = trans('pages_names.zone_type_package');


        $ids = $zone_type->zoneTypePackage()->pluck('package_type_id')->toArray();
        $types = PackageType::whereNotIn('id', $ids)->active()->get();

       $main_menu = 'vehicle_fare';
       $sub_menu = '';

        // dd($zone);

        return view('admin.zone_type_package.create', compact('page', 'main_menu', 'sub_menu','types','zone_type'));
    }

    public function packageStore(ZoneTypePackagePriceRequest $request,ZoneType $zone_type)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

         return redirect('/vehicle_fare/rental_package/index/'.$zone_type->id)->with('warning', $message);
        }

        // dd($request->all());
         $zonePackage = $zone_type->zoneTypePackage()->create([
            'base_price' => $request->base_price,
            'package_type_id' => $request->type_id,
            'distance_price_per_km' => $request->distance_price,
            'time_price_per_min' => $request->time_price,
            'free_distance' => $request->free_distance,
            'free_min' => $request->free_minute,
            'cancellation_fee' => $request->cancellation_fee,
            'zone_type_id' => $zone_type->id,
             'zone_id' => $zone_type->zone_id,

        ]);

         $message = trans('succes_messages.zone_package_store_succesfully');

         return redirect('/vehicle_fare/rental_package/index/'.$zone_type->id)->with('success', $message);
        }

    public function packageEdit(ZoneTypePackagePrice $package)
    {
        // $item = $this->package->where('id', $id)->first();
        $page = trans('pages_names.edit_zone_type_package_price');
        $types = PackageType::all();

        $main_menu = 'map';
        $sub_menu = 'zone';
        $item = $package;
        // dd($item);

        return view('admin.zone_type_package.update', compact('item', 'page', 'main_menu', 'sub_menu','types'));
    }

     public function packageUpdate(ZoneTypePackagePriceRequest $request,ZoneTypePackagePrice $package)
    {
         if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('/vehicle_fare/rental_package/index/'.$package->zone_type_id)->with('warning', $message);
        }
        // dd($request->all());
         $zonePackage = $package->update([
            'base_price' => $request->base_price,
            'package_type_id' => $request->type_id,
            'distance_price_per_km' => $request->distance_price,
            'time_price_per_min' => $request->time_price,
            'free_distance' => $request->free_distance,
            'free_min' => $request->free_minute,
            'cancellation_fee' => $request->cancellation_fee,
            'zone_id' => $package->zoneType->zone_id,
         ]);

         $message = trans('succes_messages.zone_package_update_succesfully');

         return redirect('/vehicle_fare/rental_package/index/'.$package->zone_type_id)->with('success', $message);
        }

    public function packageDelete(ZoneTypePackagePrice $package)
    {
        $package->delete();
        $message = trans('succes_messages.zone_package_deleted_succesfully');
        // return $message;
        return redirect()->back()->with('success', $message);
        // return redirect('zone')->with('success', $message);
    }

    public function PackagetoggleStatus(ZoneTypePackagePrice $package)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('zone')->with('warning', $message);
        }

        $status = $package->active == 1 ? 0 : 1;

        $pack = ZoneTypePackagePrice::find($package->id);
        $pack->active = $status;
        $pack->save();


        $message = trans('succes_messages.zone_type_package_status_changed_succesfully');
        return redirect()->back()->with('success', $message);

    }


// priceRangeIndex
    public function dayWiseIndex($day, Zone $zone)
    {
        $main_menu = 'vehicle_fare';
        $sub_menu = 'price_range';
        $page = trans('pages_names.surge');

        $price = $zone->zoneSurge()->where('day', $day)->orderBy('start_time')->get();

        return view('admin.zone.surge_by_day', compact('page', 'main_menu', 'sub_menu', 'price', 'day','zone'));
    }
    public function dayWiseStore(HttpRequest $request, Zone $zone)
    {
    //Surge Price Range
        $zone->zoneSurge()->where('day', $request->day[0])->delete();
            foreach ($request->from_time as $key => $from_value) 
            {
                $created_params['zone_id'] = $zone->id;

                $created_params['start_time'] = $request->from_time[$key];
                $created_params['end_time'] = $request->to_time[$key];
                $created_params['day'] = $request->day[0];
               
                $created_params['value'] = $request->distance_surge[$key];
                $zone->zoneSurge()->create($created_params);

           }
        $message = trans('succes_messages.price_range_added__succesfully');

        return redirect('zone')->with('success', $message);


    }


}
