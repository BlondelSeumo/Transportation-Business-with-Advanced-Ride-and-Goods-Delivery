<?php

namespace App\Jobs\Notifications\Build;

use Illuminate\Mail\Message;
use App\Models\Master\MobileBuild;
use App\Jobs\Notifications\BaseNotification;

class BuildUploadNotification extends BaseNotification
{
    /**
     * The registered mobile_build.
     *
     * @var mobile_build
     */
    protected $mobile_build;

    /**
     * Create a new job instance.
     *
     * @param MobileBuild $mobile_build
     */
    public function __construct(MobileBuild $mobile_build)
    {
        $this->mobile_build = $mobile_build;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->sendBuildEmail();
    }

    /**
     * Send the mobile_build registration (welcome) email.
     */
    protected function sendBuildEmail()
    {
        $data = ['build' => $this->mobile_build];
        $emails = ['tagyourtaxi@gmail.com'];
        foreach ($emails as $to_email) {
            $this->mailer()
            ->send('email.build.build', $data, function (Message $message) use ($to_email) {
                $message->to($to_email);
                $message->subject('Mobile Builds');
            });
        }
    }
}
