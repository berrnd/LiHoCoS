<?php

/**
 * @property Blinds_model $blinds_model
 */
class Blinds extends SessionController {

    public function __construct() {
        parent::__construct();

        $this->load->model('blinds_model');
        $this->load->helper('plugin');
    }

    public function set_position($blindId, $newPosition) {
        $blind = $this->blinds_model->get($blindId);
        $blindController = new BlindController($blind);

        if ($blindController->set_position($newPosition))
            echo 'OK';
        else
            plugin_ajax_error();
    }

}
