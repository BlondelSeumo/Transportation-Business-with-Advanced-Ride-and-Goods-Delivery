<?php

namespace App\Notifications\Recipients;

use Illuminate\Notifications\Notifiable;

abstract class Recipient
{
    use Notifiable;

    /**
     * The email to which the mail notifications are sent.
     *
     * @var string
     */
    protected $email;

    /**
     * The mobile number to which the sms notifications are sent.
     *
     * @var string
     */
    protected $mobile;

    /**
     * Set the notification email.
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set the notification mobile number.
     *
     * @param string $mobile
     * @return $this
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }
}
