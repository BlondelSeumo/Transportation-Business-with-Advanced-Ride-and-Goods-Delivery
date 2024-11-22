<?php

namespace App\Base\Services\OTP;

interface CanSendOTPContract
{
    /**
     * Create a new OTP for the user.
     *
     * @return bool
     */
    public function createOTP();

    /**
     * Get the created OTP.
     *
     * @return string
     */
    public function getCreatedOTP();

    /**
     * Get the UUID of the created OTP.
     *
     * @return string
     */
    public function getCreatedOTPUuid();
    /**
     * Check if the user entered OTP is valid.
     *
     * @param string $otp
     * @return bool
     */
    public function validateOTP($otp);

    /**
     * Delete the user's OTP entry in the table.
     *
     * @return mixed
     */
    public function deleteOTP();

    /**
     * Get the current user's mobile number for sending OTP.
     *
     * @return string
     */
    public function getMobileNumberForSendingOTP();
}
