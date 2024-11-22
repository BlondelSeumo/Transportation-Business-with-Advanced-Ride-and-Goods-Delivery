<?php

namespace App\Http\Controllers\Web;

use App\Base\Constants\Auth\Role;
use App\Http\Controllers\ApiController;
use App\Models\Access\Role as RoleSlug;
use App\Models\User;
use Redirect;

abstract class BaseController extends ApiController
{
    protected function validateAdmin()
    {
        $user = auth()->user();

        if (!$user) {
            return Redirect::to('login')->send();
        } else {
            //  check his role if admin roles
            $web_login_roles = RoleSlug::whereNotIn('slug', array_merge(Role::mobileAppRoles(), Role::dispatchRoles()))
                    ->pluck('slug')
                    ->toArray(); 
            if ($user->hasRole($web_login_roles)) {
                $this->user = $user;
            } else {
                return Redirect::to('unauthorized')->send();
            }
        }
    }
}
