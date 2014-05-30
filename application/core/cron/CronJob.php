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
     * @var int
     */
    protected $interval_minutes;

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

        if (empty($lastExecutionTime))
            $lastExecutionTime = now();

        $nextExecutionTime = date_create($lastExecutionTime);
        date_add($nextExecutionTime, date_interval_create_from_date_string("$this->interval_minutes minutes"));

        if (date_timestamp_get($nextExecutionTime) <= now()) {
            $this->execute();
            set_internal_setting($settingKey, mysql_now());
        }
    }

}
