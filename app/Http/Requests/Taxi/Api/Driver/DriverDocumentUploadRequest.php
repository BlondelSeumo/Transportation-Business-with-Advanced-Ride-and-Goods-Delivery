<?php

namespace App\Http\Requests\Taxi\Api\Driver;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Admin\DriverNeededDocument;

class DriverDocumentUploadRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $driver_document = DriverNeededDocument::find($this->document_id);
        $rules = [
            'document_id'=>'required|exists:driver_needed_documents,id',
            'identify_number'=>'',
            // 'expiry_date' => request()->has('expiry_date') ? $this->requiredDateRule() : '',
            'document'=>'required|'.$this->driverDocumentRule()
        ];
        if ($driver_document->has_identify_number) {
            $rules['identify_number'] = 'required';
        }
        return $rules;
    }

    /**
     * Required date rule.
     *
     * @return string
     */
    protected function requiredDateRule()
    {
        return 'sometimes|required|date_format:Y-m-d H:i:s';
    }
}
