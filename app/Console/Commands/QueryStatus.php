<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;
use PhpMqtt\Client\MqttClient;

class QueryStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:query';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mqtt = MQTT::connection();


        // Subscribe to the topic
        // echo 'Querying status...';
        // $mqtt->publish('device/status', function (string $topic, string $message) {
        //     echo sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message);
        // }, 1);
        $mqtt->publish('device/status', 'testing', 1);


        // Wait for the subscription to be established
        // $mqtt->loop(true, true);

        return Command::SUCCESS;
    }
}
