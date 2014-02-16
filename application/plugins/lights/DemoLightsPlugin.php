<?php

require_once 'LightsPlugin.php';

class DemoLightsPlugin extends LightsPlugin {

    public function __construct() {
        parent::__construct();

        //Provide plugin details
        $this->pluginReadableName = 'Demo/Example Plugin for Lights';
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
    public function switch_on(Lights_model $light) {
        //Switching on the given light...
        return TRUE;
    }

    /**
     * {@inheritdoc}
     */
    public function switch_off(Lights_model $light) {
        //Switching off the given light...
        return TRUE;
    }

}