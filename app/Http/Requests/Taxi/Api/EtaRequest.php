<?php

namespace App\Http\Requests\Taxi\Api;

use Illuminate\Foundation\Http\FormRequest;

class EtaRequest extends FormRequest
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
            'drop_lat'  =>'required',
            'drop_lng'  =>'required',
            'vehicle_type'=>'required|uuid|exists:vehicle_types,id',
            'ride_type'=>'required|in:1',
            'drivers'=>'sometimes|required'
        ];
    }
}
