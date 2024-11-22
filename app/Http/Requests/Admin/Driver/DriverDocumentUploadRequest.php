<?php

namespace App\Http\Requests\Admin\Driver;

use App\Http\Requests\BaseRequest;

class DriverDocumentUploadRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identify_number'=>'sometimes|required',
            // 'expiry_date'=> $this->requiredDateRule(),
            'document'=> $this->needed_document->driverDocument()->where('driver_id', request()->driver->id)->exists() ? $this->driverDocumentRule() : 'required|'.$this->driverDocumentRule()
        ];
    }

    /**
     * Required date rule.
     *
     * @return string
     */
    protected function requiredDateRule()
    {
        return 'required|date_format:Y-m-d';
    }
}
