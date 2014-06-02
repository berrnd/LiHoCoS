<?php

abstract class PluginHost {

    public function __construct() {
        $this->ci = & get_instance();
        $this->id = get_class($this);
        $this->settings = array();
        $this->bootFunctionNames = array();
    }

    /**
     * @var string
     */
    public $id;

    /**
     * @var CI_Controller
     */
    public $ci;

    /**
     * @var string
     */
    public $pluginReadableName;

    /**
     * @var string
     */
    public $pluginDescription;

    /**
     * @var string
     */
    public $authorName;

    /**
     * @var string
     */
    public $authorWebsite;

    /**
     * @var string
     */
    public $pluginWebsite;

    /**
     * @var ArrayObject
     */
    public $settings;

    /**
     * @var ArrayObject
     */
    public $bootFunctionNames;

    /**
     * @var string
     */
    public $pluginArea;

    /**
     * @param string $key
     * @param string $description
     * @return string
     */
    protected function register_setting($key, $readableName, $helpText) {
        $this->settings[] = array(
            'key' => 'plugin_' . $this->id . '_' . $key,
            'readableName' => $readableName,
            'helpText' => $helpText
        );
    }

    /**
     * @param string $key
     * @return string
     */
    protected function get_setting($key) {
        $settingKey = 'plugin_' . $this->id . '_' . $key;
        return get_setting($settingKey);
    }

    /**
     * @param string $key
     * @param string $value
     */
    protected function set_setting($key, $newValue) {
        $settingKey = 'plugin_' . $this->id . '_' . $key;
        set_setting($settingKey, $newValue);
    }

    /**
     * This functions will be executed on application start (e. g. after a server restart)
     * @param string $functionName
     */
    protected function register_boot_function($functionName) {
        $this->bootFunctionNames[] = $functionName;
    }

    /**
     * Should return all the devices the appropriate plugin is responsible for
     * (if any, if not then FALSE or simply don't implement this function)
     * @return ArrayObject (an array if arrray('id', 'readableName'))
     */
    public function get_devices() {
        //Will happen in the appropriate plugin
        return FALSE;
    }

    /**
     * Returns the url to directly call a plugin function (this can not have parameters)
     * @param string $functionName
     */
    protected function get_direct_function_url($functionName) {
        $apiKey = current_user_api_key();
        return base_url("/api/common/call_plugin_function/$this->pluginArea/$this->id/$functionName?api-key=$apiKey");
    }

}
