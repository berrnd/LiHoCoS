<?php

/**
 * @property Cameras_model $cameras_model
 */
class Cameras extends ApiController {

    public function __construct() {
        parent::__construct();

        $this->load->model('cameras_model');
        $this->load->helper('output');
    }

    public function snapshot($cameraId) {
        no_cache_headers();
        header('Content-Type: image/jpg');
        header('X-Server-Time: ' . format_datetime_user_defined(mysql_now()));

        $camera = $this->cameras_model->get($cameraId);
        $cameraController = new CameraController($camera);
        $image = $cameraController->snapshot();

        if ($image === FALSE) {
            http_404();
            return;
        }

        if (isset($_GET['base64']))
            echo chunk_split(base64_encode($image));
        else
            echo $image;
    }

}
