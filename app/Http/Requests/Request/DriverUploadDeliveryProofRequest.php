<?php

namespace App\Http\Requests\Request;

use App\Http\Requests\BaseRequest;

class DriverUploadDeliveryProofRequest extends BaseRequest
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
            'after_load'=>'sometimes|required|boolean|in:0,1',
            'after_unload'=>'sometimes|required|boolean|in:0,1',
            'proof_image'=>$this->requestDeliveryProofRule()

        ];
    }
}
