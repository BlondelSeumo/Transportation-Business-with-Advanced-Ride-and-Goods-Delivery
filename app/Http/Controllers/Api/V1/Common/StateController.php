<?php

namespace App\Http\Controllers\Api\V1\Common;

use App\Models\State;
use App\Transformers\StateTransformer;
use App\Http\Controllers\ApiController;

/**
 * @resource States
 *
 * Get countries
 */
class StateController extends ApiController
{
    /**
     * Get all the states.
     *@hideFromAPIDocumentation
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $statesQuery = State::active();

        $states = filter($statesQuery, new StateTransformer)->defaultSort('name')->get();

        return $this->respondOk($states);
    }

    /**
     * Get a state by its id.
     *@hideFromAPIDocumentation
     * @param State $state
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(State $state)
    {
        $state = filter()->transformWith(new StateTransformer)->loadIncludes($state);

        return $this->respondOk($state);
    }
}
