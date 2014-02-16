<?php

class Blinds_model extends Device {

    public function __construct() {
        parent::__construct();

        $this->table = 'blinds';

        //Default values
        $this->position = -1;
        $this->last_change = mysql_now();
    }

    /**
     * @var int
     */
    public $position;

    /**
     * @var DateTime
     */
    public $last_change;

    /**
     * @return Blinds_model | Blinds_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

    public function make_history_entry() {
        $history_entry = new Blinds_History_model();
        $history_entry->blind_id = $this->id;
        $history_entry->timestamp = $this->last_change;
        $history_entry->position = $this->position;
        $history_entry->save();
    }

    public function get_display_name() {
        return $this->name . ' (' . $this->get_room_name() . ')';
    }

}