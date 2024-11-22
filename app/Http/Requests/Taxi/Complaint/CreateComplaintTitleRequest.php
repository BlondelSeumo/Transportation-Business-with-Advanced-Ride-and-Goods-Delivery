<?php

namespace App\Http\Requests\Taxi\Complaint;

use Illuminate\Foundation\Http\FormRequest;

class CreateComplaintTitleRequest extends FormRequest
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
            'complaint_type' => 'required',
            'title' => 'required||min:10|max:100|unique:complaint_titles,title,NULL,id,deleted_at,NULL,service_location,'.$this->service_location_id.',user_type,'.$this->user_type
        ];
    }

    public function messages()
    {
        return [
            'service_location_id.required' => 'Area name is required'
        ];
    }
}
