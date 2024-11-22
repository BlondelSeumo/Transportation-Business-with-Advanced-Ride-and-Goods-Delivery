<?php

namespace App\Transformers;

use App\Models\State;

class StateTransformer extends Transformer {
	/**
	 * Resources that can be included if requested.
	 *
	 * @var array
	 */
	protected array $availableIncludes = [
		'cities',
	];

	/**
	 * A Fractal transformer.
	 *
	 * @param State $state
	 * @return array
	 */
	public function transform(State $state) {
		return [
			'id' => $state->id,
			'slug' => $state->slug,
			'name' => $state->name,
		];
	}

	/**
	 * Include the cities of the state.
	 *
	 * @param State $state
	 * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
	 */
	public function includeCities(State $state) {
		$cities = $state->cities;

		return $cities
		? $this->collection($cities, new CityTransformer)
		: $this->null();
	}
}
