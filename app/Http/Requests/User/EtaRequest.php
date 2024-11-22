<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class EtaRequest extends BaseRequest
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
            'drop_lat'  =>'sometimes|required',
            'drop_lng'  =>'sometimes|required',
            'vehicle_type'=>'sometimes|required|uuid|exists:zone_types,id',
            'ride_type'=>'required|in:1',
            'drivers'=>'sometimes|required',
            'promo_code'=>'sometimes|required|exists:promo,code',
        ];
    }
}
