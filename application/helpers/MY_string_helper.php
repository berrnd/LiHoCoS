<?php

/**
 * @param string $haystack
 * @param string $needle
 * @return boolean
 */
function string_starts_with($haystack, $needle) {
    return $needle === '' || strpos($haystack, $needle) === 0;
}

/**
 * @param string $haystack
 * @param string $needle
 * @return boolean
 */
function string_ends_with($haystack, $needle) {
    return $needle === '' || substr($haystack, -strlen($needle)) === $needle;
}

/**
 * @param string $haystack
 * @param string $needle
 * @return boolean
 */
function string_contains($haystack, $needle) {
    return strpos($haystack, $needle) !== false;
}

/**
 * @return string
 */
function guid() {
    mt_srand((double) microtime() * 10000);
    $charid = strtoupper(md5(uniqid(rand(), true)));
    $hyphen = chr(45); // "-"

    return strtolower(
            substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12));
}

/**
 * @param string $string
 * @return boolean
 */
function is_sha1($string) {
    return (bool) preg_match('/^[0-9a-f]{40}$/i', $string);
}
