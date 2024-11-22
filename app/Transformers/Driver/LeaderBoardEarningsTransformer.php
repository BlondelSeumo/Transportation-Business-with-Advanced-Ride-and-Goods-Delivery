<?php

namespace App\Transformers\Driver;

use App\Transformers\Transformer;
use App\Models\Admin\Driver;


class LeaderBoardEarningsTransformer extends Transformer
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
    public function transform($request)
    {

        // dd($request-);

        $params['driver_id'] =  $request['driver_id'];
        $params['driver_name'] =  $request['name'];
        $params['commission'] =  $request['commission'];
        
        $driver = Driver::where('id', $request['driver_id'])->first();

        $params['profile_picture'] =  $driver->profile_picture;

        return $params;
    }


}
