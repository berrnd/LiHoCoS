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

    public function import_from_google_takeout() {
        $config['upload_path'] = APPPATH . '/cache/';
        $config['file_name'] = 'google_location_history.json';
        $config['overwrite'] = TRUE;
        $config['allowed_types'] = 'zip|json';
        $config['max_size'] = '0';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            echo $this->upload->display_errors();
        } else {
            echo 'success';
        }
//        $jsonRaw = file_get_contents($localFilePath);
//        $json = json_decode($jsonRaw);
//
//        foreach ($json->locations as $location) {
//            $timestamp = $location->timestampMs;
//            $latitude = $location->latitudeE7 / 10000000;
//            $longitude = $location->longitudeE7 / 10000000;
//            $accuracy = $location->accuracy;
//        }
    }

}
