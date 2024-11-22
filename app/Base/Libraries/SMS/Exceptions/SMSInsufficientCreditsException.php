<?php

namespace App\Base\Libraries\SMS\Exceptions;

class SMSInsufficientCreditsException extends SMSFailException {
	/**
	 * Create a new exception instance.
	 *
	 * @param string|null $message
	 */
	public function __construct($message = null) {
		if (empty($message)) {
			$message = 'SMS failed due to insufficient credits.';
		}

		parent::__construct($message);
	}
}
