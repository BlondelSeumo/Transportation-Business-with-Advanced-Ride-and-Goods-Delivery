<?php

namespace App\Models\Admin;

use App\Base\Uuid\UuidModel;
use App\Models\Traits\HasActive;
use App\Models\Admin\ServiceLocation;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasActiveCompanyKey;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use UuidModel,HasActive,HasActiveCompanyKey;
    // ,SoftDeletes;

    protected $fillable = [
        'service_location_id','question','answer','user_type','active','company_key',
    ];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [
        'serviceLocation','serviceLocation.zones'
    ];

    public function serviceLocation()
    {
        return $this->belongsTo(ServiceLocation::class, 'service_location_id', 'id');
    }
}
