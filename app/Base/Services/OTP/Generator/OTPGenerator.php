<?php

namespace App\Base\Services\OTP\Generator;

class OTPGenerator implements OTPGeneratorContract {
	/**
	 * The character length of the OTP to generate.
	 *
	 * @var int
	 */
	protected $length;

	/**
	 * The maximum character length allowed for the OTP.
	 *
	 * @var int
	 */
	protected $maxLength = 9;

	/**
	 * OTPGenerator constructor.
	 *
	 * @param int|null $length
	 */
	public function __construct($length = 6) {
		$this->length = $length;
	}

	/**
	 * Generate a random OTP.
	 *
	 * @param int|null $length Maximum value of 9
	 * @return string
	 */
	public function generate($length = null) {
		return substr(str_shuffle('123456789'), 0, $this->resolveLength($length));
	}

	/**
	 * Resolve the OTP character length.
	 *
	 * @param int|null $length
	 * @return int
	 */
	protected function resolveLength($length = null) {
		return $length ?
		min($length, $this->maxLength) :
		min($this->length, $this->maxLength);
	}
}