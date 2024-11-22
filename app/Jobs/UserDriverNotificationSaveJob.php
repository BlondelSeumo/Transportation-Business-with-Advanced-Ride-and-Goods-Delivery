<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserDriverNotificationSaveJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $users;

    public $drivers;

    public $pushSave;

    public function __construct($users, $drivers, $pushSave)
    {
        $this->users = $users;
        $this->drivers = $drivers;
        $this->pushSave  = $pushSave;
    }

    public function handle()
    {
        if (!empty($this->users)) {
            foreach ($this->users as $user) {
                $this->pushSave->userNotification()->create([
                    'user_id' => $user
                ]);
            }
        }

        if (!empty($this->drivers)) {
            foreach ($this->drivers as $driver) {
                $this->pushSave->userNotification()->create([
                    'driver_id' => $driver
                ]);
            }
        }
    }
}
