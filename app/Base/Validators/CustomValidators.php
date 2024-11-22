<?php

namespace App\Base\Validators;

use InvalidArgumentException;

class CustomValidators
{
    /**
     * The custom rule name.
     *
     * @var string|null
     */
    protected $rule = null;

    /**
     * Validate that an attribute is a valid mobile number.
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param \Illuminate\Validation\Validator $validator
     * @return bool
     */
    public function validateMobileNumber($attribute, $value, $parameters, $validator)
    {
        $this->rule = 'mobile_number';

        $this->registerCustomMessage($validator, 'The :attribute provided is invalid.');

        return is_valid_mobile_number($value);
    }

    /**
     * Validate the given value is a valid decimal.
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param \Illuminate\Validation\Validator $validator
     * @return bool
     */
    public function validateDecimal($attribute, $value, $parameters, $validator)
    {
        $this->rule = 'decimal';

        $this->registerCustomMessage($validator, 'The :attribute provided is invalid.');

        $length = empty($parameters) ? 2 : $parameters[0];

        return preg_match('/^(\d+(\.\d{1,' . $length . '})?)?$/', $value);
    }

    /**
     * Validate the given value is a valid double.
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param \Illuminate\Validation\Validator $validator
     * @return bool
     */
    public function validateDouble($attribute, $value, $parameters, $validator)
    {
        $this->rule = 'double';
        $this->registerCustomMessage($validator, 'The :attribute provided is invalid.');

        $length = empty($parameters) ? 4 : $parameters[0];

        return preg_match('/^[0-9]+(\.[0-9][0-9]?)?$/', $value);
    }

    /**
     * Validate the given value is a valid UUID.
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param \Illuminate\Validation\Validator $validator
     * @return bool
     */
    public function validateUuid($attribute, $value, $parameters, $validator)
    {
        $this->rule = 'uuid';

        $this->registerCustomMessage($validator, 'The :attribute format is invalid.');

        return is_valid_uuid($value);
    }

    /**
     * Validate the given value is a valid OTP code.
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param \Illuminate\Validation\Validator $validator
     * @return bool
     */
    public function validateOtp($attribute, $value, $parameters, $validator)
    {
        $this->rule = 'otp';

        $this->registerCustomMessage($validator, 'The :attribute provided is invalid.');

        $length = empty($parameters) ? config('auth.mobile_otp.length', 6) : $parameters[0];

        return preg_match('/^[0-9]{' . $length . '}+$/', $value);
    }

    /**
     * Validate that an attribute is numeric and is greater than or equal to given number of digits.
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param \Illuminate\Validation\Validator $validator
     * @return bool
     */
    public function validateNumericMin($attribute, $value, $parameters, $validator)
    {
        $this->rule = 'numeric_min';

        $this->requireParameterCount(1, $parameters);

        $this->registerCustomMessage($validator, 'The :attribute must be a number and be at least :digits digits.');

        $this->registerReplacer($validator, ':digits');

        return !preg_match('/[^0-9]/', $value)
        && strlen((string) $value) >= $parameters[0];
    }

    /**
     * Validate that an attribute is numeric and is less than or equal to given number of digits.
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param \Illuminate\Validation\Validator $validator
     * @return bool
     */
    public function validateNumericMax($attribute, $value, $parameters, $validator)
    {
        $this->rule = 'numeric_max';

        $this->requireParameterCount(1, $parameters);

        $this->registerCustomMessage($validator, 'The :attribute must be a number and not be greater than :digits digits.');

        $this->registerReplacer($validator, ':digits');

        return !preg_match('/[^0-9]/', $value)
        && strlen((string) $value) <= $parameters[0];
    }

    /**
     * Register a custom validator message.
     *
     * @param \Illuminate\Validation\Validator $validator
     * @param string $message
     */
    protected function registerCustomMessage($validator, $message)
    {
        $validator->setCustomMessages([$this->rule => $message]);
    }

    /**
     * Register a custom validator message replacer.
     *
     * @param \Illuminate\Validation\Validator $validator
     * @param string|array $replacer
     */
    protected function registerReplacer($validator, $replacer)
    {
        $replacer = array_wrap($replacer);

        if (empty($replacer) || is_null($this->rule)) {
            return;
        }

        $validator->addReplacer($this->rule, function ($message, $attribute, $rule, $parameters) use ($replacer) {
            return str_replace($replacer, $parameters, $message);
        });
    }

    /**
     * Require a certain number of parameters to be present.
     *
     * @param int $count
     * @param array $parameters
     * @throws \InvalidArgumentException
     */
    protected function requireParameterCount($count, $parameters)
    {
        if (count($parameters) < $count) {
            throw new InvalidArgumentException("Validation rule $this->rule requires at least $count parameters.");
        }
    }
}
