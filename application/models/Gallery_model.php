<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->CI = get_instance();
        $this->CI->config->load('pagination');
    }

    /**
     * This function takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * set $context to 1 to fetch contests files
     * @param int $id
     * @return mixed
     */
    public function get($data = null, $context = '0') {
        $this->db->select('*')->from('gallery');
        
        $this->db->where('uid', $data['uid']);
        $this->db->where('context', $context); 

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
        } else {
            $this->db->order_by('rank ASC, id DESC'); 
        }

        if (isset($data['page'])) {
            $this->db->limit($this->config->item('per_page'), $data['page']);
        }

        if (!isset($data['page']) && isset($data['limit'])) {
            $this->db->limit($data['limit']);
        }

        $query = $this->db->get();
        if (isset($data['id'])) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('gallery');
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
            $this->db->update('gallery', $data);
            return $this->db->affected_rows();
        } else {
            $this->db->insert('gallery', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    } 

}
