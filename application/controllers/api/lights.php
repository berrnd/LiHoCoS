<?php

/**
 * @property Lights_model $lights_model
 */
class Lights extends ApiController {

    public function __construct() {
        parent::__construct();

        $this->load->model('lights_model');
        $this->load->helper('plugin');
    }

    public function switch_light($lightId, $onOrOff) {
        $light = $this->lights_model->get($lightId);
        $lightController = new LightController($light);

        if ($lightController->switch_light($onOrOff))
            $this->api_output(TRUE, 'Light successfully controlled', NULL);
        else
            $this->api_output(FALSE, 'Light controlling failed, check log', NULL);
    }

}
