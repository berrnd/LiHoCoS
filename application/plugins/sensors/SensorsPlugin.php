<?php

class SensorsPlugin extends PluginHost {

    public function __construct() {
        parent::__construct();
        $this->pluginArea = PluginAreas::SENSORS;
    }

    /**
     * Should update the values (temperature, relative_humidity and last_update) of the given sensor
     * and returning (not saving) it after that
     * @param Sensors_model $sensor
     * @return Sensors_model
     */
    public function update_sensor_values(Sensors_model $sensor) {
        //Will happen in the appropriate plugin
    }

}