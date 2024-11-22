<?php

namespace App\Jobs\Notifications\Auth\Registration;

use App\Jobs\EmailBaseNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class ContactusNotification extends EmailBaseNotification
{


    use Dispatchable, SerializesModels;


    /**
     * The registered user.
     *
     * @var User
     */
    protected $data;

    /**
     * Create a new job instance.
     *
     * @param User $user
     */
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Send the mail
        try {
            Mail::to(get_settings('mail_from_address'))
                ->send(new ContactUsMail($this->data));
        } catch (\Exception $e) {
            // Log the error or handle failure
            \Log::error('Mail sending failed: ' . $e->getMessage());
        }
    }

}
