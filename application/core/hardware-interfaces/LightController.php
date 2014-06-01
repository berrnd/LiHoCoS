<?php

class LightController extends HardwareController {

    public function __construct(Lights_model $light) {
        parent::__construct();
        
        $this->light = $light;
        $this->ci->load->helper('plugin');
    }

    private $light;

    public function switch_light($onOrOff) {
        $lightPluginName = get_setting(KnownSettings::PLUGIN_LIGHTS);
        load_plugin_class(PluginAreas::LIGHTS, $lightPluginName);
        $lightPlugin = new $lightPluginName();

        $result = FALSE;
        if ($onOrOff == 1)
            $result = $lightPlugin->switch_on($this->light);
        else
            $result = $lightPlugin->switch_off($this->light);

        if ($result) {
            $this->light->state = $onOrOff;
            $this->light->last_change = mysql_now();
            $this->light->save();

            $this->light->make_history_entry();
        }

        return $result;
    }

}
