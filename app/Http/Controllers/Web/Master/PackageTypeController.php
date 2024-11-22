<?php

namespace App\Http\Controllers\Web\Master;

use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Http\Controllers\Web\BaseController;
use App\Models\Master\PackageType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageTypeController extends BaseController
{
     protected $package;

    /**
     * CarMakeController constructor.
     *
     * @param \App\Models\Admin\CarMake $car_make
     */
    public function __construct(PackageType $package)
    {
        $this->package = $package;
    }
    public function index()
    {
         $page = trans('pages_names.view_package_type');

        $main_menu = 'master';
        $sub_menu = 'package_type';
      if((config('app.app_for')=="super") || (config('app.app_for')=="bidding")){

        return view('admin.master.package_type.index', compact('page', 'main_menu', 'sub_menu'));
        }else{
            return view('admin.master.taxi.package_type.index', compact('page', 'main_menu', 'sub_menu'));
        }
    }

    public function fetch(QueryFilterContract $queryFilter)
    {
        $query = $this->package->query();//->active()
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

      if((config('app.app_for')=="super") || (config('app.app_for')=="bidding")){

        return view('admin.master.package_type._package', compact('results'));
      }else{
        return view('admin.master.taxi.package_type._package', compact('results'));
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $page = trans('pages_names.add_package_type');

        $main_menu = 'master';
        $sub_menu = 'package_type';
      if((config('app.app_for')=="super") || (config('app.app_for')=="bidding")){

        return view('admin.master.package_type.create', compact('page', 'main_menu', 'sub_menu'));
       }else{
        return view('admin.master.taxi.package_type.create', compact('page', 'main_menu', 'sub_menu'));

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('package_type')->with('warning', $message);
        }

        Validator::make($request->all(), [
            'name' => 'required',
            'transport_type' => 'sometimes|required'
        ])->validate();

        $created_params = $request->only(['name','transport_type','description','short_description']);
        $created_params['active'] = 1;

        // $created_params['company_key'] = auth()->user()->company_key;

        $this->package->create($created_params);

        $message = trans('succes_messages.package_type_added_succesfully');

        return redirect('package_type')->with('success', $message);
    }

     public function getById(PackageType $package)
    {
        $page = trans('pages_names.edit_package_type');

        $main_menu = 'master';
        $sub_menu = 'package_type';
        $item = $package;
        // dd($item);
      if((config('app.app_for')=="super") || (config('app.app_for')=="bidding")){

        return view('admin.master.package_type.update', compact('item', 'page', 'main_menu', 'sub_menu'));
      }else{
        return view('admin.master.taxi.package_type.update', compact('item', 'page', 'main_menu', 'sub_menu'));

      }
    }

    public function update(Request $request, PackageType $package)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('package_type')->with('warning', $message);
        }

        Validator::make($request->all(), [
            'name' => 'required',
            'transport_type' => 'sometimes|required'
        ])->validate();

        $updated_params = $request->all();
        $package->update($updated_params);
        $message = trans('succes_messages.package_type_updated_succesfully');
        return redirect('package_type')->with('success', $message);
    }

     public function toggleStatus(PackageType $package)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('package_type')->with('warning', $message);
        }

        $status = $package->isActive() ? false: true;
        $package->update(['active' => $status]);

        $message = trans('succes_messages.package_type_status_changed_succesfully');
        return redirect('package_type')->with('success', $message);
    }

    public function delete(PackageType $package)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('package_type')->with('warning', $message);
        }
        
        $package->delete();

        $message = trans('succes_messages.package_type_deleted_succesfully');
        return redirect('package_type')->with('success', $message);
    }

    
}
