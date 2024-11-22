<?php

namespace App\Jobs\Notifications\Exception;

use App\Jobs\Notifications\BaseNotification;
use Illuminate\Mail\Message;

class SendExceptionToEmailNotification extends BaseNotification
{
    /**
     * The emailTemplateModel.
     *
     * @var User
     */
    protected $emailTemplateModel;
    protected $to_email;

    /**
     * Create a new job instance.
     *
     * @param  $emailTemplateModel
     */
    public function __construct($emailTemplateModel, $to_email)
    {
        $this->emailTemplateModel = $emailTemplateModel;
        $this->to_email = $to_email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->sendExceptionEmail();
    }

    /**
     * Send the user registration (welcome) email.
     */
    protected function sendExceptionEmail()
    {
        $appName = \Config::get('app.name');

        $this->mailer()
            ->send('email.errors.exception', $this->emailTemplateModel, function (Message $message) {
                $message->subject($appName . 'CRASH Report');
                $message->to($this->to_email);
                $message->subject('Welcome to Tag Your Taxi');
            });
    }
}
