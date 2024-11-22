<?php

namespace App\Http\Requests\Taxi\TaxiStand;

use Illuminate\Foundation\Http\FormRequest;

class TaxiStandStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'service_location_id' => 'required',
            'zone' => 'required',
            'name' => 'required|unique:taxi_stands,name,NULL,id,deleted_at,NULL,service_location_id,'.$this->service_location_id.',zone_id,'.$this->zone,
            'coordinates' => 'required'
            // 'location' => 'required',
            // 'latitude' => 'required',
            // 'longitude' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'service_location_id.required' => 'Area is required',
            'coordinates.required' => 'Draw the area on map'
        ];
    }
}
