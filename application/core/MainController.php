<?php

class MainController extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $timezone = get_setting(KnownSettings::TIMEZONE);
        if (empty($timezone)) //This should only happen after installation before deploying default settings
            $timezone = 'Europe/Berlin';

        date_default_timezone_set($timezone);
    }

}
