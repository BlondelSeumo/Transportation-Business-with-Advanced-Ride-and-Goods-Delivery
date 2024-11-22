<?php

namespace App\Jobs;

use ElephantIO\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use ElephantIO\Engine\SocketIO\Version2X;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Salman\Mqtt\MqttClass\Mqtt;

class NotifyViaMqtt //implements ShouldQueue
{
    // use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event_name;
    protected $message;
    protected $client_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($event_name, $message, $client_id)
    {
        $this->event_name = $event_name;
        $this->message = $message;
        $this->client_id= $client_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $mqtt = new Mqtt();
            $output = $mqtt->ConnectAndPublish($this->event_name, $this->message, $this->client_id);
            Log::info($output);
        } catch (\Expection $e) {
            Log::error($e);
        }
    }
}
