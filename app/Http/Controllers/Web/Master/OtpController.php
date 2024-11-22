<?php

namespace App\Http\Controllers\Web\Master;

use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Http\Controllers\Web\BaseController;
use App\Models\MailOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OtpController extends BaseController
{
    
    protected $mailOtp;

    /**
     * DriverNeededDocumentController constructor.
     *
     * @param \App\Models\Admin\DriverNeededDocument $neededDoc
     */
    public function __construct(MailOtp $mailOtp)
    {
        $this->mailOtp = $mailOtp;
    }

    public function index()
    {
        $page = trans('pages_names.otp');

        $main_menu = 'master';
        $sub_menu = 'otp';

        return view('admin.master.otp.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function fetch(QueryFilterContract $queryFilter)
    {
        $query = $this->mailOtp->query();//->active()
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

        return view('admin.master.otp._otp', compact('results'));
    }

  
}
