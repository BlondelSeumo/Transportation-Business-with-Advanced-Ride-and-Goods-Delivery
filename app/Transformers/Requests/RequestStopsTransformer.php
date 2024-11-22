<?php

namespace App\Transformers\Requests;

use App\Transformers\Transformer;
use App\Models\Request\RequestStop;

class RequestStopsTransformer extends Transformer
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
     * @param RequestStop $request
     * @return array
     */
    public function transform(RequestStop $request)
    {
    
        return [
            'id' => $request->id,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'poc_name' => $request->poc_name,
            'completed_at' => $request->completed_at,
            'poc_mobile' => $request->poc_mobile,
            'poc_instruction' => $request->poc_instruction,
            'order'=>$request->order
        ];
    }
}
