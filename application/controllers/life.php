<?php

class Life extends SessionController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array(
            'pageId' => 'life',
            'title' => lang('Life')
        );

        $this->load->view('life', $data);
    }

}
