<?php

class Sensors_model extends Device {

    const SENSOR_TYPE_THERMO_ONLY = 'THERMOONLY';
    const SENSOR_TYPE_HYGRO_ONLY = 'HYGROONLY';
    const SENSOR_TYPE_THERMOHYGRO = 'THERMOHYGRO';
    const SENSOR_LOCATION_TYPE_INSIDE = 'INSIDE';
    const SENSOR_LOCATION_TYPE_OUTSIDE = 'OUTSIDE';
    const SENSOR_LOCATION_TYPE_UNDEFINED = 'UNDEFINED';

    public function __construct() {
        parent::__construct();

        $this->table = 'sensors';

        //Default values
        $this->type = self::SENSOR_TYPE_THERMOHYGRO;
        $this->location_type = self::SENSOR_LOCATION_TYPE_UNDEFINED;
        $this->temperature = -1;
        $this->relative_humidity = -1;
        $this->last_change = mysql_now();
    }

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $location_type;

    /**
     * @var int
     */
    public $temperature;

    /**
     * @var int
     */
    public $relative_humidity;

    /**
     * @var DateTime
     */
    public $last_change;

    /**
     * @return Sensors_model | Sensors_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

    public function make_history_entry() {
        $this->load->model('sensors_history_model');
        $history_entry = new Sensors_History_model();
        $history_entry->sensor_id = $this->id;
        $history_entry->timestamp = $this->last_change;
        $history_entry->temperature = $this->temperature;
        $history_entry->relative_humidity = $this->relative_humidity;
        $history_entry->save();
    }

    public function get_display_name() {
        return $this->name . ' (' . $this->get_room_name() . ')';
    }

}
