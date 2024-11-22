<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class GenericLoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

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

            'email' => 'required|email|exists:users,email',
            'password' => 'required',

        ];
    }
}
