<?php

/**
 * @property Cameras_model $cameras_model
 */
class Cameras extends SessionController {

    public function __construct() {
        parent::__construct();

        $this->load->model('cameras_model');
        $this->load->helper('output');
    }

    public function snapshot($cameraId) {
        no_cache_headers();
        header('Content-Type: image/jpg');
        header('X-Server-Time: ' . timestamp_to_date_time_string_iso(time()));

        $camera = $this->cameras_model->get($cameraId);
        $cameraController = new CameraController($camera);
        $image = $cameraController->snapshot();

        if (isset($_GET['base64']))
            echo chunk_split(base64_encode($image));
        else
            echo $image;
    }

}
