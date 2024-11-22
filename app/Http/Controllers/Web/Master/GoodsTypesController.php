<?php

namespace App\Http\Controllers\Web\Master;

use Illuminate\Http\Request;
use App\Models\Master\GoodsType;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Web\BaseController;
use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;

class GoodsTypesController extends BaseController
{
    protected $goods_type;

    /**
     * GoodsTypesController constructor.
     *
     * @param \App\Models\Admin\GoodsType $goods_type
     */
    public function __construct(GoodsType $goods_type)
    {
        $this->make = $goods_type;
    }

    public function index()
    {
        $page = trans('pages_names.view_goods_type');

        $main_menu = 'master';
        $sub_menu = 'goods_type';

        return view('admin.master.goods-types.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function fetch(QueryFilterContract $queryFilter)
    {
        $query = $this->make->query();//->active()
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

        return view('admin.master.goods-types._goods_types', compact('results'));
    }

    public function create()
    {
        $page = trans('pages_names.add_goods_type');

        $main_menu = 'master';
        $sub_menu = 'goods_type';

        return view('admin.master.goods-types.create', compact('page', 'main_menu', 'sub_menu'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'goods_type_name' => 'required|unique:goods_types,goods_type_name' ,
            'goods_types_for' => 'required'
        ])->validate();

        $created_params = $request->only(['goods_type_name','goods_types_for']);
        $created_params['active'] = 1;

        // $created_params['company_key'] = auth()->user()->company_key;

        $this->make->create($created_params);

        $message = trans('succes_messages.goods_type_added_succesfully');

        return redirect('goods-types')->with('success', $message);
    }

    public function getById(GoodsType $goods_type)
    {
        $page = trans('pages_names.edit_goods_type');

        $main_menu = 'master';
        $sub_menu = 'goods_type';
        $item = $goods_type;

        return view('admin.master.goods-types.update', compact('item', 'page', 'main_menu', 'sub_menu'));
    }

    public function update(Request $request, GoodsType $goods_type)
    {
        Validator::make($request->all(), [
            'goods_type_name' => 'required|unique:goods_types,goods_type_name,'.$goods_type->id ,
            'goods_types_for' => 'required'
        ])->validate();

        $updated_params = $request->all();
        $goods_type->update($updated_params);
        $message = trans('succes_messages.goods_type_updated_succesfully');
        return redirect('goods-types')->with('success', $message);
    }

    public function toggleStatus(GoodsType $goods_type)
    {
        $status = $goods_type->isActive() ? false: true;
        $goods_type->update(['active' => $status]);

        $message = trans('succes_messages.goods_type_status_changed_succesfully');
        return redirect('goods-types')->with('success', $message);
    }

    public function delete(GoodsType $goods_type)
    {
        $goods_type->delete();

        $message = trans('succes_messages.goods_type_deleted_succesfully');
        return redirect('goods-types')->with('success', $message);
    }
}
