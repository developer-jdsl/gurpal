<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/third_party/hybridauth/autoload.php';
use Hybridauth\Hybridauth;
class Authentication extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		 check_login();
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 $this->load->model('authentication_model');
 	}
	
	
	public function admin()
	{
	
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
	

	
	public function forgot_password()
	{
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email',
			array('required' =>  keyword_value('you_must_enter_email','You must enter Email.'),
				  'valid_email' => keyword_value('please_enter_valid_email','Please Enter a valid Email'))
		);
		
		  if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/forgot_password');
		}
		else
		{
			$email=$this->input->post('email');
			$return=$this->authentication_model->send_reset_link($email);
			$this->session->set_flashdata('msg', $return['msg']);
			redirect('authentication/forgot_password');
		}
		
	
		
	}
	
	
	public function reset_password($id)
	
	{
		
		if($id)
		{
			$chk=$this->authentication_model->check_reset_hash($id);
			 
			if($chk['pk_admin_id'])
				
				{
					$this->session->set_userdata('reset_id',$chk['pk_admin_id']);
					
					$this->form_validation->set_rules('password', 'Password', 'required',
			array('required' =>  keyword_value('you_must_enter_email','You must enter new Password.'))
		);
		
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]',
			array('required' =>  keyword_value('you_must_enter_email','You must Confirm new Password.'),
			'matches' =>  keyword_value('pass_mismatch','Confirm password Must match New Password'))
		);
		
		  if ($this->form_validation->run() == FALSE)
		{
			$this->data['id']=$id;
			$this->load->view('admin/reset_password',$this->data);
		}
		else
		{
			if($this->session->reset_id)
			{
				$password= hash ( "sha256", $this->input->post('password'));
				$return=$this->authentication_model->set_reset_password($this->session->reset_id,$password);
				if($return)
				{
					$this->session->reset_id=NULL;
					$this->session->set_flashdata('msg', 'Your password is changed successfully.Please Login');
					redirect('authentication/admin');
					
				}
				
				else
				{
					$this->session->set_flashdata('msg','Unable to complete action.Please try again after sometime');
					redirect('authentication/forgot_password');
					
				}
			}
		}
					
				}
				
				else
					
					{
						$this->session->set_flashdata('msg','Invalid password reset link, Please generate new');
						redirect('authentication/forgot_password');
					}
			
			
		}
		else
		{
			$this->session->set_flashdata('msg','Invalid password reset link, Please generate new');
			redirect('authentication/forgot_password');
			
		}
		
		
	}
	
	
	public function social($provider = NULL)
	{
		
		 $service = NULL;

        try
        {
            //Instantiate Hybridauth's classes
            $hybrid = new Hybridauth(getHybridConfig());
			
	
			
            //Check if given provider is enabled
            if ((isset($provider)) && in_array($provider, $hybrid->getProviders()))
            {
                $this->session->set_userdata('provider', $provider);
            }

            //Update variable with the valid provider
            $provider = $this->session->userdata('provider');

            if ($provider)
            {
                $service = $hybrid->authenticate($provider);
				
                if ($service->isConnected())
                {
                    //Get user profile
                    $profile = $service->getUserProfile();
					
					if($this->authentication_model->check_email($profile->email))
					{
						$this->authentication_model->user_login_social($profile->email);
						
					}
					else
					{
						$rdata['user_firstname']	=	$profile->firstName?$profile->firstName:$profile->displayName;
						$rdata['user_lastname']		=	$profile->lastName?$profile->lastName:$profile->displayName;
						$rdata['user_email']		=	$profile->email;
						$rdata['active']			=	1;
						$rdata['is_verified']		=	1;
						$this->authentication_model->user_register_social($rdata);
						$this->authentication_model->user_login_social($profile->email);
					}
					
                    /*
                    Disconnect the service else HA would reuse stored session data
                    rather making a fresh request in case the user has denied permissions
                    in the previous authorization request
                    */
                    $service->disconnect();

                    $this->session->unset_userdata('provider');

                    //Display the profile data
                  redirect('my-account');
                }
                else
                {
                    $this->session->set_flashdata('showmsg', array('msg' => 'Sorry! We couldn\'t authenticate your identity.'));
					
				redirect('/');
                }
            }
        }
        catch(Exception $e)
        {
            if (isset($service) && $service->isConnected()) 
                $service->disconnect();

            $error = 'Sorry! We couldn\'t authenticate you.';
            $this->session->set_flashdata('showmsg', array('msg' => $error));
            $error .= '\nError Code: ' . $e->getCode();
            $error .= '\nError Message: ' . $e->getMessage();

            log_message('error', $error);
        }
		
		
	}
	
	
	function social_callback()
	
	{
		
		var_dump($_GET);
		
		var_dump($_POST);
		
			var_dump($_SESSION);
	}
	
	


	
}
