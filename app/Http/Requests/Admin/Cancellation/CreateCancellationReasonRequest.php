<?php

namespace App\Http\Requests\Admin\Cancellation;

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
            'user_type' => 'required',
            'transport_type' => 'sometimes|required',
            'payment_type' => 'required',
            'arrival_status' => 'required',
            'reason' => 'required|min:5'
        ];
    }
}
