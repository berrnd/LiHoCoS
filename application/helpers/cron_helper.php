<?php

/**
 * @return CronJob[]
 */
function get_cron_jobs() {
    $jobs = array();
    $folder = APPPATH . 'core/cron/jobs';

    if ($directory = opendir($folder)) {
        while (($file = readdir($directory)) !== false) {
            if ($file !== '.' && $file !== '..') {
                $class = basename($file, '.php');

                include_once $folder . '/' . $file;

                /* @var $instance CronJob */
                $instance = new $class();
                $jobs[] = $instance;
            }
        }
        closedir($directory);
    }

    return $jobs;
}
