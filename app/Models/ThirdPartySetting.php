<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Base\Uuid\UuidModel;

class ThirdPartySetting extends Model
{

    use UuidModel;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'third_party_settings';


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
        'name',
        'value',
        'module'
    ];


}
