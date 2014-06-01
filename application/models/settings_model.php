<?php

class Settings_model extends GenericModel {

    public function __construct() {
        parent::__construct();

        $this->table = 'settings';
    }

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $value;

    /**
     * @return Settings_model | Settings_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

    /**
     * @return Settings_model
     */
    public function get_by_name($name = FALSE) {
        $object = parent::get_by_identifier_column('name', $name);
        if (!$object) {
            $object = new Settings_model();
            $object->name = $name;
        }

        return $object;
    }

}
