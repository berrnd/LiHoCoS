<?php

class Users_model extends GenericModel {

    public function __construct() {
        parent::__construct();

        $this->table = 'users';
    }

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $firstname;

    /**
     * @var string
     */
    public $lastname;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $api_key;

    /**
     * @return Users_model | Users_model[]
     */
    public function get($id = FALSE) {
        return parent::get($id);
    }

    /**
     * @return Users_model
     */
    public function get_by_username_or_email($usernameOrEmail) {
        $query = $this->db->
                select('*')->
                where('username =', $usernameOrEmail)->
                or_where('email =', $usernameOrEmail)->
                get($this->table);

        if ($query->num_rows() === 1)
            return $query->row();
        else
            return FALSE;
    }

    /**
     * @return Users_model
     */
    public function get_by_api_key($hashedApiKey) {
        return $this->get_by_identifier_column('api_key', $hashedApiKey);
    }

    public function get_display_name() {
        return trim("$this->firstname $this->lastname");
    }

    protected function on_before_save($dataSaveAction) {
        if (!is_sha1($this->password))
            $this->password = $this->encrypt->sha1($this->password);
    }

}
