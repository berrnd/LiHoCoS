<?php

class Cameras_model extends Device {

    public function __construct() {
        parent::__construct();

        $this->table = 'cameras';
    }

    /**
     * @var string
     */
    public $snapshot_url;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @return Cameras_model | Cameras_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

}
