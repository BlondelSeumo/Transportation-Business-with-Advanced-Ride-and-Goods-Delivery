<?php

namespace App\Http\Controllers;

use App\Helpers\Auth\AuthHelpers;
use App\Helpers\Response\ResponseHelpers;
use App\Helpers\Exception\ExceptionHelpers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests,
        DispatchesJobs,
        ResponseHelpers,
        // Custom Traits
        AuthHelpers,
        ExceptionHelpers,
        ValidatesRequests;
}
