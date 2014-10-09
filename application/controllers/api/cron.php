<?php

class Cron extends MainController {

    public function __construct() {
        parent::__construct();

        $this->load->helper('cron');
    }

    public function index() {
        $cronJobs = get_cron_jobs();

        foreach ($cronJobs as $cronJob) {
            $cronJob->execute_when_needed();
        }
    }

}
