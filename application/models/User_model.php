<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

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
    public function get($id = null, $row = null) {

        $this->db->select('*')->from('users');

        if (isset($id['filter'])) {
            if ($id['filter'] == '0') {
                $this->db->where('active', '0'); 
            } elseif ($id['filter'] == '1') {
                $this->db->where('active', '1'); 
            } elseif ($id['filter'] == 'featured') {
                $this->db->where('featured', '1'); 
            } elseif ($id['filter'] == 'banned') {
                $this->db->where('banned', '1'); 
            }
        }   

        if (isset($id['page'])) {
            $this->db->limit($this->config->item('per_page'), $id['page']);
        }

        if (is_array($id)) {
            $id = null;
        }

        if ($id !== null || $row) {
            $this->db->where('id', $id);
            $this->db->or_where('username', $id);
            $this->db->or_where('email', $id); 
        } else {
            $this->db->order_by('id');
        }    

        $query = $this->db->get();
        if ($id !== null || $row) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function get_credit($id = null, $row = null) {
        $this->db->select('*')->from('credit');
        if ($id !== null || $row) {
            $this->db->where('user_id', $id); 
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id !== null || $row) {
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
        $this->db->delete('users');
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
            $this->db->update('users', $data);
        } else {
            $this->db->insert('users', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    } 

    public function add_credit($data) {
        if (isset($data['id'])) {
            if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
            }
            if (isset($data['user_id'])) { 
                $this->db->where('user_id', $data['user_id']);
            }
            $this->db->update('credit', $data);
            return $this->db->affected_rows();
        } else {
            $this->db->insert('credit', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    } 

    public function userLogin($data) {
        $this->db->select('id, username, password');
        $this->db->from('users');
        $this->db->where('email', $data['username']);
        $this->db->or_where('username', $data['username']);
        $this->db->where('password', MD5($data['password']));
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function read_user_information($email) {
        $condition = "email =" . "'" . $email . "'";
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function readByEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $condition = "email =" . "'" . $email . "'";
        } else {
            $condition = "username =" . "'" . $email . "'";
        }
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    } 

    public function change_password($data) {
        $condition = "id =" . "'" . $data['id'] . "'";
        $this->db->select('password');
        $this->db->from('users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkOldPass($data) {
        $this->db->where('id', $data['user_id']);        
        $this->db->where('email', $data['user_email']);
        $query = $this->db->get('users');

        if ($query->num_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    public function saveNewPass($data) {
        $this->db->where('id', $data['id']);
        $query = $this->db->update('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function saveForgotPass($data) {
        $this->db->where('email', $data['email']);
        $query = $this->db->update('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    } 
}
