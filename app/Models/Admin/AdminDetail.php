<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Base\Uuid\UuidModel;
use App\Models\Traits\HasActive;
use App\Models\Admin\ServiceLocation;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasActiveCompanyKey;
use Nicolaslopezj\Searchable\SearchableTrait;

class AdminDetail extends Model
{
    use HasActive, UuidModel,SearchableTrait,HasActiveCompanyKey;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'address', 'country','state','city','pincode','email','mobile','user_id','created_by','service_location_id'
    ];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [

    ];

    /**
    * The accessors to append to the model's array form.
    *
    * @var array
    */
    protected $appends = [
        'profile_picture','service_location_name'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function serviceLocationDetail()
    {
        return $this->belongsTo(ServiceLocation::class, 'service_location_id', 'id');
    }

    /**
    * Get Service location's name
    *
    * @return string
    */
    public function getServiceLocationNameAttribute()
    {
        if (!$this->serviceLocationDetail()->exists()) {
            return null;
        }
        return $this->serviceLocationDetail->name;
    }
    /**
    * Get profile picture
    *
    * @return string
    */
    public function getProfilePictureAttribute()
    {
        if (!$this->user()->exists()) {
            return null;
        }
        return $this->user->profile_picture;
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
            'admin_details.first_name' => 20,
            'admin_details.last_name'=> 20,
            'admin_details.email'=> 20,
            'admin_details.mobile'=> 20,
            'service_locations.name'=> 20,
        ],
        'joins' => [
            'service_locations' => ['admin_details.service_location_id','service_locations.id'],
        ],
    ];
}
