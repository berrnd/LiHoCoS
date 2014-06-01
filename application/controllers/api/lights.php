<?php

/**
 * @property Lights_model $lights_model
 */
class Lights extends SessionController {

    public function __construct() {
        parent::__construct();

        $this->load->model('lights_model');
        $this->load->helper('plugin');
    }

    public function switch_light($lightId, $onOrOff) {
        $light = $this->lights_model->get($lightId);
        $lightController = new LightController($light);

        if ($lightController->switch_light($onOrOff))
            echo 'OK';
        else
            plugin_ajax_error();
    }

}
