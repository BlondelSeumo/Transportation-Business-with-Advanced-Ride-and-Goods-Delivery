<?php

namespace App\Base\Libraries\SMS\Providers;

use App\Base\Libraries\SMS\Exceptions\SMSFailException;
use App\Base\Libraries\SMS\Exceptions\SMSInsufficientCreditsException;
use App\Base\Libraries\SMS\Exceptions\SMSMaxNumbersException;
use App\Base\Libraries\SMS\SMS;

class SMSIndiaHub extends AbstractProvider implements ProviderContract
{
    /** @var string */
    protected $apiUrl = 'https://cloud.smsindiahub.in/vendorsms/pushsms.aspx';

    /** @var string */
    protected $username;

    /** @var string */
    protected $password;

    /** @var string */
    protected $senderId;

    /**
     * SMSIndiaHub constructor.
     *
     * @param array $settings
     */
    public function __construct($settings)
    {
        $this->username = data_get($settings, 'username');
        $this->password = data_get($settings, 'password');
        $this->senderId = data_get($settings, 'sender_id');

        if (($apiUrl = data_get($settings, 'api_url')) && $this->isValidUrl($apiUrl)) {
            $this->apiUrl = $apiUrl;
        }

        $this->validateSettings();
    }

    /**
     * Send the SMS.
     *
     * @param array $numbers
     * @param string $message
     * @param int $type
     * @return bool
     * @throws SMSFailException
     * @throws SMSInsufficientCreditsException
     */
    public function send(array $numbers, $message, $type)
    {
        /**
     	* SMSIndiaHub only allows sending SMS to 100 numbers at once.
     	* So we split the numbers into batches of 100 and send them.
        */
        $chunkedNumbers = collect($numbers)->chunk(100)->toArray();

        foreach ($chunkedNumbers as $numbers) {
            $this->sendChunkedSMS($numbers, $message, $type);
        }

        return true;
    }

    /**
     * Send the SMS for chunked numbers.
     *
     * @param array $numbers
     * @param string $message
     * @param int $type
     * @throws SMSFailException
     * @throws SMSInsufficientCreditsException
     */
    protected function sendChunkedSMS(array $numbers, $message, $type)
    {
        $query = $this->buildQuery($numbers, $message, $type);
        $response = $this->makeGetRequest($this->apiUrl, $query);

        $errorCode = data_get($response, 'ErrorCode');
        $errorMessage = data_get($response, 'ErrorMessage');

        if (is_null($errorCode) || (int) $errorCode !== 0) {
            if ((int) $errorCode === 21) {
                throw new SMSInsufficientCreditsException($errorMessage);
            }
            throw new SMSFailException($errorMessage);
        }
    }

    /**
     * Build the query array.
     *
     * @param array $numbers
     * @param string $message
     * @param int $type
     * @return array
     * @throws SMSFailException
     */
    protected function buildQuery(array $numbers, $message, $type)
    {
        if (count($numbers) > 100) {
            throw new SMSMaxNumbersException;
        }

        $query = [
            'user' => $this->username,
            'password' => $this->password,
            'sid' => $this->senderId,
            'msisdn' => implode(',', $numbers),
            'msg' => $message,
            'fl' => 0,
        ];

        if ($type === SMS::TRANSACTIONAL) {
            $query['gwid'] = 2;
        }

        return $query;
    }

    /**
     * Validate the provider settings.
     *
     * @throws SMSFailException
     */
    protected function validateSettings()
    {
        if (empty($this->username) || empty($this->password) || empty($this->senderId)) {
            throw new SMSFailException('Missing required configuration for sending SMS with SMSIndiaHub.');
        }
    }
}
