<?php

namespace App\Http\Controllers\Web\Admin;

use App\Base\Filters\Admin\RequestFilter;
use App\Base\Filters\Admin\RequestCancellationFilter;
use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Http\Controllers\Controller;
use App\Models\Request\Request as RequestRequest;
use App\Models\Request\RequestCancellationFee;
use App\Models\Admin\CancellationReason;
use Illuminate\Http\Request;
use App\Base\Constants\Setting\Settings;

class CancellationRideController extends Controller
{
    public function index()
    {
        $page = trans('pages_names.cancellation_rides');
        $main_menu = 'trip-request';
        $sub_menu = 'cancellation-rides';

        return view('admin.cancellation-rides.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function indexDelivery()
    {
        $page = trans('pages_names.cancellation_delivery_rides');
        $main_menu = 'delivery-trip-request';
        $sub_menu = 'cancellation-rides';

        return view('admin.cancellation-delivery-rides.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function getAllRides(QueryFilterContract $queryFilter)
    {
        $app_for = config('app.app_for');


        $query = RequestRequest::where('transport_type' , 'taxi')->whereIsCancelled(true);
      
        if($app_for=='taxi')
        {
        
        $query = RequestRequest::whereIsCancelled(true);

        }


        $results = $queryFilter->builder($query)->customFilter(new RequestFilter)->defaultSort('-created_at')->paginate();

        return view('admin.cancellation-rides._rides', compact('results'));
    }


    public function getAllDeliveryRides(QueryFilterContract $queryFilter)
    {
        $app_for = config('app.app_for');

        $query = RequestRequest::where('transport_type' , 'delivery')->whereIsCancelled(true);
       
        if($app_for=='delivery')
        {
        
        $query = RequestRequest::whereIsCancelled(true);

        }


        $results = $queryFilter->builder($query)->customFilter(new RequestFilter)->defaultSort('-created_at')->paginate();


        return view('admin.cancellation-delivery-rides._rides', compact('results'));


    }

   
     
}
