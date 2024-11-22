<?php

namespace App\Models\Admin;

use App\Base\Uuid\UuidModel;
use App\Models\Traits\HasActive;
use App\Models\Admin\ServiceLocation;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasActiveCompanyKey;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;




class Onboarding extends Model
{
    use UuidModel,HasActive,HasActiveCompanyKey;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'onboarding_screen';


    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sn_o',
        'screen',
        'title',
        'order',
        'onboarding_image',
        'description',
        'active',
    ];



    public function uploadPath()
    {
        // return config('base.onboarding.upload.path');
         return config('base.onboarding.upload.path');

    }
    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_code', 'code');
    }
}
