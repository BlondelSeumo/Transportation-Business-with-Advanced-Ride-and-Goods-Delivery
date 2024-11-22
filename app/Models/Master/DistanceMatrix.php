<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class DistanceMatrix extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'distance_matrixes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['origin_addresses','origin_lat','origin_lng','destination_addresses','destination_lat','destination_lng','distance','duration','json_result'];
}
