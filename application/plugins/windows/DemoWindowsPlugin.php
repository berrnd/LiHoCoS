<?php

require_once 'WindowsPlugin.php';

class DemoWindowsPlugin extends WindowsPlugin {

    public function __construct() {
        parent::__construct();

        //Provide plugin details
        $this->pluginReadableName = 'Demo/Example Plugin for Windows';
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
    public function get_state(Windows_model $window) {
        //Querying the current position of the given window...
        return $window->state;
    }

}
