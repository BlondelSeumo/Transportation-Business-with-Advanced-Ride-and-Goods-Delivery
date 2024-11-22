<?php

namespace App\Models\Request;

use Illuminate\Database\Eloquent\Model;

class RequestPlace extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'request_places';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['request_id','pick_lat','pick_lng','drop_lat','drop_lng','pick_address','drop_address','active','request_path','pickup_poc_name','pickup_poc_mobile','drop_poc_name','drop_poc_mobile','pickup_poc_instruction','drop_poc_instruction'];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [

    ];
}
