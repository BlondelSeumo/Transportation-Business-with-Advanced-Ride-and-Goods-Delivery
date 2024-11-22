<?php

namespace App\Http\Controllers\Web\Auth\Registration;

use App\Base\Constants\Auth\Role;
use App\Events\Auth\UserRegistered;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\Registration\AdminRegistrationRequest;
use App\Http\Requests\Auth\Registration\UserRegistrationRequest;
use App\Jobs\Notifications\Auth\Registration\UserRegistrationNotification;
use App\Models\User;
use App\Models\Admin\AdminDetail;
use DB;
use Illuminate\Support\Facades\Log;

/**
 * @resource Admin-Register
 *
 * Web-panel-admin register
 */
class AdminRegistrationController extends ApiController
{

    /**
     * The user model instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * The user model instance.
     *
     * @var \App\Models\User
     */
    protected $admin_detail;

    /**
     * AdminRegistrationController constructor.
     *
     * @param \App\Models\User $user
     */
    public function __construct(User $user, AdminDetail $admin_detail)
    {
        $this->user = $user;
        $this->admin_detail = $admin_detail;
    }

    /**
     * Register the admin user.
     * @param \App\Http\Requests\Auth\Registration\UserRegistrationRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @response
     * {
     *"success": true,
     *"message": "success"
     *}
     */
    public function register(AdminRegistrationRequest $request)
    {
        DB::beginTransaction();
        try {
            $name = $request->input('first_name').' '.$request->input('last_name');

            $user = $this->user->create([
            'name' => $name,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'mobile' => $request->input('mobile'),
            'mobile_confirmed' => true,
        ]);

            $admin_data = $request->only(['first_name', 'last_name', 'address', 'country','pincode','timezone','email','mobile','emergency_contact','area_name']);

            $admin = $user->admin()->create($admin_data);

            $user->attachRole($request->input('role'));

            event(new UserRegistered($user));

            $this->dispatch(new UserRegistrationNotification($user));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e . 'Error while Create Admin. Input params : ' . json_encode($request->all()));
            return $this->respondBadRequest('Unknown error occurred. Please try again later or contact us if it continues.');
        }
        DB::commit();


        return $this->respondSuccess();
    }
}
