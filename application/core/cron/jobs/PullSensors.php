<?php

class PullSensors extends CronJob {

    public function __construct() {
        parent::__construct();

        $this->interval_minutes = 5;
    }

    public function execute() {
        $this->ci->load->model('sensors_model');
        $this->ci->load->helper('plugin');

        $sensorPluginName = get_setting(KnownSettings::PLUGIN_SENSORS);
        load_plugin_class(PluginAreas::SENSORS, $sensorPluginName);
        $sensorPlugin = new $sensorPluginName();

        $sensors = $this->ci->sensors_model->get();

        foreach ($sensors as $sensor) {
            $originUpdateTime = $sensor->last_change;
            $sensor = $sensorPlugin->update_sensor_values($sensor);

            if (strtotime($originUpdateTime) < strtotime($sensor->last_change)) {
                //Sensor has been updated

                $sensor->save();
                $sensor->make_history_entry();
            }
        }
    }

}
