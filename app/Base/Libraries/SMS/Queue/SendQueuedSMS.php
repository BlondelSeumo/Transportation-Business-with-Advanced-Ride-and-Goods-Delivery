<?php

namespace App\Base\Libraries\SMS\Queue;

use App\Base\Libraries\SMS\SMSContract;

class SendQueuedSMS
{
    /** @var string */
    protected $provider;

    /** @var array */
    protected $numbers;

    /** @var string */
    protected $message;

    /** @var int */
    protected $type;

    /**
     * Create a new job instance.
     *
     * @param string $provider
     * @param array $numbers
     * @param string $message
     * @param int $type
     */
    public function __construct($provider, $numbers, $message, $type)
    {
        $this->provider = $provider;
        $this->numbers = $numbers;
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Handle the queued job.
     *
     * @param \App\Base\Libraries\SMS\SMSContract $sms
     */
    public function handle(SMSContract $sms)
    {
        $sms->with($this->provider)
            ->send($this->numbers, $this->message, $this->type);
    }

    /**
     * Get the display name for the queued job.
     *
     * @return string
     */
    public function displayName()
    {
        return 'SMS';
    }
}
