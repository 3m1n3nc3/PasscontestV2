<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends Access_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function index()
    {
        redirect('access/signup');      
    }

    /**
     * This method will enroll the user on the validation platform
     * and activates the school if a valid record was found
     * @param  string $user this should contain the unique identifier for the user
     * @param  string $key  the license key to validate
     * @return json       returns a json containing success and the kay
     */
    public function signup() 
    {   
        // if ($this->account_data->user_logged_in()) {
        //     $this->account_data->user_redirect();
        // }
        $view_data['page_title']    = 'signup';   
        $view_data['active_page']   = 'login-page'; 
        $view_data['has_banner']    = TRUE; 
        $view_data['reset_footer']  = ''; 
        
        $this->form_validation->set_error_delimiters('<small class="text-danger my-0 py-0">', '</small>');
        $this->form_validation->set_rules('username', 'Username', 'trim|alpha_dash|required|is_unique[users.username]|min_length[5]',
            array('is_unique' => lang('username_notavailable'))
        );
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|is_unique[users.email]'); 
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        // $this->form_validation->set_rules('repassword', 'Repeat Password', 'trim|required|min_length[6]|matches[password]');
        // $this->form_validation->set_rules('agree', 'Agree to terms', 'required',
        //     array('required' => 'lang:agree_to_terms')
        // ); 

        $this->load->view('layout/main_header', $view_data);  

        if ($this->form_validation->run() !== FALSE) { 
            $data['username'] = $this->input->post('username');
            $data['password'] = MD5($this->input->post('password'));
            $data['email']    = $this->input->post('email'); 
            // $data['role']     = 'user'; 

            $register = $this->user_model->add($data);
            if ($register) {
                $data = $this->user_model->get($data['username']);
                $this->session->set_flashdata('msg', $this->my_config->alert($data['username'].lang('signup_success_message'), 'success')); 
                $this->session->set_userdata(['user_id' => $data['id'] , 'username' => $data['username'] , 'email' => $data['email'], 'password' => $data['password']]);
                redirect('access/signup_success');
            } else {
                $this->session->set_flashdata('msg', $this->my_config->alert(lang('registration_failed'), 'success'));   
            }   
        }
        $this->load->view('users/signup', $view_data);   
        $this->load->view('layout/main_footer', $view_data); 
    }

    public function login($action = 'user') 
    {   
        $view_data['page_title']    = $action.'_login';  
        $view_data['action']        = $action;
        $view_data['active_page']   = 'login-page'; 
        $view_data['has_banner']    = TRUE; 
        $view_data['reset_footer']  = '';   

        if ($action === 'user' && $this->account_data->user_logged_in()) {
            $this->account_data->user_redirect();
        }

        $password = $this->input->post('password');
        $username = $this->input->post('username');
        $this->form_validation->set_error_delimiters('<small class="text-danger my-0 py-0">', '</small>');
        $this->form_validation->set_rules('username', 'Username', 'trim|alpha_dash|required|min_length[5]|validate_login['.$password.']');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|validate_login[password]|min_length[6]'); 

        $this->load->view('layout/main_header', $view_data);

        if ($this->form_validation->run() !== FALSE) {  

            if ($this->input->post('remember')) { 
                $this->input->set_cookie('username', $username, time() + 30 * 24 * 60 * 60);             
            }
            $data = $this->user_model->get($username); 
            $this->session->set_userdata(['user_id' => $data['id'] , 'username' => $data['username'] , 'email' => $data['email'], 'password' => $data['password']]);

            if ($this->session->has_userdata('redirect_to'))
                redirect($this->session->userdata('redirect_to'));
            else
                redirect('profile/info/'.$data['username']);       
        }  
        $this->load->view('users/login', $view_data);  
        $this->load->view('layout/main_footer', $view_data);     

    }

    public function signup_success() 
    {   
        $this->account = $this->account_data->fetch($this->session->userdata('username'));
        $data = $this->account;
        $data['page_title'] = 'signup_success';    
        $data['fullname'] = $data['name']; 
        $this->session->set_flashdata('msg', $this->my_config->alert('Hello '.$data['username'].lang('signup_success_message'), 'success')); 

        $this->load->view('layout/header', $data);      
        $this->load->view('users/signup_success', $data);       
        $this->load->view('layout/footer', $data);      

    }
}
