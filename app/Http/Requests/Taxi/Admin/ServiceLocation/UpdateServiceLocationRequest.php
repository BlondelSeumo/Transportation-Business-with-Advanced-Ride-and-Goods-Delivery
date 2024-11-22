<?php

namespace App\Http\Requests\Taxi\Admin\ServiceLocation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceLocationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:50|unique:service_locations,name,'.$this->service_location->id.',id,deleted_at,NULL',

            'coordinates' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'coordinates.required' => 'Draw the area on map'
        ];
    }
}
