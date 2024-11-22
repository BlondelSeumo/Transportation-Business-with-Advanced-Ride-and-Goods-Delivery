<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FleetOwnerController extends Controller
{
    /**
     * Redirect to login
     */
    public function viewLogin()
    {
        return view('admin.company-login');
    }

     public function dashboard(){
        return view('dispatch.home');
    }
}
