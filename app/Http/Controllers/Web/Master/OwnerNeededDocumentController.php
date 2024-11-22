<?php

namespace App\Http\Controllers\Web\Master;

use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Http\Controllers\Web\BaseController;
use App\Models\Admin\OwnerNeededDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OwnerNeededDocumentController extends BaseController
{
    
    protected $neededDoc;
    protected $doctypes = ['jpg','png','doc','pdf'];

    /**
     * DriverNeededDocumentController constructor.
     *
     * @param \App\Models\Admin\DriverNeededDocument $neededDoc
     */
    public function __construct(OwnerNeededDocument $neededDoc)
    {
        $this->neededDoc = $neededDoc;
    }

    public function index()
    {
        $page = trans('pages_names.view_needed_document');

        $main_menu = 'master';
        $sub_menu = 'owner_needed_document';

        return view('admin.master.owner_needed_doc.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function fetch(QueryFilterContract $queryFilter)
    {
        $query = $this->neededDoc->query();//->active()
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

        return view('admin.master.owner_needed_doc._document', compact('results'));
    }

    public function create()
    {
        $page = trans('pages_names.add_owner_needed_doc');

        $main_menu = 'master';
        $sub_menu = 'owner_needed_document';
        $format = $this->doctypes;

        return view('admin.master.owner_needed_doc.create', compact('page', 'main_menu', 'sub_menu','format'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:owner_needed_documents,name'
        ])->validate();

        $created_params = $request->only(['name','has_expiry_date','has_identify_number']);

        if($request->has_identify_number){
            $created_params['identify_number_locale_key'] = $request->identify_number_locale_key;
        }else{
            $created_params['identify_number_locale_key'] = null;
        }

        $created_params['active'] = 1;

        $this->neededDoc->create($created_params);

        $message = trans('succes_messages.owner_needed_doc_added_succesfully');

        return redirect('owner_needed_doc')->with('success', $message);
    }

    public function getById(OwnerNeededDocument $neededDoc)
    {
        $page = trans('pages_names.edit_needed_doc');

        $main_menu = 'master';
        $sub_menu = 'owner_needed_document';
        $item = $neededDoc;
        $format = $this->doctypes;

        return view('admin.master.owner_needed_doc.update', compact('item', 'page', 'main_menu', 'sub_menu','format'));
    }

    public function update(Request $request, OwnerNeededDocument $neededDoc)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:owner_needed_documents,name,'.$neededDoc->id
        ])->validate();

        $updated_params = $request->only(['name','has_expiry_date','has_identify_number']);

        if($request->has_identify_number){
            $updated_params['identify_number_locale_key'] = $request->identify_number_locale_key;
        }else{
            $updated_params['identify_number_locale_key'] = null;
        }

        $neededDoc->update($updated_params);

        $message = trans('succes_messages.owner_needed_doc_updated_succesfully');

        return redirect('owner_needed_doc')->with('success', $message);
    }

    public function toggleStatus(OwnerNeededDocument $neededDoc)
    {
        $status = $neededDoc->isActive() ? false: true;
        $neededDoc->update(['active' => $status]);

        $message = trans('succes_messages.owner_needed_doc_status_changed_succesfully');
        return redirect('owner_needed_doc')->with('success', $message);
    }

    public function delete(OwnerNeededDocument $neededDoc)
    {
        $neededDoc->delete();

        $message = trans('succes_messages.owner_needed_doc_deleted_succesfully');
        return redirect('owner_needed_doc')->with('success', $message);
    }
}
