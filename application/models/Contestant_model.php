<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contestant_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->CI = get_instance();
        $this->CI->config->load('pagination'); 
    }

    /**
     * This function takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($data = null, $row = null) {
        $this->db->select('*')->from('contestants');

        if (isset($data['active'])) {
            if ($data['active'] !== 'all') {
                $this->db->where('active', $data['active']); 
            }
        } else {
            $this->db->where('active', '1'); 
        }

        if (isset($data['contest_id'])) {
            $this->db->where('contest_id', $data['contest_id']); 
        }
        
        if (isset($data['contestant_id'])) {
            $this->db->where('contestant_id', $data['contestant_id']); 
        } 
        
        if (isset($data['where_in'])) {
            $this->db->where_in('contest_id', $data['where_in']); 
        } 

        if (isset($data['join'])) {
            $this->db->join($data['join'], $data['join'].'.'.$data['index'].' = contestants.contest_id', 'left'); 
        }

        $this->db->order_by('date ASC, contestants.id DESC'); 

        if (isset($data['page'])) {
            $this->db->limit($this->config->item('per_page'), $data['page']);
        }

        if (!isset($data['page']) && isset($data['limit'])) {
            $this->db->limit($data['limit']);
        }

        $query = $this->db->get();

        if ($row == 1) {
            return $query->row_array();
        } else {
            return $query->result_array();
        } 
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($data) {
        if (isset($data['contestant'])) {
            $this->db->where('contestant_id', $data['contestant']); 
        }

        if (!is_array($data)) {
            $this->db->where('contest_id', $data); 
        } 
        $this->db->delete('contestants');
        return $this->db->affected_rows();
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('contestants', $data);
            return $this->db->affected_rows();
        } else {
            $this->db->insert('contestants', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }  

    public function update($data) {
        if (isset($data['contestant_id'])) {
            $this->db->where('contestant_id', $data['contestant_id']);
        }
        if (isset($data['contest_id'])) {
            $this->db->where('contest_id', $data['contest_id']);
        }
        $this->db->update('contestants', $data);
        return $this->db->affected_rows();
    }  

}
