<?php

namespace App\Base\Libraries\SMS\Providers;

use App\Base\Libraries\SMS\Exceptions\SMSFailException;
use App\Base\Libraries\SMS\Exceptions\SMSInsufficientCreditsException;
use App\Base\Libraries\SMS\Exceptions\SMSMaxNumbersException;
use App\Base\Libraries\SMS\SMS;

class MSG91 extends AbstractProvider implements ProviderContract
{
    /** Transactional SMS route */
    const TRANSACTIONAL_ROUTE = 4;

    /** Promotional SMS route */
    const PROMOTIONAL_ROUTE = 1;

    /** Default country code to use */
    const DEFAULT_COUNTRY_CODE = 91;

    /** @var string */
    protected $apiUrl = 'https://control.msg91.com/api/sendhttp.php';

    /** @var string */
    protected $authKey;

    /** @var string */
    protected $senderId;

    /**
     * MSG91 constructor.
     *
     * @param array $settings
     */
    public function __construct($settings)
    {
        $this->authKey = data_get($settings, 'authkey');
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
        /*
     	* MSG91 only allows sending SMS to 100 numbers at once.
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

        $responseType = data_get($response, 'type');
        $responseMessage = data_get($response, 'message');
        $responseCode = data_get($response, 'code');

        if (is_null($responseType) || mb_strtolower($responseType) !== 'success') {
            if (!is_null($responseCode) && (int) $responseCode === 301) {
                throw new SMSInsufficientCreditsException($responseMessage);
            }
            throw new SMSFailException($responseMessage);
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

        return [
            'authkey' => $this->authKey,
            'sender' => $this->senderId,
            'mobiles' => implode(',', $numbers),
            'message' => $message,
            'route' => $type === SMS::TRANSACTIONAL ? self::TRANSACTIONAL_ROUTE : self::PROMOTIONAL_ROUTE,
            'country' => self::DEFAULT_COUNTRY_CODE,
            'response' => 'json',
        ];
    }

    /**
     * Validate the provider settings.
     *
     * @throws SMSFailException
     */
    protected function validateSettings()
    {
        if (empty($this->authKey) || empty($this->senderId)) {
            throw new SMSFailException('Missing required configuration for sending SMS with MSG91.');
        }
    }
}
