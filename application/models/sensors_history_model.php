<?php

class Sensors_History_model extends GenericModel {

    public function __construct() {
        parent::__construct();

        $this->table = 'sensors_history';
    }

    /**
     * @var int
     */
    public $sensor_id;

    /**
     * @var DateTime
     */
    public $timestamp;

    /**
     * @var int
     */
    public $temperature;

    /**
     * @var int
     */
    public $relative_humidity;

    /**
     * @return Sensors_History_model | Sensors_History_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

}