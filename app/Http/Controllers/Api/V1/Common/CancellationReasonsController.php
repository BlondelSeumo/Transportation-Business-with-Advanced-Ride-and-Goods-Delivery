<?php

namespace App\Http\Controllers\Api\V1\Common;

use App\Base\Constants\Auth\Role;
use App\Models\Admin\CancellationReason;
use App\Http\Controllers\Api\V1\BaseController;
use App\Base\Filters\Admin\CancellationReasonsFilter;
use App\Transformers\Requests\CancellationReasonsTransformer;

/**
 * @group Cancellation Management
 *
 * APIs for User & cancellations
 */
class CancellationReasonsController extends BaseController
{
    protected $cancellation_reasons;

    public function __construct(CancellationReason $cancellation_reasons)
    {
        $this->cancellation_reasons = $cancellation_reasons;
    }

    /**
    * List Cancellation Reasons
    * @urlParam arrived required arrived status of the trip request. the value must be after/before
    * @response {
    "success": true,
    "message": "cancellation_reasons_listed",
    "data": [
        {
            "id": "e5cf4a77-93ee-48fd-b889-6dcf4b7041e3",
            "user_type": "user",
            "payment_type": "free",
            "arrival_status": "before",
            "reason": "test-reason",
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
        $user_type = access()->hasRole(Role::USER)?'user':'driver';

        $transport_type = request()->transport_type;
       
        $app_for = config('app.app_for');

        if($app_for=='taxi' || $app_for=='delivery')
        {
        $query = $this->cancellation_reasons->where('user_type', $user_type);

        }else{

        $query = $this->cancellation_reasons->where('user_type', $user_type)->where(function($query)    use($transport_type){
                    $query->where('transport_type',$transport_type)->orWhere('transport_type','both');
                });
            
        }


        $result=filter($query, new CancellationReasonsTransformer, new CancellationReasonsFilter)->get();

        return $this->respondSuccess($result, 'cancellation_reasons_listed');
    }
}
