<?php

namespace App\Transformers\Owner;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin\Owner;
use App\Base\Constants\Auth\Role;
use App\Transformers\Transformer;
use App\Base\Constants\Setting\Settings;
use App\Models\Admin\Fleet;
use App\Transformers\Driver\DriverTransformer;

class FleetTransformer extends Transformer
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected array $availableIncludes = [
        
    ];

    /**
    * Resources that can be included default.
    *
    * @var array
    */
    protected array $defaultIncludes = [

        'driverDetail'
        
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Fleet $fleet)
    {
        $params = [
            'id' => $fleet->id,
            'owner_id'=>$fleet->owner_id,
            'license_number'=>$fleet->license_number,
            'vehicle_type'=>$fleet->vehicleType->name,
            'brand'=>$fleet->carBrand ? $fleet->carBrand->name :  $fleet->custom_make,
            'model'=>$fleet->carModel ? $fleet->carModel->name :  $fleet->custom_model,
            'approve'=>$fleet->approve,
            'car_color'=>$fleet->car_color,
            'type_icon'=>$fleet->vehicleType->icon
        ];

        return $params;
    }

    
    /**
     * Include the driver of the request.
     *
     * @param Fleet $fleet
     * @return \League\Fractal\Resource\Item|\League\Fractal\Resource\NullResource
     */
    public function includeDriverDetail(Fleet $fleet)
    {
        $driverDetail = $fleet->driverDetail;

        return $driverDetail
        ? $this->item($driverDetail, new DriverTransformer)
        : $this->null();
    }

   
}
