<?php

namespace App\Http\Requests\Master;

use App\Http\Requests\BaseRequest;

class MobileBuildRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'build'=>'required',
            'project_id'=>'required|exists:projects,id',
            'team'=>'required',
            'version'=>'required'
        ];
    }
}
