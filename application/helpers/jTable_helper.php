<?php

/**
 * @param string $result_string
 * @param object $records
 * @param object $record
 * @return string
 */
function jtable_result($result_string, $records = '', $record = '') {
    $jTableResult = array();
    $jTableResult['Result'] = $result_string;
    $jTableResult['Records'] = $records;
    $jTableResult['Options'] = $records;
    $jTableResult['Record'] = $record;
    return json_encode($jTableResult);
}
