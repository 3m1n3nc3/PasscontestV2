<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Frontsite_Controller {

 
    /**
     * Renders the default publicly available static contents and 
     * parses a page where the page method has not been called
     * @param  string   $id   id or safelink of the parent content to render
     * @return null           Does not return anything but uses code igniter's view() method to render the page
     */
    public function index()
    {
        // Get a default page to render here
        $id = '1';
        $data = $this->user_model->get();

        $data['active_page'] = 'about-us';
        
        $query = filter_var($id, FILTER_VALIDATE_INT) ? array('id' => $id) : array('safelink' => $id); 
        $data['content'] = $this->content_model->get($query);
 
        // If the page does not exist or the content has a parent, show 404 page
        error_redirect(!$data['content']['parent']); 
        error_redirect($data['content']); 
        $data['page_title'] = $data['content']['title'];

        if ($data['content']['banner']) {
            $data['has_banner']  = TRUE;
        }
        
        $this->load->view('layout/main_header', $data);       
        $this->load->view('pages/page', $data);       
        $this->load->view('layout/main_footer', $data);  
    }

    /**
     * Renders the publicly available static contents and parses a page
     * @param  string   $id   id or safelink of the parent content to render
     * @return null           Does not return anything but uses code igniter's view() method to render the page
     */
    public function page($id = '')
    {
        $data = $this->user_model->get();

        $data['active_page'] = 'about-us';
        
        $query = filter_var($id, FILTER_VALIDATE_INT) ? array('id' => $id) : array('safelink' => $id); 
        $data['content'] = $this->content_model->get($query);
 
        // If the page does not exist or the content has a parent, show 404 page
        error_redirect(!$data['content']['parent']); 
        error_redirect($data['content']); 
        $data['page_title'] = $data['content']['title'];

        if ($data['content']['banner']) {
            $data['has_banner']  = TRUE;
        }
        
        $this->load->view('layout/main_header', $data);       
        $this->load->view('pages/page', $data);       
        $this->load->view('layout/main_footer', $data);  
    }
}
