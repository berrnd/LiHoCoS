<?php

/**
 * @property Blinds_model $blinds_model
 */
class Blinds extends ApiController {

    public function __construct() {
        parent::__construct();

        $this->load->model('blinds_model');
        $this->load->helper('plugin');
    }

    public function set_position($blindId, $newPosition) {
        $blind = $this->blinds_model->get($blindId);
        $blindController = new BlindController($blind);

        if ($blindController->set_position($newPosition))
            $this->api_output(TRUE, "Blind set to position $newPosition", NULL);
        else
            $this->api_output(FALSE, 'Blind controlling failed, check log', NULL);
    }

    public function get_position($blindId) {
        $blind = $this->blinds_model->get($blindId);
        $blindController = new BlindController($blind);

        $position = $blindController->get_position();
        $data = array(
            'position' => $position
        );

        $this->api_output(TRUE, 'Success', $data);
    }

}
