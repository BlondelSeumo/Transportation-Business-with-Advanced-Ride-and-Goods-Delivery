<?php

namespace App\Jobs\Notifications;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;


class SmsNotification extends BaseNotification
{
    /**
     * The mobile number.
     *
     * @var string
     */
    protected $mobile;

    /**
     * The otp.
     *
     * @var string
     */
    protected $sms;

    /**
     * The message.
     *
     * @var string
     */

    /**
     * Create a new job instance.
     *
     * @param string $mobile
     * @param string $otp
     */
    public function __construct($mobile, $sms)
    {
        $this->mobile = $mobile;
        $this->sms = $sms;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->sendSms();
    }

    /**
     * Send the otp sms.
     */
    protected function sendSms()
    {
        // dd($this->mobile);
        $recipientPhoneNumber = $this->mobile;
        $sms = $this->sms;
Log::info("sms");

Log::info($recipientPhoneNumber);

        $twilioSid = env('TWILIO_SID');
        $twilioToken = env('TWILIO_AUTH_TOKEN');
        $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');

        $url = "https://api.twilio.com/2010-04-01/Accounts/{$twilioSid}/Messages.json";

        $postData = [
            'From' => $twilioPhoneNumber,
            'To' => $recipientPhoneNumber,
            'Body' => $sms,
        ];

        $postFields = http_build_query($postData);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_USERPWD, "{$twilioSid}:{$twilioToken}");

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;

    }
}
