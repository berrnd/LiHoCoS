<?php

/**
 * @return Object
 */
function get_application_version_info() {
    $versionJson = file_get_contents(__DIR__ . '/../config/version.json');
    return json_decode($versionJson);
}

/**
 * @return boolean
 */
function is_demo() {
    $appInfo = get_application_version_info();
    return $appInfo->IsDemo;
}
