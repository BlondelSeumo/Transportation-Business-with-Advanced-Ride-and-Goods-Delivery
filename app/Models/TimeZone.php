<?php

namespace App\Models;

use App\Base\Slug\HasSlug;
use App\Base\Uuid\UuidModel;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasActive;

class TimeZone extends Model
{
    use UuidModel,HasActive;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'time_zones';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'timezone'
    ];

    /**
     * The attributes that can be used for sorting with query string filtering.
     *
     * @var array
     */
    public $sortable = [
        'name',
    ];

    /**
     * @param $utc
     * @return mixed
     */
    public function setUtcAttribute($utc)
    {
        $this->attributes['utc'] = json_encode($utc);
    }
    /**
     * @param $utc
     * @return mixed
     */
    public function getUtcAttribute($utc)
    {
        return json_decode($utc);
    }
    /**
     * Get all the countries from the JSON file.
     *
     * @return array
     */
    public static function allJSON()
    {
        $route = dirname(dirname(__FILE__)) . '/Helpers/TimeZones/time_zones.json';
        return json_decode(file_get_contents($route), true);
    }
}
