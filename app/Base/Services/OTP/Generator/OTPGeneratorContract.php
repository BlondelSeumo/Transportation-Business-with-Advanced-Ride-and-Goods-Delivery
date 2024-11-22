<?php

namespace App\Base\Services\OTP\Generator;

interface OTPGeneratorContract {
	/**
	 * Generate a random OTP.
	 *
	 * @param int|null $length Maximum value of 9
	 * @return string
	 */
	public function generate($length = null);
}