<?php

class Blinds_History_model extends GenericModel {

    public function __construct() {
        parent::__construct();

        $this->table = 'blinds_history';
    }

    /**
     * @var int
     */
    public $blind_id;

    /**
     * @var DateTime
     */
    public $timestamp;

    /**
     * @var int
     */
    public $position;

    /**
     * @return Blinds_History_model | Blinds_History_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

}
