<?php

namespace App\Jobs\Notifications;

class OtpNotification extends BaseNotification
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
    protected $otp;

    /**
     * The message.
     *
     * @var string
     */
    protected $message;

    /**
     * Create a new job instance.
     *
     * @param string $mobile
     * @param string $otp
     */
    public function __construct($mobile, $otp, $message)
    {
        $this->mobile = $mobile;
        $this->otp = $otp;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->sendOtpSms();
    }

    /**
     * Send the otp sms.
     */
    protected function sendOtpSms()
    {
        $to = $this->mobile;
        // $message = "Your OTP is {$this->otp}"; // @TODO change this

        // @TODO implement send sms

        // Log the sms sent.
        \Log::info("Sent OTP Sms - with Mb: {$to}, Msg: {$this->message}");
    }
}
