<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
		public function __construct(){
		parent::__construct();
		 $this->load->model('home_model');
		 $this->data['cities']			=	$this->home_model->get_cities();
		 construct_init();
 	}
		 	
		public function index()
	{
	
		$this->data['products']			=	$this->home_model->get_products(6);
		$this->data['services']			=	$this->home_model->get_services(6);
		$this->data['banners']			=	$this->home_model->get_banners();
		$this->data['brands']			=	$this->home_model->get_brands();
		$this->data['advertisements']	=	$this->home_model->get_advertisements('home','left_sidebar');
		$this->data['categories']		=	$this->home_model->get_service_cats();
		$this->data['title']			=   DEFAULT_TITLE;
		$this->data['meta_keywords']	=   DEFAULT_KEYWORDS;
		$this->data['meta_description']	=   DEFAULT_DESCRIPTION;
		
		$this->load->view('public/templates/header',$this->data);
		$this->load->view('public/templates/sidebar',$this->data);
		$this->load->view('public/home',$this->data);
		$this->load->view('public/templates/footer',$this->data);
		
		//	var_dump($this->session);
		
	}
	
	public function city($city)
	{
		if($ret=$this->home_model->is_valid_city($city))
		{
		$dt['search']	=		$this->input->post('search')?$this->input->post('search'):null;
		$dt['city']		=		$this->input->post('city')?$this->input->post('city'):null;
		$this->data['products']			=	$this->home_model->get_products(6,$dt);
		$this->data['services']			=	$this->home_model->get_services(6,$dt);
		//$this->data['banners']		=	$this->home_model->get_banners();
		$this->data['brands']			=	$this->home_model->get_brands();
		$this->data['advertisements']	=	$this->home_model->get_advertisements('home','left_sidebar');
		$this->data['categories']		=	$this->home_model->get_service_cats();
		$this->data['title']			=   $ret['meta_title']?$ret['meta_title']:DEFAULT_TITLE;
		$this->data['meta_keywords']	=   $ret['meta_keywords']?$ret['meta_keywords']:DEFAULT_KEYWORDS;
		$this->data['meta_description']	=   $ret['meta_description']?$ret['meta_description']:DEFAULT_DESCRIPTION;
		$this->data['city_name']		=	$ret['city_name'];
		
		$this->load->view('public/templates/header',$this->data);
		$this->load->view('public/templates/sidebar',$this->data);
		$this->load->view('public/city',$this->data);
		$this->load->view('public/templates/footer',$this->data);
		
		//	var_dump($this->session);
		}
		else
			
			{
				show_404();
			}
		
	}
	
	
	public function cart()
	{
		$this->data['cart']				=	get_cart_data();
		if(!empty($this->data['cart']))
		{
		$this->data['title']			=   DEFAULT_TITLE;
		$this->data['meta_keywords']	=   DEFAULT_KEYWORDS;
		$this->data['meta_description']	=   DEFAULT_DESCRIPTION;
		$this->load->view('public/templates/header',$this->data);
		$this->load->view('public/cart',$this->data);
		$this->load->view('public/templates/footer',$this->data);
		}
		else {
		redirect('/');
		}	

	}

	public function checkout()
	{
		$this->data['cart']				=	get_cart_data();
		
		if(!empty($this->data['cart']))
		{
				
	 $this->load->library('form_validation');
     $this->load->helper('form');
	 $this->load->model('authentication_model');
	 
	 
		if($this->session->front_user_id)		
		{
		


		$this->form_validation->set_rules('primaryAddressOption', 'Address', 'required',
			array('required' =>  keyword_value('you_must_enter_address','Please Select Address')
		));			
		$this->form_validation->set_rules('pg', 'Payment Method', 'required',
			array('required' =>  keyword_value('you_must_select_pg','Please Select Payment ethod')
		));	
		
		
			   if ($this->form_validation->run() == FALSE)
		{
			
		$this->data['payment_methods']	=	$this->home_model->get_payment_methods();
		$this->data['title']			=   DEFAULT_TITLE;
		$this->data['meta_keywords']	=   DEFAULT_KEYWORDS;
		$this->data['meta_description']	=   DEFAULT_DESCRIPTION;	
		$this->load->view('public/templates/header',$this->data);
		if($this->session->front_user_id)
		{
			$this->data['addresses']		=   $this->home_model->get_user_addresses();
			
		}
		$this->data['states']			=   $this->home_model->get_states();
		$this->data['cities']			=   $this->home_model->get_cities();
		$this->load->view('public/checkout',$this->data);
		$this->load->view('public/templates/footer',$this->data);
		}
		
		else
			
			{
				$pg			=		$this->input->post('pg');
				$address	=		$this->input->post('primaryAddressOption');
				
				if($pg==1)  // COD
				{
					$subt=$gst=$tqty=0;
					
					foreach(get_cart_data() as $row) 
					{ 
						$subt=$subt+($row['item_price']*$row['item_qty']);
						$tqty=$tqty+$row['item_qty'];
						$gst=$gst+($row['item_gstvalue']*$row['item_qty']); 
					} 
					
					$data3['txn_id']			= mt_rand(100000000,999999999);
					$data3['fk_user_id']		= $this->session->front_user_id;
					$data3['ip_address']		= $this->input->ip_address();
					$data3['total_quantity']	= $tqty;
					$data3['subtotal']			= $subt;
					$data3['discount']			= 0;
					$data3['order_gst']			= $gst;
					$data3['grand_total']		= $subt+$gst;
					$data3['coupon_id']			= 0;
					$data3['coupon_discount']	= 0;
					$data3['invoice_date']		= time();
					$data3['payment_id']		= $pg;
					$data3['order_status']		= 'cod';
					
					$rid=$this->home_model->add_user_order($data3);
					
					if($rid)
					{
						$this->home_model->generate_order_id($rid);
					
						foreach(get_cart_data() as $row) 
					{ 
						if($row['item_type']=='product')
						{
							$aid=get_admin_id_from_pid($row['item_pid']);
						}
						else
						{	
						   $aid=get_admin_id_from_sid($row['item_pid']);
						}
						$stotal=number_format(($row['item_qty']*$row['item_price']),'2','.','');
						$sgst=number_format(((intval($row['item_gstrate'])/100)*$stotal),'2','.','');
						$gtotal=number_format(($stotal+$sgst),'2','.','');
						$data4[]=array('fk_order_id'=>$rid,'order_status'=>'processing','fk_pricing_id'=>$row['item_pid'],'quantity'=>$row['item_qty'],'unit_price'=>$row['item_price'],'gst_slab'=>$row['item_gstrate'],'order_type'=>$row['item_type'],'fk_admin_id'=>$aid,'subtotal'=>$stotal,'gst'=>$sgst,'grandtotal'=>$gtotal);
						
					} 
						
					$this->home_model->add_order_details($data4);
					$this->session->unset_userdata('cart_data');
					redirect('my-orders');
						
					}
				
				}		
		
				
			}
		
			
			
			
		}
		
		else
		{
			
	

		$this->form_validation->set_rules('user_firstname', 'First Name', 'required',
			array('required' =>  keyword_value('you_must_enter_first_name','First Name is required')
		));
		
		$this->form_validation->set_rules('user_lastname', 'Last Name', 'required',
			array('required' =>  keyword_value('you_must_enter_last_name','Last Name is required')
		));
		
			$this->form_validation->set_rules('user_phone', 'Mobile Number', 'required|is_unique[tbl_user.user_phone]|min_length[10]|max_length[12]',
			array('required' =>  keyword_value('you_must_enter_mobile','Mobile Number is required'),
			'is_unique'=>keyword_value('email_exits','Mobile Number already exits. ')
			
		));
		
			$this->form_validation->set_rules('user_email', 'Email', 'required|valid_email|is_unique[tbl_user.user_email]',
			array('required' =>  keyword_value('you_must_enter_email','You must enter Email.'),
				  'valid_email' => keyword_value('please_enter_valid_email','Please Enter a valid Email'),
				  'is_unique'=>keyword_value('email_exits','Email already exits. Please choose another one or try logging in'))
		);	
		
		
		$this->form_validation->set_rules('profile_address', 'Address', 'required',
			array('required' =>  keyword_value('you_must_enter_address','Please enter Address')
		));
		
		$this->form_validation->set_rules('profile_state', 'State', 'required',
			array('required' =>  keyword_value('you_must_enter_state','Please Select State')
		));
		$this->form_validation->set_rules('profile_city', 'City', 'required',
			array('required' =>  keyword_value('you_must_enter_city','Please Select City')
		));
		$this->form_validation->set_rules('profile_zip', 'PIN/ZIP Code', 'required',
			array('required' =>  keyword_value('you_must_enter_zip','Please enter PIN/ZIP code')
		));
		$this->form_validation->set_rules('pg', 'Payment Method', 'required',
			array('required' =>  keyword_value('you_must_select_pg','Please Select Payment ethod')
		));


		
	   if ($this->form_validation->run() == FALSE)
		{
			
		$this->data['payment_methods']	=	$this->home_model->get_payment_methods();
		$this->data['title']			=   DEFAULT_TITLE;
		$this->data['meta_keywords']	=   DEFAULT_KEYWORDS;
		$this->data['meta_description']	=   DEFAULT_DESCRIPTION;	
		$this->load->view('public/templates/header',$this->data);
		if($this->session->front_user_id)
		{
			$this->data['addresses']		=   $this->home_model->get_user_addresses();
			
		}
		$this->data['states']			=   $this->home_model->get_states();
		$this->data['cities']			=   $this->home_model->get_cities();
		$this->load->view('public/checkout',$this->data);
		$this->load->view('public/templates/footer',$this->data);
		}
		
		else
			
			{
				$pg=$this->input->post('pg');
				
				$data1['user_email']			=	$this->input->post('user_email');
				$data1['user_firstname']		=	$this->input->post('user_firstname');
				$data1['user_lastname']			=	$this->input->post('user_lastname');
				$data1['active']				=	1;
				$data1['user_phone']			=	$this->input->post('user_phone');
				$plain_pass						=   mt_rand(1000000,9999999);
				$password						= 	hash ( "sha256", $plain_pass);
				$data1['user_password']			=	$password;
				$return							=	$this->authentication_model->user_register($data1);
				
				if($return['status'])
				{
					
				$this->sendverifylink();
				$return2=$this->authentication_model->user_login($data1['user_email'],$data1['user_password']);


				$data2['profile_address']		=	$this->input->post('profile_address');
				$data2['profile_state']			=	$this->input->post('profile_state');
				$data2['profile_city']			=	$this->input->post('profile_city');
				$data2['profile_zip']			=	$this->input->post('profile_zip');
				$data2['fk_user_id']			=	$this->session->front_user_id;
				$data2['is_default']			=	1;
				
				$return2=$this->home_model->add_user_address($data2);
				
				if($return2)
				
				{	

				if($pg==1)  // COD
				{
					$subt=$gst=$tqty=0;
					
					foreach(get_cart_data() as $row) 
					{ 
						$subt=$subt+($row['item_price']*$row['item_qty']);
						$tqty=$tqty+$row['item_qty'];
						$gst=$gst+($row['item_gstvalue']*$row['item_qty']); 
					} 
					
					$data3['txn_id']			= mt_rand(100000000,999999999);
					$data3['fk_user_id']		= $this->session->front_user_id;
					$data3['ip_address']		= $this->input->ip_address();
					$data3['total_quantity']	= $tqty;
					$data3['subtotal']			= $subt;
					$data3['discount']			= 0;
					$data3['order_gst']			= $gst;
					$data3['grand_total']		= $subt+$gst;
					$data3['coupon_id']			= 0;
					$data3['coupon_discount']	= 0;
					$data3['invoice_date']		= time();
					$data3['payment_id']		= $pg;
					$data3['order_status']		= 'cod';
					
					$rid=$this->home_model->add_user_order($data3);
					
					if($rid)
					{
						$this->home_model->generate_order_id($rid);
						
						foreach(get_cart_data() as $row) 
					{ 
					if($row['item_type']=='product')
						{
							$aid=get_admin_id_from_pid($row['item_pid']);
						}
						else
						{	
						   $aid=get_admin_id_from_sid($row['item_pid']);
						}
						$stotal=number_format(($row['item_qty']*$row['item_price']),'2','.','');
						$sgst=number_format(((intval($row['item_gstrate'])/100)*$stotal),'2','.','');
						$gtotal=number_format(($stotal+$sgst),'2','.','');
						$data4[]=array('fk_order_id'=>$rid,'order_status'=>'processing','fk_pricing_id'=>$row['item_pid'],'quantity'=>$row['item_qty'],'unit_price'=>$row['item_price'],'gst_slab'=>$row['item_gstrate'],'order_type'=>$row['item_type'],'fk_admin_id'=>$aid,'subtotal'=>$stotal,'gst'=>$sgst,'grandtotal'=>$gtotal);
						
					} 
						
					$this->home_model->add_order_details($data4);
					$this->session->unset_userdata('cart_data');
					redirect('my-orders');
						
					}
				
				}		
				
				
				}
						
				}
				
				
				
			}
			
			
		}	
		
		}
		else {
		redirect('/');
		}
		
	}
	
	public function set_city()
	{
		$city=$this->input->post('city');
		if($city)
		{
			$this->home_model->set_city($city);
			echo 'true';
		}
		else
		{
			echo 'false';
		}
	}
	
	public function user_register()
	{
	 $this->load->library('form_validation');
     $this->load->helper('form');
	 $this->load->model('authentication_model');
	$return['status']=false;
	$this->form_validation->set_rules('reg_first_name', 'First Name', 'required',
			array('required' =>  keyword_value('you_must_enter_first_name','First Name is required')
		));
		
		$this->form_validation->set_rules('reg_last_name', 'Last Name', 'required',
			array('required' =>  keyword_value('you_must_enter_last_name','Last Name is required')
		));
		
			$this->form_validation->set_rules('reg_mobile', 'Last Name', 'required|is_unique[tbl_user.user_phone]|min_length[10]|max_length[12]',
			array('required' =>  keyword_value('you_must_enter_mobile','Mobile Number is required')
		));
		
			$this->form_validation->set_rules('reg_email', 'Email', 'required|valid_email|is_unique[tbl_user.user_email]',
			array('required' =>  keyword_value('you_must_enter_email','You must enter Email.'),
				  'valid_email' => keyword_value('please_enter_valid_email','Please Enter a valid Email'),
				  'is_unique'=>keyword_value('email_exits','Emil already exits. Please choose another one or try logging in'))
		);
		
		$this->form_validation->set_rules('reg_password', 'Password', 'required',
				array('required' =>  keyword_value('you_must_enter_password','Enter  Password'))
		);
		
		$this->form_validation->set_rules('reg_password_conf', 'Confirm Password', 'required|matches[reg_password]',
				array('required' =>  keyword_value('you_must_enter_cpassword','Enter Confirm Password'))
		
		);
		
		
		  if ($this->form_validation->run() == FALSE)
		{
			$return['message']=validation_errors();
		}
		
		else
		{
			$data['user_email']			=	$this->input->post('reg_email');
			$data['user_firstname']		=	$this->input->post('reg_first_name');
			$data['user_lastname']		=	$this->input->post('reg_last_name');
			$data['active']				=	1;
			if($this->input->post('reg_mobile'))
			{
				$data['user_phone']=$this->input->post('reg_mobile');
				
			}
			$password					= 	hash ( "sha256", $this->input->post('reg_password'));
			$data['user_password']		=	$password;
			$return						=	$this->authentication_model->user_register($data);
			if($return['status']==true)
			{
				$this->sendverifylink();
				$return2=$this->authentication_model->user_login($data['user_email'],$data['user_password']);
				if($return2['status']==false)
				{
					$return['message']=$return['msg'];
				}
				else
				{
					$return['message']='Registeration success. Logging you in....... ';
					$return['status']=true;
				}
			}
		
				
				
		}
		
		
		echo json_encode($return);
	
		
	}
	
	
		
	public function user_login()
	{
	 $this->load->library('form_validation');
     $this->load->helper('form');
	 $this->load->model('authentication_model');
	$return['status']=false;

		
			$this->form_validation->set_rules('login_email', 'Email', 'required|valid_email',
			array('required' =>  keyword_value('you_must_enter_email','You must enter Email.'),
				  'valid_email' => keyword_value('please_enter_valid_email','Please Enter a valid Email'))
		);
		
		$this->form_validation->set_rules('login_password', 'Password', 'required',
				array('required' =>  keyword_value('you_must_enter_password','Enter  Password'))
		);
	
		
		  if ($this->form_validation->run() == FALSE)
		{
			$return['message']=validation_errors();
		}
		
		else
		{
			$data['user_email']			=	$this->input->post('login_email');
			$password					= 	hash ( "sha256", $this->input->post('login_password'));
			$data['user_password']		=	$password;
		
				$return2=$this->authentication_model->user_login($data['user_email'],$data['user_password']);
				if($return2['status']==false)
				{
					$return['message']=$return2['msg'];
				}
				else
				{
					$return['message']='Success! Logging you in....... ';
					$return['status']=true;
				}
			
				
				
		}
		
		
		echo json_encode($return);
	
		
	}
	
	
	public function my_account()
	
	{
		$msg="";
		if($this->session->front_user_id)
		{
		
		$this->load->library('form_validation');
		$this->load->helper('form');
	
		$this->form_validation->set_rules('user_firstname', 'First Name', 'required');
		$this->form_validation->set_rules('user_lastname', 'Last Name', 'required');
		$this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('user_phone', 'Phone', 'required|min_length[10]|max_length[12]');	

		  if ($this->form_validation->run() == FALSE)
		{
		$this->data['title']			=   DEFAULT_TITLE;
		$this->data['meta_keywords']	=   DEFAULT_KEYWORDS;
		$this->data['meta_description']	=   DEFAULT_DESCRIPTION;
		$this->data['profile']			=   $this->home_model->get_user_profile();
		$this->load->view('public/templates/header',$this->data);
		$this->load->view('public/my_account',$this->data);
		$this->load->view('public/templates/footer',$this->data);
			
		}
		else
			
		{
			
			$image=$error=null;	
		
			if($_FILES['user_image']["name"])
			{
			  $config['upload_path']   = './uploads/users/'; 
			  $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
			  $config['max_size']      = 1024;
			  $this->load->library('upload', $config);
				   if ( ! $this->upload->do_upload('user_image')) {
			 $error = implode('<br>',$this->upload->display_errors()); 
		
		  }
		  
		  else { 
					$uploadedImage = $this->upload->data();
					$image=$uploadedImage['file_name'];
				} 
			}
			
			if($image)
			{
				$data['user_image']=$image;
			}
			
			$data['user_firstname']=$this->input->post('user_firstname');
			$data['user_lastname']=$this->input->post('user_lastname');
			$data['user_email']=$this->input->post('user_email');
			$data['user_phone']=$this->input->post('user_phone');
			
			if(!$this->home_model->profile_check_phone($data))
			{				
					$msg='Phone number is associated with another account';
				
			}
			
			if(!$this->home_model->profile_check_email($data))
			{
	
				$msg='Email is associated with another account';
				
			}
			
			$flag=$this->home_model->update_profile($data);
	
		if($flag)
		{
			$msg='Profile Sucessfully updated';

		}
		else
		{
			$msg='Error Occured try again';
		
			
		}
		
		$this->data['title']			=   DEFAULT_TITLE;
		$this->data['meta_keywords']	=   DEFAULT_KEYWORDS;
		$this->data['meta_description']	=   DEFAULT_DESCRIPTION;
		$this->data['profile']			=   $this->home_model->get_user_profile();
		$this->data['msg']			    =  $msg?$msg:'';
		$this->load->view('public/templates/header',$this->data);
		$this->load->view('public/my_account',$this->data);
		$this->load->view('public/templates/footer',$this->data);
		
		}
		
		
		}
		else
		{	$this->session->set_flashdata('lflag','login');
			redirect('/');
			
		}

		
	}
	
		public function my_addresses()
	
	{
		$this->load->library('form_validation');
		$this->load->helper('form');
		if($this->session->front_user_id)
		{
		$this->data['title']			=   DEFAULT_TITLE;
		$this->data['meta_keywords']	=   DEFAULT_KEYWORDS;
		$this->data['meta_description']	=   DEFAULT_DESCRIPTION;
		$this->data['addresses']		=   $this->home_model->get_user_addresses();
		$this->data['states']			=   $this->home_model->get_states();
		$this->data['cities']			=   $this->home_model->get_cities();
		$this->load->view('public/templates/header',$this->data);
		$this->load->view('public/my_addresses',$this->data);
		$this->load->view('public/templates/footer',$this->data);
		}
		else
		{
			$this->session->set_flashdata('lflag','login');
			redirect('/');
			
		}

		
	}
	
			public function my_orders()
	
	{
		
		if($this->session->front_user_id)
		{
		$this->data['title']			=   DEFAULT_TITLE;
		$this->data['meta_keywords']	=   DEFAULT_KEYWORDS;
		$this->data['meta_description']	=   DEFAULT_DESCRIPTION;
		$this->data['orders']			=   $this->home_model->get_user_orders();
		$this->load->view('public/templates/header',$this->data);
		$this->load->view('public/my_orders',$this->data);
		$this->load->view('public/templates/footer',$this->data);
		}
		else
		{
			$this->session->set_flashdata('lflag','login');
			redirect('/');
			
		}

		
	}
	
	public function add_address()
	
	{
		$this->load->library('form_validation');
		$this->load->helper('form');
		if($this->session->front_user_id)
		{
			$data['profile_address']=$this->input->post('add_profile_address');
			$data['profile_state']=$this->input->post('add_profile_state');
			$data['profile_city']=$this->input->post('add_profile_city');
			$data['profile_zip']=$this->input->post('add_profile_zip');
			$data['is_default']=$this->input->post('add_is_default')?1:0;
			$data['fk_user_id']=$this->session->front_user_id;
			
			
			$this->home_model->add_address($data);
			$ref_url=$this->input->post('ref_url')?$this->input->post('ref_url'):null;
			if($ref_url)
			{
				redirect($ref_url);
			}
			else
			{
				redirect('/my-addresses');
			}
		}
		else
		{	$this->session->set_flashdata('lflag','login');
			redirect('/');
			
		}

		
	}
	
		public function edit_address()
	
	{
		$this->load->library('form_validation');
		$this->load->helper('form');
		if($this->session->front_user_id)
		{
			$data['profile_address']=$this->input->post('edit_profile_address');
			$data['profile_state']=$this->input->post('edit_profile_state');
			$data['profile_city']=$this->input->post('edit_profile_city');
			$data['profile_zip']=$this->input->post('edit_profile_zip');
			$data['is_default']=$this->input->post('edit_is_default')?1:0;
			$id=$this->input->post('edit_id');
			
			$this->home_model->edit_address($id,$data);
						$ref_url=$this->input->post('ref_url')?$this->input->post('ref_url'):null;
			if($ref_url)
			{
				redirect($ref_url);
			}
			else
			{
				redirect('/my-addresses');
			}
		}
		else
		{	$this->session->set_flashdata('lflag','login');
			redirect('/');
			
		}

		
	}
	
	
	
			public function logout()
	
	{
		
		if($this->session->front_user_id)
		{
			  $sses=array('front_user_id','front_username','front_user_data');
			  $this->session->unset_userdata($sses);
		}
		redirect('/');	

		
	}
	
				public function sendverifylink()
	{
		 if(@$this->session->front_user_data->user_email)
		{
			$this->load->helper('string');
			$random=random_string('alnum',30);
			$vlink=base_url('verify_email/verify_user/'.$random);
			$this->authentication_model->update_email_otp_user($this->session->front_user_id,$random);
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
