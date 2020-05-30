<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Errors extends Frontsite_Controller 
{ 
    public function __construct() 
    { 
        parent::__construct(); 

        $data = $this->user_model->get(); 
        $container = array(
            'has_banner' => TRUE, 
            'active_page' => 'login-page', 
            'reset_footer' => ''
        );
        $this->data = array_merge($data, $container);
    } 

    public function page404() 
    { 
        $data = $this->data ;
        $data['page_title'] = 'Error 404';  

        $data['title']   = 'Error 404 Page Not Found'; 
        $data['message'] = 'The page you requested was not found on this server.'; 

        $data['view_data']  = $data; 
        $this->load->view('errors/error_page', $data); 
    } 

    public function page401() 
    { 
        $data = $this->data ;
        $data['page_title'] = 'Error 401';   

        $data['title']   = 'Error 401 Unauthorized'; 
        $data['message'] = 'You do not have access to the resource you have requested.'; 

        $data['view_data']  = $data; 
        $this->load->view('errors/error_page', $data); 
    } 
}
