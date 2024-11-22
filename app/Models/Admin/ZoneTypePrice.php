<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use App\Base\Uuid\UuidModel;
use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class ZoneTypePrice extends Model
{
    use HasActive, UuidModel,SoftDeletes,SearchableTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zone_type_price';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'zone_type_id','base_price','price_per_distance','waiting_charge','price_per_time','cancellation_fee','base_distance','price_type','active','free_waiting_time_in_mins_before_trip_start','free_waiting_time_in_mins_after_trip_start'
    ];

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
    protected $searchable = [
        'columns' => [
            'zones.name' => 20,
            'service_locations.name'=> 20,
            'vehicle_types.name'=> 20,
            
        ],
        'joins' => [
            'zones' =>['zone_type_price.zone_types.zones.id'],
            'vehicle_types' =>['zone_type_price.zone_types.zones.vehicle_types.id'],
            'service_locations' => ['zones.service_location_id','service_locations.id'],
        ],
    ];
    
}
