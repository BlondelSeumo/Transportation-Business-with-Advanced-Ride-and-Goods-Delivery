<?php

namespace App\Models\Admin;

use App\Base\Uuid\UuidModel;
use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasActiveCompanyKey;

class CancellationReason extends Model
{
    use UuidModel,HasActive,HasActiveCompanyKey;

    protected $fillable = [
        'user_type','payment_type','arrival_status','reason','active','company_key','transport_type'
    ];
}
