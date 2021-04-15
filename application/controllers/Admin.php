<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('user_type') || $this->session->userdata('user_type')=='user'){
			redirect('authentication/admin');	
		}
		
 	}

	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
	}
	
	
}
