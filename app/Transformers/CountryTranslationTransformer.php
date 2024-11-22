<?php

namespace App\Transformers;

use App\Models\CountryTranslation;
use App\Base\Constants\Setting\Settings;

class CountryTranslationTransformer extends Transformer
{
    /**
     * A Fractal transformer.
     *
     * @param Country $country
     * @return array
     */
    public function transform(CountryTranslation $translation)
    {
        $params= [
            'name' => $translation->name,
            'locale' => $translation->locale,
        ];


        return $params;
    }
}
