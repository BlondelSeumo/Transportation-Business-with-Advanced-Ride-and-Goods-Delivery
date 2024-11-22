<?php

namespace App\Http\Controllers\Web\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\VehicleType;
use App\Models\Admin\ServiceLocation;
use App\Http\Controllers\ApiController;
use App\Base\Constants\Auth\Role as RoleSlug;
use App\Base\Filters\Master\CommonMasterFilter;
use App\Http\Controllers\Api\V1\BaseController;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Http\Requests\Admin\VehicleTypes\CreateVehicleTypeRequest;
use App\Http\Requests\Admin\VehicleTypes\UpdateVehicleTypeRequest;

/**
 * @resource Vechicle-Types
 *
 * vechicle types Apis
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
    * Get all vehicle types
    * @return \Illuminate\Http\JsonResponse
    */
    public function index()
    {
        $page = trans('pages_names.types');
        $main_menu = 'types';
        $sub_menu = '';
        return view('admin.types.index', compact('page', 'main_menu', 'sub_menu'))->render();
    }

    public function getAllTypes(QueryFilterContract $queryFilter)
    {

            $query = VehicleType::query();

            $app_for = config('app.app_for');
           
            $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();
            return view('admin.types._types', compact('results','app_for'))->render();
    }

    /**
    * Get Types by admin for ajax
    *
    */
    public function byAdmin(Request $request)
    {
        $types = VehicleType::where('admin_id', $request->admin_id)->get();

        return $this->respondSuccess($types);
    }

    /**
    * Create Vehicle type
    *
    */
    public function create()
    {
        $page = trans('pages_names.add_type');
        // $services = ServiceLocation::whereActive(true)->get();
            $app_for = config('app.app_for');
        $main_menu = 'types';
        $sub_menu = '';
        return view('admin.types.create', compact('page', 'main_menu', 'sub_menu','app_for'));
    }




    /**
     * Store Vehicle type.
     *
     * @param \App\Http\Requests\Admin\VehicleTypes\CreateVehicleTypeRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @response
     * {
     *"success": true,
     *"message": "success"
     *}
     */
    public function store(CreateVehicleTypeRequest $request)
    {
      
         if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('types')->with('warning', $message);
        }
        // dd($request->transport_type);
        // echo "test";
        // exit;
        $created_params = $request->only(['name', 'capacity','is_accept_share_ride','description','supported_vehicles','short_description', 'transport_type', 'is_taxi','icon_types_for','trip_dispatch_type']);
           
             $is_taxi = $request->transport_type;


            if ($request->size)
            {
                $created_params['size'] = $request->size;
                $created_params['capacity'] = $request->maximum_weight_can_carry;
            }

        if ($uploadedFile = $this->getValidatedUpload('icon', $request)) {
            $created_params['icon'] = $this->imageUploader->file($uploadedFile)
                ->saveVehicleTypeImage();
        }
        $created_params['active'] = true;

        $created_params['is_taxi'] = $request->transport_type;


        $this->vehicle_type->create($created_params);

        $message = trans('succes_messages.type_added_succesfully');

        return redirect('types')->with('success', $message);
    }

    /**
    * Edit Vehicle type view
    *
    */
    public function edit($id)
    {
        $page = trans('pages_names.edit_type');
        $type = $this->vehicle_type->where('id', $id)->first();
        //  dd($type);
        // $admins = User::doesNotBelongToRole(RoleSlug::SUPER_ADMIN)->get();
        // $services = ServiceLocation::whereActive(true)->get();
        $app_for = config('app.app_for');
        $main_menu = 'types';
        $sub_menu = '';
        return view('admin.types.update', compact('page', 'main_menu', 'sub_menu','type', 'app_for'));
    }


    /**
     * Update Vehicle type.
     *
     * @param \App\Http\Requests\Admin\VehicleTypes\CreateVehicleTypeRequest $request
     * @param App\Models\Admin\VehicleType $vehicle_type
     * @return \Illuminate\Http\JsonResponse
     * @response
     * {
     *"success": true,
     *"message": "success"
     *}
     */
    public function update(UpdateVehicleTypeRequest $request, VehicleType $vehicle_type)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('types')->with('warning', $message);
        }
        // dd($request->all());
        $this->validateAdmin();

        $created_params = $request->only(['name', 'capacity','is_accept_share_ride','description','supported_vehicles','short_description','transport_type','icon_types_for','trip_dispatch_type']);

             $is_taxi = $request->transport_type;

            if ($request->size)
            {
                $created_params['size'] = $request->size;
                $created_params['capacity'] = $request->maximum_weight_can_carry;
            }
        if ($uploadedFile = $this->getValidatedUpload('icon', $request)) {
            $created_params['icon'] = $this->imageUploader->file($uploadedFile)
                ->saveVehicleTypeImage();
        }

        $created_params['is_taxi'] = $request->transport_type;


        $vehicle_type->update($created_params);

        $message = trans('succes_messages.type_updated_succesfully');
        // clear the cache
        cache()->tags('vehilce_types')->flush();
        return redirect('types')->with('success', $message);
    }
    public function toggleStatus(VehicleType $vehicle_type)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('types')->with('warning', $message);
        }

        $status = $vehicle_type->active == 1 ? 0 : 1;
        $vehicle_type->update([
            'active' => $status
        ]);

        $message = trans('succes_messages.type_status_changed_succesfully');
        return redirect('types')->with('success', $message);
    }
    /**
     * Delete Vehicle type.
     *
     * @param App\Models\Admin\VehicleType $vehicle_type
     * @return \Illuminate\Http\JsonResponse
     * @response
     * {
     *"success": true,
     *"message": "success"
     *}
     */

    public function delete(VehicleType $vehicle_type)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('types')->with('warning', $message);
        }

        $vehicle_type->delete();

        $message = trans('succes_messages.vehicle_type_deleted_succesfully');
        return $message;
    }
}
