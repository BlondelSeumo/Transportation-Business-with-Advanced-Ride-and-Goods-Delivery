<?php

namespace App\Models\Request;

use Illuminate\Database\Eloquent\Model;

class FavouriteLocation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'favourite_locations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['pick_lat','pick_lng','drop_lat','drop_lng','pick_address','drop_address','address_name','landmark','user_id'];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [

    ];
}
