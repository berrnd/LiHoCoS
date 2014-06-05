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
    if (!$fp = curl_init($url))
        return false;
    return true;
}
