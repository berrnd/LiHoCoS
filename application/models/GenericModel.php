<?php

/**
 * @property string $table
 * @property string $id
 */
abstract class GenericModel extends CI_Model {

    const DATA_SAVE_ACTION_INSERT = 1;
    const DATA_SAVE_ACTION_UPDATE = 2;

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->id = '-1';
    }

    /**
     * Should be set in the constructor of the derived class
     */
    protected $table;

    /**
     * @var int $id
     */
    public $id;

    /**
     * @param bool $id
     * @return mixed (Type should be defined in derived class,
     * 	for non-complex functionality just call this method in the overridden function)
     */
    public function get($id = FALSE) {
        if ($id == FALSE) {
            $query = $this->db->get($this->table);

            if ($query->num_rows() > 0) {
                $rows = $query->result();
                return $this->recast_array(get_class($this), $rows);
            }
        } else
            return $this->get_by_identifier_column('id', $id);

        return FALSE;
    }

    /**
     * @param string $column
     * @param string $key
     * @param bool $forceArray
     * @return mixed|bool
     */
    protected function get_by_identifier_column($column, $key, $forceArray = FALSE) {
        $query = $this->db->get_where($this->table, array($column => $key));

        if ($query->num_rows() == 1) {
            if ($forceArray)
                return $this->recast_array(get_class($this), $query->result());
            else
                return $this->recast(get_class($this), $query->row());
        }
        else if ($query->num_rows() > 1)
            return $this->recast_array(get_class($this), $query->result());
        else
            return FALSE;
    }

    /**
     * Automatically cares about insert or update
     */
    public function save() {
        if ($this->get($this->id) != FALSE || $this->id != -1) {
            $this->on_before_save(self::DATA_SAVE_ACTION_UPDATE);
            $this->db->update($this->table, $this, array('id' => $this->id));
        } else { //Insert
            $this->on_before_save(self::DATA_SAVE_ACTION_INSERT);

            $valuesToInsert = array();
            foreach ($this as $property => $value) {
                if ($property != 'id' && $property != 'table')
                    $valuesToInsert[$property] = $value;
            }
            $this->db->insert($this->table, $valuesToInsert);
            $this->id = $this->db->insert_id();
        }
    }

    public function delete() {
        if ($this->get($this->id) != FALSE)
            $this->db->delete($this->table, array('id' => $this->id));
    }

    /**
     * Casts an object to an instance of the given class
     * @param string $className
     * @param stdClass $object
     * @throws InvalidArgumentException
     * @return mixed
     */
    protected function recast($className, stdClass &$object) {
        if (!class_exists($className))
            throw new InvalidArgumentException(sprintf('Class %s not found', $className));

        $new = new $className();
        foreach ($object as $property => &$value) {
            $new->$property = &$value;
            unset($object->$property);
        }
        unset($value);
        $object = (unset) $object;

        return $new;
    }

    /**
     * Cast on array of objects to an array of instnaces of the given class
     * @param string $className
     * @param array $array
     * @throws InvalidArgumentException
     * @return mixed
     */
    protected function recast_array($className, array &$array) {
        if (!class_exists($className))
            throw new InvalidArgumentException(sprintf('Class %s not found', $className));

        $new_array = array();
        foreach ($array as $object)
            $new_array[] = $this->recast($className, $object);

        return $new_array;
    }

    /**
     * @param string $column
     * @return string[] | bool
     */
    protected function get_distinct_column($column) {
        $this->db->distinct();
        $this->db->select($column);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            $values = array();
            foreach ($query->result_array() as $row)
                $values[] = $row[$column];

            return $values;
        } else
            return FALSE;
    }

    /**
     * @param string $column
     * @param array $where
     * @param string $order_by
     * @param string $order_by_style ('asc' or 'desc')
     * @return array|bool
     */
    protected function get_custom_resultset($columns, $where, $order_by, $order_by_style) {
        $query = $this->db->
                select($columns)->
                where($where)->
                order_by($order_by, $order_by_style)->
                get($this->table);

        if ($query->num_rows() > 0)
            return $rows = $query->result_array();
        else
            return FALSE;
    }

    /**
     * Override this function to change values before data is written to the database
     */
    protected function on_before_save($dataSaveAction) {
        //Can be overridden
    }

}
