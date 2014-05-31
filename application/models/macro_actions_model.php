<?php

class Macro_Actions_model extends GenericModel {

    public function __construct() {
        parent::__construct();

        $this->table = 'macro_actions';
    }

    /**
     * @var int
     */
    public $macro_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $parameters;

    /**
     * @return Macro_model | Macro_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

}
