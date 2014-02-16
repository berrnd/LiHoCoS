<?php

class SessionController extends MainController {

    public function __construct() {
        parent::__construct();
        
        $this->check_session();
    }

    private function check_session() {
        if (!$this->session->userdata('user')) {
            redirect(base_url('auth/login?from=' . current_url()));
        }
    }

}