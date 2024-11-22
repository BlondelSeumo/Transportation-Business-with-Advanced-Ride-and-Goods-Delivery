<?php

namespace App\Helpers\Notification;

use Exception;

class AdminInformation
{
    /**
     * The admin email address.
     *
     * @var string
     */
    protected $email;

    /**
     * The admin email address for receiving ticket mails.
     *
     * @var string
     */
    protected $ticketEmail;

    /**
     * The admin email  mobile number.
     *
     * @var string
     */
    protected $mobile;

    /**
     * AdminInformation constructor.
     */
    public function __construct()
    {
        $config = config('notification');

        $this->email = data_get($config, 'admin_alert.email');

        $this->mobile = data_get($config, 'admin_alert.mobile');

        $this->ticketEmail = data_get($config, 'ticket_alert_email');

        $this->validate();
    }

    /**
     * Get the admin email.
     *
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * Get the admin ticket alert email.
     *
     * @return string
     */
    public function ticketEmail()
    {
        return $this->ticketEmail;
    }

    /**
     * Get the admin mobile number.
     *
     * @return string
     */
    public function mobile()
    {
        return $this->mobile;
    }

    /**
     * Validate the admin information values.
     *
     * @throws Exception
     */
    protected function validate()
    {
        if (!is_valid_email($this->email)) {
            throw new Exception('Invalid admin email address set in config.');
        }

        if (!is_valid_mobile_number($this->mobile)) {
            throw new Exception('Invalid admin mobile number set in config.');
        }

        if (!is_valid_email($this->ticketEmail)) {
            throw new Exception('Invalid ticket alert email address set in config.');
        }
    }
}
