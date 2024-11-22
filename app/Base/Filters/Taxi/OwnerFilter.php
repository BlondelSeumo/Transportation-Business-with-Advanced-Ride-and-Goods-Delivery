<?php

namespace App\Base\Filters\Taxi;

use App\Base\Libraries\QueryFilter\FilterContract;
use Carbon\Carbon;

/**
 * Test filter to demonstrate the custom filter usage.
 * Delete later.
 */
class OwnerFilter implements FilterContract {
	/**
	 * The available filters.
	 *
	 * @return array
	 */
	public function filters() {
		return [
			'active','approve','name','company_name'
		];
	}

	public function active($builder, $value = 0) {
		$builder->where('active', $value);
    }
    
	public function approve($builder, $value = 0) {
		$builder->where('approve', $value);
    }

	public function name($builder, $value = 0) {
		$builder->where('name', 'like', "%$value%");
    }

	public function company_name($builder, $value = 0) {
		$builder->where('company_name', 'like', "%$value%");
    }
}
