<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Base\Uuid\UuidModel;
use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasActiveCompanyKey;
use Nicolaslopezj\Searchable\SearchableTrait;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Zone extends Model
{
    use HasActive, UuidModel,SearchableTrait,HasActiveCompanyKey;
    use SpatialTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_location_id', 'name','unit','active','coordinates','default_vehicle_type','company_key','lat','lng','default_vehicle_type_for_delivery'
    ];
    protected $spatialFields = [
        'coordinates'
    ];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [
        'admin'
    ];

    /**
     * The admin that the uploaded image belongs to.
     * @tested
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    /**
     * The Zone has many bounds.
     * @tested
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function zoneBound()
    {
        return $this->hasOne(ZoneBound::class, 'zone_id', 'id');
    }


    /**
     * The Zone has many Types.
     * @tested
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function zoneType()
    {
        return $this->hasMany(ZoneType::class, 'zone_id', 'id')->orderBy('order_number');
    } 
   

    public function zoneSurge()
    {
        return $this->hasMany(ZoneSurgePrice::class, 'zone_id', 'id');
    }

    public function serviceLocation()
    {
        return $this->belongsTo(ServiceLocation::class, 'service_location_id', 'id');
    }

    /**
    * Get formated and converted timezone of user's created at.
    *
    * @param string $value
    * @return string
    */
    public function getConvertedCreatedAtAttribute()
    {
        if ($this->created_at==null||!auth()->user()->exists()) {
            return null;
        }
        $timezone = auth()->user()->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($this->created_at)->setTimezone($timezone)->format('jS M h:i A');
    }
    /**
    * Get formated and converted timezone of user's created at.
    *
    * @param string $value
    * @return string
    */
    public function getConvertedUpdatedAtAttribute()
    {
        if ($this->updated_at==null||!auth()->user()->exists()) {
            return null;
        }
        $timezone = auth()->user()->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($this->updated_at)->setTimezone($timezone)->format('jS M h:i A');
    }

    protected $searchable = [
        'columns' => [
            'zones.name' => 20,
            'service_locations.name'=> 20,
        ],
        'joins' => [
            'service_locations' => ['zones.service_location_id','service_locations.id'],
        ],
    ];
}
