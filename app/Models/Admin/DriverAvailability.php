<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DriverAvailability extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'driver_availabilities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['driver_id','is_online','online_at','offline_at','duration'];


    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [
        'driver'
    ];

    /**
    * The driver that the uploaded data belongs to.
    * @tested
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }

    public function getConvertedOnlineAtAttribute()
    {
        if ($this->online_at==null||!auth()->user()->exists()) {
            return null;
        }
        $timezone = auth()->user()->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($this->online_at)->setTimezone($timezone)->format('jS M h:i A');
    }
    public function getConvertedOfflineAtAttribute()
    {
        if ($this->offline_at==null||!auth()->user()->exists()) {
            return null;
        }
        $timezone = auth()->user()->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($this->offline_at)->setTimezone($timezone)->format('jS M h:i A');
    }
    public function getConvertedDurationAtAttribute()
    {
        $hours =intdiv($this->duration,60). 'hr'." ".($this->duration % 60)."mins";
        

        return $hours;
    }
}
