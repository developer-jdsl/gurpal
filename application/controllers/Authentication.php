<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
		if($this->session->userdata('user_type')=="admin" || $this->session->userdata('user_type')=="superadmin"){
			redirect('admin');	
		}
		else if($this->session->userdata('user_type')=="user")
		{
			redirect('user');	
		}
		
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 $this->load->model('authentication_model');
 	}
	
	
	public function admin()
	{
		$this->load->library('encrypt');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email',
			array('required' =>  keyword_value('you_must_enter_email','You must enter Email.'),
				  'valid_email' => keyword_value('please_enter_valid_email','Please Enter a valid Email'))
		);
		$this->form_validation->set_rules('password', 'Password', 'required',
				array('required' =>  keyword_value('you_must_enter_password','You must enter a Password'))
		);
		
		  if ($this->form_validation->run() == FALSE)
		{
			
				$this->load->view('admin/login');
	
		}
		else
		{
			$email=$this->input->post('email');
			$password= hash ( "sha256", $this->input->post('password'));
			
			$return=$this->authentication_model->login($email,$password);
		
			
			
			if($return['status']==false)
			{
				$this->session->set_flashdata('msg', $return['msg']);
				redirect('authentication/admin');
			}
		
				redirect('admin');
				
		}
				
				
		
		
	}

	public function user()
	{
		echo 'user';
	}
	
	
}
