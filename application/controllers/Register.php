<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	
		public function __construct(){
		parent::__construct();
		 
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 $this->load->model('authentication_model');
		 	 $this->load->model('home_model');
		 $this->data['cities']			=	$this->home_model->get_cities();
		 $this->load->model('authentication_model');
		  $this->data['social_login']	=	$this->authentication_model->generate_social_logins();
		
 	}
		 

	public function admin()
	{
	check_login();
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tbl_admin.admin_email]',
			array('required' =>  keyword_value('you_must_enter_email','You must enter Email.'),
				  'valid_email' => keyword_value('please_enter_valid_email','Please Enter a valid Email'),
				  'is_unique'=>keyword_value('email_exits','Emil already exits. Please choose another one or try logging in'))
		);
		
		$this->form_validation->set_rules('name', 'Name', 'required',
			array('required' =>  keyword_value('you_must_enter_name','Enter  Name')
		));
	
		
		$this->form_validation->set_rules('password', 'Password', 'required',
				array('required' =>  keyword_value('you_must_enter_password','Enter  Password'))
		);
		
		$this->form_validation->set_rules('conf_password', 'Confirm Password', 'required|matches[password]',
				array('required' =>  keyword_value('you_must_enter_cpassword','Enter Confirm Password'))
		
		);
		
		
		  if ($this->form_validation->run() == FALSE)
		{
					
				$this->load->view('admin/register');
	
		}
		
				else
		{
			$data['admin_email']=$this->input->post('email');
			$data['admin_name']=$this->input->post('name');
			$data['active']=1;
			if($this->input->post('mobile'))
			{
				$data['admin_mobile']=$this->input->post('mobile');
				
			}
			$password= hash ( "sha256", $this->input->post('password'));
			$data['admin_password']=$password;
			$return=$this->authentication_model->register($data);
			if($return['status']==true)
			{
				$this->sendverifylink();
				$return2=$this->authentication_model->login($data['admin_email'],$data['admin_password']);
				if($return2['status']==false)
				{
					$this->session->set_flashdata('msg', $return['msg']);
					redirect('authentication/admin');
					
				}
			}
		
				redirect('admin');
				
		}
		
	}
	
		public function admin_front()
	{
	
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tbl_admin.admin_email]',
			array('required' =>  keyword_value('you_must_enter_email','You must enter Email.'),
				  'valid_email' => keyword_value('please_enter_valid_email','Please Enter a valid Email'),
				  'is_unique'=>keyword_value('email_exits','Emil already exits. Please choose another one or try logging in'))
		);
		
		$this->form_validation->set_rules('name', 'Name', 'required',
			array('required' =>  keyword_value('you_must_enter_name','Enter  Name')
		));
	
		
		$this->form_validation->set_rules('password', 'Password', 'required',
				array('required' =>  keyword_value('you_must_enter_password','Enter  Password'))
		);
		
		$this->form_validation->set_rules('conf_password', 'Confirm Password', 'required|matches[password]',
				array('required' =>  keyword_value('you_must_enter_cpassword','Enter Confirm Password'))
		
		);
		
		
		  if ($this->form_validation->run() == FALSE)
		{
					$this->data['categories']		=	$this->home_model->get_service_cats();
			$this->data['pro_categories']	=	$this->home_model->get_product_cats();
					$this->data['title']			=   DEFAULT_TITLE;
		$this->data['meta_keywords']	=   DEFAULT_KEYWORDS;
		$this->data['meta_description']	=   DEFAULT_DESCRIPTION;
			$this->load->view('public/templates/header',$this->data);

			$this->load->view('public/register',$this->data);
			$this->load->view('public/templates/footer',$this->data);
				//$this->load->view('admin/register');
	
		}
		
				else
		{
			$data['admin_email']=$this->input->post('email');
			$data['admin_name']=$this->input->post('name');
			$data['active']=1;
			if($this->input->post('mobile'))
			{
				$data['admin_mobile']=$this->input->post('mobile');
				
			}
			$password= hash ( "sha256", $this->input->post('password'));
			$data['admin_password']=$password;
			$return=$this->authentication_model->register($data);
			if($return['status']==true)
			{
				$this->sendverifylink();
				$return2=$this->authentication_model->login($data['admin_email'],$data['admin_password']);
				if($return2['status']==false)
				{
					$this->session->set_flashdata('msg', $return['msg']);
					redirect('authentication/admin');
					
				}
			}
		
				redirect('admin');
				
		}
		
	}
	
	
			public function sendverifylink()
	{
		if(@$this->session->user_data->admin_email)
		{
			$this->load->helper('string');
			$random=random_string('alnum',30);
			$vlink=base_url('verify_email/verify/'.$random);
			$this->authentication_model->update_email_otp($this->session->pk_admin_id,$random);
			$template=get_email_template('business_register');
			$ret=false;
			if($template)
			{
			$find = array("{{LOGO}}","{{SITE_URL}}","{{SITE_NAME}}","{{ADMIN_NAME}}","{{VERIFY_LINK}}");
			$replace = array(LOGO,base_url(),SITE_NAME,$this->session->user_data->admin_name,$vlink);
			$email['to']=$this->session->user_data->admin_email;
			$email['subject']=$template['template_subject'];
			$email['message']=str_replace($find,$replace,$template['template']);
			$ret=sendemail($email);
			}
		
			
			 if($ret)
			{
				$this->session->set_flashdata('msg_info','Verification link Send Successfully. Link will be valid for 15 mins'); 	 
			}
			 else
			{
				$this->session->set_flashdata('msg_info','Verification link not sent. Please Try after sometime.'); 	 
			}
			
			
			
			redirect('admin');
	
		}
		else if(@$this->session->front_user_data->user_email)
		{
			$this->load->helper('string');
			$random=random_string('alnum',30);
			$vlink=base_url('verify_email/verify_user/'.$random);
			$this->authentication_model->update_user_email_otp($this->session->front_user_id,$random);
			$template=get_email_template('user_register');
			$ret=false;
			if($template)
			{
			$find = array("{{LOGO}}","{{SITE_URL}}","{{SITE_NAME}}","{{USER_NAME}}","{{VERIFY_LINK}}");
			$replace = array(LOGO,base_url(),SITE_NAME,$this->session->front_user_data->user_firstname.' '.$this->session->front_user_data->user_lastname,$vlink);
			$email['to']=$this->session->front_user_data->user_email;
			$email['subject']=$template['template_subject'];
			$email['message']=str_replace($find,$replace,$template['template']);
			$ret=sendemail($email);
			}
			}
		
		
		
	}
}
