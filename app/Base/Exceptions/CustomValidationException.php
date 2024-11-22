<?php

namespace App\Base\Exceptions;

use Exception;

class CustomValidationException extends Exception {
	/**
	 * The exception error messages.
	 *
	 * @var array
	 */
	protected $messages = [];

	/**
	 * Create a new exception instance.
	 *
	 * @param array $errors
	 */
	public function __construct(...$errors) {
		parent::__construct('The given data failed to pass validation.');

		$args = func_num_args();

		if ($args) {
			if ($args === 1 && is_array($errors[0])) {
				$this->messages = $errors[0];
			} else {
				$this->messages = [
					$errors[1] => is_array($errors[0]) ? $errors[0] : [$errors[0]],
				];
			}
		}
	}

	/**
	 * Get the exception error messages.
	 *
	 * @return array
	 */
	public function getMessages() {
		return $this->messages;
	}
}
