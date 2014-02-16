<?php

require_once 'LightsPlugin.php';

class TellStickForSwitches extends LightsPlugin {

    public function __construct() {
        parent::__construct();

        //Provide plugin details
        $this->pluginReadableName = 'TellStick for Switches';
        $this->pluginDescription = 'Control TellStick remote sockets';
        $this->authorName = 'Bernd Bestel';
        $this->authorWebsite = 'http://berrnd.de';
        $this->pluginWebsite = '';

        //Register your settings
        $this->register_setting('tellstick_tdtool_path', 'TellStick tdtool-Path', 'The path to tdtool.exe (something like "C:/Program Files (x86)/Telldus/tdtool.exe")');
    }

    /**
     * {@inheritdoc}
     */
    public function switch_on(Lights_model $light) {
        return string_contains($this->tdtool('--on ' . $light->plugin_reference), 'Success');
    }

    /**
     * {@inheritdoc}
     */
    public function switch_off(Lights_model $light) {
        return string_contains($this->tdtool('--off ' . $light->plugin_reference), 'Success');
    }

    /**
     * @param string $params
     * @return string
     */
    private function tdtool($params) {
        return shell_exec('"' . $this->get_setting('tellstick_tdtool_path') . '"' . ' ' . $params);
    }

    /**
     * {@inheritdoc}
     */
    public function get_devices() {
        $rawOutput = $this->tdtool('--list');
        $lines = explode("\n", $rawOutput);

        $devices = array();

        $inDeviceLines = false;
        foreach ($lines as $line) {
            if (string_starts_with($line, 'Number of devices:')) {
                $inDeviceLines = true;
                continue;
            }

            if (string_starts_with($line, 'SENSORS:'))
                break;

            if ($inDeviceLines && !empty($line)) {
                $lineParts = explode("\t", $line);

                $tellstickId = trim($lineParts[0]);
                $description = trim($lineParts[1]);
                $state = trim($lineParts[2]);

                $devices[] = array($tellstickId, $description);
            }
        }

        return $devices;
    }

}