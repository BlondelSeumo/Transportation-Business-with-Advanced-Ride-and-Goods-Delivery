<?php

namespace App\Http\Requests\Admin\Flavour;

use Illuminate\Foundation\Http\FormRequest;

class FlavourUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {       

        return [
            
            'flavour_name' => 'required|min:5|max:50|unique:project_flavours,flavour_name,'.$this->projectflavour->id.',',
            'app_name' => 'required|min:5|max:50|',
            'bundle_identifier' => 'required|min:5|max:50|',
        ];
    }
}
