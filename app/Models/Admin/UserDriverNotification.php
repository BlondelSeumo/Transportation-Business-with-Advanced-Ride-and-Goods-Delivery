<?php

namespace App\Models\Admin;

use App\Base\Uuid\UuidModel;
use Illuminate\Database\Eloquent\Model;

class UserDriverNotification extends Model
{
    use UuidModel;

    protected $fillable = [
        'notify_id','user_id','driver_id','is_read','read_at','push_enum','title','body','image','data'
    ];
}
