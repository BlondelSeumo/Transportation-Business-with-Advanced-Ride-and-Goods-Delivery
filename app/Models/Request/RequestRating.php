<?php

namespace App\Models\Request;

use App\Models\User;
use App\Models\Admin\Driver;
use App\Models\Request\Request;
use Illuminate\Database\Eloquent\Model;

class RequestRating extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'request_ratings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['request_id','user_id','driver_id','rating','comment','user_rating','driver_rating'];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [
         'driverDetail','userDetail','requestDetail'
    ];

    /**
     * The request that the Rating belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function requestDetail()
    {
        return $this->belongsTo(Request::class, 'request_id', 'id');
    }
    /**
     * The driver that the Rating belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function driverDetail()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
    /**
     * The user that the Rating belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function userDetail()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

     public function getConvertedCreatedAtAttribute()
    {
        if ($this->created_at==null) {
            return null;
        }
        $timezone = $this->serviceLocationDetail->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($this->created_at)->setTimezone($timezone)->format('jS M h:i A');
    }
}
