<?php

namespace App\Http\Controllers\Api\V1;

use App\Base\Constants\Auth\Role;
use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Validation\UnauthorizedException;

abstract class BaseController extends ApiController
{
    protected function validateAdmin()
    {
        $user = auth()->user();

        if (!$user) {
            throw new UnauthorizedException('The user does not has enough access to access the functions.');
        } else {
            //  check his role if master / sub-user
            if ($user->hasRole(Role::adminRoles())) {
                $this->user = $user;
            } else {
                throw new UnauthorizedException('The user does not has enough access to access the functionsssss.');
            }
        }
    }
}
