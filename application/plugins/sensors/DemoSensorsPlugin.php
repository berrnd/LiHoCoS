<?php

require_once 'SensorsPlugin.php';

class DemoSensorsPlugin extends SensorsPlugin {

    public function __construct() {
        parent::__construct();

        //Provide plugin details
        $this->pluginReadableName = 'Demo/Example Plugin for Sensors';
        $this->pluginDescription = 'Demo description...';
        $this->authorName = 'Bernd Bestel';
        $this->authorWebsite = 'http://berrnd.de';
        $this->pluginWebsite = '';

        //Register your settings
        $this->register_setting('mysetting1', 'Setting1', 'Helptext for Setting1');
    }

    /**
     * {@inheritdoc}
     */
    public function update_sensor_values(Sensors_model $sensor) {
        //Querying the current values of the given sensor...
        return $sensor;
    }

}