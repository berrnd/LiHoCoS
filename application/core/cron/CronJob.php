<?php

class CronJob {

    public function __construct() {
        $this->ci = & get_instance();
        $this->settingKey = 'cron_job_' . get_class($this) . '_';
    }

    private $settingKey;

    /**
     * @var CI_Controller
     */
    protected $ci;

    /**
     * @var string
     */
    protected $interval_cron;

    /**
     * @var DateTime
     */
    protected $last_execution;

    protected function execute() {
        //Should be overridden in the derived class
    }

    public function execute_when_needed() {
        $settingKey = $this->settingKey . 'last_execution_time';
        $lastExecutionTime = get_internal_setting($settingKey);

        $forceExecution = FALSE;
        if (empty($lastExecutionTime))
            $forceExecution = TRUE;
        else
            $lastExecutionTime = strtotime($lastExecutionTime);

        $cron = Cron\CronExpression::factory($this->interval_cron);
        $nextExecutionTime = date_timestamp_get($cron->getPreviousRunDate());

        if ($forceExecution === TRUE || ($nextExecutionTime <= now() && $nextExecutionTime > $lastExecutionTime)) {
            $this->execute();
            set_internal_setting($settingKey, mysql_now());
        }
    }

}
