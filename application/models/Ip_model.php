<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ip_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->CI = get_instance();
        $this->CI->config->load('pagination');
    }

    public function get_unique_visitors() {

        $this->db->select('ip')->from('visitors');
        $this->db->order_by('ip'); 
        $this->db->group_by('ip');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_visitors($id = null) {
        $this->db->select('*')->from('visitors');
        if ($id !== null) {
            $this->db->where('id', $id); 
            $this->db->or_where('ip', $id); 
        } else {
            $this->db->order_by('ip');
        }
        $query = $this->db->get();
        if ($id !== null) 
        {
            return $query->row_array();
        } 
        else 
        {
            return $query->result_array();
        }
    }

    public function save_visitor($data = null)
    {
        if (isset($data['id'])) { 
            $this->db->or_where('id', $data['id']); 
            $this->db->update('visitors', $data);
            $affected = $this->db->affected_rows();
            return $affected;
        } else {
            $this->db->insert('visitors', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }
}
