<?php

namespace App\Models\Request;

use App\Models\Request\Request;
use App\Models\User;
use App\Models\Admin\Driver;
use Illuminate\Database\Eloquent\Model;

class RequestCancellationFee extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'request_cancellation_fees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['request_id','user_id','driver_id','is_paid','paid_request_id','cancellation_fee'];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [

    ];

    /**
     * The request that the cancellation fee belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function requestDetail()
    {
        return $this->belongsTo(Request::class, 'request_id', 'id');
    } 

   

    public function userDetail()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function driverDetail()
    {
        return $this->hasOne(Driver::class, 'id', 'driver_id');
    }

    /**
     * The request that the cancellation fee belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function paidRequestDetail()
    {
        return $this->belongsTo(Request::class, 'paid_request_id', 'id');
    }
}
