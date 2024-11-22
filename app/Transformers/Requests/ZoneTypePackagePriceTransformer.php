<?php

namespace App\Transformers\Requests;

use App\Models\Admin\ZoneTypePackagePrice;
use App\Transformers\Transformer;

class ZoneTypePackagePriceTransformer extends Transformer
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
     * @param ZoneTypePackagePrice $package_price
     * @return array
     */
    public function transform(ZoneTypePackagePrice $package_price)
    {
        $params = [
            'id' => $package_price->id,
            'zone_type_id' => $package_price->zone_type_id,
            'package_type_id' => $package_price->package_type_id,
            'package_name' => $package_price->PackageName->name,
            'distance_price_per_km' => $package_price->distance_price_per_km,
            'time_price_per_min' => $package_price->time_price_per_min,
            'cancellation_fee' => $package_price->cancellation_fee,
            'free_distance' => $package_price->free_distance,
            'free_min' => $package_price->free_min
        ];

       
        return $params;
    }
}
