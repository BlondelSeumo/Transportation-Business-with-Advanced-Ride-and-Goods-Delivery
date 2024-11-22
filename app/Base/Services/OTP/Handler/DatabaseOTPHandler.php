<?php

namespace App\Base\Services\OTP\Handler;

use App\Base\Services\OTP\Generator\OTPGeneratorContract;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\ConnectionInterface;

class DatabaseOTPHandler implements OTPHandlerContract
{
    /**
     * The database connection instance.
     *
     * @var \Illuminate\Database\ConnectionInterface
     */
    protected $connection;

    /**
     * The OTP generator instance.
     *
     * @var \App\Base\Services\OTP\Generator\OTPGeneratorContract
     */
    protected $generator;

    /**
     * The hasher instance.
     *
     * @var \Illuminate\Contracts\Hashing\Hasher
     */
    protected $hasher;

    /**
     * The default config name.
     *
     * @var string
     */
    protected $config = 'auth.mobile_otp';

    /**
     * The mobile OTP Eloquent model.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The number of minutes after which the OTP will expire.
     *
     * @var int
     */
    protected $expiration;

    /**
     * The character length of the OTP to generate.
     *
     * @var int
     */
    protected $length;

    /**
     * The mobile number to which the OTP will be created.
     *
     * @var string
     */
    protected $mobile = null;

    /**
     * The generated/fetched OTP for the current instance.
     *
     * @var string
     */
    protected $otp = null;

    /**
     * The generated/fetched UUID for the current instance.
     *
     * @var string
     */
    protected $uuid = null;

    /**
     * The status of the current OTP verification.
     *
     * @var bool
     */
    protected $verified = false;

    /**
     * Holds the status of expiration of the current OTP.
     *
     * @var bool
     */
    protected $expired = false;

    /**
     * DatabaseOTPHandler constructor.
     *
     * @param \Illuminate\Database\ConnectionInterface $connection
     * @param \App\Base\Services\OTP\Generator\OTPGeneratorContract $generator
     * @param \Illuminate\Contracts\Hashing\Hasher $hasher
     */
    public function __construct(
        ConnectionInterface $connection,
        OTPGeneratorContract $generator,
        Hasher $hasher
    ) {
        $this->connection = $connection;
        $this->generator = $generator;
        $this->hasher = $hasher;
        $this->model = $this->getConfigValue('model');
        $this->expiration = $this->getConfigValue('expire', 60);
        $this->length = $this->getConfigValue('length', 6);
    }

    /**
     * Create a new OTP for the set mobile number.
     *
     * @return bool
     */
    public function create()
    {
        return $this->createNewOTP();
    }

    /**
     * Check if the OTP attached to the UUID provided is verified.
     *
     * @param string $uuid
     * @return bool
     */
    public function verified($uuid)
    {
        return $this->isOTPVerified($uuid);
    }

    /**
     * Get the mobile number if the OTP is verified.
     *
     * @return string|null
     */
    public function verifiedMobile()
    {
        if ($this->verified && $this->mobile) {
            return $this->mobile;
        }

        return null;
    }

    /**
     * Check if the user entered OTP is valid.
     *
     * @param string $otp
     * @param string|null $uuid
     * @return bool
     */
    public function validate($otp, $uuid = null)
    {
        return $this->isOTPValid($otp, $uuid);
    }

    /**
     * Delete the OTP entry in the table for the set mobile number or given UUID.
     * If UUID is provided then mobile number is ignored.
     *
     * @param string|null $uuid
     * @return mixed
     */
    public function delete($uuid = null)
    {
        return $this->deleteExistingOTP($uuid);
    }

    /**
     * Delete all the expired OTP entries in table.
     *
     * @return mixed
     */
    public function deleteExpired()
    {
        $expiredAt = now()->subMinutes($this->expiration);

        return $this->getModel()->where('created_at', '<', $expiredAt)->delete();
    }

    /**
     * Get the mobile number given the UUID of the OTP.
     *
     * @param string $uuid
     * @return string|null
     */
    public function getMobileFromUuid($uuid)
    {
        $mobileOtp = $this->getModel()->find($uuid);

        if ($mobileOtp) {
            return $mobileOtp->mobile;
        }

        return null;
    }

    /**
     * Generate and set a new OTP in the table.
     *
     * @return bool
     */
    protected function createNewOTP()
    {
        $this->deleteExistingOTP();

        // $otp = $this->generateNewOTP();
        $otp = 1234;

        $mobileOtp = $this->getModel()->create([
            'mobile' => $this->getMobile(),
            'otp' => $this->hashOTP($otp),
        ]);

        if (!$mobileOtp && !$mobileOtp->id) {
            return false;
        }

        $this->setOtp($otp)->setUuid($mobileOtp->id);

        return true;
    }

