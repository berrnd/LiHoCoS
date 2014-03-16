<?php

class Doors_model extends Device {

    const DOOR_STATE_OPEN = 1;
    const DOOR_STATE_CLOSED = 0;

    public function __construct() {
        parent::__construct();

        $this->table = 'doors';

        //Default values
        $this->state = self::DOOR_STATE_CLOSED;
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
     * @return Doors_model | Doors_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

    public function make_history_entry() {
        $history_entry = new Doors_History_model();
        $history_entry->door_id = $this->id;
        $history_entry->timestamp = $this->last_change;
        $history_entry->state = $this->state;
        $history_entry->save();
    }

    public function get_display_state() {
        if ($this->state == self::DOOR_STATE_CLOSED)
            return lang('Closed');
        else if ($this->state == self::DOOR_STATE_OPEN)
            return lang('Open');
    }

}