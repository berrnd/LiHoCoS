<?php

include_once 'SensorsPlugin.php';

class TellStickForSensors extends SensorsPlugin {

    public function __construct() {
        parent::__construct();

        //Provide plugin details
        $this->pluginReadableName = 'TellStick for Sensors';
        $this->pluginDescription = 'Control TellStick thermo and hygro sensors';
        $this->authorName = 'Bernd Bestel';
        $this->authorWebsite = 'http://berrnd.de';
        $this->pluginWebsite = '';

        //Register your settings
        $this->register_setting('tellstick_tdtool_path', 'TellStick tdtool-Path', 'The path to tdtool.exe (something like "C:/Program Files (x86)/Telldus/tdtool.exe")');

        $this->ci->load->driver('cache', array('adapter' => 'file'));
    }

    /**
     * {@inheritdoc}
     */
    public function update_sensor_values(Sensors_model $sensor) {
        $rawOutput = $this->tdtool('--list');
        $lines = explode("\n", $rawOutput);

        $inSensorLines = false;
        foreach ($lines as $line) {
            if (string_starts_with($line, 'SENSORS:'))
                $inSensorLines = true;

            if ($inSensorLines && !string_starts_with($line, 'PROTOCOL') && !empty($line)) {
                $lineParts = explode("\t", $line);

                if (count($lineParts) == 6) {
                    $tellstickId = trim($lineParts[2]);
                    $temperature = trim($lineParts[3]);
                    $relativeHumidity = trim(str_replace('%', '', $lineParts[4]));
                    $lastUpdated = trim($lineParts[5]);

                    if ($tellstickId && $sensor->plugin_reference == $tellstickId &&
                            strtotime($sensor->last_change) < strtotime($lastUpdated)) {
                        $sensor->temperature = $temperature;
                        $sensor->relative_humidity = $relativeHumidity;
                        $sensor->last_change = $lastUpdated;
                    }
                }
            }
        }

        return $sensor;
    }

    private function tdtool($params) {
        $output = '';
        $cacheKey = "tdtool_$params";
        $cachedOutput = $this->ci->cache->get($cacheKey);

        if ($cachedOutput === FALSE) {
            $output = shell_exec('"' . $this->get_setting('tellstick_tdtool_path') . '"' . ' ' . $params);
            $this->ci->cache->save($cacheKey, $output, 10);
        }
        else
            $output = $cachedOutput;

        return $output;
    }

    /**
     * {@inheritdoc}
     */
    public function get_devices() {
        $rawOutput = $this->tdtool('--list');
        $lines = explode("\n", $rawOutput);

        $devices = array();

        $inSensorLines = false;
        foreach ($lines as $line) {
            if (string_starts_with($line, 'SENSORS:'))
                $inSensorLines = true;

            if ($inSensorLines && !string_starts_with($line, 'PROTOCOL') && !empty($line)) {
                $lineParts = explode("\t", $line);

                if (count($lineParts) == 6) {
                    $tellstickId = trim($lineParts[2]);
                    $temperature = trim($lineParts[3]);
                    $relativeHumidity = trim(str_replace('%', '', $lineParts[4]));
                    $lastUpdated = trim($lineParts[5]);

                    $text = sprintf('ID=%s, Temp=%s, Humidity=%s, LastUpdate=%s', $tellstickId, $temperature, $relativeHumidity, $lastUpdated);

                    if ($tellstickId)
                        $devices[] = array($tellstickId, $text);
                }
            }
        }

        return $devices;
    }

}