<?php

/**
 * @property Location_History_model $location_history_model
 */
class Location_History extends ApiController {

    public function __construct() {
        parent::__construct();

        $this->load->model('location_history_model');
    }

    public function add_data_point() {
        $timestamp = $this->input->post('timestamp');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $accuracy = $this->input->post('accuracy');

        if (!$timestamp || !$latitude || !$longitude)
            $this->api_output(FALSE, 'Missing parameter(s)', NULL);
        else {
            $dataPoint = new Location_History_model();
            $dataPoint->timestamp = $timestamp;
            $dataPoint->latitude = $latitude;
            $dataPoint->longitude = $longitude;
            $dataPoint->accuracy = $accuracy;
            $dataPoint->save();

            $this->api_output(TRUE, 'Success', NULL);
        }
    }

}
