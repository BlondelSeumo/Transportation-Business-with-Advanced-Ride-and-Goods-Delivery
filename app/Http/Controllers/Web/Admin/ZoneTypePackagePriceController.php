<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Admin\ZoneTypePackagePrice;
use App\Models\Admin\ZoneType;
use Illuminate\Http\Request;

class ZoneTypePackagePriceController extends BaseController
{
    protected $package;
    protected $zone;

    /**
     * ZoneTypePackagePriceController constructor.
     *
     * @param \App\Models\Admin\ZoneTypePackagePrice $zone
     */
    public function __construct(ZoneTypePackagePrice $package)
    {
        $this->package = $package;
    }

    public function __construct(ZoneType $zone)
    {
        $this->zone = $zone;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = trans('pages_names.zone_type_package');

        $main_menu = 'map';
        $sub_menu = 'zone';

        return view('admin.zone_type_package.create', compact('page', 'main_menu', 'sub_menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function getById($id)
    {
        $item = $this->package->where('id', $id)->first();
        $page = trans('pages_names.edit_zone_type_package_price');

        $main_menu = 'map';
        $sub_menu = 'zone';
        // $item = $package;
        // dd($item);

        return view('admin.zone_type_package.update', compact('item', 'page', 'main_menu', 'sub_menu','zone_type'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\ZoneTypePackagePrice  $zoneTypePackagePrice
     * @return \Illuminate\Http\Response
     */
    public function show(ZoneTypePackagePrice $zoneTypePackagePrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ZoneTypePackagePrice  $zoneTypePackagePrice
     * @return \Illuminate\Http\Response
     */
    public function edit(ZoneTypePackagePrice $zoneTypePackagePrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ZoneTypePackagePrice  $zoneTypePackagePrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ZoneTypePackagePrice $zoneTypePackagePrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ZoneTypePackagePrice  $zoneTypePackagePrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ZoneTypePackagePrice $zoneTypePackagePrice)
    {
        //
    }

     
}
