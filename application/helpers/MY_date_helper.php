<?php

/**
 * Returns the given timestamp like this: 20:15
 * @param int $timestamp
 * @return string
 */
function timestamp_to_time_string($timestamp) {
    return strftime('%H:%M', $timestamp);
}

/**
 * Returns the given timestamp like this: 2014-02-15T13:54:21+01:00
 * @param int $timestamp
 * @return string
 */
function iso_8601($timestamp) {
    return date('c', $timestamp);
}

/**
 * Returns the given timestamp like this: 2014-02-15 13:54:21
 * @param int $timestamp
 * @return string
 */
function timestamp_to_date_time_string_iso($timestamp) {
    return strftime('%Y-%m-%d %H:%M:%S', $timestamp);
}

/**
 * Returns now as a string which is good for mysql datetime columns
 * @return string
 */
function mysql_now() {
    return timestamp_to_date_time_string_iso(now());
}

/**
 * @param string $date
 * @return string
 */
function format_date_user_defined($date) {
    return date(lang('php_short_date_format'), strtotime($date));
}

/**
 * @param string $date
 * @return string
 */
function format_datetime_user_defined($date) {
    return date(lang('php_long_date_format'), strtotime($date));
}
