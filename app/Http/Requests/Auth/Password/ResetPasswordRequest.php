<?php

namespace App\Http\Requests\Auth\Password;

use App\Http\Requests\BaseRequest;

class ResetPasswordRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token'     => 'sometimes|required',
            'email'     => 'sometimes|required|email|exists:users,email,active,1',
            'mobile'=>'sometimes|required|mobile_number|exists:users,mobile',
            'country'=>'sometimes|required',
            'password'  => 'required|min:6|confirmed',
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
            'email.exists' => 'The password reset token is invalid or has expired.',
        ];
    }
}
