<?php

class Common extends ApiController {

    //TODO: Unfiltered SQL is not good!
    public function get_data($model) {
        $modelClass = $model . '_model';
        $this->load->model($modelClass);

        if (empty($_REQUEST['custom-select']))
            $rows = $this->$modelClass->get();
        else
            $rows = $this->$modelClass->get_custom_select(urldecode($_REQUEST['custom-select']), TRUE);

        $this->api_output(TRUE, 'Success', $rows);
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

        $this->api_output(TRUE, 'Boot done', NULL);
    }

    public function call_plugin_function($pluginArea, $pluginClassName, $functionName) {
        $this->load->helper('plugin');

        load_plugin_class($pluginArea, $pluginClassName);
        $plugin = new $pluginClassName();
        $plugin->$functionName();

        $this->api_output(TRUE, 'No error', NULL);
    }

}
