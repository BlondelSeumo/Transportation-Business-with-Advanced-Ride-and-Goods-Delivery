<?php

namespace App\Transformers\Driver;

use App\Transformers\Transformer;
use App\Models\Admin\Driver;

class LeaderBoardTripsTransformer extends Transformer
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
    ];
    /**
     * A Fractal transformer.
     *
     * @param DriverNeededDocument $driverneededdocument
     * @return array
     */
    public function transform($driver_trip)
    {

        // dd($driver_trip);
        $params =  [
            'driver_id' => $driver_trip->driver_id,
            'driver_name' => $driver_trip->name,
            'total_trips' => $driver_trip->total,

        ];

        $driver = Driver::find('id', $driver_trip->driver_id);

        $params['profile_picture'] =  $driver->profile_picture;
        
        return $params;
    }


}
