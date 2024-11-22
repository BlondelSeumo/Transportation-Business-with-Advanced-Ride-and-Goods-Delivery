<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class ProjectFlavour extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['flavour_name','app_name','bundle_identifier','project_id'];
}
