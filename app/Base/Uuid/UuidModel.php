<?php

namespace App\Base\Uuid;

trait UuidModel {
	/**
	 * Get the value indicating whether the IDs are incrementing.
	 * Overwrite the method to always return false to disable auto incrementing as we are using UUID.
	 *
	 * @return bool
	 */
	public function getIncrementing() {
		return false;
	}

	/**
	 * Binds creating event to insert an auto generated UUID.
	 *
	 * @return void
	 */
	public static function bootUuidModel() {
		static::creating(function ($model) {
			$model->attributes[$model->getKeyName()] = uuid();
		});
	}
}