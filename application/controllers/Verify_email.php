<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify_email extends CI_Controller {
	
		public function __construct(){
		parent::__construct();
		 $this->load->model('authentication_model');
		
 	}
		 

	public function verify($passcode)
	{
		if($passcode)
		
		{
			if($det=$this->authentication_model->get_otpdetails($passcode))
			{
				$now=time();
		
				if($now<$det['otp_validity'])
				{
					
					if($this->authentication_model->verify($det['pk_admin_id']))
						
					{
						$this->session->user_data->is_verified=1;
						$this->session->set_flashdata('msg_success','Your Account is successfully verified'); 		
						
					}
					
					else
					{
					
						$this->session->set_flashdata('msg_info','Verification failed please try after sometime.<a href="'.base_url('verify_email/resend').'" class="alert-link">Click Here</a> to get new verification link'); 		
						
					}
				}
				else
				{
					$this->session->set_flashdata('msg_info','Verification link Expired.<a href="'.base_url('verify_email/resend').'" class="alert-link">Click Here</a> to get new verification link'); 	
				}
				
				
			}
			else
			{
			 $this->session->set_flashdata('msg_info','Invalid Verification link .<a href="'.base_url('verify_email/resend').'" class="alert-link">Click Here</a> to get new verification link'); 	
			}
			
		}
		
		else
			{
				$this->session->set_flashdata('msg_info','Invalid Verification link .<a href="'.base_url('verify_email/resend').'" class="alert-link">Click Here</a> to get new verification link'); 

			}
			
			
			redirect('admin');
		
	}
	
		public function verify_user($passcode)
	{
		if($passcode)
		
		{
			if($det=$this->authentication_model->get_otpdetails_user($passcode))
			{
				$now=time();
		
				if($now<$det['otp_validity'])
				{
					
					if($this->authentication_model->verify_user($det['pk_user_id']))
						
					{
						$this->session->front_user_data->is_verified=1;
						$this->session->set_flashdata('msg_success','Your Account is successfully verified'); 		
						
					}
					
					else
					{
					
						$this->session->set_flashdata('msg_info','Verification failed please try after sometime.<a href="'.base_url('verify_email/resend').'" class="alert-link">Click Here</a> to get new verification link'); 		
						
					}
				}
				else
				{
					$this->session->set_flashdata('msg_info','Verification link Expired.<a href="'.base_url('verify_email/resend').'" class="alert-link">Click Here</a> to get new verification link'); 	
				}
				
				
			}
			else
			{
			 $this->session->set_flashdata('msg_info','Invalid Verification link .<a href="'.base_url('verify_email/resend').'" class="alert-link">Click Here</a> to get new verification link'); 	
			}
			
		}
		
		else
			{
				$this->session->set_flashdata('msg_info','Invalid Verification link .<a href="'.base_url('verify_email/resend').'" class="alert-link">Click Here</a> to get new verification link'); 

			}
			
			
			redirect('admin');
		
	}
	
	
	
	public function resend()
	{
		if(@$this->session->user_data->admin_email)
		{
			$this->load->helper('string');
			$this->load->library('email');
			$random=random_string('alnum',30);
			$this->authentication_model->update_email_otp($this->session->pk_admin_id,$random);
			
			
			
			$this->email->from('email@example.com', 'Identification');
			$this->email->to($this->session->user_data->admin_email);
			$this->email->subject('Verification link for gurpal');
			$this->email->message('Your Verfication link is '.base_url('verify_email/verify/'.$random));
			
			 if($this->email->send())
			{
				$this->session->set_flashdata('msg_info','Verification link Send Successfully. Link will be valid for 15 mins'); 	 
			}
			 else
			{
				$this->session->set_flashdata('msg_info','Verification link not sent. Please Try after sometime.'); 	 
			}
			
			redirect('admin');
	
		}
		else
			
			{
				redirect('authentication/admin');
			}
		
		
	}
	
		
	public function resend_user()
	{
		if(@$this->session->front_user_data->user_email)
		{
			$this->load->helper('string');
			$this->load->library('email');
			$random=random_string('alnum',30);
			$this->authentication_model->update_email_otp_user($this->session->front_user_id,$random);
			
			
			
			$this->email->from('email@example.com', 'Identification');
			$this->email->to($this->session->front_user_data->user_email);
			$this->email->subject('Verification link for gurpal');
			$this->email->message('Your Verfication link is '.base_url('verify_email/verify_user/'.$random));
			
			 if($this->email->send())
			{
				$this->session->set_flashdata('msg_info','Verification link Send Successfully. Link will be valid for 15 mins'); 	 
			}
			 else
			{
				$this->session->set_flashdata('msg_info','Verification link not sent. Please Try after sometime.'); 	 
			}
			
			redirect('/');
	
		}
		else
			
			{
				$this->sesssion->set_flashdata('lflag','login');
			redirect('/');
			}
		
		
	}
}
