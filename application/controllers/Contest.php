<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contest extends Contest_Controller {

    public function index($id = null)
    {
        $user    = $this->logged_user; 
        $user_id = $user['id'] ? $user['id'] : '';
        $data    = $this->contest_model->get($id);

        // If the contest does not exist, show 404 page
        error_redirect($data);

        $data['contestants']     = $this->contestant_model->get(['contest_id' => $data['id'], 'limit' => 4]);
        $data['this_contestant'] = $this->contestant_model->get(['contest_id' => $data['id'], 'contestant_id' => $user_id, 'active' => 'all']);

        $data['has_banner']      = TRUE;
        $data['active_page']     = 'profile-page';
        $data['contest_banner']  = $this->load->view('layout/contest__banner', $data, TRUE);
        $data['contest_sidebar'] = $this->load->view('layout/contest__sidebar', $data, TRUE);
        
        if ($id && $data) { 
            $this->load->view('layout/profile_header', $data);       
            $this->load->view('contest/contest', $data);       
            $this->load->view('layout/main_footer', $data);  
        }
    }

    public function details($contest_id = null)
    {
        $user    = $this->logged_user; 
        $user_id = $user['id'] ? $user['id'] : '';
        $data    = $this->contest_model->get($contest_id);

        // If the contest does not exist, show 404 page
        error_redirect($data);

        $data['contestants']     = $this->contestant_model->get(['contest_id' => $data['id'], 'limit' => 4]);
        $data['this_contestant'] = $this->contestant_model->get(['contest_id' => $data['id'], 'contestant_id' => $user_id, 'active' => 'all']);

        $data['contest_banner']  = $this->load->view('layout/contest__banner', $data, TRUE);
        $data['contest_sidebar'] = $this->load->view('layout/contest__sidebar', $data, TRUE);
        
        if ($contest_id && $data) { 
            $this->load->view('layout/profile_header', $data);       
            $this->load->view('contest/contest', $data);       
            $this->load->view('layout/main_footer', $data);  
        }
    } 

    public function voters($contest_id = 1, $endpoint = null, $endpoint_id = null)
    {
        $user    = $this->logged_user; 
        $user_id = $user['id'] ? $user['id'] : '';
        $data    = $this->contest_model->get($contest_id);

        // If the user does not exist, show 404 page
        error_redirect($data);

        $data['contestants'] = $this->contestant_model->get(['contest_id' => $data['id'], 'limit' => 4]);
        $data['this_contestant'] = $this->contestant_model->get(['contest_id' => $data['id'], 'contestant_id' => $user_id, 'active' => 'all']);

        $endpoint_id = ($endpoint == 'contest' ? $data['id'] : $endpoint_id);

        $config['base_url']     = site_url('contest/voters/'.$contest_id.'/'.$endpoint.'/'.$endpoint_id.'/page/');
        $config['total_rows']   = count($this->contest_model->getVotes(['contest_id' => $data['id'], $endpoint.'_id' => $endpoint_id])); 

        $this->pagination->initialize($config);
        $_page = $this->uri->segment(7, 0);
        $data['pagination'] = $this->pagination->create_links();

        $data['voters'] = $this->contest_model->getVotes(['contest_id' => $data['id'], $endpoint.'_id' => $endpoint_id, 'page' => $_page]);

        $data['contest_banner']     = $this->load->view('layout/contest__banner', $data, TRUE);
        $data['contest_sidebar']    = $this->load->view('layout/contest__sidebar', $data, TRUE);
        
        if ($contest_id && $data) { 
            $this->load->view('layout/profile_header', $data);       
            $this->load->view('contest/voters', $data);       
            $this->load->view('layout/main_footer', $data);  
        }
    }

    public function contestants($contest_id = null)
    {
        $user    = $this->logged_user; 
        $user_id = $user['id'] ? $user['id'] : '';
        $data    = $this->contest_model->get($contest_id);

        // If the user does not exist, show 404 page
        error_redirect($data);

        $config['base_url']      = site_url('contest/contestants/'.$contest_id.'/page/');
        $config['total_rows']    = count($this->contestant_model->get(['contest_id' => $data['id']])); 

        $this->pagination->initialize($config);
        $_page                   = $this->uri->segment(5, 0);
        $data['pagination']      = $this->pagination->create_links();

        $c_config = ['contest_id' => $data['id'], 'page'=> $_page];
        $data['contestants']     = $this->contestant_model->get($c_config);
        $data['this_contestant'] = $this->contestant_model->get(['contest_id' => $data['id'], 'contestant_id' => $user_id, 'active' => 'all']);

        $data['contest_banner']  = $this->load->view('layout/contest__banner', $data, TRUE);
        $data['contest_sidebar'] = $this->load->view('layout/contest__sidebar', $data, TRUE);

        if ($contest_id && $data) { 
            $this->load->view('layout/profile_header', $data);       
            $this->load->view('contest/contestants', $data);       
            $this->load->view('layout/main_footer', $data);  
        }
    }
}
