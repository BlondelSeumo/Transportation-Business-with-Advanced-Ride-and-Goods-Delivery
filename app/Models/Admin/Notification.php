<?php

namespace App\Models\Admin;

use App\Base\Uuid\UuidModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Notification extends Model
{
    use UuidModel;

    protected $fillable = [
        'push_enum','title','body','image','data','for_user','for_driver'
    ];

    public function userNotification()
    {
        return $this->hasMany(UserDriverNotification::class, 'notify_id', 'id');
    }

    /**
    * The accessors to append to the model's array form.
    *
    * @var array
    */
    protected $appends = [
        'push_image'
    ];

    public function getPushImageAttribute()
    {
        if (!$this->image) {
            return null;
        }
        return Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(), $this->image));
    }

    public function uploadPath()
    {
        return config('base.pushnotification.upload.images.path');
    }
}
