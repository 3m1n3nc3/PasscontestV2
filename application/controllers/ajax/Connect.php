<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Connect extends MY_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function add_vote()
	{	 
		$data['count'] 		   = 1;

		if ($this->logged_user['id']) 
		{
			$data['voter_id']  = $this->logged_user['id'];
		} 
		else 
		{
			$data['voter_id']  = $this->logged_guest['ip'];
		}
		$data['contest_id']    = $q_data['contest_id']     = $this->input->post('contest');
		$data['contestant_id'] = $q_data['contestant_id']  = $this->input->post('contestant');

        $crc     = my_config('credit_code');

		// Fetch the contest
        $contest = $this->contest_model->get($data['contest_id']);

		// Check if this user has voted before
		$voted   = $this->contest_model->getVotes($data, 1);
	    
		// Check the credit balance of the user
	    $balance  = $this->passcontest->credit($data['voter_id'], 'balance');

	    // Check if the user has enough credit to vote this contest
	    if (($balance >= $contest['vote_cost']) || $this->ip->guestVoter($data['contest_id'], $data['contestant_id'])) { 
			// If the user has voted before, dont create a new record, just update the records
			if ($voted) 
			{
				$data['id']    = $voted['id'];
				$data['count'] = ($voted['count'] + 1);
				$cast 		   = $this->contest_model->add_vote($data);
			} 
			else 
			{
				$cast = $this->contest_model->add_vote($data);
			}
		} else {

	        $message = (
	        	!$this->logged_user ? lang('guest_login_to_vote') : sprintf(lang('insufficient_vote_credit'), my_config('credit_name'))
	        );

			$msg = 
				alert_notice(
                    $message, 'danger', $data['contestant_id']
                );
			echo json_encode(array('response' => 'Error', 'msg' => $msg, 'status' => 0), JSON_FORCE_OBJECT);
			return;
		}

		if (isset($cast)) 
		{
	        $votes       = $this->contest_model->getVotes($q_data);
	        $votes_count = 0;

	        // Count the contestants current votes
	        foreach ($votes as $v) 
	        {
	            if ($v['count'] > 1) 
	            {
	                $votes_count += $v['count'];
	            }
	        }                        

	        // If the vote was casted, subtract the vote cost from the users balance
			if ($this->logged_user['id']) 
			{
		        $add['action']  = 'update';  
	            $add['balance'] = $balance - $contest['vote_cost'];
	            $this->passcontest->credit($data['voter_id'], $add);
	        }

	        $votes_count = $votes_count > 1 ? $votes_count : count($votes);

	        $message = $this->logged_user ? sprintf(lang('voted_delivered_success'), $contest['vote_cost'].' '.$crc) : lang('thanks_for_voting');
			$msg = alert_notice($message, 'success', $data['contestant_id']);
	        echo json_encode(array('response' => $votes_count, 'msg' => $msg, 'status' => 1), JSON_FORCE_OBJECT);
	        return;
		}

		$msg = alert_notice(lang('failed_to_add_vote'), 'danger', $data['contestant_id']);
		echo json_encode(array('response' => 'Error', 'msg' => $msg, 'status' => 0), JSON_FORCE_OBJECT);
		return;
	}

	public function login()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');

		$login = $this->user_model->userLogin($data);
		if (!$login) {
			echo json_encode(NULL, JSON_FORCE_OBJECT);
			return;
		}
		echo json_encode('true', JSON_FORCE_OBJECT);
		return;
	}

	public function upload_image($endpoint_id = '', $endpoint = 0)
	{ 	
		if ($endpoint === 'user') 
		{
			$endpoint = 0;
		}
		$upload_type 	 = $this->input->post('set_type');
		if ($upload_type == 'cover') {
			$folder 	 = 'covers/';
			$table_index = 'cover';
		} else {
			$folder 	 = 'avatars/';
			$table_index = 'avatar';
		}

		// fetch user data
		if ($endpoint === 0) 
		{
			$user_id 	= $endpoint_id ? $endpoint_id : $this->session->userdata('username');
			$data    	= $this->account_data->fetch($user_id); 
	        $sub_folder = $data['username'] . '/'; 	
	        $_config['upload_path'] = './uploads/' . $folder . $sub_folder; 	
		} 
		else 
		{
			$data    	= $this->contest_model->get($endpoint_id); 
	        $sub_folder = $data['safelink'] . '/'; 
	        $_config['upload_path'] = './uploads/' . $folder . $sub_folder; 
		}

		if ($data) { 

			// Check if this upload is ajax
			$file = $this->input->post('ajax_image');
			if ($file) 
			{
			  	$ajax_image_ = explode(';', $file);
			  	$ajax_image_ = isset($ajax_image_[1]) ? $ajax_image_[1] : null; 
			}

			if (isset($ajax_image_)) 
			{ 
				list($type, $file) = explode(';', $file);
				list(, $file) = explode(',', $file);
				$image = base64_decode($file);
				$new_image = mt_rand().'_'.mt_rand().'_'.mt_rand().'_p.png';

			  	// Save the new image to the upload directory              
			  	if ($image) 
			  	{   
	                if ( ! $this->creative_lib->create_dir($_config['upload_path'])) 
	                { 
	                    $data['error'] = $this->my_config->alert('The upload destination folder does not appear to be writable.', 'danger'); 
	                } 
	                else 
	                {
	                    $this->creative_lib->delete_file('./' . $data[$table_index]);

		                if ( ! file_put_contents($_config['upload_path'] . $new_image, $image) )
		                {
		                    $data['error'] = $this->my_config->alert('The file could not be written to disk.', 'danger'); 
		                }
		                else
		                { 	
		                    $data_img = array('id' => $data['id'], $table_index => 'uploads/' . $folder . $sub_folder . $new_image);
							
							if ($endpoint === 0) 
							{
		                    	$this->user_model->add($data_img);
		                    } else {
		                    	$this->contest_model->add($data_img);
		                    }

		                    chmod($_config['upload_path'].'/'.$new_image, 0777); 
		                    $data['success'] = $this->my_config->alert('Your upload was completed successfully.', 'success');
		                }
	                }
	            } 
			} 
			elseif (empty($ajax_image_)) 
			{
	            $data['error'] = $this->my_config->alert('We were unable to process this upload, maybe you did not select a file.', 'danger'); 
			}
		} 
		else 
		{
            $data['error'] = $this->my_config->alert('There is no endpoint id for this upload, set username or contest id', 'danger'); 
		}

		echo json_encode($data, JSON_FORCE_OBJECT);
		return;
	}

	public function user_availability()
	{	
		$post  = $this->input->post();
		$data  = (isset($post['email']) ? $post['email'] : $post['username']); 
		$_msg  = (isset($post['email']) ? 'email' : 'username'); 

		$email = $this->user_model->readByEmail($data);
		if ($email) {
			echo json_encode('<small>'.lang($_msg.'_notavailable').'</small>', JSON_FORCE_OBJECT);
			return;
		}
		echo json_encode(true, JSON_FORCE_OBJECT);
		return;
	}

	public function acceptItem()
	{
		$data['contest_id']     = $q_data['contest_id']    = $this->input->post('contest_id');
		$data['contestant_id'] 	= $q_data['contestant_id'] = $this->input->post('id');
		$data['type'] 	        = $q_data['type'] 		   = $this->input->post('type');
		$data['action'] 	    = $q_data['action'] 	   = $this->input->post('action');
		$data['init'] 	        = $q_data['init'] 		   = $this->input->post('init');
 		
 		if ($data['type'] == 'contestant') 
 		{	
 			$query = ['contestant_id' => $data['contestant_id'], 'contest_id' => $data['contest_id'], 'active' => $data['action']];
 			$this->contestant_model->update($query);
 		}
        echo json_encode(array('response' => true, 'msg' => '', 'status' => 1), JSON_FORCE_OBJECT);
        return;
	}

	public function deleteItem()
	{
		$type = $this->input->post('type');
		$data['id']     = $this->input->post('id'); 
		$data['action'] = $this->input->post('action');
		$data['init'] 	= $this->input->post('init');
 		
 		if ($type == 'contest') 
 		{	 
			$contest = $this->contest_model->get($data['id']);

			// Delete the images associated with this item
 			$this->creative_lib->delete_file([$contest['avatar'], $contest['cover']]);
 			
 			// Delete all records associated with this item
 			$this->contest_model->remove($data['id']);
 			$this->contestant_model->remove($data['id']);
 			$this->contest_model->removeVotes($data['id']);
 			$this->credit_model->remove($data['id']);
 		} 
 		elseif ($type == 'user') 
 		{
 			$user = $this->user_model->get($data['id'], 1);

 			// Delete the images associated with this item
 			$this->creative_lib->delete_file([$user['avatar'], $user['cover']]);
 			
 			// Delete all records associated with this item
 			$this->contest_model->remove(['creator' => $data['id']]);
 			$this->contestant_model->remove(['contestant' => $data['id']]);
 			$this->contest_model->removeVotes(['contestant' => $data['id']]);
 			$this->contest_model->removeVotes(['voter' => $data['id']]);
 			$this->credit_model->remove(['agent' => $data['id']]);
 			$this->credit_model->removeCredit($data['id']);
 			$this->user_model->remove($data['id']);
 		}
 		elseif ($type == 'page') 
 		{
 			$query = array('id' => $data['id']);
        	$page = $this->content_model->get($query);

        	// Delete the images associated with this item
 			$this->creative_lib->delete_file($page['banner']);

 			// Delete all records associated with this item
 			if (!$page['parent']) {
 				$this->content_model->remove(['parent' => $page['safelink']]); 
 			}
 			$this->content_model->remove($data['id']);
 		}
        echo json_encode(array('response' => true, 'msg' => '', 'status' => 1), JSON_FORCE_OBJECT);
        return;
	}
}
