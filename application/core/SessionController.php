<?php

class SessionController extends MainController {

    public function __construct() {
        parent::__construct();

        $this->check_session();
    }

    private function check_session() {
        if (is_api_request() && !$this->session->userdata('user')) {
            $this->load->model('users_model');
            $this->load->helper('output');

            $apiKey = $this->input->get('api-key');
            if (!empty($apiKey)) {
                $user = $this->users_model->get_by_api_key($apiKey);

                if ($user === FALSE)
                    unauthorized_and_exit();
            } else
                unauthorized_and_exit();
        } else {
            if (!$this->session->userdata('user'))
                redirect(base_url('auth/login?from=' . current_url()));
        }
    }

}
