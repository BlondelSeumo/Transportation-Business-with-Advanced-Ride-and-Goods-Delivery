<?php

namespace App\Models\Request;

use App\Base\Uuid\UuidModel;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Chat extends Model
{
    use UuidModel;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['message','from_type','request_id','user_id','request_id','user_id','delivered','seen','created_at'];

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
       'converted_created_at'
    ];

     /**
    * Get formated and converted timezone of user's created at.
    * @return string
    */
    public function getConvertedCreatedAtAttribute()
    {
        if ($this->created_at==null) {
            return null;
        }
        
        $timezone = $this->requestDetail()->pluck('timezone')->first()?:env('SYSTEM_DEFAULT_TIMEZONE');

        return (string)Carbon::parse($this->created_at)->setTimezone($timezone)->format('g:i A');
    }


     /**
     * The request that the meta belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function requestDetail()
    {
        return $this->belongsTo(Request::class, 'request_id', 'id');
    }

}
