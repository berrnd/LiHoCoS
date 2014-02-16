<?php

class Rooms_model extends GenericModel {

    public function __construct() {
        parent::__construct();

        $this->table = 'rooms';
    }

    /**
     * @var string
     */
    public $name;

    /**
     * @return Rooms_model | Rooms_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

}