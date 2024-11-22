<?php

namespace App\Transformers\Common;

use App\Models\Admin\Faq;
use App\Transformers\Transformer;

class FaqTransformer extends Transformer
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
    public function transform(Faq $faq)
    {
        return [
            'id' => $faq->id,
            'service_location_id' => $faq->service_location_id,
            'question' => $faq->question,
            'answer' => $faq->answer,
            'user_type' => $faq->user_type,
            'active' => (bool) $faq->active,
        ];
    }
}
