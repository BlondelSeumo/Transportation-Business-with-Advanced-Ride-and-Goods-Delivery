<?php

namespace App\Base\Libraries\SMS\Providers;

use App\Base\Libraries\SMS\SMS;

class SMSLog implements ProviderContract
{
    /**
     * Send the SMS.
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
        $logText = "SMS Logger\n{$numberText}\n{$messageText}\n{$typeText}";

        logger()->info($logText);

        return true;
    }
}
