<?php

namespace App\Base\Filters;

use App\Base\Libraries\QueryFilter\FilterContract;
use Exception;

abstract class BaseFilter implements FilterContract {
	/**
	 * Allowed status filter values.
	 *
	 * @var array
	 */
	protected $allowedStatusValues = [];

	/**
	 * Apply status filter.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $builder
	 * @param string $status
	 * @throws Exception
	 */
	protected function applyStatus($builder, $status) {
		if (!in_array($status, $this->allowedStatusValues)) {
			return;
		}

		$method = 'status' . studly_case($status);

		if (!method_exists($this, $method)) {
			throw new Exception("Undefined method '{$method}' in custom filter.");
		}

		$this->$method($builder);
	}

	/**
	 * Validates city id.
	 *
	 * @param string $cityId
	 * @param string $field
	 * @throws Exception
	 */
	protected function validateCity($cityId, $field = 'city') {
		if (!is_valid_city_id($cityId)) {
			throw new Exception("Invalid {$field}.");
		}
	}

	/**
	 * Validates date time string.
	 * Returns the Carbon instance of the date if valid.
	 *
	 * @param string $date
	 * @param string $field
	 * @return \Carbon\Carbon
	 * @throws Exception
	 */
	protected function validateDateTime($date, $field = 'date') {
		if (($date = is_valid_date($date)) === false) {
			throw new Exception("Invalid {$field}.");
		}

		return $date;
	}

	/**
	 * Validates date time string.
	 * Returns the Carbon instance of the date (Resets the time to 00:00:00) if valid.
	 *
	 * @param string $date
	 * @param string $field
	 * @return \Carbon\Carbon
	 * @throws Exception
	 */
	protected function validateDate($date, $field = 'date') {
		return $this->validateDateTime($date, $field)->startOfDay();
	}
}
