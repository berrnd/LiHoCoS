<?php

class Tools extends SessionController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array(
            'pageId' => 'tools',
            'title' => lang('Tools')
        );

        $this->load->view('tools', $data);
    }

}
