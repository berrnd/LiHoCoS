<?php

class Auth extends MainController {

    public function __construct() {
        parent::__construct();
    }

    public function login() {
        $data = array(
            'pageId' => 'login',
            'title' => lang('Login')
        );

        $this->load->view('login', $data);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url('auth/login'));
    }

    public function process() {
        $this->load->model('users_model');
        $this->load->library('encrypt');

        if (!$this->validate())
            redirect(base_url('auth/login?message=bad'));
        else {
            $url = $this->input->post('from');
            if (empty($url))
                $url = base_url();

            redirect($url);
        }
    }

    private function validate() {
        $usernameOrEmail = $this->security->xss_clean($this->input->post('emailOrUsername'));
        $password = $this->security->xss_clean($this->input->post('password'));
        $passwordHash = $this->encrypt->sha1($password);

        $user = $this->users_model->get_by_username_or_email($usernameOrEmail);

        if ($user && $passwordHash === $user->password) {
            $this->session->set_userdata('user', $user);
            return true;
        } else
            return false;
    }

}
