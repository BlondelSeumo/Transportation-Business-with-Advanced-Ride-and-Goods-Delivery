<?php

namespace App\Transformers\Requests;

use App\Models\Admin\Promo;
use App\Transformers\Transformer;

class PromoCodesTransformer extends Transformer
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
     * @param Promo $promo
     * @return array
     */
    public function transform(Promo $promo)
    {
        $params = [
            'id' => $promo->id,
            'code' => $promo->code,
            'service_location_id' => $promo->service_location_id,
            'minimum_trip_amount' => $promo->minimum_trip_amount,
            'maximum_discount_amount' => $promo->maximum_discount_amount,
            'discount_percent' => $promo->discount_percent,
            'total_uses' => $promo->total_uses,
            'uses_per_user' => $promo->uses_per_user,
            'from' => $promo->from,
            'to' => $promo->to,
            'active' => $promo->active,
        ];

        if (request()->has('coupon_code') && request()->coupon_code==$promo->code) {
            $params['is_applied'] = true;
        } else {
            $params['is_applied'] = false;
        }
        return $params;
    }
}
