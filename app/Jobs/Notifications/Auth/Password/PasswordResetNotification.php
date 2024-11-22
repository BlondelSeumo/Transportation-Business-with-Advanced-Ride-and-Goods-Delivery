<?php

namespace App\Jobs\Notifications\Auth\Password;

use App\Models\User;
use Illuminate\Mail\Message;
use App\Jobs\Notifications\BaseNotification;

class PasswordResetNotification extends BaseNotification
{
    /**
     * The user resetting the password.
     *
     * @var User
     */
    protected $user;

    /**
     * The password reset token.
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
        $this->sendPasswordResetEmail();
    }

    /**
     * Send the password reset email.
     */
    protected function sendPasswordResetEmail()
    {
        $data = ['user' => $this->user, 'token' => $this->token];

        $this->mailer()
            ->send('email.auth.password.reset', $data, function (Message $message) {
                $message->to($this->user->email);
                $message->subject('Reset Password');
            });
    }
}
