<?php

require_once 'DoorsPlugin.php';

class DemoDoorsPlugin extends DoorsPlugin {

    public function __construct() {
        parent::__construct();

        //Provide plugin details
        $this->pluginReadableName = 'Demo/Example Plugin for Doors';
        $this->pluginDescription = 'Demo description...';
        $this->authorName = 'Bernd Bestel';
        $this->authorWebsite = 'http://berrnd.de';
        $this->pluginWebsite = '';

        //Register your settings
        $this->register_setting('mysetting1', 'Setting1', 'Helptext for Setting1');
    }

    /**
     * {@inheritdoc}
     */
    public function get_state(Doors_model $door) {
        //Querying the current state of the door blind...
        return $door->state;
    }

}
