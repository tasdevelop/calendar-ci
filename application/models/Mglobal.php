<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mglobal extends CI_Model
{
    private $cal;
    public function __construct() {
        parent::__construct();
        $this->cal = $this->load->database('calendar', TRUE);
    }
    public function get_list($table, $where = FALSE )
    {
        if ($where) {
            $this->cal->where($where);
        }
        return $this->cal->get($table)->result();
    }

    public function insert($table, $param)
    {
        $this->cal->insert($table, $param);
        return $this->cal->insert_id();
    }

    public function update($table, $set, $where)
    {
        $this->cal->where($where);
        $this->cal->update($table, $set);
        return $this->cal->affected_rows();
    }

    public function delete($table, $where)
    {
        $this->cal->where($where);
        $this->cal->delete($table);
        return $this->cal->affected_rows();
    }

}