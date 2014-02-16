<?php

class LightsPlugin extends PluginHost {

    public function __construct() {
        parent::__construct();
        $this->pluginArea = PluginAreas::LIGHTS;
    }

    /**
     * Should switch on the given light
     * @param Lights_model $light
     * @return boolean (true when everyhting worked great, false when not)
     */
    public function switch_on(Lights_model $light) {
        //Will happen in the appropriate plugin
    }

    /**
     * Should switch off the given light
     * @param Lights_model $light
     * @return boolean (true when everyhting worked great, false when not)
     */
    public function switch_off(Lights_model $light) {
        //Will happen in the appropriate plugin
    }

}