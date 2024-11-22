<?php

namespace App\Transformers;

use App\Models\Admin\Onboarding;
use App\Base\Constants\Setting\Settings;

class OnboardingTransformer extends Transformer
{
    /**
     * A Fractal transformer.
     *
     * @param Onboarding $onboarding
     * @return array
     */
    public function transform(Onboarding $onboarding)
    {
        $baseUrl = config('app.url');
        $imagePath = $baseUrl . '/storage/onboarding/upload/' . $onboarding->onboarding_image;
        $params= [

            'order' => $onboarding->order,
            'id' => $onboarding->sn_o,
            'screen' => $onboarding->screen,
            'title' => $onboarding->title,
            'onboarding_image'=>$imagePath,
            'description'=>$onboarding->description,
            'active'=>$onboarding->active,
        ];



        return $params;
    }
}
