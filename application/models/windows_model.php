<?php

class Windows_model extends Device {

    const WINDOW_STATE_OPEN = 'OPEN';
    const WINDOW_STATE_CLOSED = 'CLOSED';
    const WINDOW_STATE_TILTED = 'TILTED';

    public function __construct() {
        parent::__construct();

        $this->table = 'windows';

        //Default values
        $this->state = self::WINDOW_STATE_CLOSED;
        $this->last_change = mysql_now();
    }

    /**
     * @var string
     */
    public $state;

    /**
     * @var DateTime
     */
    public $last_change;

    /**
     * @return Windows_model | Windows_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

    public function make_history_entry() {
        $history_entry = new Windows_History_model();
        $history_entry->window_id = $this->id;
        $history_entry->timestamp = $this->last_change;
        $history_entry->state = $this->state;
        $history_entry->save();
    }

    public function get_display_name() {
        return $this->name . ' (' . $this->get_room_name() . ')';
    }

}