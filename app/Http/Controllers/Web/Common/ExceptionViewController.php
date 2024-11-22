<?php

namespace App\Http\Controllers\Web\Common;

use App\Http\Controllers\Web\BaseController;

class ExceptionViewController extends BaseController
{

    /**
     * Redirect to unauthorized exception page
     */
    public function unauthorized()
    {
        return view('exception.unauthorized');
    }
}
