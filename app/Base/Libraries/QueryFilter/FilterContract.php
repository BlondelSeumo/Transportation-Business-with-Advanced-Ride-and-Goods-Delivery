<?php

namespace App\Base\Libraries\QueryFilter;

interface FilterContract {
	/**
	 * The available filters.
	 *
	 * @return array
	 */
	public function filters();
}
