<?php

/**
 * @property Blinds_model $blinds_model
 * @property Cameras_model $cameras_model
 * @property Computers_model $computers_model
 * @property Doors_model $doors_model
 * @property Lights_model $lights_model
 * @property Sensors_model $sensors_model
 * @property Windows_model $windows_model
 */
class Home extends SessionController {

    public function __construct() {
        parent::__construct();

        $this->load->model('blinds_model');
        $this->load->model('cameras_model');
        $this->load->model('computers_model');
        $this->load->model('doors_model');
        $this->load->model('lights_model');
        $this->load->model('sensors_model');
        $this->load->model('windows_model');
    }

    public function index() {
        $blinds = $this->blinds_model->get();
        $cameras = $this->cameras_model->get();
        $computers = $this->computers_model->get();
        $doors = $this->doors_model->get();
        $lights = $this->lights_model->get();
        $sensors = $this->sensors_model->get();
        $windows = $this->windows_model->get();

        $data = array(
            'pageId' => 'home',
            'title' => lang('Home'),
            'blinds' => $blinds,
            'cameras' => $cameras,
            'computers' => $computers,
            'doors' => $doors,
            'lights' => $lights,
            'sensors' => $sensors,
            'windows' => $windows
        );

        $this->load->view('home', $data);
    }
    
    public function sensor_history() {
        $data = array(
            'pageId' => 'home-sensors-history',
            'title' => lang('Home')
        );

        $this->load->view('home_sensors_history', $data);
    }

}
