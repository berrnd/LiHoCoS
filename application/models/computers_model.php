<?php

class Computers_model extends Device {

    public function __construct() {
        parent::__construct();

        $this->table = 'computers';
    }
    
    /**
     * @var string
     */
    public $fqdn;
    
    /**
     * @var string
     */
    public $mac;

    /**
     * @return Computers_model | Computers_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

}