<?php

namespace App\Transformers\User;

use App\Transformers\Transformer;
use App\Transformers\Access\RoleTransformer;
use App\Models\Admin\ZoneType;

class ZoneTypeTransformer extends Transformer
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected array $availableIncludes = [
        'zoneTypePrice'
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($zone_type)
    {
        $params = [
            'id' => $zone_type->id,
            'type_id'=>$zone_type->type_id,
            'name' => $zone_type->vehicle_type_name,
            'icon' => $zone_type->icon,
            'capacity'=>$zone_type->vehicleType->capacity,
            'is_accept_share_ride'=>$zone_type->vehicleType->is_accept_share_ride,
            'active'=>$zone_type->vehicleType->active,
            'currency' => $zone_type->zone->serviceLocation->currency_symbol,
            'unit' => $zone_type->zone->unit,
            'unit_in_words' => $zone_type->zone->unit ? 'Km' : 'Miles',

        ];

        // dd($zone_type->zoneTypePackage);

        if ($zone_type->payment_type=='all') {
            $payment_type = ['card','cash','wallet'];
            $params['payment_type'] = $payment_type;
        } else {
            $payment_type = explode(',', $zone_type->payment_type);
            $params['payment_type'] = $payment_type;
        }

        return $params;
    }

    public function includeZoneTypePrice(ZoneType $zone_type)
    {
        // $zoneTypePrice = $zone_type;

        return $zone_type
        ? $this->item($zone_type, new ZoneTypePriceTransformer)
        : $this->null();
    }
}
