<?php

function no_cache_headers() {
    header('Expires: Mon, 07 Jan 1991 23:11:00 GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');
}

function unauthorized_and_exit() {
    header('HTTP/1.1 401 Unauthorized');
    exit();
}
