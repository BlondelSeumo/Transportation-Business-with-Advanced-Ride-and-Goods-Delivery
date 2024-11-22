<?php
namespace App\Models\Admin;

use Carbon\Carbon;
use App\Base\Uuid\UuidModel;
use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZoneTypePackagePrice extends Model
{
    use HasActive, UuidModel,SoftDeletes;

     protected $table = 'zone_type_package_prices';

      protected $fillable = [
        'zone_type_id','base_price','package_type_id','distance_price_per_km','time_price_per_min','cancellation_fee','free_distance','free_min','zone_id'
    ];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [
        'zoneType','zoneType.zone'
    ];


    public function PackageName()
    {
    	return $this->hasOne(\App\Models\Master\PackageType::class, 'id','package_type_id');
    }

    /**
     * The zone type that belongs to.
     * @tested
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function zoneType()
    {
        return $this->belongsTo(ZoneType::class, 'zone_type_id', 'id');
    }
}
