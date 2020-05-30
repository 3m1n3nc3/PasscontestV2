<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {    
        $data = $this->logged_user; 
        error_redirect(has_privilege('manage-configuration'), '401');
        
        $data['section']    = 'dashboard'; 
        $data['page_title'] = 'admin_configuration';   

        $this->load->view('layout/_dashboard_header', $data);       
        $this->load->view('manage/admin_configuration', $data);       
        $this->load->view('layout/_dashboard_footer', $data);  
    } 


    /**
     * Lists all created page content
     * @param  string $parent If this is set it will get the content for a specific page item 
     * @return null           Does not return anything but uses code igniter's view() method to render the page
     */
    public function pages($parent = '')
    {    
        $data = $this->logged_user; 
        error_redirect(has_privilege('manage-pages'), '401');

        $data['section']    = 'dashboard';  
        $data['page_title'] = 'manage_pages';  

        $parent = $this->input->get('parent');  

        // configure and initialize the pagination
        $get_query = ($parent ? '?parent='.$parent : '');
        $set_parent = (!$parent ? 'null' : '');
        $config['suffix'] = $get_query;
        $config['base_url']   = site_url('manage/admin/pages/page');
        $config['total_rows'] = count($this->content_model->get(['parent' => $set_parent, 'manage' => TRUE])); 

        $this->pagination->initialize($config);
        $_page = $this->uri->segment(5, 0);
        $data['pagination'] = $this->pagination->create_links();

        $query = array('parent' => $set_parent, 'manage' => TRUE, 'page' => $_page);
        $data['contents']   = $this->content_model->get($query);

        $this->load->view('layout/_dashboard_header', $data);       
        $this->load->view('manage/manage_pages', $data);       
        $this->load->view('layout/_dashboard_footer', $data);  
    }

    /**
     * Manages page and page creation and updating
     * @param  string $action This specified action for this method (edit is implemented)
     * @param  string $id     The id of the content to edit if action is set
     * @return null           Does not return anything but uses code igniter's view() method to render the page
     */
    public function create_page($action = '', $id = '')
    {    
        $data = $this->logged_user; 
        error_redirect(has_privilege('manage-pages'), '401');
        
        $data['section']       = 'dashboard';  
        $data['page_title']    = 'edit_page';  
        $data['page_subtitle'] = 'manage_pages';   
        
        $query = array('id' => $id);
        $data['content']  = $this->content_model->get($query, 1);
        $parent           = $id ? ($data['content']['parent'] ? $data['content']['parent'] : $data['content']['safelink']) : 'non';
        $data['children'] = $this->content_model->get(['parent' => $parent]);
        $data['children_title'] = $id ? 'Page Content' : 'Pages';

        $data['profile']  = $this->passcontest->basic_profile($data['id']);

        $unique_safelink  = $this->input->post('safelink') != $data['content']['safelink'] ? '|is_unique[content.safelink]|is_unique[users.username]' : '';
        
        // Validate Input
        $this->form_validation->set_error_delimiters('<div class="text-danger form-text text-muted">', '</div>');
        $this->form_validation->set_rules('title', 'Title', 'trim|required'.$unique_safelink);  
        $this->form_validation->set_rules('safelink', 'Safelink', 'trim|required|alpha_dash'); 
        $this->form_validation->set_rules('icon', 'Icon', 'trim'); 
        $this->form_validation->set_rules('color', 'Color', 'trim'); 
        $this->form_validation->set_rules('priority', 'Priority', 'trim|required|numeric|in_list[1,2,3]'); 
        $this->form_validation->set_rules('content', 'Content', 'trim|required'); 

        // The intro becomes required when the parent is not set
        if (!$this->input->post('parent')) {
            $this->form_validation->set_rules('intro', 'Introductory Text', 'trim|required'); 
        }

        if ($this->form_validation->run() === FALSE) { 
            if ($this->input->post()) {
                $this->session->set_flashdata('msg', alert_notice(lang('submission_has_errors'), 'danger'));
            }
        } else { 
            $save = $this->input->post();
            $msg  = lang('page_created');

            $save['in_footer'] = ($save['in_footer'] && !$save['parent']) ? '1' : '0';
            if ($id) {
                $msg = lang('page_updated');
                $save['id'] = $data['content']['id']; 
            }

            $save['safelink'] = (!$save['safelink'] ? url_title($save['title'], '_', TRUE) : $save['safelink']);
            $this->content_model->add($save);
            $this->session->set_flashdata('msg', alert_notice($msg, 'success'));
        }

        $this->load->view('layout/_dashboard_header', $data);       
        $this->load->view('manage/create_page', $data);       
        $this->load->view('layout/_dashboard_footer', $data);  
    }

    public function contests($filter = null)
    {    
        $data = $this->logged_user; 
        error_redirect(has_privilege('manage-contests'), '401');
        
        $data['section']        = 'dashboard';  
        $data['page_title']     = 'manage_contests';   
        $data['next_subtitle']  = 'for ';
        $data['use_datatables'] = TRUE; 
        $data['table_method']   = 'fetch_contests'.($filter !== null ? '/'.$filter : '');
  
        $data['contests']       = $this->contest_model->get(['filter' => $filter]);
        $data['filter']         = $filter;

        $this->load->view('layout/_dashboard_header', $data);       
        $this->load->view('manage/manage_contests', $data);       
        $this->load->view('layout/_dashboard_footer', $data);  
    }

    public function update_contest($id = null)
    {    
        $data = $this->logged_user; 
        error_redirect(has_privilege('manage-contests'), '401');
        
        $data['section']       = 'dashboard';  
        $data['page_title']    = 'update_contest';  
        $data['page_subtitle'] = 'manage_contests';   
  
        $data['contest']       = $this->contest_model->get($id);
        $data['profile']       = $this->passcontest->basic_profile($data['contest']['id'], 1);

        $unique_title    = $this->input->post('title') != $data['contest']['title'] ? '|is_unique[contests.title]|is_unique[users.username]' : ''; 
        
        $this->form_validation->set_error_delimiters('<div class="text-danger form-text text-muted">', '</div>');
        $this->form_validation->set_rules('title', 'Title', 'trim|required'.$unique_title);  
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email'); 
        $this->form_validation->set_rules('phone', 'Phone', 'trim|numeric'); 
        $this->form_validation->set_rules('safelink', 'Safelink', 'trim|required|alpha_dash'); 
        $this->form_validation->set_rules('creator_id', 'Creator ID', 'trim|required|numeric'); 
        $this->form_validation->set_rules('tags', 'Tags', 'trim'); 

        if ($this->form_validation->run() === FALSE) { 
            if ($this->input->post()) {
                $this->session->set_flashdata('msg', alert_notice(lang('submission_has_errors'), 'danger'));
            }
        } else { 
            $save       = $this->input->post();
            $save['id'] = $data['contest']['id'];   
            $this->contest_model->add($save);
            $this->session->set_flashdata('msg', alert_notice(lang('account_updated'), 'success'));
        }

        $this->load->view('layout/_dashboard_header', $data);       
        $this->load->view('manage/update_contest', $data);       
        $this->load->view('layout/_dashboard_footer', $data);  
    }


    public function users($filter = '')
    {    
        $data = $this->logged_user; 
        error_redirect(has_privilege('manage-users'), '401');
        
        $data['section']        = 'dashboard';  
        $data['page_title']     = 'manage_users';   
        $data['use_datatables'] = TRUE;
        $data['table_method']   = 'fetch_users'.($filter !== '' ? '/'.$filter : '');
  
        $config['base_url']     = site_url('manage/admin/users/'.($filter ? $filter.'/' : 'all/').'page');
        $config['total_rows']   = count($this->user_model->get(['filter' => $filter])); 

        $this->pagination->initialize($config);
        $_page = $this->uri->segment(($filter ? 6 : 5), 0);
        $data['pagination'] = $this->pagination->create_links();

        $data['users']          = $this->user_model->get(['filter' => $filter, 'page' => $_page]);
        $data['filter']         = $filter; 
        $data['display_method'] = $this->input->get('use') ? '?use='.$this->input->get('use') : '';

        $this->load->view('layout/_dashboard_header', $data);     
        if ($this->input->get('use') == 'datatables') 
        {
            $this->load->view('manage/manage_users', $data); 
        } 
        else 
        {
            $this->load->view('manage/no_datatable/manage_users', $data); 
        }       
        $this->load->view('layout/_dashboard_footer', $data);  
    }

    public function update_user($id = null)
    {    
        $data = $this->logged_user; 
        error_redirect(has_privilege('manage-users'), '401');
        
        $data['section']       = 'dashboard';  
        $data['page_title']    = 'update_user';  
        $data['page_subtitle'] = 'manage_users';   
  
        $data['user']          = $this->account_data->fetch($id);
        $data['profile']       = $this->passcontest->basic_profile($data['user']['id']);

        $unique_email    = $this->input->post('email') != $data['user']['email'] ? '|is_unique[users.email]' : '';
        $unique_username = $this->input->post('username') != $data['user']['username'] ? '|is_unique[users.username]' : '';
        
        $this->form_validation->set_error_delimiters('<div class="text-danger form-text text-muted">', '</div>');
        $this->form_validation->set_rules('username', 'Username', 'trim|required'.$unique_username); 
        $this->form_validation->set_rules('password', 'Password', 'trim'); 
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email'.$unique_email); 
        $this->form_validation->set_rules('phone', 'Phone', 'trim|numeric'); 
        $this->form_validation->set_rules('first_name', 'First Name', 'trim'); 
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim'); 

        if ($this->form_validation->run() === FALSE) { 
            if ($this->input->post()) {
                $this->session->set_flashdata('msg', alert_notice(lang('submission_has_errors'), 'danger'));
            }
        } else { 
            $save       = $this->input->post();
            $save['id'] = $data['user']['id'];  
            $save['password'] = MD5($save['password']);  
            $this->user_model->add($save); 
            $this->session->set_flashdata('msg', alert_notice(lang('account_updated'), 'success'));
        }

        $this->load->view('layout/_dashboard_header', $data);       
        $this->load->view('manage/update_user', $data);       
        $this->load->view('layout/_dashboard_footer', $data);  
    }

    public function credit($filter = null)
    {    
        $data = $this->logged_user; 
        error_redirect(has_privilege('manage-credit'), '401');
        
        $data['section']        = 'dashboard';  
        $data['page_title']     = 'manage_credit';  
        $data['page_subtitle']  = 'admin_credit';
        $data['profile']        = $this->passcontest->basic_profile($data['id']);
        
        $data['credit']         = array('actual_value' => 1, 'balance' => 1); 
        $data['agent']          = $this->credit_model->fetch_stats(); 
        $data['filter']         = $filter;

        // Generate credit tokens 
        if ($this->input->post('generate_tokens')) {
            $data['generate'] = $this->passcontest->generate_token($this->input->post('quantity'), $this->input->post(), $this->input->post('action'));
            $this->session->set_flashdata('generate_msg', alert_notice($data['generate']['message'], 'info'));
        }

        $this->load->view('layout/_dashboard_header', $data);       
        $this->load->view('manage/manage_credit', $data);       
        $this->load->view('layout/_dashboard_footer', $data);  
    }


    /**
     * Create, manage and assign user privileges
     * @param  string $action create, assign: Determines what action to take during post
     * @param  string $id     if you are updating a privilege this would be the id of the privilege to update
     * @return null           Does not return anything but uses code igniter's view() method to render the page
     */
    public function privileges($action = '', $id = '')
    {    
        $data = $this->logged_user; 
        error_redirect(has_privilege('manage-privilege'), '401');
        
        $data['section']    = 'dashboard';  
        $data['page_title'] = 'manage_privileges';

        $data['privileges']  = $this->privilege_model->get($action == 'create' ? $id : '');
        $data['action_id']   = $id;

        // Generate or assign privileges  
        if ($this->input->post('action')) 
        {
            $this->form_validation->set_error_delimiters('<div class="text-danger form-text text-muted">', '</div>'); 
            if ($action == 'assign') 
            {
                $this->form_validation->set_rules('id', 'User ID', 'trim|numeric|required'); 
            }
            elseif ($action == 'create') 
            {
                $this->form_validation->set_rules('title', 'title', 'trim|required'); 
                $this->form_validation->set_rules('permissions', 'Permissions', 'trim|required'); 
                $this->form_validation->set_rules('info', 'Description', 'trim'); 
            } 

            if ($this->form_validation->run() !== FALSE) 
            { 
                $save = $this->input->post();
                unset($save['action']);
                if ($action == 'assign') 
                { 
                    $p = $this->privilege_model->get($save['role_id']);
                    $u = $this->account_data->fetch($save['id']);
                    $msg = sprintf(lang('user_granted_privilege'), $u['name'], $p['title']);
                    $this->user_model->add($save);
                    $this->session->set_flashdata('assign_msg', alert_notice($msg, 'info'));
                } 
                elseif ($action == 'create') 
                {
                    $msg = lang('new_privilege_created');

                    if ($data['privileges']['id']) {
                        $save['id'] = $data['privileges']['id'];
                        $msg = lang('privilege_updated');
                    }
                    $save['permissions'] = encode_privilege(str_ireplace(', ', ',', $save['permissions']));
                    $this->privilege_model->add($save);
                    $this->session->set_flashdata('create_msg', alert_notice($msg, 'info'));
                } 
                redirect(uri_string());
            }
        }
        elseif ($action == 'delete') 
        {
            $this->privilege_model->remove($id);
            $this->session->set_flashdata('create_msg', alert_notice(lang('privilege').' '.lang('deleted'), 'info'));
            redirect(site_url('manage/admin/privileges/create'));
        } 

        $this->load->view('layout/_dashboard_header', $data);       
        $this->load->view('manage/manage_privileges', $data);       
        $this->load->view('layout/_dashboard_footer', $data);  
    }

    public function configuration($step = 'main')
    {    
        $data = $this->logged_user; 
        error_redirect(has_privilege('manage-configuration'), '401');
        
        $data['section']       = 'dashboard';  
        $data['page_title']    = 'admin_configuration';  
        $data['page_subtitle'] = 'admin_configuration';  
        $data['profile']       = $this->passcontest->basic_profile($data['id']);

        $data['step']         = $this->input->post('step') ? $this->input->post('step') : $step;
        $data['enable_steps'] = 1;  

        $this->form_validation->set_error_delimiters('<div class="text-danger form-text text-muted">', '</div>'); 
 
        if (!$data['enable_steps'] || $data['step'] == 'main') 
        { 
            $this->form_validation->set_rules('value[site_name]', 'Site Name', 'trim|required|alpha_numeric_spaces');
            $this->form_validation->set_rules('value[primary_server]', 'Primary Server', 'trim|valid_url');
            $this->form_validation->set_rules('value[server_dir]', 'Site Directory', 'trim'); 
            $this->form_validation->set_rules('value[ip_interval]', 'IP Interval', 'trim|numeric'); 
        }

        if (!$data['enable_steps'] || $data['step'] == 'payment')
        { 
            $this->form_validation->set_rules('value[site_currency]', 'Site Currency', 'trim|alpha|required|max_length[3]'); 
            $this->form_validation->set_rules('value[currency_symbol]', 'Currency Symbol', 'trim'); 
            $this->form_validation->set_rules('value[credit_code]', 'Credit Code', 'trim|alpha|max_length[3]'); 
            $this->form_validation->set_rules('value[credit_rate]', 'Credit Rate', 'trim|numeric|required'); 
            $this->form_validation->set_rules('value[credit_bonus]', 'Credit Bonus', 'trim|numeric'); 
            $this->form_validation->set_rules('value[credit_units]', 'Available Credit Units', 'trim'); 
            $this->form_validation->set_rules('value[payment_ref_pref]', 'Payment Reference Prefix', 'trim|alpha_dash'); 
            $this->form_validation->set_rules('value[paystack_public]', 'Paystack Public Key', 'trim|alpha_dash'); 
            $this->form_validation->set_rules('value[paystack_secret]', 'Paystack Secret Key', 'trim|alpha_dash'); 
            $this->form_validation->set_rules('value[checkout_info]', 'Checkout Info', 'trim'); 
        }

        if (!$data['enable_steps'] || $data['step'] == 'contact') 
        { 
            $this->form_validation->set_rules('value[contact_email]', 'Contact Email', 'trim|valid_emails'); 
            $this->form_validation->set_rules('value[contact_phone]', 'Contact Phone', 'trim'); 
            $this->form_validation->set_rules('value[contact_facebook]', 'Site Facebook', 'trim'); 
            $this->form_validation->set_rules('value[contact_twitter]', 'Site Twitter', 'trim'); 
            $this->form_validation->set_rules('value[contact_instagram]', 'Site Instagram', 'trim'); 
            $this->form_validation->set_rules('value[contact_address]', 'Contact Address', 'trim'); 
        }    

        if ($this->form_validation->run() === FALSE) { 
            if ($this->input->post('value')) {
                $this->session->set_flashdata('msg', alert_notice(lang('submission_has_errors'), 'danger'));
            }
        } else { 
            unset($_POST['step']);
            $save = $this->input->post('value');    

            $this->setting_model->save_settings($save);
            $this->session->set_flashdata('msg', $this->my_config->alert(lang('configuration_saved'), 'success'));
            // redirect('manage/admin/configuration/'.$step); 

            $process_complete = TRUE;
        }  

        $this->load->view('layout/_dashboard_header', $data);       
        $this->load->view('manage/admin_configuration', $data);       
        $this->load->view('layout/_dashboard_footer', $data);  
    }
}
