<?php

namespace App\Base\Libraries\SMS\Exceptions;

class SMSMaxNumbersException extends SMSFailException {
	/**
	 * Create a new exception instance.
	 *
	 * @param string|null $message
	 */
	public function __construct($message = null) {
		if (empty($message)) {
			$message = 'Cannot sent SMS to more than 100 numbers at once.';
		}

		parent::__construct($message);
	}
}
