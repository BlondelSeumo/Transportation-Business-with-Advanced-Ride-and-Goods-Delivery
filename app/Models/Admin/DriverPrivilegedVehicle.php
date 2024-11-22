<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class DriverPrivilegedVehicle extends Model
{
    protected $fillable = ['owner_id','driver_id','fleet_id','vehicle_id'];

    public function fleet(){
        return $this->belongsTo(Fleet::class,'fleet_id','id');
    }
}
