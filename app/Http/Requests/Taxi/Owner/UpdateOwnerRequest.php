<?php

namespace App\Http\Requests\Taxi\Owner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOwnerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => 'required|unique:owners,company_name,'.$this->owner->id.',id,deleted_at,NULL',
            'owner_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->owner->user->id,
            'mobile'=>'required|unique:users,mobile,'.$this->owner->user->id,
			'address'=>'required|min:10',
            
            'postal_code'=>'required|numeric',
			'city'=>'required',
            'service_location_id' => 'sometimes',
            'expiry_date' => 'sometimes|required',
            'no_of_vehicles' => 'required|numeric',
            'tax_number' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'ifsc' => 'required',
            'account_no' => 'required',
            'transport_type' => 'sometimes',
        ];
    }
}
