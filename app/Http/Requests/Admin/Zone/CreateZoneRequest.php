<?php

namespace App\Http\Requests\Admin\Zone;

use App\Http\Requests\BaseRequest;

class CreateZoneRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' => 'required|max:50|unique:zones,name',
            // 'unit'=>'required|in:1,2'

        ];
    }
}
