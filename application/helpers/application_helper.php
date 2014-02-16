<?php

/**
 * @return boolean
 */
function is_demo() {
    return file_exists(APPPATH . 'config/demo.txt');
}