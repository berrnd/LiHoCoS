<?php

class Dashboard extends SessionController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array(
            'pageId' => 'dashboard',
            'title' => lang('Dashboard'),
            'subtitle' => 'LiHoCoS'
        );

        $this->load->view('dashboard', $data);
    }

}