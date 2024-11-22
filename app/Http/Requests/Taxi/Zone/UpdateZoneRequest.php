<?php

namespace App\Http\Requests\Taxi\Zone;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class UpdateZoneRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $route = Route::currentRouteName();
        return [
            'name' => 'required|max:50|unique:zones,name,'.$this->zone->id,
            // 'unit'=>'required|in:1,2',
            'service_location_id' => $route == 'updateZoneSettings' ? '' : 'required',
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
