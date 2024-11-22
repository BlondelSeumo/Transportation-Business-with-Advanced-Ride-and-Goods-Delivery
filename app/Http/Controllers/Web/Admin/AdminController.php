<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Admin\Driver\CreateDriverRequest;
use App\Http\Requests\Admin\Driver\UpdateDriverRequest;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Models\Admin\AdminDetail;
use App\Base\Constants\Auth\Role as RoleSlug;
use App\Models\User;
use App\Models\Admin\Driver;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Base\Filters\Master\CommonMasterFilter;
use App\Http\Requests\Admin\AdminDetail\CreateAdminRequest;
use App\Http\Requests\Admin\AdminDetail\UpdateAdminRequest;
use App\Http\Requests\Admin\AdminDetail\UpdateProfileRequest;
use App\Models\Admin\Company;
use App\Models\Country;
use App\Models\Access\Role;
use App\Models\Admin\ServiceLocation;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * @resource Driver
 *
 * vechicle types Apis
 */
class AdminController extends BaseController
{
    /**
     * The Driver model instance.
     *
     * @var \App\Models\Admin\AdminDetail
     */
    protected $admin_detail;

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
     * @param \App\Models\Admin\AdminDetail $admin_detail
     */
    public function __construct(AdminDetail $admin_detail, ImageUploaderContract $imageUploader, User $user)
    {
        $this->admin_detail = $admin_detail;
        $this->imageUploader = $imageUploader;
        $this->user = $user;
    }

