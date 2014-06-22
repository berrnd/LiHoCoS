<?php

class Location_History_model extends GenericModel {

    public function __construct() {
        parent::__construct();

        $this->table = 'location_history';
    }

    /**
     * @var DateTime
     */
    public $timestamp;

    /**
     * @var float
     */
    public $latitude;

    /**
     * @var float
     */
    public $longitude;

    /**
     * @var float
     */
    public $accuracy;

    /**
     * @return Location_History_model | Location_History_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

}
