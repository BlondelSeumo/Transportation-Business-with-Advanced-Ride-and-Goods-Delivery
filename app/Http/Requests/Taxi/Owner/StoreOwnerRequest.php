<?php

namespace App\Http\Requests\Taxi\Owner;

use Illuminate\Foundation\Http\FormRequest;

class StoreOwnerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => 'required|unique:owners,company_name,NULL,id,deleted_at,NULL',
            'owner_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile'=>'required|unique:users,mobile',
            'password'=>'required|min:8|max:32|confirmed',
			'address'=>'required|min:10',
            'postal_code'=>'required|numeric',
			'city'=>'required',
            'service_location_id' => 'sometimes',
            'expiry_date.*' => 'required',
            'no_of_vehicles' => 'required|numeric',
            'tax_number' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'ifsc' => 'required',
        ];
    }
}
