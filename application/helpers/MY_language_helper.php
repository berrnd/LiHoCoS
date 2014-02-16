<?php

/**
 * Returns the keys of available languages
 * @return string[]
 */
function get_available_languages() {
    $folder = APPPATH . '/language';
    $fullPathsList = glob($folder . '/*', GLOB_ONLYDIR);

    $languageList = array();
    foreach ($fullPathsList as $fullPath) {
        $languageList[] = end(explode('/', $fullPath));
    }
    return $languageList;
}