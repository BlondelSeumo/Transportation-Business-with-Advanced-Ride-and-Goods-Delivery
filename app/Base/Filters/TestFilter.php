<?php

namespace App\Base\Filters;

use App\Base\Libraries\QueryFilter\FilterContract;

/**
 * Test filter to demonstrate the custom filter usage.
 * Delete later.
 */
class TestFilter implements FilterContract {
	/**
	 * The available filters.
	 *
	 * @return array
	 */
	public function filters() {
		return [
			'dummy',
		];
	}

	/**
	 * Just a dummy method to demonstrate the filter usage.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $builder
	 * @param mixed|null $value
	 */
	public function dummy($builder, $value = null) {
		$builder->where('example', $value);
	}
}
