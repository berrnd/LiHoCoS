<?php

class WindowsPlugin extends PluginHost {

    public function __construct() {
        parent::__construct();
        $this->pluginArea = PluginAreas::WINDOWS;
    }

    /**
     * Should return the current state of the given window
     * @param Windows_model $window
     * @return boolean
     */
    public function get_state(Windows_model $window) {
        //Will happen in the appropriate plugin
    }

}
