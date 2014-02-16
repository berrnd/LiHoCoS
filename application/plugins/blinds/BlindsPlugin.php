<?php

class BlindsPlugin extends PluginHost {

    public function __construct() {
        parent::__construct();
        $this->pluginArea = PluginAreas::BLINDS;
    }

    /**
     * Should set the position of the given blind
     * @param Blinds_model $blind
     * @param int $newPosition
     * @return boolean (true when everyhting worked great, false when not)
     */
    public function set_position(Blinds_model $blind, $newPosition) {
        //Will happen in the appropriate plugin
    }

    /**
     * Should return the current position of the given blind
     * @param Blinds_model $blind
     * @return int
     */
    public function get_position(Blinds_model $blind) {
        //Will happen in the appropriate plugin
    }

}
