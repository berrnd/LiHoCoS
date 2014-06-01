<?php

class HardwareController {

    public function __construct() {
        $this->ci = & get_instance();
    }

    /**
     * @var CI_Controller
     */
    protected $ci;

}
