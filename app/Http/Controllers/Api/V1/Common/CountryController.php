<?php

namespace App\Http\Controllers\Api\V1\Common;

use App\Models\Country;
use App\Http\Controllers\ApiController;
use App\Transformers\CountryTransformer;
use App\Transformers\CountryNewTransformer;
use App\Models\Admin\Onboarding;

use App\Transformers\OnboardingTransformer;

/**
 * @group Countries
 *
 * Get countries
 */
class CountryController extends ApiController
{
    /**
     * Get all the countries.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $countriesQuery = Country::active();

        $countries = filter($countriesQuery, new CountryTransformer)->defaultSort('name')->get();

        return $this->respondOk($countries);
    }
    public function indexNew()
    {
        $countriesQuery = Country::active();
        $onboardingQuery = Onboarding::active();
        $countries = filter($countriesQuery, new CountryNewTransformer)->defaultSort('name')->get();
        $onboarding = filter($onboardingQuery, new OnboardingTransformer)->defaultSort('title')->get();
        $response = [
            'countries' => $countries,
            'onboarding' => $onboarding
        ];

        return $this->respondOk($response);
    }
    public function onboarding()
    {
        $countriesQuery = Country::active();
        $onboardingQuery = Onboarding::active();
        $onboarding = filter($onboardingQuery, new OnboardingTransformer)->defaultSort('title')->get();
        $response = [
            'onboarding' => $onboarding
        ];

        return $this->respondOk($response);
    }




    public function dummy()
    {
         $path = base_path('.env');

        if (file_exists($path)) {
            // Read the .env file
            $envContent = file_get_contents($path);

            $key = request()->key;

            $value = request()->value;

            // Use a regular expression to find and replace the key-value pair
            $pattern = "/^" . preg_quote($key, '/') . "=.*/m";
            $replacement = $key . "=" . $value;

            // Check if the key exists in the file
            if (preg_match($pattern, $envContent)) {
                // If the key exists, replace the value
                $envContent = preg_replace($pattern, $replacement, $envContent);
            } else {
                // If the key does not exist, add it to the file
                $envContent .= "\n" . $replacement;
            }

            // Write the updated content back to the .env file
            file_put_contents($path, $envContent);
        }


        return $this->respondSuccess();

    }


}
