<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class UserLoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'     => 'sometimes|required|email|exists:users,email',
            'password'  => 'sometimes|required',
            'mobile'    => 'sometimes|required|mobile_number|exists:users,mobile',
            'otp'       => 'sometimes|required|otp',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'mobile.exists' => "User with that mobile number doesn't exist.",
        ];
    }
}
