<?php

namespace App\Http\Requests\Common;

use App\Http\Requests\BaseRequest;

class SubscriberRequest extends BaseRequest
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
            'email' => 'required|email|unique:subscribers,email',
            'status' => 'required|boolean',
        ];
    }
}
