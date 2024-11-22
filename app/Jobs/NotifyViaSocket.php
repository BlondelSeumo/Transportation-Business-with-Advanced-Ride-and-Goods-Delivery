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

class NotifyViaSocket //implements ShouldQueue
{
    // use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event_name;
    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($event_name, $message)
    {
        $this->event_name = $event_name;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return;
        
        try {
            $path2 = base_path('/vendor/autoload.php');
            include("$path2");

            $socket_port=env('SOCKET_PORT');

            $socket_https=env('SOCKET_HTTPS');

            if ($socket_https == "yes") {
                $socket_url='http://localhost:'.$socket_port;
                $client = new Client(new Version2X($socket_url, ['context' => ['ssl' => ['verify_peer_name' =>false, 'verify_peer' => false]]]));
            } else {
                $socket_url='http://localhost:'."$socket_port";

                $client = new Client(new Version2X($socket_url));
            }
            Log::info("message-transfered");

            $client->initialize();
            $client->of('/php/user');
            $client->emit($this->event_name, $this->message);
            $client->close();
        } catch (\Expection $e) {
            Log::error($e);
        }
    }
}