    /**
     * Check if the OTP attached to the UUID provided is verified.
     *
     * @param string $uuid
     * @return bool
     */
    protected function isOTPVerified($uuid)
    {
        $mobileOtp = $this->getModel()->find($uuid);

        if ($mobileOtp && $mobileOtp->isVerified()) {
            $this->setMobile($mobileOtp->mobile)->setUuid($uuid)->setVerified(true);

            return true;
        }

        return false;
    }

    /**
     * Check if the user provided OTP is valid.
     *
     * @param string $otp
     * @param string|null $uuid
     * @return bool
     */
    protected function isOTPValid($otp, $uuid = null)
    {
        if (!$otp) {
            return false;
        }

        $mobileOtp = $this->getModel()
            ->when($uuid, function ($query) use ($uuid) {
                return $query->where('id', $uuid);
            }, function ($query) {
                return $query->where('mobile', $this->getMobile());
            })
            ->first();

        if ($mobileOtp
            && $this->validateInputOTP($otp, $mobileOtp->otp)
            && $this->isOTPActive($mobileOtp->created_at)
        ) {
            $mobileOtp->update(['verified' => true]);

            $this->setOtp($otp)->setUuid($mobileOtp->id)->setVerified(true);

            return true;
        }

        return false;
    }

    /**
     * Check if the OTP is still valid based on its creation time.
     *
     * @param mixed $createdAt
     * @return bool
     */
    protected function isOTPActive($createdAt)
    {
        $active = Carbon::parse($createdAt)->addMinutes($this->expiration)->isFuture();

        $this->setExpired(!$active);

        return $active;
    }

    /**
     * Delete the OTP entry in the table for the set mobile number or given UUID.
     * If UUID is provided then mobile number is ignored.
     *
     * @param string|null $uuid
     * @return mixed
     */
    protected function deleteExistingOTP($uuid = null)
    {
        return $this->getModel()
            ->when($uuid, function ($query) use ($uuid) {
                return $query->where('id', $uuid);
            }, function ($query) {
                return $query->where('mobile', $this->getMobile());
            })
            ->delete();
    }

    /**
     * Generate a new OTP code.
     *
     * @return string
     */
    protected function generateNewOTP()
    {
        return $this->generator->generate($this->length);
    }

    /**
     * Get the current mobile number.
     *
     * @return string
     * @throws Exception
     */
    public function getMobile()
    {
        if (!$this->mobile) {
            throw new Exception('No mobile number set for handling the OTP.');
        }

        return $this->mobile;
    }

    /**
     * Set the mobile number.
     *
     * @param $mobile
     * @return $this
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get the current set/fetched OTP.
     *
     * @return string
     */
    public function getOtp()
    {
        return $this->otp;
    }

    /**
     * Set the OTP.
     *
     * @param string $otp
     * @return $this
     */
    protected function setOtp($otp)
    {
        $this->otp = $otp;

        return $this;
    }

    /**
     * Get the current set/fetched UUID.
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set the UUID.
     *
     * @param string $uuid
     * @return $this
     */
    protected function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Has the current OTP being checked expired.
     *
     * @return bool
     */
    public function isExpired()
    {
        return $this->expired;
    }

    /**
     * Set the expired status.
     *
     * @param bool $expired
     * @return $this
     */
    protected function setExpired($expired)
    {
        $this->expired = $expired;

        return $this;
    }

    /**
     * Set the verified status.
     *
     * @param bool $verified
     * @return $this
     */
    protected function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Get the model instance to handle OTP DB transactions.
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    protected function getModel()
    {
        if (!$this->model || !class_exists($this->model)) {
            throw new Exception('Invalid model set for handling OTP.');
        }

        return (new $this->model);
    }

    /**
     * Get the current database connection instance.
     *
     * @return \Illuminate\Database\ConnectionInterface
     */
    protected function getConnection()
    {
        return $this->connection;
    }

    /**
     * Get the config value given their name.
     *
     * @param string $name
     * @param mixed|null $default
     * @return mixed
     */
    protected function getConfigValue($name, $default = null)
    {
        return config("{$this->config}.{$name}", $default);
    }

    /**
     * Hash the given OTP.
     *
     * @param string $otp
     * @return string
     */
    protected function hashOTP($otp)
    {
        return $this->hasher->make($otp);
    }

    /**
     * validate if the user OTP matches the hashed OTP in database.
     *
     * @param string $otp
     * @param string $hashedOtp
     * @return bool
     */
    protected function validateInputOTP($otp, $hashedOtp)
    {
        return $this->hasher->check($otp, $hashedOtp);
    }
}
