<?php

namespace App\Jobs\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;


class SendMailNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mail_template;


    protected $user_mail;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mail_template, $user_mail)
    {
        $this->mail_template = $mail_template;
        $this->user_mail = $user_mail;        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
                // dd($this->user_mail);

        Mail::to($this->user_mail)->send(new WelcomeMail($this->mail_template));

    }
}
