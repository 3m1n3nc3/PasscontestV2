<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contest extends User_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {    
        $data = $this->logged_user; 
        error_redirect(has_privilege('contest-creator'), '401');
        
        $data['profile']    = $this->passcontest->basic_profile($data['id']);
        
        $data['section']    = 'dashboard'; 
        $data['page_title'] = 'account_contests';  

        $data['contests']   = $this->contest_model->get(['creator' => $data['id']]);
        $data['pending_contestants'] = $this->passcontest->entry_requests($data['contests'], 'alert-secondary border');

        $this->load->view('layout/_dashboard_header', $data);       
        $this->load->view('users/account_contests', $data);       
        $this->load->view('layout/_dashboard_footer', $data);  
    }

    public function contestants($contest_id = null, $status = 'all')
    {    
        $data = $this->logged_user; 
        error_redirect(has_privilege('contest-creator'), '401');
        
        $data['section']        = 'dashboard';
        $data['page_title']     = 'manage_contestants';
        $data['page_subtitle']  = 'account_contests';
        $data['next_subtitle']  = 'for ';
        $data['use_datatables'] = TRUE;
        $data['table_method']   = 'fetch_contestants/'.$contest_id.($status !== null && $status !== 'all' ? '/'.$status : '');

        $config['base_url']   = site_url('manage/contest/contestants/'.$contest_id.'/'.$status.'/page');
        $config['total_rows'] = count($this->contestant_model->get(['contest_id' => $contest_id, 'active' => $status])); 

        $this->pagination->initialize($config); 
        $_page = $this->uri->segment(7, 0);
        $data['pagination__'] = $this->pagination->create_links();

        if ($status === 'all') $status = null;
 
        $data['contestants'] = $this->contestant_model->get(['contest_id' => $contest_id, 'active' => $status, 'page' => $_page]);
        $data['contest']     = $this->contest_model->get($contest_id);
        $data['filter']      = $status;
        $data['display_method'] = $this->input->get('use') ? '?use='.$this->input->get('use') : '';

        // If the user does not match the contest creator, show 404 page
        error_redirect(($data['id'] === $data['contest']['creator_id'] ? TRUE : FALSE), '401');

        $this->load->view('layout/_dashboard_header', $data);
        if ($this->input->get('use') == 'datatables')
        {
            $this->load->view('manage/manage_contestants', $data);
        }
        else
        {
            $this->load->view('manage/no_datatable/manage_contestants', $data);
        }
        $this->load->view('layout/_dashboard_footer', $data);
    }

    public function create($contest_id = '', $state = 'update', $step = 0)
    {    
        $data = $this->logged_user; 
        if (my_config('restrict_creation')) {
            error_redirect(has_privilege('contest-creator'), '401');
        }
        
        $data['section']       = 'dashboard';  
        $data['page_title']    = 'create_contest';  
        $data['page_subtitle'] = 'account_contests'; 
 
        $data['contestants']   = $this->contestant_model->get(['contest_id' => $contest_id]);
        $data['contest']       = $this->contest_model->get($contest_id);
        $data['profile']       = $this->passcontest->basic_profile($contest_id, 1);

        $data['step']         = $this->input->post('step') ? $this->input->post('step') : ($step ? $step : 0);
        $data['enable_steps'] = 1;  

        $this->form_validation->set_error_delimiters('<div class="text-danger form-text text-muted">', '</div>'); 

        error_redirect((!isset($data['contest']) || $data['id'] === $data['contest']['creator_id'] ? TRUE : FALSE), '401');

        if ($data['step'] !== 'settings') 
        {
            if (!$data['enable_steps'] || $data['step'] == 1 || $data['step'] == 0) 
            {
                $unique_title  = $this->input->post('title') != $data['contest']['title'] ? '|is_unique[contests.title]' : '';

                $this->form_validation->set_rules('title', 'Contest Title', 'trim|required'.$unique_title);
                $this->form_validation->set_rules('slug', 'Short Intro or Slogan', 'trim|required');
                $this->form_validation->set_rules('type', 'Contest Type', 'trim|required'); 
            }

            if (!$data['enable_steps'] || $data['step'] == 2)
            {
                $unique_email  = $this->input->post('email') != $data['contest']['email'] ? '|is_unique[contests.email]' : '';

                $this->form_validation->set_rules('email', 'Contact Email', 'trim|valid_email|required'.$unique_email); 
                $this->form_validation->set_rules('phone', 'Contact Phone', 'trim|required'); 
                $this->form_validation->set_rules('facebook', 'Facebook', 'trim'); 
                $this->form_validation->set_rules('twitter', 'Twitter', 'trim'); 
                $this->form_validation->set_rules('instagram', 'Instagram', 'trim'); 
            }

            if (!$data['enable_steps'] || $data['step'] == 3) 
            { 
                $this->form_validation->set_rules('description', 'Details', 'trim|required'); 
                $this->form_validation->set_rules('eligibility', 'Eligibility Info', 'trim|required'); 
                $this->form_validation->set_rules('prizes', 'Prizes', 'trim|required'); 
            }

            if (!$data['enable_steps'] || $data['step'] == 4) 
            { 
                $this->form_validation->set_rules('country', 'Country', 'trim|required'); 
                $this->form_validation->set_rules('state', 'State', 'trim|required'); 
                $this->form_validation->set_rules('city', 'City', 'trim|required'); 
                $this->form_validation->set_rules('office', 'Contact Address', 'trim|required'); 
                $this->form_validation->set_rules('event', 'Event Location', 'trim'); 
            }            
        } 
        else 
        {
            $this->form_validation->set_rules('vote_cost', 'Cost per Vote', 'trim|required|numeric'); 
        }

        if ($this->form_validation->run() === FALSE) { 
            if ($this->input->post()) {
                $this->session->set_flashdata('msg', $this->my_config->alert(lang('submission_has_errors'), 'danger'));
            }
        } else { 
            unset($_POST['step']);
            $save = $this->input->post();
            if ($contest_id) {
                $save['id'] = $contest_id; 
            } 

            // Generate safelink for this contest
            if (!$contest_id) {
                $save['safelink'] = safelink($this->input->post('title'));
            }

            $save['creator_id'] = $data['id'];
            $save_id = $this->contest_model->add($save);

            if ($data['step'] !== 'settings') 
            {
                redirect('manage/contest/create/'.($contest_id ? $contest_id.'/update/' : $save_id.'/new/').($data['enable_steps'] ? $data['step']+1 : ''));
            }
            else 
            {
                $message = lang('contest_settings_updated');
                $this->session->set_flashdata('msg', $this->my_config->alert($message, 'success'));

                redirect('manage/contest/create/'.$contest_id.'/update/'.$data['step']);
            }
            $process_complete = TRUE;
        }

        if ($state == 'new') 
        {
            $this->session->set_userdata('update_contests', 'new');
        }

        if ($data['step'] === '5' || (isset($process_complete) && !$data['enable_steps'])) 
        {
            $message = lang('contest_updated');
            if ($this->session->has_userdata('update_contests') && $this->session->userdata('update_contests') == 'new') 
            {
                $message = lang('new_contest_created');
                $this->session->unset_userdata('update_contests');
            }
            $this->session->set_flashdata('msg', $this->my_config->alert($message, 'success'));
        } 

        $this->load->view('layout/_dashboard_header', $data);       
        $this->load->view('manage/create_contest', $data);       
        $this->load->view('layout/_dashboard_footer', $data);  
    }
}
