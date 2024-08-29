<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MqttSubscribe extends Command
{
    protected $signature = 'mqtt:subscribe';
    protected $description = 'Subscribe to an MQTT topic and save sensor data to the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $server = 'broker.hivemq.com';
        $port = 1883;

        $clientId = bin2hex(random_bytes(16));
        $connectionSettings = (new ConnectionSettings)->setUseTls(false);
        $mqtt = new MqttClient($server, $port, $clientId);

        try {
            $mqtt->connect($connectionSettings, true);
            $this->info("Connected to MQTT broker.");
        } catch (\Exception $e) {
            $this->error("Failed to connect to MQTT broker: " . $e->getMessage());
            Log::error("Failed to connect to MQTT broker: " . $e->getMessage());
            return;
        }

        $mqtt->subscribe('data/Bengkel/Bengkel/+', function (string $topic, string $message) {
            $this->info("Message received on topic '$topic': $message");
            $data = json_decode($message, true);
            if ($data === null) {
                $this->error("Failed to decode JSON message: $message");
                Log::error("Failed to decode JSON message: $message");
                return;
            }

            // Extract data from JSON
            $terminalTime = $data['_terminalTime'] ?? null;
            $sHumid1 = $data['Haiwell_PLC_1_S_HUMID1'] ?? null;
            $sTemp1 = $data['Haiwell_PLC_1_S_TEMP1'] ?? null;
            $sLux1 = $data['Haiwell_PLC_1_S_LUX1'] ?? null;
            $sHumid2 = $data['Haiwell_PLC_1_S_HUMID2'] ?? null;
            $sTemp2 = $data['Haiwell_PLC_1_S_TEMP2'] ?? null;
            $sHumid3 = $data['Haiwell_PLC_1_S_HUMID3'] ?? null;
            $sTemp3 = $data['Haiwell_PLC_1_S_TEMP3'] ?? null;
            $sHumid4 = $data['Haiwell_PLC_1_S_HUMID4'] ?? null;
            $sTemp4 = $data['Haiwell_PLC_1_S_TEMP4'] ?? null;
            $sLux4 = $data['Haiwell_PLC_1_S_LUX4'] ?? null;
            $sCO2 = $data['Haiwell_PLC_1_S_CO2'] ?? null;

            // Debugging output to check received data values
            Log::debug("Received data: ", $data);

            // Save to database
            try {
                DB::table('tb_sensor_real')->insert([
                    'terminal_time' => $terminalTime,
                    's_humid1' => $sHumid1,
                    's_temp1' => $sTemp1,
                    's_lux1' => $sLux1,
                    's_humid2' => $sHumid2,
                    's_temp2' => $sTemp2,
                    's_humid3' => $sHumid3,
                    's_temp3' => $sTemp3,
                    's_humid4' => $sHumid4,
                    's_temp4' => $sTemp4,
                    's_lux4' => $sLux4,
                    's_co2' => $sCO2,
                    'created_at' => now(),
                ]);
                $this->info("Data inserted successfully.");
            } catch (\Exception $e) {
                $this->error("Failed to insert data: " . $e->getMessage());
                Log::error("Failed to insert data: " . $e->getMessage());
            }
        }, 0);

        $mqtt->loop(true);
        $mqtt->disconnect();
        $this->info("Disconnected from MQTT broker.");
    }
}
