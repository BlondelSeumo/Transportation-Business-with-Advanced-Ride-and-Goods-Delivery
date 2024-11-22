<?php

namespace App\Notifications\Recipients;

use App\Helpers\Notification\AdminInformation;

class AdminRecipient extends Recipient
{
    public function __construct()
    {
        $adminInfo = new AdminInformation;

        $this->email = $adminInfo->email();

        $this->mobile = $adminInfo->mobile();
    }
}
