<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use App\Models\Admin\Zone;
use App\Base\Uuid\UuidModel;
use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasActiveCompanyKey;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class ServiceLocation extends Model
{
    use HasActive, UuidModel,SoftDeletes,SearchableTrait,HasActiveCompanyKey;

    protected $table = 'service_locations';

    protected $fillable = ['name','currency_name','currency_code','currency_symbol','country','timezone','active','company_key'];


    protected $searchable = [
        'columns' => [
            'service_locations.name' => 20,
            'service_locations.currency_name'=> 10
        ],
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
    * The Servicelocation has many Zone.
    * @tested
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function zones()
    {
        return $this->hasMany(Zone::class, 'service_location_id', 'id');
    }
}
