<?php

namespace App\Http\Requests\Taxi\CancellationReason;

use Illuminate\Foundation\Http\FormRequest;

class CreateCancellationReasonRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'service_location_id' => 'required',
            'paying_status' => 'required',
            'reason.*' => 'required',
            'arrive_status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'reason.*.required' => 'Reason is required',
            'service_location_id.required' => 'Area name is required'
        ];
    }
}
