<?php

namespace App\Transformers\Requests;

use App\Transformers\Transformer;
use App\Models\Request\RequestDeliveryProof;

class RequestProofsTransformer extends Transformer
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
     * @param RequestDeliveryProof $request
     * @return array
     */
    public function transform(RequestDeliveryProof $request)
    {
        return [
            'id' => $request->id,
            'after_load' => $request->after_load,
            'after_unload' => $request->after_unload,
            'proof_image' => $request->proof_image
        ];
    }
}
