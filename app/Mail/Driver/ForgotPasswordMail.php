<?php

namespace App\Mail\Driver;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Jobs\ForgotPassword;
use URL; 


class ForgotPasswordMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    protected $detail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detail)
    {
        $this->detail = $detail;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
            $token = $this->detail->token;
            $app_url = url()->current();
            
        return $this->view('email.forgetPassword', ['token' => $token, 'app_url' => $app_url]);

    }
}
