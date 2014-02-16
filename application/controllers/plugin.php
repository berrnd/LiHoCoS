<?php

/**
 * @property Blinds_model $blinds_model
 * @property Cameras_model $cameras_model
 * @property Computers_model $computers_model
 * @property Doors_model $doors_model
 * @property Lights_model $lights_model
 * @property Sensors_model $sensors_model
 * @property Windows_model $windows_model
 */
class Plugin extends MainController {

    public function __construct() {
        parent::__construct();

        $this->load->model('blinds_model');
        $this->load->model('cameras_model');
        $this->load->model('computers_model');
        $this->load->model('doors_model');
        $this->load->model('lights_model');
        $this->load->model('sensors_model');
        $this->load->model('windows_model');
        $this->load->helper('plugin');
    }

    public function set_blind_position($blindId, $newPosition) {
        $blind = $this->blinds_model->get($blindId);

        if (!$blind)
            exit();

        $blindPluginName = get_setting(KnownSettings::PLUGIN_BLINDS);
        load_plugin_class(PluginAreas::BLINDS, $blindPluginName);
        $blindPlugin = new $blindPluginName();

        if ($blindPlugin->set_position($blind, $newPosition)) {
            $blind->position = $newPosition;
            $blind->last_change = mysql_now();
            $blind->save();

            $blind->make_history_entry();

            echo 'OK';
        }
        else
            plugin_ajax_error();
    }

    public function switch_light($lightId, $onOrOff) {
        $light = $this->lights_model->get($lightId);

        if (!$light)
            exit();

        $lightPluginName = get_setting(KnownSettings::PLUGIN_LIGHTS);
        load_plugin_class(PluginAreas::LIGHTS, $lightPluginName);
        $lightPlugin = new $lightPluginName();

        $result = FALSE;
        if ($onOrOff == 1)
            $result = $lightPlugin->switch_on($light);
        else
            $result = $lightPlugin->switch_off($light);

        if ($result) {
            $light->state = $onOrOff;
            $light->last_change = mysql_now();
            $light->save();

            $light->make_history_entry();

            echo 'OK';
        }
        else
            plugin_ajax_error();
    }

    public function read_sensors() {
        $sensorPluginName = get_setting(KnownSettings::PLUGIN_SENSORS);
        load_plugin_class(PluginAreas::SENSORS, $sensorPluginName);
        $sensorPlugin = new $sensorPluginName();

        $sensors = $this->sensors_model->get();

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

    public function computer_action($computerId, $action) {
        switch ($action) {
            case 'wake':
                break;
            case 'hibernate':
                break;
            case 'shutdown':
                break;
        }
    }

    public function call_function($pluginArea, $pluginClassName, $functionName) {
        load_plugin_class($pluginArea, $pluginClassName);
        $plugin = new $pluginClassName();
        $plugin->$functionName();
    }

    public function boot() {
        $plugins = get_all_plugins();

        foreach ($plugins as $plugin) {
            foreach ($plugin->bootFunctionNames as $bootFunctionName) {
                $plugin->$bootFunctionName();
            }
        }
    }

}