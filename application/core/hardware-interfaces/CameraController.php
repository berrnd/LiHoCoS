<?php

class CameraController extends HardwareController {

    public function __construct(Cameras_model $camera) {
        parent::__construct();

        $this->camera = $camera;
    }

    private $camera;

    public function snapshot() {
        $url = $this->camera->snapshot_url;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $this->camera->username . ':' . $this->camera->password);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);

        if (empty($result))
            $result = file_get_contents(APPPATH . '/views/img/camera_error.png');

        return $result;
    }

}
