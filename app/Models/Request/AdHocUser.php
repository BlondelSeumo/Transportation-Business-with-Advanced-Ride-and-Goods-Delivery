<?php

namespace App\Models\Request;

use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;

class AdHocUser extends Model
{
    use HasActive;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'adhoc_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['request_id','name','email','mobile','active'];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [
        'request','request.requestPlace'
    ];
    /**
    * The accessors to append to the model's array form.
    *
    * @var array
    */
    protected $appends = [
        'profile_picture'
    ];

    /**
    * The request that the meta belongs to.
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function request()
    {
        return $this->belongsTo(Request::class, 'request_id', 'id');
    }

    public function getProfilePicAttribute()
    {
        $default_image_path = config('base.default.user.profile_picture');
        return env('APP_URL').$default_image_path;
    }
}
