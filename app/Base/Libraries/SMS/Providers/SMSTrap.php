<?php

namespace App\Base\Libraries\SMS\Providers;

use App\Base\Libraries\SMS\SMS;
use Illuminate\Mail\Message;
use Mail;

class SMSTrap implements ProviderContract
{
    /** @var string */
    protected $email;

    /**
     * SMSTrap constructor.
     *
     * @param array $settings
     */
    public function __construct($settings)
    {
        $this->email = data_get($settings, 'email');

        if (empty($this->email)) {
            $this->email = config('notification.default_alert.email');
        }
    }

    /**
     * Trap the SMS and send an email with the SMS details.
     *
     * @param array $numbers
     * @param string $message
     * @param int $type
     * @return bool
     */
    public function send(array $numbers, $message, $type)
    {
        $numberText = 'Mobile Number(s): ' . implode(', ', $numbers);
        $messageText = 'Message: ' . $message;
        $typeText = 'Type: ' . ($type === SMS::TRANSACTIONAL ? 'TRANSACTIONAL' : 'PROMOTIONAL');
        $subject = 'SMS Trapped: ' . array_first($numbers);
        $trapText = "SMS Trapped\n-----------\n{$numberText}\n{$messageText}\n{$typeText}";

        Mail::raw($trapText, function (Message $message) use ($subject) {
            $message->to($this->email);
            $message->subject($subject);
        });

        return true;
    }
}
