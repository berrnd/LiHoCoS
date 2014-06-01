<?php

class Windows_History_model extends GenericModel {

    public function __construct() {
        parent::__construct();

        $this->table = 'windows_history';
    }

    /**
     * @var int
     */
    public $window_id;

    /**
     * @var DateTime
     */
    public $timestamp;

    /**
     * @var string
     */
    public $state;

    /**
     * @return Windows_History_model | Windows_History_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

}
