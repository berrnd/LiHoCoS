<?php

/**
 * Returns the timestamp of the next sunrise, based on the given timestamp
 * @param int $timestamp
 * @return int
 */
function sunrise($timestamp) {
    return date_sunrise($timestamp, SUNFUNCS_RET_TIMESTAMP, get_setting(KnownSettings::LATITUDE), get_setting(KnownSettings::LONGITUDE), 90, date('Z') / 60 / 60);
}

/**
 * Returns the timestamp of the next sunset, based on the given timestamp
 * @param int $timestamp
 * @return int
 */
function sunset($timestamp) {
    return date_sunset($timestamp, SUNFUNCS_RET_TIMESTAMP, get_setting(KnownSettings::LATITUDE), get_setting(KnownSettings::LONGITUDE), 90, date('Z') / 60 / 60);
}
