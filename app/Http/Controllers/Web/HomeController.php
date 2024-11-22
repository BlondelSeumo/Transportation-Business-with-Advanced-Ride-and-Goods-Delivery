<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return redirect('login');
        
    }

    public function test()
    {
        return view('admin.test');
    }
}
