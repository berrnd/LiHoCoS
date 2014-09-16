<?php

/**
 * @return string
 */
function current_user_display_name() {
    $ci = & get_instance();
    return $ci->session->userdata('user_display_name');
}

/**
 * @return string
 */
function current_user_api_key() {
    if (is_api_request())
        return $_GET['api-key'];
    else {
        $ci = & get_instance();
        return $ci->session->userdata('user_api_key');
    }
}

/**
 * @return int
 */
function current_user_id() {
    $ci = & get_instance();
    return $ci->session->userdata('user_id');
}

/**
 * @return string
 */
function current_user_mail_address() {
    $ci = & get_instance();
    return $ci->session->userdata('user_email');
}
