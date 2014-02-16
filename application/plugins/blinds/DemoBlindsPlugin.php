<?php

require_once 'BlindsPlugin.php';

class DemoBlindsPlugin extends BlindsPlugin {

    public function __construct() {
        parent::__construct();

        //Provide plugin details
        $this->pluginReadableName = 'Demo/Example Plugin for Blinds';
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
    public function set_position(Blinds_model $blind, $newPosition) {
        //Controlling the given blind...
        return TRUE;
    }

    /**
     * {@inheritdoc}
     */
    public function get_position(Blinds_model $blind) {
        //Querying the current position of the given blind...
        return $blind->position;
    }

    /**
     * {@inheritdoc}
     */
    public function get_devices() {
        //Querying the list of devices in my system...

        $devices = array();

        $devices[] = array('1', 'DemoDevice1');
        $devices[] = array('2', 'DemoDevice2');
        $devices[] = array('3', 'DemoDevice3');
        $devices[] = array('4', 'DemoDevice4');
        $devices[] = array('5', 'DemoDevice5');

        return $devices;
    }

}
