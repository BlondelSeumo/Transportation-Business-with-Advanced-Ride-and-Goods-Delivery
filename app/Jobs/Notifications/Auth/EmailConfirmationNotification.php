<?php

namespace App\Jobs\Notifications\Auth;

use App\Models\User;
use Illuminate\Mail\Message;
use App\Jobs\Notifications\BaseNotification;

class EmailConfirmationNotification extends BaseNotification
{
    /**
     * The registered user.
     *
     * @var User
     */
    protected $user;

    /**
     * The email confirmation token.
     *
     * @var string
     */
    protected $token;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param string $token
     */
    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->sendConfirmationEmail();
    }

    /**
     * Send the email confirmation mail.
     */
    protected function sendConfirmationEmail()
    {
        $data = ['user' => $this->user, 'token' => $this->token];

        $this->mailer()
            ->send('email.auth.email-confirmation', $data, function (Message $message) {
                $message->to($this->user->email);
                $message->subject('Confirm your email');
            });
    }
}
