<?php

require_once 'config.php';
require_once 'VnstatDbRow.php';
require_once 'VnstatDatabase.php';

$vnstat = new VnstatDatabase();
$days = $vnstat->getDays();

foreach ($days as $day) {
    $date = $day->getDateTime()->format('Y-m-d');
    $out = $day->getBytesSent();
    $in = $day->getBytesReceived();

    $apiRequestUrl = LIHOCOS_URL . '/api/computers/add_traffic/' . LIHOCOS_COMPUTER_ID . '/' . $date . '/' . $in . '/' . $out . '?api-key=' . LIHOCOS_API_KEY;
    file_get_contents($apiRequestUrl);
}

echo 'done';
