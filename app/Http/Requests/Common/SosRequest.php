<?php

namespace App\Http\Requests\Common;

use App\Http\Requests\BaseRequest;

class SosRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'number' => 'required',
        ];
    }
}
