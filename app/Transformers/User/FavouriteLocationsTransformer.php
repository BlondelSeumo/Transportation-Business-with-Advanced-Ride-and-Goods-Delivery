<?php

namespace App\Transformers\User;

use App\Models\Request\FavouriteLocation;
use App\Transformers\Transformer;

class FavouriteLocationsTransformer extends Transformer
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
    public function transform(FavouriteLocation $favourite_location)
    {
        $params = [
            'id' => $favourite_location->id,
            'pick_lat' => $favourite_location->pick_lat,
            'pick_lng' => $favourite_location->pick_lng,
            'drop_lat' => $favourite_location->drop_lat,
            'drop_lng' => $favourite_location->drop_lng,
            'pick_address' => $favourite_location->pick_address,
            'drop_address' => $favourite_location->drop_address,
            'address_name' => $favourite_location->address_name,
            'landmark' => $favourite_location->landmark,
        ];
        return $params;
    }
}
