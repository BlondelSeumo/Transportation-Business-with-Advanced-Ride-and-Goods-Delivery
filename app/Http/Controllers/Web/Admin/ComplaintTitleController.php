<?php

namespace App\Http\Controllers\Web\Admin;

use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Complaint\CreateComplaintTitleRequest;
use App\Models\Admin\ComplaintTitle;
use Illuminate\Http\Request;

class ComplaintTitleController extends Controller
{
    protected $complaintTitle;

    /**
     * FaqController constructor.
     *
     * @param \App\Models\Admin\ComplaintTitle $complaintTitle
     */
    public function __construct(ComplaintTitle $complaintTitle)
    {
        $this->complaintTitle = $complaintTitle;
    }

    public function index()
    {
        $page = trans('pages_names.view_complaint_title');

        $main_menu = 'complaints';
        $sub_menu = 'complaint-title';

        return view('admin.complaints.title.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function fetch(QueryFilterContract $queryFilter)
    {
        $query = $this->complaintTitle->companyKey();
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

        return view('admin.complaints.title._title', compact('results'));
    }

    public function create()
    {
        $page = trans('pages_names.add_complaint_title');
        $main_menu = 'complaints';
        $sub_menu = 'complaint-title';

        return view('admin.complaints.title.create', compact('page', 'main_menu', 'sub_menu'));
    }

    public function store(CreateComplaintTitleRequest $request)
    {
// dd($request);

        $created_params = $request->only(['title','user_type','complaint_type',]);

        $created_params['company_key'] = auth()->user()->company_key;

        $this->complaintTitle->create($created_params);

        $message = trans('succes_messages.complaint_title_added_succesfully');

        return redirect('complaint/title')->with('success', $message);
    }

    public function getById(ComplaintTitle $title)
    {
        $page = trans('pages_names.edit_complaint_title');
        $main_menu = 'complaints';
        $sub_menu = 'complaint-title';
        $item = $title;

        return view('admin.complaints.title.update', compact('item', 'page', 'main_menu', 'sub_menu'));
    }

    public function update(CreateComplaintTitleRequest $request, ComplaintTitle $title)
    {
     
        $updated_params = $request->all();
// dd($updated_params);
        
        $title->update($updated_params);

        $message = trans('succes_messages.complaint_title_updated_succesfully');

        return redirect('complaint/title')->with('success', $message);
    }

    public function toggleStatus(ComplaintTitle $title)
    {
        $status = $title->isActive() ? false: true;
        $title->update(['active' => $status]);

        $message = trans('succes_messages.complaint_title_status_changed_succesfully');

        return redirect('complaint/title')->with('success', $message);
    }

    public function delete(ComplaintTitle $title)
    {
        $title->delete();

        $message = trans('succes_messages.complaint_title_deleted_succesfully');

        return redirect('complaint/title')->with('success', $message);
    }
}
