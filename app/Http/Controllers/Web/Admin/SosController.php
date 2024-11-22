<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Admin\SoS\CreateSosRequest;
use App\Http\Requests\Admin\Driver\UpdateDriverRequest;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Models\Admin\Sos;
use App\Base\Constants\Auth\Role as RoleSlug;
use App\Models\User;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Base\Filters\Master\CommonMasterFilter;
use App\Http\Requests\Admin\SoS\UpdateSosRequest;
use App\Models\Admin\Company;
use App\Models\Admin\ServiceLocation;
use App\Models\Country;
use Carbon\Carbon;

class SosController extends BaseController
{
    /**
     * The Driver model instance.
     *
     * @var \App\Models\Admin\Driver
     */
    protected $driver;

    /**
     * The User model instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * The
     *
     * @var App\Base\Services\ImageUploader\ImageUploaderContract
     */
    protected $imageUploader;


    /**
     * DriverController constructor.
     *
     * @param \App\Models\Admin\Driver $driver
     */
    public function __construct(Sos $sos, ImageUploaderContract $imageUploader, User $user)
    {
        $this->sos = $sos;
        $this->imageUploader = $imageUploader;
        $this->user = $user;
    }

    /**
    * Get all drivers
    * @return \Illuminate\Http\JsonResponse
    */
    public function index()
    {
        $page = trans('pages_names.emergency_number');

        $main_menu = 'emergency_number';
        $sub_menu = '';

        return view('admin.sos.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function getAllSos(QueryFilterContract $queryFilter)
    {
        $url = request()->fullUrl(); //get full url

        $query = Sos::companyKey()->where('user_type', 'admin');
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

        return view('admin.sos._sos', compact('results'));
    }

    /**
    * Create Driver View
    *
    */
    public function create()
    {
        $page = trans('pages_names.add_sos');
        $cities = ServiceLocation::companyKey()->whereActive(true)->get();
        $main_menu = 'emergency_number';
        $sub_menu = '';

        return view('admin.sos.create', compact('cities', 'page', 'main_menu', 'sub_menu'));
    }

    /**
     * Create Driver.
     *
     * @param \App\Http\Requests\Admin\Driver\CreateDriverRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateSosRequest $request)
    {
        $created_params = $request->only(['service_location_id', 'name','number']);
        $created_params['active'] = 1;
        $created_params['created_by']=auth()->user()->id;

        $created_params['company_key'] = auth()->user()->company_key;
        $created_params['user_type'] = 'admin';
        Sos::create($created_params);

        $message = trans('succes_messages.sos_added_succesfully');
        return redirect('sos')->with('success', $message);
    }

    public function getById(Sos $sos)
    {
        $page = trans('pages_names.edit_sos');
        $cities = ServiceLocation::whereActive(true)->get();
        $main_menu = 'emergency_number';
        $sub_menu = '';

        return view('admin.sos.update', compact('cities', 'sos', 'page', 'main_menu', 'sub_menu'));
    }

    public function update(UpdateSosRequest $request, Sos $sos)
    {
        $updated_params = $request->all();
        $sos->update($updated_params);
        $message = trans('succes_messages.sos_updated_succesfully');
        return redirect('sos')->with('success', $message);
    }

    public function toggleStatus(Sos $sos)
    {
        $status = $sos->isActive() ? false: true;
        $sos->update(['active' => $status]);

        $message = trans('succes_messages.sos_status_changed_succesfully');
        return redirect('sos')->with('success', $message);
    }

    public function delete(Sos $sos)
    {
        $sos->delete();

        $message = trans('succes_messages.sos_deleted_succesfully');
        return $message;
    }
}
