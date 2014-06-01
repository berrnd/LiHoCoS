<?php

class Doors_History_model extends GenericModel {

    public function __construct() {
        parent::__construct();

        $this->table = 'doors_history';
    }

    /**
     * @var int
     */
    public $door_id;

    /**
     * @var DateTime
     */
    public $timestamp;

    /**
     * @var int
     */
    public $state;

    /**
     * @return Doors_History_model | Doors_History_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

}
