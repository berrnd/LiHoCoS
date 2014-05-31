<?php

class Macros_model extends GenericModel {

    public function __construct() {
        parent::__construct();

        $this->table = 'macros';
    }

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @return Macro_model | Macro_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

    public function get_actions() {
        $this->load->model('macro_actions_model');
        return $this->macro_actions_model->get_by_identifier_column('macro_id', $this->id, TRUE);
    }

}
