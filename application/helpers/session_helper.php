<?php

/**
 * @return string
 */
function current_user_display_name() {
    $ci =& get_instance();
    $ci->load->model('users_model');
    $userId = $ci->session->userdata('user')->id;
    $user = new Users_model();
    $user = $user->get($userId);
    return $user->get_display_name();
}