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
        $this->load->helper('network');
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
        } else
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
        } else
            plugin_ajax_error();
    }

    public function computer_action($computerId, $action) {
        $computer = $this->computers_model->get($computerId);

        switch ($action) {
            case 'wake':
                wakeOnLan($computer->mac, get_setting(KnownSettings::LOCAL_BROADCAST_ADDRESS));
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
