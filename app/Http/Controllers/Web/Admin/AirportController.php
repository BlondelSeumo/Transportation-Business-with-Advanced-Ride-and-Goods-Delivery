<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\User;
use App\Models\Admin\Airport;
use App\Models\Admin\ServiceLocation;
use App\Http\Controllers\ApiController;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Base\Constants\Auth\Role as RoleSlug;
use App\Base\Exceptions\CustomValidationException;
use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use App\Http\Controllers\Api\V1\BaseController;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
use Grimzy\LaravelMysqlSpatial\Types\MultiPolygon;
use App\Http\Requests\Admin\Zone\CreateZoneRequest;
use App\Http\Requests\Admin\Zone\AssignZoneTypeRequest;
use App\Models\Request\Request;
use Carbon\Carbon;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Prewk\XmlStringStreamer;
use Prewk\XmlStringStreamer\Stream;
use Prewk\XmlStringStreamer\Parser;

/**
 * @resource Airport
 *
 * Airport CRUD Apis
 */
class AirportController extends BaseController
{
    /**
     * The Airport model instance.
     *
     * @var \App\Models\Admin\Airport
     */
    protected $airport;

    /**
     * AirportController constructor.
     *
     * @param \App\Models\Admin\Airport $airport
     */
    public function __construct(Airport $airport)
    {
        $this->airport = $airport;
    }

    /**
    * Get all Airports
    * @return \Illuminate\Http\JsonResponse
    */
    public function index()
    {
        $page = trans('pages_names.zone');

        $main_menu = 'map';
        $sub_menu = 'airport';

        return view('admin.airport.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function getAllAirports(QueryFilterContract $queryFilter)
    {
        $query = Airport::companyKey();
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

        return view('admin.airport._airport', compact('results'));
    }

    /**
    * Create Airport view
    */
    public function create()
    {
        $page = trans('pages_names.add_zone');

        $main_menu = 'map';
        $sub_menu = 'airport';

        // $admins = User::doesNotBelongToRole(RoleSlug::SUPER_ADMIN)->get();
        $services = ServiceLocation::companyKey()->whereActive(true)->get();
        $cities = $this->getCityBySearch();

        return view('admin.airport.create', compact('page', 'services', 'main_menu', 'sub_menu','cities'));
    }





    public function createopen()
    {
        $page = trans('pages_names.add_zone');

        $main_menu = 'map';
        $sub_menu = 'airport';

        // $admins = User::doesNotBelongToRole(RoleSlug::SUPER_ADMIN)->get();
        $services = ServiceLocation::companyKey()->whereActive(true)->get();
        $cities = $this->getCityBySearch();

        return view('admin.airport.createopen', compact('page', 'services', 'main_menu', 'sub_menu','cities'));
    }



    /**
    * Airport Edit
    *
    */
    public function airportEdit($id)
    {
        $zone = $this->airport->where('id', $id)->first();
        $page = trans('pages_names.add_zone');
        $main_menu = 'map';
        $sub_menu = 'airport';

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


        return view('admin.airport.edit', compact('page', 'zone', 'zone_coordinates', 'services', 'main_menu', 'sub_menu', 'default_lat', 'default_lng'));
    }

    /**
     * Get Airport By ID
     * @param id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById($id)
    {
        $airport = $this->airport->where('id', $id)->first();

        return $this->respondSuccess($airport);
    }

    /**
     * Create Airport.
     *
     * @param \App\Http\Requests\Admin\Zone\CreateZoneRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateZoneRequest $request)
    {
        // dd($request->all());
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
                $check_if_exists = $this->airport->companyKey()->contains('coordinates', $point)->exists();
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
        $created_params['airport_surge_fee'] = $request->input('airport_surge_fee');

        $created_params['coordinates'] = $multi_polygon;

        // dd($created_params);
        $created_params['company_key'] = auth()->user()->company_key;

        $airport = $this->airport->create($created_params);


        $message = trans('succes_messages.airport_added_succesfully');

        return redirect('airport')->with('success', $message);
    }
    /**
    * Create Airport.
    *
    * @param \App\Http\Requests\Admin\Airport\CreateZoneRequest $request
    * @return \Illuminate\Http\JsonResponse
    */
    public function update(Airport $airport, CreateZoneRequest $request)
    {
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
                $check_if_exists = $this->airport->companyKey()->contains('coordinates', $point)->where('id', '!=', $airport->id)->exists();
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
        $updated_params['airport_surge_fee'] = $request->input('airport_surge_fee');

        $updated_params['coordinates'] = $multi_polygon;

        $airport = $airport->update($updated_params);

        // return true;
        $message = trans('succes_messages.airport_updated_succesfully');

        return redirect('airport')->with('success', $message);
    }

    /**
    * Airport map view
    */
    public function airportMapView($id)
    {
        $airport = $this->airport->find($id);

        $coordinates = $airport->coordinates->toArray();

        $multi_polygon = [];

        foreach ($coordinates as $key => $airport) {
            $polygon = [];
            foreach ($airport[0] as $key => $point) {
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
        $sub_menu = 'airport';

        return view('admin.airport.mapview', compact('page', 'main_menu', 'sub_menu', 'zones', 'default_lat', 'default_lng'));
    }



    /**
    * Airport Delete
    *
    */
    public function delete(Airport $airport)
    {
        $airport->delete();
        $message = trans('succes_messages.airport_deleted_succesfully');
        // return $message;
        return redirect('airport')->with('success', $message);
    }



    public function toggleAirportStatus(Airport $airport)
    {
        $status = $airport->isActive() ? false : true;
        $airport->update(['active' => $status]);

        $message = trans('succes_messages.airport_status_changed_succesfully');
        return redirect('airport')->with('success', $message);
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



}
