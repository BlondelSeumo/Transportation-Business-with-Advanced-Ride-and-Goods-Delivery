<?php

namespace App\Http\Requests\Request;

use App\Http\Requests\BaseRequest;

class DriverEndRequest extends BaseRequest
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
            'distance'=>'required|double',
            'before_arrival_waiting_time'=>'required',
            'after_arrival_waiting_time'=>'required',
            'drop_lat'=>'required',
            'drop_lng'=>'required',
            'drop_address'=>'required'
        ];
    }
}
