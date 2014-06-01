<?php

/**
 * @param string $pluginArea
 * @return PluginHost[]
 */
function get_plugins($pluginArea) {
    $plugins = array();
    $folder = APPPATH . 'plugins/' . $pluginArea;

    if ($directory = opendir($folder)) {
        while (($file = readdir($directory)) !== false) {
            if ($file !== '.' && $file !== '..') {
                $class = basename($file, ".php");

                if (!is_base_plugin($pluginArea, $class)) {
                    include_once $folder . '/' . $file;

                    /* @var $instance PluginHost */
                    $instance = new $class();
                    $plugins[] = $instance;
                }
            }
        }
        closedir($directory);
    }

    return $plugins;
}

/**
 * @return PluginHost[]
 */
function get_all_plugins() {
    $plugins = array();
    $class = new ReflectionClass('PluginAreas');
    $consts = $class->getConstants();
    foreach ($consts as $const) {
        foreach (get_plugins($const) as $plugin) {
            $plugins[] = $plugin;
        }
    }
    return $plugins;
}

/**
 * @param string $pluginArea
 * @param string $pluginClassName
 */
function load_plugin_class($pluginArea, $pluginClassName) {
    $folder = APPPATH . 'plugins/' . $pluginArea;
    $file = $folder . '/' . $pluginClassName . '.php';
    include_once $file;
}

/**
 * @param string $pluginArea
 * @param string $pluginClassName
 * @return bool
 */
function is_base_plugin($pluginArea, $pluginClassName) {
    $basePluginFileName = strtolower($pluginArea . 'Plugin');
    return strtolower($pluginClassName) === $basePluginFileName;
}

/**
 * Default error message when an error on an ajax request happened
 */
function plugin_ajax_error() {
    http_response_code(400);
    echo 'ERROR';
}
