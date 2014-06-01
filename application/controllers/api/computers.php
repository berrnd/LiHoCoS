<?php

/**
 * @property Computers_model $computers_model
 */
class Computers extends SessionController {

    public function __construct() {
        parent::__construct();

        $this->load->model('computers_model');
        $this->load->helper('plugin');
    }

    public function wake($computerId) {
        $computer = $this->computers_model->get($computerId);
        $computerController = new ComputerController($computer);
        $computerController->wake();
    }

}
