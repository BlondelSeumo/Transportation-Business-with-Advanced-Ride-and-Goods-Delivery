<?php

namespace App\Http\Requests\Taxi\VehicleType;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleTypeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50|unique:vehicle_types,name,'.$this->vehicle_type->id,
            'icon' => $this->vechicleTypeImageRule(),
            'capacity' => 'required|min:1|max:15',
            'luggage_capacity' => 'required|min:1|max:8'
        ];
    }
}
