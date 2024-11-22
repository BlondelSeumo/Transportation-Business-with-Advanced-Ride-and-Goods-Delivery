<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\MailOtp;
use App\Models\User;
use App\Base\Constants\Setting\Settings;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $otp;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otp)
    {

            $this->otp = $otp;

     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $otp = $this->otp;

        $app_name = get_settings('app_name');

        return $this->view('emails.otp', ['otp' => $otp, 'app_name' => $app_name]);
    }
}
