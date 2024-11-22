<?php

namespace App\Http\Requests\Admin\Company;

use App\Http\Requests\BaseRequest;

class UpdateCompanyRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'icon'=>$this->companyImageRule(),
            'owner_name'=>'required|max:50',
            'vat_number'=>'required',
            'mobile'=>'required|mobile_number|unique:companies,mobile,'.$this->company->id,
            'landline'=>'required|numeric|unique:companies,landline,'.$this->company->id,
            'email'=>'required|email|unique:companies,email,'.$this->company->id,
            'address'=>'required|min:10',
            'postal_code'=>'required',
            'state'=>'max:100',
            'city'=>'required',
            'country'=>'required|exists:countries,id'

        ];
    }
}
