<?php

namespace App\Http\Controllers\Web\Common;

use App\Models\Country;
use App\Http\Controllers\ApiController;
use App\Transformers\CountryTransformer;
use App\Models\TimeZone;
use App\Transformers\TimezoneTransformer;

/**
 * @group Web-Spa-Countries&Timezones
 *
 * APIs for User-Management
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

    /**
     * Get all the timezone.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function timezones()
    {
        $timezonesQuery = TimeZone::active();

        $timezones = filter($timezonesQuery, new TimezoneTransformer)->defaultSort('name')->get();

        return $this->respondOk($timezones);
    }
}
