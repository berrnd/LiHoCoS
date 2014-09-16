<?php

class ApiController extends MainController {

    public function __construct() {
        parent::__construct();

        $this->check_session();
    }

    private function check_session() {
        if ($this->session->userdata('user_authenticated') === FALSE) { //Otherwise we already have a logged in user
            $this->load->model('users_model');
            $this->load->helper('output');

            $apiKey = $this->input->get('api-key');
            if (!empty($apiKey)) {
                $user = $this->users_model->get_by_api_key($apiKey);

                if ($user === FALSE)
                    unauthorized_and_exit();
                else
                    $this->setup_session($user);
            } else
                unauthorized_and_exit();
        }
    }

    protected function api_output($success, $message, $data) {
        $json = array(
            'success' => $success,
            'message' => $message,
            'data' => $data
        );

        $this->load->helper('output');
        no_cache_headers();
        header('Content-Type: application/json');

        echo json_encode($json);
    }

}
