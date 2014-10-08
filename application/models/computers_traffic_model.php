<?php

class Computers_Traffic_model extends GenericModel {

    public function __construct() {
        parent::__construct();

        $this->table = 'computers_traffic';
    }

    /**
     * @var int
     */
    public $computer_id;

    /**
     * @var date
     */
    public $date;

    /**
     * @var int
     */
    public $bytes_in;

    /**
     * @var int
     */
    public $bytes_out;

    /**
     * @return Computers_Traffic_model | Computers_Traffic_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

}
