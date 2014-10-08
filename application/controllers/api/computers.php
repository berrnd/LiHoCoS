<?php

/**
 * @property Computers_model $computers_model
 */
class Computers extends ApiController {

    public function __construct() {
        parent::__construct();

        $this->load->model('computers_model');
        $this->load->model('computers_traffic_model');
        $this->load->helper('plugin');
    }

    public function wake($computerId) {
        $computer = $this->computers_model->get($computerId);
        $computerController = new ComputerController($computer);
        $computerController->wake();

        $this->api_output(TRUE, 'Magic packet sent', NULL);
    }

    public function add_traffic($computerId, $date, $bytesIn, $bytesOut) {
        $computer = $this->computers_model->get($computerId);

        $dataPoint = new Computers_Traffic_model();
        $dataPoint->computer_id = $computerId;
        $dataPoint->date = $date;
        $dataPoint->bytes_in = $bytesIn;
        $dataPoint->bytes_out = $bytesOut;
        $dataPoint->save();

        $this->api_output(TRUE, 'Success', NULL);
    }

}
