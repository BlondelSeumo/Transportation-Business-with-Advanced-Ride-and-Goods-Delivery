<?php

namespace App\Transformers;

use App\Models\Country;
use App\Base\Constants\Setting\Settings;

class CountryTransformer extends Transformer
{
    /**
     * A Fractal transformer.
     *
     * @param Country $country
     * @return array
     */
    public function transform(Country $country)
    {
        $params= [
            'id' => $country->id,
            'dial_code' => $country->dial_code,
            'name' => $country->name,
            'code' => $country->code,
            'flag'=>$country->flag,
            'dial_min_length'=>$country->dial_min_length,
            'dial_max_length'=>$country->dial_max_length,
            'active' => (bool)$country->active,
            'default'=>false
        ];

        if(get_settings(Settings::DEFAULT_COUNTRY_CODE_FOR_MOBILE_APP)==$country->code){
            $params['default'] = true;
        }

        return $params;
    }
}
