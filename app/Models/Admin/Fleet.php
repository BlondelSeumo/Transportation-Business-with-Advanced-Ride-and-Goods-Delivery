<?php

namespace App\Models\Admin;

use App\Base\Uuid\UuidModel;
use App\Models\Master\CarMake;
use App\Models\Master\CarModel;
use App\Models\Traits\HasActive;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fleet extends Model
{
    use UuidModel,SoftDeletes,HasActive;

    protected $fillable = [
        'owner_id','brand','model','license_number','permission_number','vehicle_type','active','fleet_id','qr_image','approve','car_color','driver_id','custom_make','custom_model'
    ];

    /**
    * The accessors to append to the model's array form.
    *
    * @var array
    */
    protected $appends = [
       'car_make_name','car_model_name'
    ];

    public function vehicleType(){
        return $this->belongsTo(VehicleType::class,'vehicle_type','id');
    }

    public function carBrand(){
        return $this->belongsTo(CarMake::class,'brand','id');
    }

    public function carModel(){
        return $this->belongsTo(CarModel::class,'model','id');
    }

    public function fleetDocument(){
        return $this->hasMany(FleetDocument::class,'fleet_id','id');
    }

    public function getQrCodeImageAttribute(){
        return asset('storage/uploads/qr-codes/'.$this->qr_image);
    }

    public function user(){
        return $this->belongsTo(User::class,'owner_id','id');
    }


    public function getCarMakeNameAttribute()
    {
        if($this->carBrand()->exists()){
            return $this->carBrand?$this->carBrand->name:null;            
        }else{

            return $this->custom_make;
        }
    }
    public function getCarModelNameAttribute()
    {
        if($this->carModel()->exists()){
            return $this->carModel?$this->carModel->name:null;
        }else{
            return $this->custom_model;
        }
    }

    public function getFleetNameAttribute(){
        return  $this->carBrand->name .' - '. $this->carModel->name .' ('.$this->vehicleType->name.')';
    }

    public function driverDetail(){
        return $this->belongsTo(Driver::class,'id','fleet_id');
    }

    public function ownerDetail(){
        return $this->belongsTo(Owner::class,'owner_id','id');
    }
}
