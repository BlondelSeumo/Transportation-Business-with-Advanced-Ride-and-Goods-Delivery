<?php

namespace App\Models\Request;

use Carbon\Carbon;
use App\Models\User; 
use Illuminate\Database\Eloquent\Model;


class RequestCycles extends Model
{ 
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'request_cycles';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'request_id', // Add 'request_id' to the fillable array 
        'user_id',
        'driver_id',
        'request_data',
        'orderby_status'
    ];


    
}
