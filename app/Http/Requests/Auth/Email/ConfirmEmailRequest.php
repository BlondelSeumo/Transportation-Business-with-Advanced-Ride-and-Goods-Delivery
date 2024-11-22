<?php

namespace App\Http\Requests\Auth\Email;

use App\Http\Requests\BaseRequest;

class ConfirmEmailRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
        ];
    }
}
