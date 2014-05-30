<?php

class PullBlindStates extends CronJob {

    public function __construct() {
        parent::__construct();
        
        $this->interval_minutes = 5;
    }

    public function execute() {
        $this->ci->load->model('blinds_model');
        $this->ci->load->helper('plugin');

        $blindsPluginName = get_setting(KnownSettings::PLUGIN_BLINDS);
        load_plugin_class(PluginAreas::BLINDS, $blindsPluginName);
        $blindsPlugin = new $blindsPluginName();

        $blinds = $this->ci->blinds_model->get();

        foreach ($blinds as $blind) {
            $lastPosition = $blind->position;
            $currentPosition = $blindsPlugin->get_position($blind);

            if ($lastPosition != $currentPosition) {
                //Blind has been updated

                $blind->position = $currentPosition;
                $blind->last_change = mysql_now();
                $blind->save();
                $blind->make_history_entry();
            }
        }
    }

}
