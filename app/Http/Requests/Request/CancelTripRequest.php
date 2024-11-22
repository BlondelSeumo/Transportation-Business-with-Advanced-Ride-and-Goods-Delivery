<?php

namespace App\Http\Requests\Request;

use App\Http\Requests\BaseRequest;

class CancelTripRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'request_id'=>'required|exists:requests,id',
            'reason'=>'sometimes|required',
            'custom_reason'=>'sometimes|required|min:2|max:100',
        ];
    }
}
