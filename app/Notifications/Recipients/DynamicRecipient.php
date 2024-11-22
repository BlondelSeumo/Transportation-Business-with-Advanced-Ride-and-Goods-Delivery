<?php

namespace App\Notifications\Recipients;

class DynamicRecipient extends Recipient
{
    public function __construct($email = null, $mobile = null)
    {
        $this->email = $email;

        $this->mobile = $mobile;
    }
}
