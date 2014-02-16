<?php

class Lights_History_model extends GenericModel {

    public function __construct() {
        parent::__construct();

        $this->table = 'lights_history';
    }

    /**
     * @var int
     */
    public $light_id;

    /**
     * @var DateTime
     */
    public $timestamp;

    /**
     * @var int
     */
    public $state;

    /**
     * @return Lights_History_model | Lights_History_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

}