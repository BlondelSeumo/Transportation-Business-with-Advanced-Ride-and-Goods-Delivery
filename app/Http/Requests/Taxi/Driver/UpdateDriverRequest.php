<?php

namespace App\Http\Requests\Taxi\Driver;

use App\Http\Requests\BaseRequest;

class UpdateDriverRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'email'=>'required|email|unique:users,email,'.$this->driver->user_id,
            // 'service_location_id' => 'required',
            // 'owner' => 'required',
            'name' => 'required|max:50',
            'surname' => 'required|max:50',
            'username' => 'required|unique:users,username,'.$this->driver->user_id,
            'mobile'=>'required|mobile_number|unique:users,mobile,'.$this->driver->user_id,
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
