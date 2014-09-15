<?php

/**
 * @return string
 */
function current_user_display_name() {
    $ci = & get_instance();
    $ci->load->model('users_model');
    $userId = $ci->session->userdata('user')->id;
    $user = new Users_model();
    $user = $user->get($userId);
    return $user->get_display_name();
}

/**
 * @return string
 */
function current_user_api_key() {
    if (is_api_request())
        return $_GET['api-key'];
    else {
        $ci = & get_instance();
        return $ci->session->userdata('user')->api_key;
    }
}

/**
 * @return int
 */
function current_user_id() {
    $ci = & get_instance();
    $ci->load->model('users_model');
    $userId = $ci->session->userdata('user')->id;
    return $userId;
}

/**
 * @return string
 */
function current_user_mail_address() {
    $ci = & get_instance();
    $ci->load->model('users_model');
    $userId = $ci->session->userdata('user')->email;
    return $userId;
}
