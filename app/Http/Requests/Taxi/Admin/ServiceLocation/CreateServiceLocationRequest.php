<?php

namespace App\Http\Requests\Taxi\Admin\ServiceLocation;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceLocationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:50|unique:service_locations,name,NULL,id,deleted_at,NULL',

            // 'service_location' => 'required',
            'coordinates' => 'required',
            // 'unit'=>'required|in:1,2',
        ];
    }

    public function messages()
    {
        return [
            'coordinates.required' => 'Draw the area on map'
        ];
    }
}
