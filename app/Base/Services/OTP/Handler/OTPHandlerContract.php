<?php

namespace App\Base\Services\OTP\Handler;

interface OTPHandlerContract
{
    /**
     * Create a new OTP for the set mobile number.
     *
     * @return bool
     */
    public function create();

    /**
     * Check if the OTP attached to the UUID provided is verified.
     *
     * @param string $uuid
     * @return bool
     */
    public function verified($uuid);

    /**
     * Get the mobile number if the OTP is verified.
     *
     * @return string|null
     */
    public function verifiedMobile();

    /**
     * Check if the user provided OTP is valid.
     *
     * @param string $otp
     * @param string|null $uuid
     * @return bool
     */
    public function validate($otp, $uuid = null);

    /**
     * Delete the OTP entry in the table for the set mobile number or given UUID.
     * If UUID is provided then mobile number is ignored.
     *
     * @param string|null $uuid
     * @return mixed
     */
    public function delete($uuid = null);

    /**
     * Delete all the expired OTP entries in table.
     *
     * @return mixed
     */
    public function deleteExpired();

    /**
     * Get the mobile number given the UUID of the OTP.
     *
     * @param string $uuid
     * @return string|null
     */
    public function getMobileFromUuid($uuid);

    /**
     * Get the current mobile number.
     *
     * @return string
     * @throws \Exception
     */
    public function getMobile();

    /**
     * Set the mobile number.
     *
     * @param $mobile
     * @return $this
     */
    public function setMobile($mobile);

    /**
     * Get the current set/fetched OTP.
     *
     * @return string
     */
    public function getOtp();

    /**
     * Get the current set/fetched UUID.
     *
     * @return string
     */
    public function getUuid();

    /**
     * Has the current OTP being checked expired.
     *
     * @return bool
     */
    public function isExpired();
}
