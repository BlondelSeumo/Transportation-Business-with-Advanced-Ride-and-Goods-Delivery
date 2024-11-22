<?php

namespace App\Base\Libraries\QueryFilter;

use Illuminate\Support\Facades\Facade;

class QueryFilterFacade extends Facade {
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
		return 'query-filter';
	}
}
