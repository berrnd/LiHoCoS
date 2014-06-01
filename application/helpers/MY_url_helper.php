<?php

/**
 * @param string $image_filename
 * @return string
 */
function img_url($image_filename) {
    return base_url('application/views') . "/img/$image_filename";
}

/**
 * @param string $css_filename
 * @return string
 */
function css($css_filename) {
    if (string_starts_with($css_filename, '//'))
        $url = $css_filename;
    else
        $url = base_url('application/views') . "/css/$css_filename.css";

    return "<link rel=\"stylesheet\" href=\"$url\">\n";
}

/**
 * @param string $js_filename
 * @return string
 */
function js($js_filename) {
    if (string_starts_with($js_filename, '//'))
        $url = $js_filename;
    else
        $url = base_url('application/views') . "/js/$js_filename.js";

    return "<script src=\"$url\"></script>\n";
}

/**
 * @param string $css_filename
 * @return string
 */
function third_party_css($css_filename) {
    if (string_starts_with($css_filename, '//'))
        $url = $css_filename;
    else
        $url = base_url('application/views') . "/third_party/$css_filename.css";

    return "<link rel=\"stylesheet\" href=\"$url\">\n";
}

/**
 * @param string $js_filename
 * @return string
 */
function third_party_js($js_filename) {
    if (string_starts_with($js_filename, '//'))
        $url = $js_filename;
    else
        $url = base_url('application/views') . "/third_party/$js_filename.js";

    return "<script src=\"$url\"></script>\n";
}

/**
 * @return boolean
 */
function is_api_request() {
    $apiRootUrl = base_url('api');
    return string_starts_with(current_url(), $apiRootUrl);
}
