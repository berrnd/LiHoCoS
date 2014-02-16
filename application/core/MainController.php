<?php

class MainController extends CI_Controller {

    public function __construct() {
        parent::__construct();

        date_default_timezone_set(get_setting(KnownSettings::TIMEZONE));
    }

}