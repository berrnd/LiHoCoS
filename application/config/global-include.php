<?php

function __autoload($class) {
    $path = array('core', 'core/cron', 'core/macro-engine', 'plugins', 'models');

    if (strpos($class, 'CI_') !== 0) {
        foreach ($path as $dir) {
            if (file_exists(APPPATH . $dir . '/' . $class . '.php'))
                include_once(APPPATH . $dir . '/' . $class . '.php');
        }
    }
}
