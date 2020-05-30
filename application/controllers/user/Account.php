<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends User_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {    
        $data = $this->logged_user; 
        $data['profile']    = $this->passcontest->basic_profile($data['id']);
        
        $data['section']    = 'dashboard'; 
        $data['page_title'] = 'edit_profile';  

        $unique_email    = $this->input->post('email') != $data['email'] ? '|is_unique[users.email]' : '';
        $unique_phone    = $this->input->post('phone') != $data['phone'] ? '|is_unique[users.phone]' : '';
        
        $this->form_validation->set_error_delimiters('<div class="text-danger form-text text-muted">', '</div>');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required'); 
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');   
        $this->form_validation->set_rules('bio', 'About Me', 'trim|required', 
            array('required' => lang('tell_us_about_you'))
        );
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required'.$unique_phone); 
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required'.$unique_email); 
        $this->form_validation->set_rules('country', 'Country', 'trim|required');  
        $this->form_validation->set_rules('curr_address', 'Current Address', 'trim|required');  
        
        if ($this->form_validation->run() === FALSE) { 
            if ($this->input->post()) {
                $this->session->set_flashdata('msg', alert_notice(lang('submission_has_errors'), 'danger')); 
            }
        } else {    
            $save = $this->input->post();
            $save['id'] = $data['id'];  
            $this->user_model->add($save);
            $this->session->set_flashdata('msg', alert_notice(lang('user_profile_updated'), 'success'));
        }

        $this->load->view('layout/_dashboard_header', $data);       
        $this->load->view('users/update_profile', $data);       
        $this->load->view('layout/_dashboard_footer', $data);  
    }

    public function settings()
    {    
        $data = $this->logged_user; 
        
        $data['section']    = 'dashboard';  
        $data['page_title'] = 'account_settings';  
        
        $this->form_validation->set_error_delimiters('<div class="text-danger form-text text-muted">', '</div>');
        $this->form_validation->set_rules('email_letter', lang('allow').' '.lang('email_notifications'), 'trim|required');  
        
        if ($this->form_validation->run() === FALSE) { 
            if ($this->input->post()) {
                $this->session->set_flashdata('msg', alert_notice(lang('submission_has_errors'), 'danger')); 
            }
        } else {    
            $save = $this->input->post();
            $save['id'] = $data['id'];  
            $this->user_model->add($save); 
            $this->session->set_flashdata('msg', alert_notice(lang('account_updated'), 'success'));
        }

        $this->load->view('layout/_dashboard_header', $data);       
        $this->load->view('users/settings', $data);       
        $this->load->view('layout/_dashboard_footer', $data);  
    }

    public function update($do = 'update', $action = 'data', $cid = null)
    {   
        $data = $this->account_data->fetch($this->logged_user['id']);
        $requirements_complete = TRUE;

        if ($do !== 'update') {
            $data['update_action'] = uri_string();
        }

        if ($do == 'apply')
        {
            $data['contest']       = $this->contest_model->get($cid, 1); 
            $data['contestant']    = $this->contestant_model->get(['contest_id' => $data['contest']['id'], 'contestant_id' => $data['id'], 'active' => 'all'], 1);
            if ($data['contestant']) {
                $rmsg   = ($data['contestant']['active'] == 1 ? sprintf(lang('already_in_contest'), $data['contest']['type']) : sprintf(lang('recently_applied_contest'), $data['contest']['type'])); 

                $this->session->set_flashdata('msg', alert_notice($rmsg, 'info'));
            }
            error_redirect($data['contest'], '404');
        } else {
            error_redirect($data['id'], '404');
        }

        $data['do'] = $do;
        
        $this->load->view('layout/main_header', $data);   

        if ($action == 'photo') 
        {
            $this->load->view('users/update_photo', $data); 
        } 
        else 
        {   
            $notify = ($do == 'update' ? 'updated' : 'submitted');
            $do_on  = ($do == 'update' ? 'profile' : 'application');

            if ($this->input->post() !== NULL) {
                // Validation rules
                $unique_email = $this->input->post('email') != $data['email'] ? '|is_unique[users.email]' : '';
                
                $this->form_validation->set_error_delimiters('<div class="text-danger form-text text-muted">', '</div>');
                $this->form_validation->set_rules('first_name', 'First Name', 'trim|required'); 
                $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required'); 
                $this->form_validation->set_rules('other_name', 'Other Name', 'trim'); 
                $this->form_validation->set_rules('stage_name', 'Stage Name', 'trim'); 
                $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required'); 
                $this->form_validation->set_rules('religion', 'Religion', 'trim|required'); 
                $this->form_validation->set_rules('bio', 'Self Introduction', 'trim|required'); 
                $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required'); 
                $this->form_validation->set_rules('email', 'Email Address', 'trim|required'.$unique_email); 
                $this->form_validation->set_rules('country', 'Nationality', 'trim|required'); 
                $this->form_validation->set_rules('state', 'State of Origin', 'trim|required'); 
                $this->form_validation->set_rules('city', 'Home Town', 'trim|required'); 
                $this->form_validation->set_rules('curr_address', 'Current Address', 'trim|required'); 
                $this->form_validation->set_rules('perm_address', 'Permanent Address', 'trim|required'); 
                $this->form_validation->set_rules('qualification', 'Educational Qualification', 'trim|required'); 
                $this->form_validation->set_rules('school', 'School or College', 'trim|required'); 
                $this->form_validation->set_rules('course', 'Course/Specialization', 'trim|required'); 
                $this->form_validation->set_rules('ref_name', 'Referee', 'trim|required'); 
                $this->form_validation->set_rules('ref_phone', 'Referee Phone', 'trim|required'); 
                
                // If this update is a contest application, make sure the user accepts the terms and conditions
                if ($do == 'apply') {
                    $this->form_validation->set_rules('accept', 'Accept Terms and Condition', 'trim|required',
                        array('required' => 'Please accept the terms and conditions to continue!')
                    ); 
                    
                    // Validate the serial number if this is a paid contest
                    if ($data['contest']['use_payment']) 
                    {   
                        $tcid = $data['contest']['id'];
                        $this->form_validation->set_rules('key', 'Serial Number', 'trim|alpha_dash|required|validate_token['.$tcid.']',
                            array('required' => 'Please enter a valid {field}!')
                        ); 
                    }
                }
 
                // If the user say they have been in other contests, make sure the provide the name
                if ($this->input->post('contested') && !$this->input->post('prev_contest')) {
                    $this->form_validation->set_rules('prev_contest', 'Previous Contest', 'trim|required'); 
                }

                // Validate the form
                if ($this->form_validation->run() === FALSE) { 
                    if ($this->input->post()) 
                    {
                        $this->session->set_flashdata('msg', $this->my_config->alert(lang('form_has_errors'), 'danger'));
                    }
                    $this->load->view('users/update', $data);  
                } else {    

                    $save = $this->input->post();       

                    // Add the user to the contestants table
                    if ($do == 'apply' && $requirements_complete)
                    {   
                        $apply = array(
                            'id'            => $data['contestant'] ? $data['contestant']['id'] : null,
                            'contest_id'    => $data['contest']['id'], 
                            'contestant_id' => $data['id'], 
                            'category'      => isset($save['category']) ? $save['category'] : '',
                            'active'        => $data['contestant'] ? $data['contestant']['active'] : '0'
                        );

                        $this->contestant_model->add($apply);
                    }

                    // Remove unneeded variables
                    unset($save['contested'], $save['accept'], $save['submit'], $save['category'], $save['key']);

                    if ($requirements_complete) { 
                        // Save the users data
                        $save['id'] = $data['id'];  
                        $this->user_model->add($save);  
                        $this->session->set_flashdata('msg', $this->my_config->alert('Your '.$do_on.' has been '.$notify, 'success'));
                    }
                }                
            }

            $this->load->view('users/update', $data); 
        }      

        $this->load->view('layout/main_footer', $data);  
    }

    public function contests() 
    {    
        $data = $this->logged_user; 
        $data['profile']    = $this->passcontest->basic_profile($data['id']);
        
        $data['section']    = 'dashboard'; 
        $data['page_title'] = 'account_contests';  

        $data['contests']   = $this->contest_model->get(['creator' => $data['id']]);
        $data['pending_contestants'] = $this->passcontest->entry_requests($data['contests'], 'alert-secondary border');

        $this->load->view('layout/_dashboard_header', $data);       
        $this->load->view('users/account_contests', $data);       
        $this->load->view('layout/_dashboard_footer', $data);  

    }

    /**
     * Credit method 
     */
    public function credit() 
    {    
        $data = $this->logged_user; 
        
        $data['section']    = 'dashboard'; 
        $data['page_title'] = 'account_credit';  

        $data['contests'] = $this->contest_model->get(['creator' => $data['id']]); 
        $data['credit']   = $this->passcontest->credit($data['id'], 'get');
        $data['agent']    = $this->credit_model->fetch_stats(['agent' => $data['id']]); 

        if ($this->input->post('key')) 
        { 
            $this->form_validation->set_rules('key', 'Card Serial', 'trim|required|alpha_dash', 
                array('required' => lang('enter_valid_serial'), 'alpha_dash' => lang('enter_valid_serial'))
            ); 
            
            if ($this->form_validation->run() !== FALSE) 
            {  
                $status = $this->passcontest->credit($data['id'], ['action' => 'pay', 'key' => $this->input->post('key')]);
                $this->session->set_flashdata('recharge_msg', $this->my_config->alert($status['msg'], $status['status']));
            }  
        }

        $this->load->view('layout/_dashboard_header', $data);       
        $this->load->view('users/credit', $data);       
        $this->load->view('layout/_dashboard_footer', $data);  
    }

    public function logout() 
    {    
        $this->account_data->user_logout();
        redirect('access/login');       

    }

}
