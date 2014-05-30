<?php

class Blind_Positions_model extends GenericModel {

    public function __construct() {
        parent::__construct();

        $this->table = 'blind_positions';

        //Default values
        $this->position = 0;
    }

    /**
     * @var int
     */
    public $blind_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $position;

    /**
     * @return Blind_Positions_model | Blind_Positions_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

}
