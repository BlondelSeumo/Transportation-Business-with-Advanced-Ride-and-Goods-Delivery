<?php

namespace App\Transformers\Requests;

use App\Transformers\Transformer;
use App\Transformers\Access\RoleTransformer;
use App\Models\Admin\ZoneType;

class ZoneTypeWithPackagePriceTransformer extends Transformer
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
    public function transform($zone_type)
    {
        $params = [
            'zone_type_id' => $zone_type['zone_type_id'],
            'type_id'=>$zone_type['type_id'],
            'name' => $zone_type['name'],
            'capacity'=>$zone_type['capacity'],
            'currency'=> $zone_type['currency'],
            'unit' => $zone_type['unit'],
            'unit_in_words' =>$zone_type['unit_in_words'],
            'distance_price_per_km'=>$zone_type['distance_price_per_km'],
            'time_price_per_min'=>$zone_type['time_price_per_min'],
            'free_distance'=>$zone_type['free_distance'],
            'free_min'=>$zone_type['free_min'],
            'fare_amount'=>$zone_type['fare_amount'],
            'description'=>$zone_type['description'],
            'short_description'=>$zone_type['short_description'],
            'supported_vehicles'=>$zone_type['supported_vehicles'],
            'icon'=>$zone_type['icon'],
            'driver_arival_estimation'=>'--',
            'is_default'=>$zone_type['is_default'],
            'payment_type'=>$zone_type['payment_type'],
            'discounted_totel'=>$zone_type['discounted_totel'],
            'has_discount'=>$zone_type['has_discount'],
            'promocode_id'=>$zone_type['promocode_id'],
        ];


        return $params;
    }

   
}
