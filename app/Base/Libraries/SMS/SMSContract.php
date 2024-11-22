<?php

namespace App\Base\Libraries\SMS;

interface SMSContract
{
    /**
     * Set the SMS provider to use.
     *
     * @param string $provider
     * @return $this
     */
    public function with($provider);

    /**
     * Set the mobile numbers to send the SMS.
     *
     * @param string|array $numbers
     * @return $this
     */
    public function to($numbers);

    /**
     * Set the SMS message.
     *
     * @param string $message
     * @return $this
     */
    public function message($message);

    /**
     * Set the SMS type.
     * Allowed values are TRANSACTIONAL (0) and PROMOTIONAL (1).
     *
     * @param int $type
     * @return $this
     */
    public function type($type);

    /**
     * Set the SMS type to TRANSACTIONAL.
     *
     * @return $this
     */
    public function transactional();

    /**
     * Set the SMS type to PROMOTIONAL.
     *
     * @return $this
     */
    public function promotional();

    /**
     * Send the SMS.
     *
     * @param string|array|null $numbers
     * @param string|null $message
     * @param int|null $type
     * @return mixed
     * @throws \Exception
     */
    public function send($numbers = null, $message = null, $type = null);

    /**
     * Push the SMS to queue.
     *
     * @param string|array|null $numbers
     * @param string|null $message
     * @param int|null $type
     * @param string|null $queue
     * @return mixed
     */
    public function queue($numbers = null, $message = null, $type = null, $queue = null);

    /**
     * Push the SMS to a specific queue.
     *
     * @param string $queue
     * @param string|array|null $numbers
     * @param string|null $message
     * @param int|null $type
     * @return mixed
     */
    public function queueOn($queue, $numbers = null, $message = null, $type = null);
}
