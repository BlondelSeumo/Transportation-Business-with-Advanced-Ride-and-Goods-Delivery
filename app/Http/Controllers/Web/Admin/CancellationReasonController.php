<?php

namespace App\Http\Controllers\Web\Admin;

use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Cancellation\CreateCancellationReasonRequest;
use App\Models\Admin\CancellationReason;
use Illuminate\Http\Request;

class CancellationReasonController extends Controller
{
    protected $reason;

    /**
     * FaqController constructor.
     *
     * @param \App\Models\Admin\CancellationReason $reason
     */
    public function __construct(CancellationReason $reason)
    {
        $this->reason = $reason;
    }

    public function index()
    {
        $page = trans('pages_names.view_cancellation_reason');

        $main_menu = 'cancellation-reason';
        $sub_menu = '';

        return view('admin.cancellation.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function fetch(QueryFilterContract $queryFilter)
    {
        $app_for = config('app.app_for');

        $query = $this->reason->query();
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

        return view('admin.cancellation._cancellation', compact('results','app_for'));
    }

    public function create()
    {
        $page = trans('pages_names.add_cancellation_reason');
        $main_menu = 'cancellation-reason';
        $sub_menu = '';
        $app_for = config('app.app_for');

        return view('admin.cancellation.create', compact('page', 'main_menu', 'sub_menu','app_for'));
    }

    public function store(CreateCancellationReasonRequest $request)
    {
        $created_params = $request->only(['payment_type', 'arrival_status','reason','user_type']);

       if($request->has('transport_type'))
        {
        $created_params['transport_type'] = $request->transport_type;
            
        }
        // $created_params['company_key'] = auth()->user()->company_key;

        $this->reason->create($created_params);

        $message = trans('succes_messages.cancellation_reason_added_succesfully');

        return redirect('cancellation')->with('success', $message);
    }

    public function getById(CancellationReason $reason)
    {
        $page = trans('pages_names.edit_cancellation_reason');
        $main_menu = 'cancellation-reason';
        $sub_menu = '';
        $item = $reason;
        $app_for = config('app.app_for');

        return view('admin.cancellation.update', compact('item', 'page', 'main_menu', 'sub_menu','app_for'));
    }

    public function update(CreateCancellationReasonRequest $request, CancellationReason $reason)
    {
        $updated_params = $request->all();
        $reason->update($updated_params);

        $message = trans('succes_messages.cancellation_reason_updated_succesfully');

        return redirect('cancellation')->with('success', $message);
    }

    public function toggleStatus(CancellationReason $reason)
    {
        $status = $reason->isActive() ? false: true;
        $reason->update(['active' => $status]);

        $message = trans('succes_messages.cancellation_reason_status_changed_succesfully');

        return redirect('cancellation')->with('success', $message);
    }

    public function delete(CancellationReason $reason)
    {
        $reason->delete();

        $message = trans('succes_messages.cancellation_reason_deleted_succesfully');

        return redirect('cancellation')->with('success', $message);
    }
}
