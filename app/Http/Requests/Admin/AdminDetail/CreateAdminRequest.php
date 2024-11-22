<?php

namespace App\Http\Requests\Admin\AdminDetail;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:50',
            // 'last_name' => 'required|max:50',
            'mobile'=>'required|mobile_number|unique:users,mobile',
            'email'=>'required|email|unique:users,email',
            'address'=>'required|min:10',
            'state'=>'max:100',
            'city'=>'required',
            'country'=>'required|exists:countries,id',
            'service_location_id' => 'sometimes',
            'role' => 'required',
            'postal_code'=>'required|numeric',
            'password'=>'required|min:8|max:32|confirmed'
        ];
    }
}
