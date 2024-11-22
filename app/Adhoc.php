<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adhoc extends Model
{
     public function serviceLocationDetail()
    {
        return $this->belongsTo(ServiceLocation::class, 'service_location_id', 'id');
    }
}
