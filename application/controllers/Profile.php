<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Frontsite_Controller {

    public function __construct()
    {
        parent::__construct(); 
    }

    public function index()
    {   
        $data = $this->account_data->fetch($cdata['contestant_id']);

        // If the user does not exist, show 404 page
        error_redirect($data);
        
        $data['profile_sidebar']   = $this->load->view('layout/profile_sidebar', $data, TRUE);

        $this->load->view('layout/main_header', $data);       
        $this->load->view('users/profile', $data);       
        $this->load->view('layout/main_footer', $data);  
    } 

    public function info($user_id = null)
    {   
        $user_id  = ($user_id ? $user_id : $this->logged_user['id']); 
        $data     = $this->account_data->fetch($user_id);

        // If the user does not exist, show 404 page
        error_redirect($data);

        $config['base_url']   = site_url('profile/info/'.$user_id.'/page/');
        $config['total_rows'] = count($this->contestant_model->get(['contestant_id' => $data['id']]));
        $config['per_page']   = 4;

        $page = $this->uri->segment(5, 0); 
        $c_config             = ['contestant_id' => $data['id'], 'page'=> $page, 'limit' => $config['per_page']];
        $data['contests']     = $this->contestant_model->get($c_config);

        $this->pagination->initialize($config);

        $this->pagination->create_links();
        
        $data['profile_banner']  = $this->load->view('layout/profile__banner', $data, TRUE);
        $data['profile_sidebar'] = $this->load->view('layout/profile__sidebar', $data, TRUE);
                      
        if (filter_var($user_id, FILTER_VALIDATE_IP)) 
        {
            $data = $this->ip->guestUser($user_id);
        } 
        else 
        {
            if ($user_id && $data) { 
                $this->load->view('layout/profile_header', $data);
                $this->load->view('users/profile', $data);
                $this->load->view('layout/main_footer', $data);
            }
        }
    } 

    public function gallery($user_id = null)
    {   
        $user_id  = ($user_id ? $user_id : $this->logged_user['id']); 
        $data = $this->account_data->fetch($user_id); 

        // If the user does not exist, show 404 page
        error_redirect($data);

        $config['base_url']     = site_url('profile/info/'.$user_id.'/page/');
        $config['total_rows']   = count($this->gallery_model->get(['uid' => $data['id']]));
        $config['per_page']     = 4;

        $page = $this->uri->segment(5, 0); 
        $c_config               = ['uid' => $data['id'], 'page'=> $page, 'limit' => $config['per_page']];
        $data['gallery']        = $this->gallery_model->get($c_config);

        $this->pagination->initialize($config);

        $this->pagination->create_links();
        
        $data['profile_banner']     = $this->load->view('layout/profile__banner', $data, TRUE);
        $data['profile_sidebar']    = $this->load->view('layout/profile__sidebar', $data, TRUE);

        if ($user_id && $data) { 
            $this->load->view('layout/profile_header', $data);
            $this->load->view('gallery', $data);
            $this->load->view('layout/main_footer', $data);
        }
    } 

    public function logout() 
    {    
        $this->account_data->user_logout();
        redirect('access/login');       

    }

}
