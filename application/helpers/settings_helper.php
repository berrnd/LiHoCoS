<?php

/**
 * @param string $key
 * @return string
 */
function get_setting($key) {
    $ci = & get_instance();
    $ci->load->model('settings_model');
    $setting = $ci->settings_model->get_by_name($key);
    return $setting->value;
}

/**
 * @param string $key
 * @return string
 */
function get_internal_setting($key) {
    $key = '__' . $key;
    return get_setting($key);
}

/**
 * @param string $key
 * @param string $newValue
 */
function set_setting($key, $newValue) {
    $ci = & get_instance();
    $ci->load->model('settings_model');
    $setting = $ci->settings_model->get_by_name($key);
    $setting->value = $newValue;
    $setting->save();
}

/**
 * @param string $key
 * @param string $newValue
 */
function set_internal_setting($key, $newValue) {
    $key = '__' . $key;
    set_setting($key, $newValue);
}

/**
 * @return string[]
 */
function get_known_settings() {
    return get_class_constants('KnownSettings');
}
