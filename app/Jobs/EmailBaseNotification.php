<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

abstract class EmailBaseNotification
{
    use SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    abstract public function handle();

    /**
     * Get the Mailer instance.
     *
     * @return \Illuminate\Mail\Mailer
     */
    protected function mailer()
    {
        return app('mailer');
    }
}
