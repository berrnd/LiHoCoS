<?php

class Common extends SessionController {

    public function get_data($model) {
        $modelClass = $model . '_model';
        $this->load->model($modelClass);
        $rows = $this->$modelClass->get();
        echo json_encode($rows);
    }

    public function boot() {
        //Execute registered plugin boot functions
        //TODO: Do this only for active plugins, not all
        $this->load->helper('plugin');
        $plugins = get_all_plugins();

        foreach ($plugins as $plugin) {
            foreach ($plugin->bootFunctionNames as $bootFunctionName) {
                $plugin->$bootFunctionName();
            }
        }
    }

    public function call_plugin_function($pluginArea, $pluginClassName, $functionName) {
        $this->load->helper('plugin');

        load_plugin_class($pluginArea, $pluginClassName);
        $plugin = new $pluginClassName();
        $plugin->$functionName();
    }

}
