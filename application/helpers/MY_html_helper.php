<?php

/**
 * Converts an array to a HTML list (ul)
 * @param array $arr
 * @return string|null
 */
function array_to_html_list($arr) {
    if (empty($arr))
        return NULL;
    else {
        $ul = "<ul>\n";
        foreach ($arr as $val) {
            $ul .= '<li>' . htmlentities($val, ENT_QUOTES, 'UTF-8') . "</li>\n";
        }
        $ul .= "</ul>\n";

        return $ul;
    }
}
