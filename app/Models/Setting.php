<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';


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
        'category',
        'value',
        'option_value',
        'field',
        'group_name'
    ];

    public function getAppLogoAttribute(){
        if (!$this->value) {
            return null;
        }
        return Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(), $this->value));
    }

    public function getFavIconAttribute(){
        if (!$this->value) {
            return null;
        }
        return Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(), $this->value));
    }

    public function getLoginBgAttribute(){
        if (!$this->value) {
            return null;
        }
        return Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(), $this->value));
    }

    public function uploadPath(){
        return config('base.system-admin.upload.logo.path');
    }
}
