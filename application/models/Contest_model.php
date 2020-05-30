<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contest_model extends CI_Model {

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
    public function get($id = null, $row = 0) {
        $this->db->select('*')->from('contests');
        if ($id !== null && !is_array($id)) {
            $this->db->where('id', $id);
            $this->db->or_where('safelink', $id);
        } else {
            if (isset($id['creator'])) {
                $this->db->where('creator_id', $id['creator']); 
            }
            if (isset($id['filter'])) {
                if ($id['filter'] == '0') {
                    $this->db->where('status', '0'); 
                } elseif ($id['filter'] == '1') {
                    $this->db->where('status', '1'); 
                } elseif ($id['filter'] == 'featured') {
                    $this->db->where('featured', '1'); 
                } elseif ($id['filter'] == 'recommended') {
                    $this->db->where('recommend', '1'); 
                }
            }
            if (isset($id['page'])) {
                $this->db->limit($this->config->item('per_page'), $id['page']);
            }

            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id !== null && !is_array($id) || $row == 1) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function getVotes($id = null, $row = 0) {
        $this->db->select('*')->from('votes'); 
        
        if (isset($id['contest_id'])) {
            $this->db->where('contest_id', $id['contest_id']); 
        }
        
        if (isset($id['contestant_id'])) {
            $this->db->where('contestant_id', $id['contestant_id']); 
        }
        
        if (isset($id['voter_id'])) {
            $this->db->where('voter_id', $id['voter_id']); 
        } 

        if (isset($id['page'])) {
            $this->db->limit($this->config->item('per_page'), $id['page']);
        }

        if (!isset($id['page']) && isset($id['limit'])) {
            $this->db->limit($id['limit']);
        }

        $this->db->group_by('voter_id, id');
        $this->db->order_by('id');
 
        $query = $this->db->get();
        if ($id !== null && !is_array($id) || $row == 1) {
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
        if (isset($data['creator'])) {
            $this->db->where('creator_id', $data['creator']); 
        }

        if (!is_array($data)) {
            $this->db->where('id', $data); 
        }
        $this->db->delete('contests');
        return $this->db->affected_rows();
    }

    public function removeVotes($data) {
        if (isset($data['contest'])) {
            $this->db->where('contest_id', $data['contest']); 
        }
        
        if (isset($data['contestant'])) {
            $this->db->where('contestant_id', $data['contestant']); 
        }
        
        if (isset($data['voter'])) {
            $this->db->where('voter_id', $data['voter']); 
        }

        if (!is_array($data)) {
            $this->db->where('contest_id', $data); 
        } 
        $this->db->delete('votes');
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
            $this->db->update('contests', $data);
            return $this->db->affected_rows();
        } else {
            $this->db->insert('contests', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }  

    public function add_vote($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('votes', $data);
            return $this->db->affected_rows();
        } else {
            $this->db->insert('votes', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }  

}
