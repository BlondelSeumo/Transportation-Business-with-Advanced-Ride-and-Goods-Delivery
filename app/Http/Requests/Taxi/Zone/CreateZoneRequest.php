<?php

namespace App\Http\Requests\Taxi\Zone;

use Illuminate\Foundation\Http\FormRequest;

class CreateZoneRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50|unique:zones,name',
            // 'unit'=>'required|in:1,2',
            'service_location_id' => 'required',
            'coordinates' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'service_location_id.required' => 'Select the area',
            'coordinates.required' => 'Draw the area on map'
        ];
    }
}
