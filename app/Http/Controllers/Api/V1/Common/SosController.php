<?php

namespace App\Http\Controllers\Api\V1\Common;

use App\Models\Admin\Sos;
use App\Http\Requests\Common\SosRequest;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group Sos-Apis
 *
 * APIs for Sos
 */
class SosController extends BaseController
{
    protected $sos;

    public function __construct(Sos $sos)
    {
        $this->sos = $sos;
    }

    /**
    * List Sos
    * @urlParam lat required double  latitude provided by user
    * @urlParam lng required double  longitude provided by user
    * @responseFile responses/common/sos.json
    */
    public function index()
    {
        $result = $this->sos
        ->select('id', 'name', 'number', 'user_type', 'created_by')
        ->where('created_by', auth()->user()->id)
        ->orWhere('user_type', 'admin')
        ->orderBy('created_at', 'Desc')
        ->companyKey()->get();

        return $this->respondSuccess($result, 'sos_list');
    }

    /**
    * Store Sos
     * @bodyParam name string required name of the user
     * @bodyParam number string required number of the user
     * @response {
    "success": true,
    "message": "sos_created"
}
    */
    public function store(SosRequest $request)
    {
        $sos =  Sos::where('created_by', auth()->user()->id)
                    ->count();

        if ($sos == 4) {
            $this->throwCustomException('You cant able to add more than 4 contacts');
        }

        $sos =  Sos::where('created_by', auth()->user()->id)
                ->where('number', $request->number)
                ->first();

        if ($sos) {
            $this->throwCustomException('Already added this Number');
        }

        $sos = new Sos;
        $sos->name = $request->name;
        $sos->number = $request->number;
        $sos->created_by = (int)auth()->user()->id;
        $sos->user_type = 'mobile-users';
        $sos->company_key = auth()->user()->company_key;
        $sos->active = true;

        $sos->save();

        return $this->respondSuccess(null, 'sos_created');
    }

    /**
    * Delete Sos
    * @urlParam id required uuid  id of sos
    * @response {
    "success": true,
    "message": "sos_deleted"
}
    */
    public function delete(Sos $sos)
    {
        if ($sos->created_by != auth()->user()->id) {
            $this->throwAuthorizationException();
        }

        $sos->delete();

        return $this->respondSuccess(null, 'sos_deleted');
    }
}
