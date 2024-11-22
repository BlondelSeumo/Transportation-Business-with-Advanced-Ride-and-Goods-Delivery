<?php

namespace App\Http\Controllers\Web\Admin;

use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\ServiceLocation;
use App\Base\Constants\Auth\Role as RoleSlug;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Admin\ServiceLocation\CreateServiceLocationRequest;
use App\Http\Requests\Admin\ServiceLocation\UpdateServiceLocationRequest;
use App\Models\Country;
use App\Models\TimeZone;
use Carbon\Carbon;

class ServiceLocationController extends BaseController
{
    /**
     * Class constructor.
     */
    protected $imageUploader;

    protected $serviceLocation;

    public function __construct(ServiceLocation $serviceLocation, ImageUploaderContract $imageUploader)
    {
        $this->imageUploader = $imageUploader;
        $this->serviceLocation = $serviceLocation;
    }

    public function index()
    {
        $page = trans('pages_names.service_location');
        $main_menu = 'service_location';
        $sub_menu = '';

        return view('admin.servicelocation.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function getAllLocation(QueryFilterContract $queryFilter)
    {

        $query = ServiceLocation::query(); 

        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();
        return view('admin.servicelocation._servicelocation', compact('results'));
    }

    public function create()
    {
        
        $timezones = TimeZone::active()->get();
        $countries = Country::active()->get();
        $page = trans('pages_names.add_service_location');
        $main_menu = 'service_location';
        $sub_menu = '';
        return view('admin.servicelocation.create', compact('timezones', 'page', 'main_menu', 'sub_menu', 'countries'));
    }

    public function store(CreateServiceLocationRequest $request)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('service_location')->with('warning', $message);
        }

        $created_params = $request->only(['name','currency_name','currency_code','currency_symbol','country','timezone']);
        $created_params['active'] = 1;

        $created_params['company_key'] = auth()->user()->company_key;

        ServiceLocation::create($created_params);

        $message = trans('succes_messages.service_location_added_succesfully');
        return redirect('service_location')->with('success', $message);
    }

    public function getById(ServiceLocation $serviceLocation)
    {
        

        $item = $serviceLocation;
        $timezones = TimeZone::active()->get();
        $countries = Country::active()->get();
        $page = trans('pages_names.edit_service_location');
        $main_menu = 'service_location';
        $sub_menu = '';
        return view('admin.servicelocation.update', compact('timezones', 'item', 'page', 'main_menu', 'sub_menu', 'countries'));
    }

    public function update(UpdateServiceLocationRequest $request, ServiceLocation $serviceLocation)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('service_location')->with('warning', $message);
        }
        
        $updated_params = $request->all();
        $serviceLocation->update($updated_params);
        $message = trans('succes_messages.service_location_updated_succesfully');
        return redirect('service_location')->with('success', $message);
    }

    public function toggleStatus(ServiceLocation $serviceLocation)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('service_location')->with('warning', $message);
        }
        
        $status = $serviceLocation->isActive() ? false: true;
        $serviceLocation->update(['active' => $status]);

        $message = trans('succes_messages.service_location_status_changed_succesfully');
        return redirect('service_location')->with('success', $message);
    }

    public function delete(ServiceLocation $serviceLocation)
    {
        if(env('APP_FOR')!='demo'){
        $serviceLocation->delete();                        
        }

        $message = trans('succes_messages.service_location_deleted_succesfully');

        return $message;
    }

    public function getCurrencyByCountry(Request $request)
    {
        return Country::active()->whereId($request->id)->first();
    }
}
