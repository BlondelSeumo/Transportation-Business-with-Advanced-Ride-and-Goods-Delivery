<?php

namespace App\Models\Request;

use Illuminate\Database\Eloquent\Model;

class DriverRejectedRequest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'driver_rejected_requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['request_id','driver_id','is_after_accept','reason','custom_reason'];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    
    public $includes = [

    ];
}

