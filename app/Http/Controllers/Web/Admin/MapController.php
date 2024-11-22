<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Admin\Zone;
use Illuminate\Http\Request;
use App\Base\Constants\Auth\Role;
use App\Http\Controllers\Controller;
use App\Models\Admin\ServiceLocation;
use App\Models\Request\Request as RequestRequest;
use Carbon\Carbon;

class MapController extends Controller
{
    public function heatMapView(Request $request)
    {
        $page = trans('pages_names.heat_map');

        $main_menu = 'manage-map';
        $sub_menu = 'heat_map';

        // if ($request->has('zone_id')) {
        //     $results = RequestRequest::companyKey()->whereHas('zoneType.zone', function ($q) use ($request) {
        //         $q->where('id', $request->zone_id);
        //     })->get();

        // } else {
        //     $results = RequestRequest::companyKey()->get();
        // }

        // Calculate the date one week ago
        $oneWeekAgo = Carbon::now()->subWeek();

        if ($request->has('zone_id')) {
            $results = RequestRequest::companyKey()
                ->whereHas('zoneType.zone', function ($q) use ($request) {
                    $q->where('id', $request->zone_id);
                })
                ->whereBetween('created_at', [$oneWeekAgo, Carbon::now()])
                ->get();
        } else {
            $results = RequestRequest::companyKey()
                ->whereBetween('created_at', [$oneWeekAgo, Carbon::now()])
                ->get();
        }

        $serviceLocation = ServiceLocation::companyKey()->active()->get();

        return view('admin.map.heatmap', compact('page', 'main_menu', 'sub_menu', 'results', 'serviceLocation'));
    }





    public function heatMapViewOpen(Request $request)
    {
        $page = trans('pages_names.heat_map');

        $main_menu = 'manage-map';
        $sub_menu = 'heat_map';

        // if ($request->has('zone_id')) {
        //     $results = RequestRequest::companyKey()->whereHas('zoneType.zone', function ($q) use ($request) {
        //         $q->where('id', $request->zone_id);
        //     })->get();

        // } else {
        //     $results = RequestRequest::companyKey()->get();
        // }

        // Calculate the date one week ago
        $oneWeekAgo = Carbon::now()->subWeek();

        if ($request->has('zone_id')) {
            $results = RequestRequest::companyKey()
                ->whereHas('zoneType.zone', function ($q) use ($request) {
                    $q->where('id', $request->zone_id);
                })
                ->whereBetween('created_at', [$oneWeekAgo, Carbon::now()])
                ->get();
        } else {
            $results = RequestRequest::companyKey()
                ->whereBetween('created_at', [$oneWeekAgo, Carbon::now()])
                ->get();
        }

        $serviceLocation = ServiceLocation::companyKey()->active()->get();
       

        return view('admin.map.heatmapopen', compact('page', 'main_menu', 'sub_menu', 'results', 'serviceLocation'));
    }



    public function getZoneByServiceLocation(Request $request)
    {
        $id = $request->id;

        return Zone::active()->whereServiceLocationId($id)->get();
    }

    public function mapView()
    {
        $page = trans('pages_names.map');
        $main_menu = 'manage-map';
        $sub_menu = 'map';

        $default_lat = get_settings('default_latitude');
        $default_lng = get_settings('default_longitude');

        $zone = Zone::active()->companyKey()->first();

        if ($zone) {
            if (access()->hasRole(Role::SUPER_ADMIN)) {
            } else {
                $admin_detail = auth()->user()->admin;
                $zone = $admin_detail->serviceLocationDetail->zones()->first();
            }

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
        }



        return view('admin.map.map', compact('page', 'main_menu', 'sub_menu', 'default_lat', 'default_lng'));
    }





    public function mapViewopen()
    {
        $page = trans('pages_names.map');
        $main_menu = 'manage-map';
        $sub_menu = 'map';

        $default_lat = get_settings('default_latitude');
        $default_lng = get_settings('default_longitude');

        $zone = Zone::active()->companyKey()->first();

        if ($zone) {
            if (access()->hasRole(Role::SUPER_ADMIN)) {
            } else {
                $admin_detail = auth()->user()->admin;
                $zone = $admin_detail->serviceLocationDetail->zones()->first();
            }

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
        }



        return view('admin.map.mapopen', compact('page', 'main_menu', 'sub_menu', 'default_lat', 'default_lng'));
    }



    public function mapViewMapbox()
    {
         $page = trans('pages_names.map');
        $main_menu = 'manage-map';
        $sub_menu = 'map-mapbox';

        $default_lat = get_settings('default_latitude');
        $default_lng = get_settings('default_longitude');

        $zone = Zone::active()->companyKey()->first();

        if ($zone) {
            if (access()->hasRole(Role::SUPER_ADMIN)) {
            } else {
                $admin_detail = auth()->user()->admin;
                $zone = $admin_detail->serviceLocationDetail->zones()->first();
            }

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
        }



        return view('admin.map.map-mapbox', compact('page', 'main_menu', 'sub_menu', 'default_lat', 'default_lng'));

    }
    public function fetchCity(Request $request)
    {

        //sfd
        $pick_lat = $request->lat;
        $pick_lng = $request->lng;

        $driver_search_radius = $request->radius;

        $radius = kilometer_to_miles($driver_search_radius);

        $calculatable_radius = ($radius/2);

        $calulatable_lat = 0.0144927536231884 * $calculatable_radius;
        $calulatable_long = 0.0181818181818182 * $calculatable_radius;

        $lower_lat = ($pick_lat - $calulatable_lat);
        $lower_long = ($pick_lng - $calulatable_long);

        $higher_lat = ($pick_lat + $calulatable_lat);
        $higher_long = ($pick_lng + $calulatable_long);

        $g = new Geohash();

        $lower_hash = $g->encode($lower_lat,$lower_long, 12);
        $higher_hash = $g->encode($higher_lat,$higher_long, 12);

        $conditional_timestamp = Carbon::now()->subMinutes(7)->timestamp;





        $fire_drivers = $this->database->getReference('drivers')->orderByChild('g')->startAt($lower_hash)->endAt($higher_hash)->getValue();


        return response()->json(['data'=>$fire_drivers]);
    }




}
