<?php

namespace App\Transformers\User;

use App\Transformers\Transformer;
use App\Transformers\Access\RoleTransformer;
use App\Models\Admin\ZoneType;

class ZoneTypeTransformerOld extends Transformer
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected array $availableIncludes = [

    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ZoneType $zone_type)
    {
        $params = [
            'id' => $zone_type->id,
            'type_id'=>$zone_type->type_id,
            'name' => $zone_type->vehicle_type_name,
            'icon' => $zone_type->icon,
            'capacity'=>$zone_type->vehicleType->capacity,
            'is_accept_share_ride'=>$zone_type->vehicleType->is_accept_share_ride,
            'active'=>$zone_type->vehicleType->active
        ];
        return $params;
    }
}
