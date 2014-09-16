<?php

class MainController extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $timezone = get_setting(KnownSettings::TIMEZONE);
        if (empty($timezone)) //This should only happen after installation before deploying default settings
            $timezone = 'Europe/Berlin';

        date_default_timezone_set($timezone);
    }

    /**
     * @param Users_model $user
     */
    protected function setup_session($user) {
        $this->session->set_userdata('user_username', $user->id);
        $this->session->set_userdata('user_firstname', $user->firstname);
        $this->session->set_userdata('user_lastname', $user->lastname);
        $this->session->set_userdata('user_email', $user->email);
        $this->session->set_userdata('user_api_key', $user->api_key);
        $this->session->set_userdata('user_display_name', $user->get_display_name());
        $this->session->set_userdata('user_id', $user->id);
        $this->session->set_userdata('user_authenticated', TRUE);
    }

}
