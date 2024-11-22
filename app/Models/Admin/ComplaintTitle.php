<?php

namespace App\Models\Admin;

use App\Base\Uuid\UuidModel;
use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasActiveCompanyKey;

class ComplaintTitle extends Model
{
    use HasActive,UuidModel,HasActiveCompanyKey;

    protected $fillable = [
        'user_type','title','complaint_type','active','company_key',
    ];
}
