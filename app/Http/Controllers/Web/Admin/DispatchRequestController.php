<?php

namespace App\Http\Controllers\Web\Admin;

use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Admin\Faq\CreateFaqRequest;
use App\Models\Admin\Driver;


use App\Models\Request\DriverRejectedRequest;
use App\Models\Admin\Faq;
use App\Models\Admin\ServiceLocation;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\SearchingDriver;


class DispatchRequestController extends BaseController
{
    protected $faq;

    /**
     * FaqController constructor.
     *
     * @param \App\Models\Admin\Faq $faq
     */
    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    public function index()
    {
        $page = trans('pages_names.view_faq');

        $main_menu = 'faq';
        $sub_menu = '';

        return view('admin.samplerequestmeta.model_view', compact('page', 'main_menu', 'sub_menu'));
    }
public function indexmeta()
{
    return view('admin.samplerequestmeta.requestmeta');
}
    public function DispatchRequest($dispatchsample,Request $request)
    {

        $item = $dispatchsample;
        $users = User::active()->get();
        $driver = Driver::active()->get();
        $driverRejectedRequest= DriverRejectedRequest::all();
        return view('admin.samplerequestmeta.update', compact('item','users','driver','driverRejectedRequest'));
    }
    public function DispatchRequestMeta($dispatchrequestmeta,Request $request)
    {

        $item = $dispatchrequestmeta;
        $users = User::active()->get();
        $driver = Driver::active()->get();
        return view('admin.samplerequestmeta.final_page', compact('item','users','driver'));
    }
}
