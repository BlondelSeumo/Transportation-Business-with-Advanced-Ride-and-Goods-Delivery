<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\MailOtp;
use App\Models\User;
use App\Base\Constants\Setting\Settings;

class RideDetailsMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $email,$ridedetails,$pick_address,$drop_address;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$ridedetails,$pick_address,$drop_address)
    {

            $this->email = $email;
            $this->ridedetails = $ridedetails;
            $this->pick_address = $pick_address;
            $this->drop_address = $drop_address;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->email;
        $ridedetails = $this->ridedetails;
        $pick_address = $this->pick_address;
        $drop_address = $this->drop_address;

        $app_name = get_settings('app_name');

        return $this->view('emails.ridedetails', ['email' => $email, 'ridedetails' => $ridedetails,'app_name' => $app_name,'pick_address'=>$pick_address,'drop_address'=>$drop_address]);
    }
}
