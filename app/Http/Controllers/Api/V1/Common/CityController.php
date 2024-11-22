<?php

namespace App\Http\Controllers\Api\V1\Common;

use App\Http\Controllers\ApiController;
use App\Models\City;
use App\Transformers\CityTransformer;

/**
 * @resource Cities
 *
 * Get cities
 */
class CityController extends ApiController
{
    /**
     * Get all the cities.
     *@hideFromAPIDocumentation
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $citiesQuery = City::active();

        $cities = filter($citiesQuery, new CityTransformer)->defaultSort('name')->get();

        return $this->respondOk($cities);
    }

    /**
     * Get all cities by state
     *
     *@hideFromAPIDocumentation
     * @return \Illuminate\Http\JsonResponse
     */
    public function byState($state_id)
    {
        $citiesQuery = City::where('state_id', $state_id);

        $cities = filter($citiesQuery, new CityTransformer)->defaultSort('name')->get();

        return $this->respondOk($cities);
    }
    /**
     * Get a city by its id.
     *
     *@hideFromAPIDocumentation
     * @param City $city
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(City $city)
    {
        $city = filter()->transformWith(new CityTransformer)->loadIncludes($city);

        return $this->respondOk($city);
    }
}
