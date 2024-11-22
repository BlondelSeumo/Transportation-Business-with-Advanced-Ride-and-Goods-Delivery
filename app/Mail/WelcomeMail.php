<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Master\MailTemplate;
use App\Models\User;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $mail_template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_template)
    {

            $this->mail_template = $mail_template;

     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail_template = $this->mail_template;

        // dd($mail_template);

        return $this->view('email.mails.welcomeMail', ['mail_template' => $mail_template]);
    }
}
