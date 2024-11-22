<?php

namespace App\Http\Controllers\Web\Admin;

use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Admin\Faq\CreateFaqRequest;
use App\Models\Admin\Faq;
use App\Models\Admin\ServiceLocation;
use Illuminate\Http\Request;

class FaqController extends BaseController
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

        return view('admin.faq.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function fetch(QueryFilterContract $queryFilter)
    {
        $query = $this->faq->companyKey()->active();
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

        return view('admin.faq._faq', compact('results'));
    }

    public function create()
    {
        $page = trans('pages_names.add_faq');
        $cities = ServiceLocation::companyKey()->whereActive(true)->get();
        $main_menu = 'faq';
        $sub_menu = '';

        return view('admin.faq.create', compact('cities', 'page', 'main_menu', 'sub_menu'));
    }

    public function store(CreateFaqRequest $request)
    {
        $created_params = $request->only(['service_location_id', 'question','answer','user_type']);
        $created_params['active'] = 1;

        $created_params['company_key'] = auth()->user()->company_key;

        $this->faq->create($created_params);

        $message = trans('succes_messages.faq_added_succesfully');

        return redirect('faq')->with('success', $message);
    }

    public function getById(Faq $faq)
    {
        $page = trans('pages_names.edit_faq');
        $cities = ServiceLocation::companyKey()->whereActive(true)->get();
        $main_menu = 'faq';
        $sub_menu = '';
        $item = $faq;

        return view('admin.faq.update', compact('cities', 'item', 'page', 'main_menu', 'sub_menu'));
    }

    public function update(CreateFaqRequest $request, Faq $faq)
    {
        $updated_params = $request->all();
        $faq->update($updated_params);
        $message = trans('succes_messages.faq_updated_succesfully');
        return redirect('faq')->with('success', $message);
    }

    public function toggleStatus(Faq $faq)
    {
        $status = $faq->isActive() ? false: true;
        $faq->update(['active' => $status]);

        $message = trans('succes_messages.faq_status_changed_succesfully');
        return redirect('faq')->with('success', $message);
    }

    public function delete(Faq $faq)
    {
        $faq->delete();

        $message = trans('succes_messages.faq_deleted_succesfully');
        return redirect('faq')->with('success', $message);
    }
}
