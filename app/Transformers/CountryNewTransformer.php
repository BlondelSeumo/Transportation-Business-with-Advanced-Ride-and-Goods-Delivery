<?php

namespace App\Transformers;

use App\Models\Country;
use App\Base\Constants\Setting\Settings;

class CountryNewTransformer extends Transformer
{
    /**
    * Resources that can be included default.
    *
    * @var array
    */
    protected array $defaultIncludes = [
        'countryTranslationDetail'
    ];
    /**
     * A Fractal transformer.
     *
     * @param Country $country
     * @return array
     */
    public function transform(Country $country)
    {
        $name = $country->name;
        $user = auth()->user();
        $translated_country = null;
        if($user && $user->lang){
            $translated_country = $country->countryTranslationDetail()->where('locale',$user->lang)->first();
        }
        if(request()->lang){
            $translated_country = $country->countryTranslationDetail()->where('locale',request()->lang)->first();
        }
        if($translated_country){
            $name = $translated_country->name;
        }
        $params= [
            'id' => $country->id,
            'dial_code' => $country->dial_code,
            'name' => $name,
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
    /**
     * Include the Country Translation.
     *
     * @param Country $country
     * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
     */
    public function includeCountryTranslationDetail(Country $country)
    {
        $translation = $country->countryTranslationDetail;
        return $translation
        ? $this->collection($translation, new CountryTranslationTransformer)
        : $this->null();
        
    }
}
