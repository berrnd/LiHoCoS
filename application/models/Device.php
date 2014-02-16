<?php

class Device extends GenericModel {

    public function __construct() {
        parent::__construct();
    }

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $room_id;

    /**
     * @var string
     */
    public $plugin_reference;

    /**
     * @return Rooms_model
     */
    public function get_room() {
        $this->load->model('rooms_model');
        $room = $this->rooms_model->get($this->room_id);
        return $room;
    }

    /**
     * @return string
     */
    public function get_room_name() {
        $room = $this->get_room();
        return $room->name;
    }

    /**
     * @param string $pluginReference
     * @return mixed
     */
    public function get_by_plugin_reference($pluginReference) {
        return $this->get_by_identifier_column('plugin_reference', $pluginReference);
    }

    /**
     * @return string
     */
    public function get_display_name() {
        return $this->name;
    }

}