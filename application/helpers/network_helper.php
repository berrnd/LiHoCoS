<?php

/**
 * @param string $macAddressHexadecimal
 * @param string $broadcastAddress
 */
function wake_on_lan($macAddressHexadecimal, $broadcastAddress) {
    $macAddressHexadecimal = str_replace(':', '', $macAddressHexadecimal);

    //check if $macAddress is a valid mac address
    if (!ctype_xdigit($macAddressHexadecimal)) {
        log_message('error', 'wake_on_lan: Mac address invalid, only 0-9 and a-f are allowed');
    }

    $macAddressBinary = pack('H12', $macAddressHexadecimal);
    $magicPacket = str_repeat(chr(0xff), 6) . str_repeat($macAddressBinary, 16);

    if (!$fp = fsockopen('udp://' . $broadcastAddress, 7, $errno, $errstr, 2))
        log_message('error', "wake_on_lan: Cannot open UDP socket: $errno ($errstr}");

    fputs($fp, $magicPacket);
    fclose($fp);
}

/**
 * @param string $url
 * @return boolean
 */
function url_exists($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($ch, CURLOPT_TIMEOUT, 2);
    curl_setopt($ch, CURLOPT_NOBODY, 1);

    if (curl_exec($ch) !== FALSE)
        return TRUE;
    else
        return FALSE;
}
