<?php

namespace App\Jobs\Notifications\Auth\Registration;

use App\Jobs\Notifications\BaseNotification;
use App\Models\User;
use Illuminate\Mail\Message;

class UserRegistrationNotification extends BaseNotification
{
    /**
     * The registered user.
     *
     * @var User
     */
    protected $user;

    /**
     * Create a new job instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->sendRegistrationEmail();
    }

    /**
     * Send the user registration (welcome) email.
     */
    protected function sendRegistrationEmail()
    {
        $data = ['user' => $this->user];

        $this->mailer()
            ->send('email.auth.registration.user', $data, function (Message $message) {
                $message->to($this->user->email);
                $message->subject('Welcome to Tag Your Taxi');
            });
    }
}
