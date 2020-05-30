<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modal extends MY_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	} 

	public function upload_image()
	{
		$data['endpoint']    = $this->input->post('endpoint');
		$data['endpoint_id'] = $this->input->post('endpoint_id');
		
		$content = $this->load->view('modals/upload_resize_image', $data, TRUE);

		echo json_encode(['content' => $content], JSON_FORCE_OBJECT);
		return;
	} 
}
