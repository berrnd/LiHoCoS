<?php

/**
 * Sends a HTML email with an given template
 * @param string $to
 * @param string $template
 * @param array $templateData
 */
function send_mail_with_template($to, $template, $templateData) {
    $ci = & get_instance();
    $ci->load->library('email');

    $config = array(
        'protocol' => 'smtp',
        'smtp_host' => get_setting(KnownSettings::SMTP_HOST),
        'smtp_port' => get_setting(KnownSettings::SMTP_PORT),
        'smtp_crypto' => get_setting(KnownSettings::SMTP_CRYPTO),
        'smtp_user' => get_setting(KnownSettings::SMTP_USERNAME),
        'smtp_pass' => get_setting(KnownSettings::SMTP_PASSWORD),
        'mailtype' => 'html'
    );
    $ci->email->initialize($config);

    $ci->email->from(get_setting(KnownSettings::SMTP_FROM), 'LiHoCoS');
    $ci->email->to($to);
    $ci->email->subject($templateData['subject']);

    $body = $ci->load->view($template, $templateData, TRUE);
    $ci->email->message($body);

    $ci->email->send();
}
