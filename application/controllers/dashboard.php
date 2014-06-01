<?php

/**
 * @property Macros_model $macros_model
 */
class Dashboard extends SessionController {

    public function __construct() {
        parent::__construct();

        $this->load->model('macros_model');
        $this->load->model('sensors_model');
    }

    public function index() {
        $macros = $this->macros_model->get();

        $data = array(
            'pageId' => 'dashboard',
            'title' => lang('Dashboard'),
            'subtitle' => 'LiHoCoS',
            'macros' => $macros
        );

        $this->load->view('dashboard', $data);
    }

}
