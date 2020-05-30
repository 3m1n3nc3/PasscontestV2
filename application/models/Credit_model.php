<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Credit_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function add($data = null)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('credit_token', $data);
            return $this->db->affected_rows();
        } else {
            $this->db->insert('credit_token', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }

    public function check($data = null, $row = 0)
    {
        $this->db->select('*')->from('credit_token');
        if (isset($data['key'])) {
            $this->db->where('key', $data['key']);
        }

        if (isset($data['contest'])) {
            $this->db->where('contest_id', $data['contest']);
        }

        if (isset($data['user'])) {
            $this->db->where('used_by', $data['user']);
        }

        if (isset($data['agent'])) {
            $this->db->where('agent_id', $data['agent']);
        }

        $query = $this->db->get();
        if (isset($data['key']) || $row == 1) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function validate($user = '', $key = null)
    {
        $this->db->select('*')->from('school');
        if ($key) {
            $this->db->where('purchase_code', $key);
        }
        
        if (isset($data['site_url'])) 
        {
            $this->db->where('site_url', $data['site_url']); 
        } 
        elseif (isset($data['email'])) 
        {
            $this->db->where('email', $data['email']); 
        } 
        elseif (isset($data['username'])) 
        {
            $this->db->where('username', $data['username']); 
        } 
        elseif (isset($data['id'])) 
        {
            $this->db->where('id', $data['id']); 
        }   
        
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_unused($validity = null)
    {
        $this->db->select('key')->from('license');
        if ($validity) {
            $this->db->where('valid_for', $validity);
        }
        $this->db->where('used_by', NULL);
        $this->db->where('used_date', NULL);
        $this->db->order_by('id', 'RANDOM');

        $query = $this->db->get();
        return $query->row_array()['key'];
    } 

    public function approve($user = null, $key = null, $type = 0)
    {   
        $data = $this->validate($user);
        $update = array(
            'purchase_code' => $key,
            'sslk'          => $key
        );
        if ($type == 0) {
            if (isset($data['id'])) {
                $this->db->where('username', $data['username']); 
                $this->db->update('school', $update);
                $this->approve($user, $key, 1);
                return $update;
            }     
        } else {
            $use_data = array(
                'used_by'       => $data['id'],
                'used_date'     => date('Y-m-d', strtotime('NOW'))
            );

            if (isset($data['id'])) {
                $this->db->where('key', $data['purchase_code']);
                $this->db->update('license', $use_data);
            }
        }
    }    

    public function fetch_stats($data = array())
    {   
        $append = '';

        if (isset($data['contest'])) {
            $this->db->where('contest_id', $data['contest']);
            $append .= " contest_id = '".$data['contest']."' AND ";
        }

        if (isset($data['used_by'])) {
            $this->db->where('used_by', $data['used_by']); 
            $append .= " used_by = '".$data['used_by']."' AND ";
        }

        if (isset($data['agent'])) {
            $this->db->where('agent_id', $data['agent']); 
            $append .= " agent_id = '".$data['agent']."' AND ";
        }

        $this->db->select('COUNT(id) AS total_available, SUM(value) AS total_value');
        $this->db->select('(SELECT COUNT(id) FROM credit_token WHERE'.$append.' (used_by IS NOT NULL OR used_date IS NOT NULL)) AS total_sold');
        $this->db->select('(SELECT COUNT(id) FROM credit_token WHERE'.$append.' (used_by IS NULL OR used_date IS NULL)) AS total_unsold');
        $this->db->select('(SELECT SUM(value) FROM credit_token WHERE'.$append.' (used_by IS NOT NULL OR used_date IS NOT NULL)) AS sold_value');
        $this->db->select('(SELECT SUM(value) FROM credit_token WHERE'.$append.' (used_by IS NULL OR used_date IS NULL)) AS unsold_value');

        // echo $this->db->get_compiled_select('credit_token');
        $query = $this->db->get('credit_token'); 
        return $query->row_array();
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($data) {
        if (isset($data['agent'])) {
            $this->db->where('agent_id', $data['agent']);  
        }

        if (isset($data['contest'])) {
            $this->db->where('contest_id', $data['contest']); 
        }

        if (!is_array($data)) {
            $this->db->where('contest_id', $data); 
        }
 
        $this->db->delete('credit_token');
        return $this->db->affected_rows();
    }

    public function removeCredit($data) {  
        $this->db->where('user_id', $data);  
 
        $this->db->delete('credit');
        return $this->db->affected_rows();
    }
}
