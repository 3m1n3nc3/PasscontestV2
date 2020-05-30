<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account_Data {

    public $CI;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->database();
    }

    /*
    this checks to see if the admin is logged in
    we can provide a link to redirect to, and for the login page, we have $default_redirect,
    this way we can check if they are already logged in, but we won't get stuck in an infinite loop if it returns false.
     */ 

    public function user_logged_in()
    { 
        return (bool) $this->CI->session->userdata('username') or get_cookie('username');
    }     

    public function is_logged_in($role = false)
    {
        if ($this->CI->session->has_userdata('username') or get_cookie('username')) {
            $_user = ($this->CI->session->userdata('username') ? $this->CI->session->userdata('username') : get_cookie('username'));
            $user = $this->fetch($_user);
            if (!$user) {
                redirect('access/login');
            } else { 
                return true; 
            }
        } else {
            $this->CI->session->set_userdata('redirect_to', current_url());
            redirect('access/login');
        }
    }

    public function user_redirect()
    {
        if ($this->CI->session->has_userdata('username') || get_cookie('username')) {
            $_user = ($this->CI->session->userdata('username') ? $this->CI->session->userdata('username') : get_cookie('username'));
            $user = $this->fetch($_user); 
            if ($user) {
                redirect('profile/info');   
            }
        } else {
            redirect('access/login');
        }
    }

    public function fetch($id = null, $admin = 0)
    {    
        $data = $this->CI->user_model->get($id, 1);
        
        if ($data) { 
            if ($data['gender'] == 'male') {
                $data['personify']  = 'him';
                $data['personify_'] = 'his';
            } elseif ($data['gender'] == 'female') {
                $data['personify_'] = $data['personify'] ='her'; 
            } else {
                $data['personify']  = 'their';
            }

            if ($data['first_name'] && $data['first_name']) {
                $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
            } elseif ($data['first_name']) {
                $data['name'] = $data['first_name'];
            } elseif ($data['last_name']) {
                $data['name'] = $data['last_name'];
            } elseif ($data) {
                $data['name'] = $data['username'];
            } else {
                $data['name'] = '';
            }
        }
        return $data;
    }

    public function user_logout()
    {   
        delete_cookie('username');
        $this->CI->session->unset_userdata('username');
        $this->CI->session->sess_destroy();
    } 

    public function days_diff($far_date = NULL, $close_date = NULL)
    {   
        $far_date = $far_date ? $far_date : date('Y-m-d', strtotime('tomorrow'));
        $close_date = $close_date ? $close_date : date('Y-m-d', strtotime('NOW'));

        $far_date = new DateTime($far_date ? $far_date : date('Y-m-d', strtotime('tomorrow')));
        $close_date = new DateTime($close_date ? $close_date : date('Y-m-d', strtotime('NOW')));        

        if ($far_date > $close_date) {
            return true;
        }
        return false; 
    }

}
