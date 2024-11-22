<?php

namespace App\Base\Services\OTP;

use App\Base\Services\OTP\Handler\OTPHandlerContract;

trait CanSendOTP {
	/**
	 * Create a new OTP for the user.
	 *
	 * @return bool
	 */
	public function createOTP() {
		return $this->getOTPHandler()->create();
	}

	/**
	 * Get the created OTP.
	 *
	 * @return string
	 */
	public function getCreatedOTP() {
		return $this->getOTPHandler()->getOtp();
	}

	/**
	 * Get the UUID of the created OTP.
	 *
	 * @return string
	 */
	public function getCreatedOTPUuid() {
		return $this->getOTPHandler()->getUuid();
	}

	/**
	 * Check if the user entered OTP is valid.
	 *
	 * @param string $otp
	 * @return bool
	 */
	public function validateOTP($otp) {
		return $this->getOTPHandler()->validate($otp);
	}

	/**
	 * Delete the user's OTP entry in the table.
	 *
	 * @return mixed
	 */
	public function deleteOTP() {
		return $this->getOTPHandler()->delete();
	}

	/**
	 * Get the current user's mobile number for sending OTP.
	 *
	 * @return string
	 */
	public function getMobileNumberForSendingOTP() {
		return $this->mobile;
	}

	/**
	 * Get the OTP handler instance for the current mobile number.
	 *
	 * @return \App\Base\Services\OTP\Handler\OTPHandlerContract
	 */
	protected function getOTPHandler() {
		return app(OTPHandlerContract::class)
			->setMobile($this->getMobileNumberForSendingOTP());
	}
}