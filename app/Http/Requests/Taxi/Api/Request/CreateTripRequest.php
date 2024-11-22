<?php

namespace App\Http\Requests\Taxi\Api\Request;

use Illuminate\Foundation\Http\FormRequest;

class CreateTripRequest extends FormRequest
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
            'vehicle_type'=>'required|exists:vehicle_types,id',
            'payment_opt'=>'required|in:0,1,2',
            'pick_address'=>'required',
            'drop_address'=>'sometimes|required',
            'drivers'=>'sometimes|required',
            'is_ride_for_others' => 'sometimes|required',
            'rider_name' => request()->is_ride_for_others ? 'required' : '',
            'rider_mobile' => request()->is_ride_for_others ? 'required' : '',
        ];
    }
}
