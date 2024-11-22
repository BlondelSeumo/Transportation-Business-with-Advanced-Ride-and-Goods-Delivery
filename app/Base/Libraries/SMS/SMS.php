<?php

namespace App\Base\Libraries\SMS;

use App\Base\Libraries\SMS\Providers\ProviderContract;
use App\Base\Libraries\SMS\Queue\SendQueuedSMS;
use Exception;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Queue\Queue;

class SMS implements SMSContract
{
    /** Transactional SMS type */
    const TRANSACTIONAL = 0;

    /** Promotional SMS type */
    const PROMOTIONAL = 1;

    /** @var array */
    protected $config;

    /** @var \Illuminate\Contracts\Queue\Queue */
    protected $queue;

    /** @var string */
    protected $provider;

    /** @var string */
    protected $providerClass;

    /** @var array */
    protected $settings;

    /** @var int */
    protected $limit;

    /** @var array|null */
    protected $numbers = null;

    /** @var string|null */
    protected $message = null;

    /** @var int */
    protected $type = self::TRANSACTIONAL;

    /**
     * SMS constructor.
     *
     * @param \Illuminate\Config\Repository $config
     * @param \Illuminate\Contracts\Queue\Queue $queue
     * @throws \Exception
     */
    public function __construct(ConfigRepository $config, Queue $queue)
    {
        $this->config = $config['sms'];

        $this->queue = $queue;

        if (is_null($this->config)) {
            throw new Exception('Missing SMS config file.');
        }

        $this->limit = data_get($this->config, 'message_limit', 480);

        $this->setProvider(data_get($this->config, 'default'));
    }

    /**
     * Set the SMS provider to use.
     *
     * @param string $provider
     * @return $this
     */
    public function with($provider)
    {
        if ($this->provider !== $provider) {
            $this->setProvider($provider);
        }

        return $this;
    }

    /**
     * Set the mobile numbers to send the SMS.
     *
     * @param string|array $numbers
     * @return $this
     */
    public function to($numbers)
    {
        if (!is_null($numbers)) {
            $this->numbers = $this->validateNumbers($numbers);
        }

        return $this;
    }

    /**
     * Set the SMS message.
     *
     * @param string|object $message
     * @return $this
     */
    public function message($message)
    {
        if (!is_null($message)) {
            $this->message = $this->validateMessage((string) $message);
        }

        return $this;
    }

    /**
     * Set the SMS type.
     * Allowed values are TRANSACTIONAL (0) and PROMOTIONAL (1).
     *
     * @param int $type
     * @return $this
     */
    public function type($type)
    {
        if ($type === self::TRANSACTIONAL || $type === self::PROMOTIONAL) {
            $this->type = $type;
        }

        return $this;
    }

    /**
     * Set the SMS type to TRANSACTIONAL.
     *
     * @return $this
     */
    public function transactional()
    {
        $this->type = self::TRANSACTIONAL;

        return $this;
    }

    /**
     * Set the SMS type to PROMOTIONAL.
     *
     * @return $this
     */
    public function promotional()
    {
        $this->type = self::PROMOTIONAL;

        return $this;
    }

    /**
     * Send the SMS.
     *
     * @param string|array|null $numbers
     * @param string|object|null $message
     * @param int|null $type
     * @return mixed
     * @throws \Exception
     */
    public function send($numbers = null, $message = null, $type = null)
    {
        $this->to($numbers)->message($message)->type($type);

        $this->validateRequiredData();

        $providerInstance = new $this->providerClass($this->settings);

        if (!$providerInstance instanceof ProviderContract) {
            throw new Exception('SMS provider class should implement "ProviderContract".');
        }

        return $providerInstance->send($this->numbers, $this->message, $this->type);
    }

    /**
     * Push the SMS to queue.
     *
     * @param string|array|null $numbers
     * @param string|object|null $message
     * @param int|null $type
     * @param string|null $queue
     * @return mixed
     */
    public function queue($numbers = null, $message = null, $type = null, $queue = null)
    {
        $this->to($numbers)->message($message)->type($type);

        $this->validateRequiredData();

        $job = new SendQueuedSMS($this->provider, $this->numbers, $this->message, $this->type);

        return $this->queue->pushOn($queue, $job);
    }

    /**
     * Push the SMS to a specific queue.
     *
     * @param string $queue
     * @param string|array|null $numbers
     * @param string|object|null $message
     * @param int|null $type
     * @return mixed
     */
    public function queueOn($queue, $numbers = null, $message = null, $type = null)
    {
        return $this->queue($numbers, $message, $type, $queue);
    }

    /**
     * Set the sms provider after validation.
     *
     * @param string $provider
     * @throws Exception
     */
    protected function setProvider($provider)
    {
        if (is_null($provider) || is_null($settings = data_get($this->config, "providers.{$provider}"))) {
            throw new Exception('Invalid SMS provider specified.');
        }

        if (!isset($settings['class']) || !class_exists($providerClass = $settings['class'])) {
            throw new Exception('Invalid SMS provider class defined.');
        }

        $this->provider = $provider;
        $this->settings = $settings;
        $this->providerClass = $providerClass;
    }

    /**
     * Validate the provided mobile numbers.
     * Returns the validated mobile numbers.
     *
     * @param string|array $numbers
     * @return array
     * @throws Exception
     */
    protected function validateNumbers($numbers)
    {
        $numbers = array_wrap($numbers);

        foreach ($numbers as $number) {
            // if (!preg_match('/^[0-9]{10}+$/', $number)) {
            if (!preg_match('/^[0-9]+$/', $number)) {
                throw new Exception("Invalid SMS mobile number provided: {$number}.");
            }
        }

        return $numbers;
    }

    /**
     * Validate the provided message.
     * Returns the validated message.
     *
     * @param string $message
     * @return string
     * @throws Exception
     */
    protected function validateMessage($message)
    {
        if (!is_string($message)) {
            throw new Exception('Invalid SMS message provided.');
        }

        if (mb_strlen($message) > $this->limit) {
            throw new Exception('The SMS message length cannot exceed ' . $this->limit . ' characters.');
        }

        return $message;
    }

    /**
     * Validate the required data needed to send the SMS.
     *
     * @throws Exception
     */
    protected function validateRequiredData()
    {
        if (empty($this->numbers) || empty($this->message)) {
            throw new Exception('Missing mobile number or message for SMS.');
        }
    }
}
