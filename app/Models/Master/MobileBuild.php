<?php

namespace App\Models\Master;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Traits\HasActive;
use App\Models\Master\ProjectFlavour;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class MobileBuild extends Model
{
    use HasActive,SearchableTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mobile_builds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['project_name','project_id','flavour_id','build_number','environment','team','version','download_link','additional_comments','file_size','active','uploaded_by','created_at'];

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
        'short_additional_comments','flavour_name'
    ];

    /**
    * Searchable rules.
    *
    * @var array
    */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'mobile_builds.build_number' => 20,
        ],


    ];

    // public function getCreatedAtAttribute()
    // {
    //     return date('d-m-Y', strtotime($this->attributes['created_at']));
    // }

    public function flavour()
    {
        return $this->belongsTo(ProjectFlavour::class, 'flavour_id', 'id');
    }

    public function getFlavourNameAttribute()
    {
        return $this->flavour->flavour_name;
    }
    public function getShortAdditionalCommentsAttribute()
    {
        return Str::limit($this->additional_comments, 10, '...');
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
}
