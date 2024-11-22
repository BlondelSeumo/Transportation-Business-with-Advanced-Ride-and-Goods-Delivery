<?php

namespace App\Http\Requests\Admin\FleetDriver;

use App\Http\Requests\BaseRequest;

class UpdateFleetDriverRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'mobile'=>'required|mobile_number|min:8',
            'email'=>'required|email',
            'transport_type'=>'required',
            // 'address'=>'required|min:10',
            // 'state'=>'max:100',
            // 'city'=>'required',
            // 'country'=>'required|exists:countries,id',
            // 'gender'=>'required|in:male,female,others',
            // 'is_company_driver' => 'sometimes|required|in:0,1',
            'company'=>'sometimes',
            'type' => 'sometimes|required',
            'owner_id' => 'required',


        ];
    }
}
