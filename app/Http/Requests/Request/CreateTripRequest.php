<?php

namespace App\Http\Requests\Request;

use App\Http\Requests\BaseRequest;

class CreateTripRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pick_lat'  => 'required',
            'pick_lng'  => 'required',
            // 'drop_lat'  =>'sometimes|required',
            // 'drop_lng'  =>'sometimes|required',
            'vehicle_type'=>'sometimes|required|exists:zone_types,id',
            'payment_opt'=>'sometimes|required|in:0,1,2',
            'pick_address'=>'required',
            // 'drop_address'=>'sometimes|required',
            'drivers'=>'sometimes|required',
            'is_later'=>'sometimes|required|in:1',
            'trip_start_time'=>'sometimes|required|date_format:Y-m-d H:i:s',
            'promocode_id'=>'sometimes|required|exists:promo,id',
            'transport_type'=>'sometimes|required',
        ];
    }
}
