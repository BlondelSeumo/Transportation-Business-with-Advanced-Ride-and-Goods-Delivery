<?php

namespace App\Http\Requests\Admin\VehicleTypes;

use App\Http\Requests\BaseRequest;

class CreateVehicleTypeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            // 'icon'=>$this->vechicleTypeImageRule(),
            'capacity'=>'sometimes|min:1',
            'maximum_weight_can_carry'=>'sometimes|min:1',
            'size'=>'sometimes|min:1',
            'description'=>'required|max:25',
            'short_description'=>'required|max:25',
            'supported_vehicles'=>'required',
            'icon_types_for' => 'required',
            // 'is_accept_share_ride'=>'required|boolean',
            'trip_dispatch_type'=>'sometimes',

        ];
    }
}
