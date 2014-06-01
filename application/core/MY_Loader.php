<?php

class MY_Loader extends CI_Loader {

    /**
     * Loads a file which is located in the third_party directory
     * @param string $file
     */
    public function third_party($file) {
        require_once realpath(APPPATH) . '/third_party/' . $file;
    }

}
