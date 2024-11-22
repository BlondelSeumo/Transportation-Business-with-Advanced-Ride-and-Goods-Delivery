<?php

namespace App\Http\Controllers\Web\Master;

use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Master\Roles\AttachAndDetachPermissionsRequest;
use App\Http\Requests\Master\Roles\CreateRoleRequest;
use App\Http\Requests\Master\Roles\UpdateRoleRequest;
use App\Models\Access\Permission;
use App\Models\Access\Role;
use App\Base\Constants\Auth\Role as RoleSlug;

/**
 * @resource Roles&Permissions
 *
 * Roles & Permissions
 */
class RoleController extends BaseController
{

    /**
     * The role model instance.
     *
     * @var \App\Models\Access\Role
     */
    protected $role;

    /**
     * The Permission model instance.
     *
     * @var \App\Models\Access\Permission
     */
    protected $permission;

    /**
     * RoleController constructor.
     *
     * @param \App\Models\Role $role
     * @param ImageUploaderContract $imageUploader
     */
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function index(QueryFilterContract $queryFilter)
    {
        $result = Role::where('slug', '!=', 'super-admin')->whereNotIn('slug', RoleSlug::mobileAppRoles())->whereNotIn('slug', RoleSlug::dispatchRoles());

        $results = $queryFilter->builder($result)->customFilter(new CommonMasterFilter)->paginate();

        $page = trans('pages_names.roles');

        $main_menu = 'settings';

        $sub_menu = 'roles';

        return view('admin.master.roles.index', compact('results', 'page', 'main_menu', 'sub_menu'));
    }

    /**
     * Create Role
     * @return redirect to create role page
     */
    public function create()
    {
         if (env('APP_FOR') == 'demo') {
            $message = trans('succes_messages.you_are_not_authorised');
            return redirect('roles')->with('warning', $message);
        }
        $page = trans('pages_names.add_role');

        $permissions = $this->permission->get();

        $main_menu = 'settings';

        $sub_menu = 'roles';

        return view('admin.master.roles.addRole', compact('page', 'permissions', 'main_menu', 'sub_menu'));
    }


    /**
     * Get Roles By ID
     * @param id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById($id)
    {
        $role = $this->role->where('id', $id)->first();

        $page = trans('pages_names.edit_role');

        $permissions = $this->permission->get();

        $main_menu = 'settings';

        $sub_menu = 'roles';

        return view('admin.master.roles.editRole', compact('role', 'permissions', 'page', 'main_menu', 'sub_menu'));
    }

    /**
     * create the Role.
     *
     * @param \App\Http\Requests\Auth\Registration\CreateRoleRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @response
     * {
     *"success": true,
     *"message": "success"
     *}
     */
    public function store(CreateRoleRequest $request)
    {
         if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect()->back()->with('warning', $message);
           }

        $role = $this->role->create($request->all());

        $message = trans('succes_messages.role_added_succesfully');

        return redirect('roles')->with('success', $message);
    }

    /**
     * Update role
     * @param UpdateRoleRequest $role
     * @return \Illuminate\Http\JsonResponse
     * @hideFromAPIDocumentation
     * @response
     * {
     *"success": true,
     *"message": "success"
     *}
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->all());

        $message = trans('succes_messages.role_updated_succesfully');

        return redirect('roles')->with('success', $message);
    }


    /**
     * Assign Permissions
     * @param id
     * @return
     */
    public function assignPermissionView($id)
    {
        $role = $this->role->where('id', $id)->first();

        $page = trans('pages_names.assign_permissions');

        $attachable_permissions = $this->permission->get();

        // $permissions = $this->getAttachablePermissions($attachable_permissions);

        // Filter out specific permissions by ID
        $filtered_permissions = $attachable_permissions->reject(function ($permission) {
            return in_array($permission->id, [2, 4, 5]);
        });

        $permissions = $this->getAttachablePermissions($filtered_permissions);

        $main_menu = 'settings';

        $sub_menu = 'roles';

        return view('admin.master.roles.assignPermissions', compact('role', 'permissions', 'page', 'main_menu', 'sub_menu'));
    }

    /**
     * Attach And Detach Permissions
     * @param Request $request, Role $role
     * @return Redirect to roles page with success message
     * @response
     * {
     *"success": true,
     *"message": "success"
     *}
     */
    public function attachAndDetachPermissions(AttachAndDetachPermissionsRequest $request, Role $role)
    {
        $permissions = $request->input('permissions');

        if (count($role->permissions) > 0) {
            $role->detachPermissions($role->permissions);

            $attachable_permissions = $this->getPermissions($permissions);

            $role->attachPermissions($attachable_permissions);
        } else {
            $attachable_permissions = $this->getPermissions($permissions);

            $role->attachPermissions($attachable_permissions);
        }

        $message = trans('succes_messages.permission_assigned_succesfully');

        return redirect('roles/assign/permissions/'.$role->id)->with('success', $message);
    }

    /**
     * Get all permissions by ids
     * @param $permissions
     * @return
     */
    public function getPermissions($permissions)
    {
        return $permissions = $this->permission->whereIn('id', $permissions)->get();
    }

    /**
    * Get Attachable Permissions
    */
    public function getAttachablePermissions($permissions)
    {
        $menu =[];

        foreach ($permissions as $key => $permission) {
            $menu[$permission->main_menu][]=$permission;
        }

        return $menu;
    }
}
