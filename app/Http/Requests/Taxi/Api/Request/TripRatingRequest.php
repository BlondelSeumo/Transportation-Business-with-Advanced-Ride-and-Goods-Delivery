<?php

namespace App\Http\Requests\Taxi\Api\Request;

use Illuminate\Foundation\Http\FormRequest;

class TripRatingRequest extends FormRequest
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
            'rating'=>'required|decimal',
            'comment'=>'',
        ];
    }
}