    /**
    * Get all admins
    * @return \Illuminate\Http\JsonResponse
    */
    public function index()
    {
        $page = trans('pages_names.admins');

        $main_menu = 'admin';
        $sub_menu = null;

        return view('admin.admin.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function getAllAdmin(QueryFilterContract $queryFilter)
    {
        $url = request()->fullUrl(); //get full url

        if (access()->hasRole(RoleSlug::SUPER_ADMIN)) {
            $query = AdminDetail::query();
            if (env('APP_FOR')=='demo') {
                $query = AdminDetail::whereHas('user', function ($query) {
                    $query->where('company_key', auth()->user()->company_key);
                });
            }
        } else {
            $this->validateAdmin();
            $query = $this->admin_detail->where('created_by', $this->user->id);
        }

        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

        return view('admin.admin._admin', compact('results'));
    }

    /**
    * Create Admins View
    *
    */
    public function create()
    {
        $page = trans('pages_names.add_admin');
        $admins = User::companyKey()->doesNotBelongToRole(RoleSlug::SUPER_ADMIN)->get();

        if (access()->hasRole(RoleSlug::SUPER_ADMIN)) {
            $roles = Role::whereNotIn('slug', RoleSlug::mobileAppRoles())->get();
        } else {
            $this->validateAdmin();
            $roles = Role::where('slug', '!=', 'super-admin')->whereNotIn('slug', RoleSlug::mobileAppRoles())->get();
        }

        $countries = Country::active()->get();
        $services = ServiceLocation::companyKey()->active()->get();

        $main_menu = 'admin';
        $sub_menu = null;

        return view('admin.admin.create', compact('admins', 'page', 'countries', 'main_menu', 'sub_menu', 'roles', 'services'));
    }

    /**
     * Store admin.
     *
     * @param \App\Http\Requests\Admin\Driver\CreateDriverRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateAdminRequest $request)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('admins')->with('warning', $message);
        }

        $created_params = $request->only(['service_location_id', 'first_name', 'last_name','mobile','email','address','state','city','country']);
        $created_params['pincode'] = $request->postal_code;
        $created_params['created_by'] = auth()->user()->id;

        if ($request->input('service_location_id')) {
            $timezone = ServiceLocation::where('id', $request->input('service_location_id'))->pluck('timezone')->first();
        } else {
            $timezone = env('SYSTEM_DEFAULT_TIMEZONE');
        }

        $user_params = ['name'=>$request->input('first_name').' '.$request->input('last_name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'mobile_confirmed'=>true,
            'timezone'=>$timezone,
            'country'=>$request->input('country'),
            'password' => bcrypt($request->input('password'))
        ];

        if (env('APP_FOR')=='demo') {
            $user_params['company_key'] = auth()->user()->company_key;
        }
        $user = $this->user->create($user_params);

        if ($uploadedFile = $this->getValidatedUpload('profile_picture', $request)) {
            $user->profile_picture = $this->imageUploader->file($uploadedFile)
                ->saveProfilePicture();
            $user->save();
        }

        $user->attachRole($request->role);

        $user->admin()->create($created_params);

        $message = trans('succes_messages.admin_added_succesfully');
        return redirect('admins')->with('success', $message);
    }


    public function getById(AdminDetail $admin)
    {


        $page = trans('pages_names.edit_admin');

        if (access()->hasRole(RoleSlug::SUPER_ADMIN)) {
            $roles = Role::whereNotIn('slug', RoleSlug::mobileAppRoles())->get();
        } else {
            $this->validateAdmin();
            $roles = Role::where('slug', '!=', 'super-admin')->whereNotIn('slug', RoleSlug::mobileAppRoles())->get();
        }
        $services = ServiceLocation::active()->get();
        $countries = Country::active()->get();
        $item = $admin;
        $main_menu = 'admins';
        $sub_menu = null;

        return view('admin.admin.update', compact('item', 'services', 'page', 'countries', 'main_menu', 'sub_menu', 'roles'));
    }


    public function update(AdminDetail $admin, UpdateAdminRequest $request)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('admins')->with('warning', $message);
        }

        $updatedParams = $request->only(['service_location_id', 'first_name', 'last_name','mobile','email','address','state','city','country']);
        $updatedParams['pincode'] = $request->postal_code;


        $updated_user_params = ['name'=>$request->input('first_name').' '.$request->input('last_name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'password' => bcrypt($request->input('password'))
        ];

        if ($uploadedFile = $this->getValidatedUpload('profile_picture', $request)) {
            $updated_user_params['profile_picture'] = $this->imageUploader->file($uploadedFile)
                ->saveProfilePicture();
        }

        $admin->user->update($updated_user_params);

        $admin->user->roles()->detach();

        $admin->user->attachRole($request->role);

        $admin->update($updatedParams);

        $message = trans('succes_messages.admin_updated_succesfully');
        return redirect('admins')->with('success', $message);
    }
    public function toggleStatus(User $user)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('admins')->with('warning', $message);
        }

        $status = $user->isActive() ? false: true;
        $user->update(['active' => $status]);

        $message = trans('succes_messages.admin_status_changed_succesfully');
        return redirect('admins')->with('success', $message);
    }

    public function delete(User $user)
    {
        if(env('APP_FOR')=='demo'){

        $message = 'you cannot perform this action due to demo version';

        return $message;

        }
        $user->delete();

        $message = trans('succes_messages.admin_deleted_succesfully');

        return $message;
        // return redirect('admins')->with('success', $message);
    }

    public function viewProfile(User $user)
    {
        $page = trans('pages_names.admins');

        $main_menu = 'admin';
        $sub_menu = null;

        return view('admin.admin.profile', compact('page', 'main_menu', 'sub_menu', 'user'));
    }

    public function updateProfile(UpdateProfileRequest $request, User $user)
    {
        if(env('APP_FOR')=='demo'){

        $message = 'you cannot update the profile due to demo version';

        return redirect('admins')->with('success', $message);

        }

        if ($request->action == 'password') {
            $updated_user_params['password'] = bcrypt($request->input('password'));
        } else {
            $updatedParams = $request->only(['first_name','mobile','email','address']);

            $updated_user_params = ['name'=>$request->input('first_name'),
                'email'=>$request->input('email'),
                'mobile'=>$request->input('mobile')
            ];

            if ($uploadedFile = $this->getValidatedUpload('profile_picture', $request)) {
                $updated_user_params['profile_picture'] = $this->imageUploader->file($uploadedFile)
                    ->saveProfilePicture();
            }

            $user->admin->update($updatedParams);
        }

        $user->update($updated_user_params);

        $message = trans('succes_messages.admin_profile_updated_succesfully');
        return redirect('admins')->with('success', $message);
    }
}
