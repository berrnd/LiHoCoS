<?php

/**
 * @property Blinds_model $blinds_model
 * @property Blinds_model $blinds_history_model
 * @property Cameras_model $cameras_model
 * @property Computers_model $computers_model
 * @property Doors_model $doors_model
 * @property Lights_model $lights_model
 * @property Sensors_model $sensors_model
 * @property Windows_model $windows_model
 * @property Users_model $users_model
 * @property Settings_model $settings_model
 * @property Rooms_model $rooms_model
 */
class Api extends SessionController {

    public function __construct() {
        parent::__construct();

        $this->load->model('blinds_model');
        $this->load->model('blinds_history_model');
        $this->load->model('cameras_model');
        $this->load->model('computers_model');
        $this->load->model('doors_model');
        $this->load->model('lights_model');
        $this->load->model('sensors_model');
        $this->load->model('windows_model');
        $this->load->model('users_model');
        $this->load->model('settings_model');
        $this->load->model('rooms_model');
    }

    public function get_data($model) {
        $modelClass = $model . '_model';
        $rows = $this->$modelClass->get();
        echo json_encode($rows);
    }

//    public function camera_stream($cameraId) {
//        $camera = $this->cameras_model->get($cameraId);
//
//        $url = $camera->mjpeg_stream_url;
//        $credentials = sprintf('Authorization: Basic %s', base64_encode($camera->username . ':' . $camera->password));
//        $options = array(
//            'http' => array(
//                'method' => 'GET',
//                'header' => $credentials)
//        );
//
//        $context = stream_context_create($options);
//
//        $fp = fopen($url, 'r', false, $context);
//        fpassthru($fp);
//        fclose($fp);
//    }

}