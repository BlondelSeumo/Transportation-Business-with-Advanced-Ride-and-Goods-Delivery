<?php

namespace App\Http\Controllers\Api\V1\Common;

use Illuminate\Http\Request;
use App\Models\Admin\Complaint;
use App\Base\Constants\Auth\Role;
use App\Models\Admin\ComplaintTitle;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Http\Controllers\Api\V1\BaseController;
use App\Base\Constants\Masters\ComplaintType;

/**
 * @group Complaints apis
 *
 * APIs for Complaints
 */
class ComplaintsController extends BaseController
{

    /**
    * List complaint titles
    * @queryParam complaint_type string required complaint type for the complaint request
    * @response {
    "success": true,
    "message": "complaint_titles_listed",
    "data": [
        {
            "id": "e5cf4a77-93ee-48fd-b889-6dcf4b7041e3",
            "user_type": "user",
            "title":"test-title",
            "complaint_type":"general",
            "active": 1,
            "created_at": "2020-08-31 18:13:18",
            "updated_at": "2020-08-31 18:13:18",
            "deleted_at": null
        }
    ]
    }
    */
    public function index()
    {
        if (access()->hasRole(Role::USER)) {
            $user_type = 'user';
        } elseif(access()->hasRole(Role::DRIVER)) {
            $user_type = 'driver';
        }else{
            $user_type = 'owner';
        }

        $complaint_type='general';

        if (request()->complaint_type=='request') {
            $complaint_type = 'request_help';
        }

        $result = ComplaintTitle::where('user_type', $user_type)->where('complaint_type', $complaint_type)->get();


        if(request()->has('transport_type')){

            $transport_type = request()->transport_type;

            $result = ComplaintTitle::where('user_type', $user_type)->where('complaint_type', $complaint_type)->get();
        }


        return $this->respondSuccess($result, 'complaint_titles_listed');
    }

    /**
    * Make Complaints
    * @bodyParam complaint_title_id integer required id of complaint titles
    * @bodyParam description string required description of complaints
    * @bodyParam request_id uuid optional request id for complaint against the request
    * @response {
    * "success": true,
    * "message": "complaint_posted_successfully",
    * }
    * @return \Illuminate\Http\JsonResponse
    */
    public function makeComplaint(Request $request)
    {
        // Validate params
        $request->validate([
        'complaint_title_id' => 'required|exists:complaint_titles,id',
        'description'=>'required|min:10',
        'request_id'=>'sometimes|required|exists:requests,id'
        ]);

        $created_params = $request->all();
        if ($request->request_id) {
            $created_params['complaint_type'] = 'request_help';
        }
        if (access()->hasRole(Role::USER)) {
            $created_params['user_id'] = auth()->user()->id;
        }elseif(access()->hasRole(Role::DRIVER)) {
            $created_params['driver_id'] = auth()->user()->driver->id;
        }else{
            $created_params['owner_id'] = auth()->user()->owner->id;

        }

        $created_params['status'] = ComplaintType::NEW_COMPLAINT;
        
        $taxi_complaint = Complaint::create($created_params);

        return $this->respondSuccess($data=null, 'complaint_posted_successfully');
    }
}
