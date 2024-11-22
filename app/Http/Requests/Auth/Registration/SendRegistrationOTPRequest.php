<?php

namespace App\Http\Requests\Auth\Registration;

use App\Http\Requests\BaseRequest;

class SendRegistrationOTPRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country' => 'required|exists:countries,dial_code',
            'mobile' => 'required',
            'email'=>'sometimes|required'
        ];
    }
}
