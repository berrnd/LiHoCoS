<?php

class BlindController extends HardwareController {

    public function __construct(Blinds_model $blind) {
        parent::__construct();

        $this->blind = $blind;
        $this->ci->load->helper('plugin');
    }

    private $blind;

    public function set_position($newPosition) {
        $blindPluginName = get_setting(KnownSettings::PLUGIN_BLINDS);
        load_plugin_class(PluginAreas::BLINDS, $blindPluginName);
        $blindPlugin = new $blindPluginName();

        $result = FALSE;
        if ($blindPlugin->set_position($this->blind, $newPosition)) {
            $this->blind->position = $newPosition;
            $this->blind->last_change = mysql_now();
            $this->blind->save();

            $this->blind->make_history_entry();

            $result = TRUE;
        }

        return $result;
    }

    public function get_position() {
        $blindPluginName = get_setting(KnownSettings::PLUGIN_BLINDS);
        load_plugin_class(PluginAreas::BLINDS, $blindPluginName);
        $blindPlugin = new $blindPluginName();

        return $blindPlugin->get_position($this->blind);
    }

}
