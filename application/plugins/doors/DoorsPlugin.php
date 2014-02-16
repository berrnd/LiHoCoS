<?php

class DoorsPlugin extends PluginHost {

    public function __construct() {
        parent::__construct();
        $this->pluginArea = PluginAreas::DOORS;
    }

    /**
     * Should return the current state of the given door
     * @param Doors_model $door
     * @return boolean
     */
    public function get_state(Doors_model $door) {
        //Will happen in the appropriate plugin
    }

}
