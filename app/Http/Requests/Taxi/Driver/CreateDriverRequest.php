<?php

namespace App\Http\Requests\Taxi\Driver;

use App\Http\Requests\BaseRequest;

class CreateDriverRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'service_location_id' => 'required',
            // 'owner' => 'required',
            'name' => 'required|max:50',
            'surname' => 'required|max:50',
            'username' => 'required|unique:users,username',
            'mobile'=>'required|mobile_number|unique:users,mobile',
            // 'password'=>'required|min:8|max:32|confirmed',
            'address'=>'required|min:10',
            'street'=>'required|max:100',
            'house_number'=>'required',
            'postal_code'=>'required|numeric',
            'state'=>'required',
            'country'=>'required|exists:countries,id'
        ];
    }

    public function messages()
    {
        return [
            'service_location_id.required' => 'Area field is required'
        ];
    }
}
