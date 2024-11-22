<?php

namespace App\Http\Requests\Taxi\Api\Request;

use Illuminate\Foundation\Http\FormRequest;

class CancelTripRequest extends FormRequest
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
            'reason'=>'sometimes|required|exists:cancellation_reasons,id',
            'custom_reason'=>'sometimes|required|min:5|max:100',
        ];
    }
}
