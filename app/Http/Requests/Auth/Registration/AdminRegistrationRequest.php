<?php

namespace App\Http\Requests\Auth\Registration;

use App\Http\Requests\BaseRequest;

class AdminRegistrationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:50',
            'last_name'=>'required|max:50',
            'address'=>'min:10',
            'country'=>'required|exists:countries,id',
            'timezone'=>'required|exists:time_zones,id',
            'emergency_contact'=>'mobile_number',
            'email' => 'required|email|max:150|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'mobile' => 'required|mobile_number|unique:users,mobile',
            'area_name'=>'required',
            'pincode'=>'required|min:3|max:8',
            'role'=>'required|exists:roles,slug'
        ];
    }
}
