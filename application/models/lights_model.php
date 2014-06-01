<?php

class Lights_model extends Device {

    const LIGHT_STATE_ON = 1;
    const LIGHT_STATE_OFF = 0;

    public function __construct() {
        parent::__construct();

        $this->table = 'lights';

        //Default values
        $this->state = 0;
        $this->last_change = mysql_now();
    }

    /**
     * @var int
     */
    public $state;

    /**
     * @var DateTime
     */
    public $last_change;

    /**
     * @return Lights_model | Lights_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

    public function make_history_entry() {
        $this->load->model('lights_history_model');
        $history_entry = new Lights_History_model();
        $history_entry->light_id = $this->id;
        $history_entry->timestamp = $this->last_change;
        $history_entry->state = $this->state;
        $history_entry->save();
    }

    public function get_display_name() {
        return $this->name . ' (' . $this->get_room_name() . ')';
    }

    public function get_display_state() {
        if ($this->state == self::LIGHT_STATE_OFF)
            return lang('Off');
        else if ($this->state == self::LIGHT_STATE_ON)
            return lang('On');
    }

}
