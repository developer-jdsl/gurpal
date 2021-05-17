<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		 is_authenticated();
		 $this->load->model('admin/admin_model');
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 
		
 	}

	public function index()
	{
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/templates/footer');
	}
	
	
	public function logout()
	{
		$sses=array('pk_admin_id','user_type','user_data');
		$this->session->unset_userdata($sses);
		redirect('authentication/admin');
		
	}
	

	/* 
   #######################################
   ADMIN STATE MODULE 
   #######################################
   */
	
	
	public function states()
	{
		is_superadmin();
		$this->data['results']=$this->admin_model->get_states();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/states/states',$this->data);
		$this->load->view('admin/templates/footer');
	}
	
	public function add_state()
	{
		is_superadmin();
		$this->form_validation->set_rules('state_name', 'State Name', 'required',
			array('required' =>  keyword_value('you_must_enter_state_name','You must enter State Name.'))
		);
		
		
		  if ($this->form_validation->run() == FALSE)
		{
			
			$this->load->view('admin/templates/header');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('admin/templates/topbar');
			$this->load->view('admin/states/add_state');
			$this->load->view('admin/templates/footer');
	
		}
		else
		{
			$data['state_name']=$this->input->post('state_name');
			$data['meta_title']=$this->input->post('meta_title');
			$data['meta_keywords']=$this->input->post('meta_keywords');
			$data['meta_description']=$this->input->post('meta_description');
			$data['active']=$this->input->post('active');
			$data['fk_country_id']=0;
		
			
			$return=$this->admin_model->add_state($data);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_added','Item Added Successfully'));
				redirect('admin/states');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/states/add_state');
			}
		}
				
	
	}
	
	public function edit_state()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_state_id($id);
	
			if($result['pk_state_id'])
				
				{
		
		
					$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/states/edit_state',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/states');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/states');
		}
	}
	
	
	public  function update_state()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			
		$this->form_validation->set_rules('state_name', 'State Name', 'required',
			array('required' =>  keyword_value('you_must_enter_state_name','You must enter State Name.'))
		);
		
		
		 if ($this->form_validation->run() == FALSE)
		{
			
		$this->data['results']=$result;
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/states/edit_state',$this->data);
		$this->load->view('admin/templates/footer');
		
		}
		else
		{
			
			$data['state_name']=$this->input->post('state_name');
			$data['meta_title']=$this->input->post('meta_title');
			$data['meta_keywords']=$this->input->post('meta_keywords');
			$data['meta_description']=$this->input->post('meta_description');
			$data['active']=$this->input->post('active');
			$data['fk_country_id']=0;
			$data['pk_state_id']=$id;
		
			
			$return=$this->admin_model->edit_state($data);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_updated','Item Updated Successfully'));
				redirect('admin/states');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/states/edit_state');
			}
			
			
		}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/states');
		}
		
		
		
	}
	
	public function delete_state()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_state_id($id);
	
			if($result['pk_state_id'])
				
				{
		
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/states/delete_state',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/states');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/states');
		}
		
		
	}
	
	public function remove_state()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			
			$return=$this->admin_model->remove_state($id);
			
			
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_deleted','Item Deleted Successfully'));
				redirect('admin/states');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/states/edit_state');
			}
		}
		
		else
		{
			$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/states');
		}
		
	}
	
   /* 
   #######################################
   ADMIN CITY MODULE 
   #######################################
   */
	
	
	public function cities()
	{
		is_superadmin();
		$this->data['results']=$this->admin_model->get_cities();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/cities/cities',$this->data);
		$this->load->view('admin/templates/footer');
	}
	
	public function add_city()
	{
		is_superadmin();
		$this->form_validation->set_rules('state_name', 'State Name', 'required',
			array('required' =>  keyword_value('you_must_select_state_name','You must select State Name.'))
		);
		$this->form_validation->set_rules('city_name', 'City Name', 'required',
			array('required' =>  keyword_value('you_must_enter_city_name','You must enter City Name.'))
		);
		
		
		  if ($this->form_validation->run() == FALSE)
		{
			
			$this->data['states']=$this->admin_model->get_states();
			$this->load->view('admin/templates/header');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('admin/templates/topbar');
			$this->load->view('admin/cities/add_city',$this->data);
			$this->load->view('admin/templates/footer');
	
		}
		else
		{
			
							$image=$error=null;
			if($_FILES['city_img']["name"])
			{
			  $config['upload_path']   = './uploads/cities/'; 
			  $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
			  $config['max_size']      = 1024;
			  $this->load->library('upload', $config);
				   if ( ! $this->upload->do_upload('city_img')) {
			 $error = implode('<br>',$this->upload->display_errors()); 
		
		  }else { 


			$uploadedImage = $this->upload->data();
			$image=$uploadedImage['file_name'];
      } 
			}
	  
			if($image)
			{
				$data['city_image']=$image;
			}
			$data['fk_state_id']=$this->input->post('state_name');
			$data['city_name']=$this->input->post('city_name');
			$data['active']=$this->input->post('active');
			$data['meta_title']=$this->input->post('meta_title');
			$data['meta_keywords']=$this->input->post('meta_keywords');
			$data['meta_description']=$this->input->post('meta_description');

		
			
			$return=$this->admin_model->add_city($data);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_added','Item Added Successfully'));
				redirect('admin/cities');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/cities/add_city');
			}
		}
				
	
	}
	
	public function edit_city()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_city_id($id);
	
			if($result['pk_city_id'])
				
				{
		
				$this->data['states']=$this->admin_model->get_states();
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/cities/edit_city',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/cities');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/cities');
		}
	}
	
	
	public  function update_city()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			
		$this->form_validation->set_rules('state_name', 'State Name', 'required',
			array('required' =>  keyword_value('you_must_select_state_name','You must select State Name.'))
		);
		$this->form_validation->set_rules('city_name', 'City Name', 'required',
			array('required' =>  keyword_value('you_must_enter_city_name','You must enter City Name.'))
		);
		
		
		 if ($this->form_validation->run() == FALSE)
		{
			
		$this->data['results']=$result;
		$this->data['states']=$this->admin_model->get_states();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/cities/edit_city',$this->data);
		$this->load->view('admin/templates/footer');
		
		}
		else
		{
				$image=$error=null;
			if($_FILES['city_img']["name"])
			{
			  $config['upload_path']   = './uploads/cities/'; 
			  $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
			  $config['max_size']      = 1024;
			  $this->load->library('upload', $config);
				   if ( ! $this->upload->do_upload('city_img')) {
			 $error = implode('<br>',$this->upload->display_errors()); 
		
		  }else { 


			$uploadedImage = $this->upload->data();
			$image=$uploadedImage['file_name'];
      }
			}	  
	  
			if($image)
			{
				$data['city_image']=$image;
			}
			else{
				$data['city_image']=null;
			}
			$data['fk_state_id']=$this->input->post('state_name');
			$data['city_name']=$this->input->post('city_name');
			$data['city_slug']=$this->input->post('city_slug');
			$data['active']=$this->input->post('active');
			$data['pk_city_id']=$id;
			$data['meta_title']=$this->input->post('meta_title');
			$data['meta_keywords']=$this->input->post('meta_keywords');
			$data['meta_description']=$this->input->post('meta_description');
			
		
			
			$return=$this->admin_model->edit_city($data);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_updated','Item Updated Successfully'));
				redirect('admin/cities');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/cities/edit_city');
			}
			
			
		}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/cities');
		}
		
		
		
	}
	
	public function delete_city()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_city_id($id);
	
			if($result['pk_city_id'])
				
				{
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/cities/delete_city',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/cities');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/cities');
		}
		
		
	}
	
	public function remove_city()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			
			$return=$this->admin_model->remove_city($id);
			
			
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_deleted','Item Deleted Successfully'));
				redirect('admin/cities');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/cities/edit_city');
			}
		}
		
		else
		{
			$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/cities');
		}
		
	}
	
	/* 
   #######################################
   ADMIN BRAND MODULE 
   #######################################
   */
	
	public function brands()
	{
		is_superadmin();
		$this->data['results']=$this->admin_model->get_brands();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/brands/brands',$this->data);
		$this->load->view('admin/templates/footer');
	}
	
	public function add_brand()
	{

		is_superadmin();
		$this->form_validation->set_rules('brand_name', 'Brand Name', 'required',
			array('required' =>  keyword_value('you_must_enter_brand_name','You must Enter Brand Name.'))
		);
		
		
		
		  if ($this->form_validation->run() == FALSE)
		{
			
	
			$this->load->view('admin/templates/header');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('admin/templates/topbar');
			$this->load->view('admin/brands/add_brand');
			$this->load->view('admin/templates/footer');
	
		}
		else
		{
			$image=$error=null;
			if($_FILES['brand_name']["name"])
			{
			  $config['upload_path']   = './uploads/brands/'; 
			  $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
			  $config['max_size']      = 1024;
			  $this->load->library('upload', $config);
				   if ( ! $this->upload->do_upload('brand_name')) {
			 $error = implode('<br>',$this->upload->display_errors()); 
		
		  }else { 


			$uploadedImage = $this->upload->data();
			$image=$uploadedImage['file_name'];
      } 
			}
			
			$data['brand_name']=$this->input->post('brand_name');
			
			if($image)
			{
				$data['brand_image']=$image;
			}
			$data['active']=$this->input->post('active');
			$data['created_by']=$this->session->pk_admin_id;
			
			$return=$this->admin_model->add_brand($data);
		
			if($return['status']==true && !$error)
			{
				$this->session->set_flashdata('msg', keyword_value('item_added','Item Added Successfully'));
				redirect('admin/brands');
			}
			else if($return['status']==true && $error)
			{
				$this->session->set_flashdata('msg', $error);
				redirect('admin/brands');
				
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/brands/add_brand');
			}
		}
				
	
	}
	
	public function edit_brand()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			
			
			$result=$this->admin_model->check_brand_id($id);
	
			if($result['pk_brand_id'])
				
				{
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/brands/edit_brand',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/brands');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/brands');
		}
	}
	
	
	public  function update_brand()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			$this->load->library('upload');
			
		$this->form_validation->set_rules('brand_name', 'Brand Name', 'required',
			array('required' =>  keyword_value('you_must_enter_brand_name','You must Enter Brand Name.'))
		);
		
		 if ($this->form_validation->run() == FALSE)
		{
	
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/brands/edit_brand',$this->data);
		$this->load->view('admin/templates/footer');
		
		}
		else
		{
			
			$image=$error=null;
			if($_FILES['brand_name']["name"])
			{
			  $config['upload_path']   = './uploads/brands/'; 
			  $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
			  $config['max_size']      = 1024;
			  $this->load->library('upload', $config);
				   if ( ! $this->upload->do_upload('brand_name')) {
			 $error = implode('<br>',$this->upload->display_errors()); 
		
		  }else { 


			$uploadedImage = $this->upload->data();
			$image=$uploadedImage['file_name'];
      } 
			}
			

			$data['brand_name']=$this->input->post('brand_name');
			if($image)
			{
				$data['brand_image']=$image;
			}
			$data['active']=$this->input->post('active');
			$data['pk_brand_id']=$id;
			
		
			
			$return=$this->admin_model->edit_brand($data);
		
			if($return['status']==true && !$error)
			{
				$this->session->set_flashdata('msg', keyword_value('item_updated','Item Updated Successfully'));
				redirect('admin/brands');
			}
			else if($return['status']==true && $error)
			{
				$this->session->set_flashdata('msg', $error);
				redirect('admin/brands');
				
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/brands/edit_brand');
			}
			
			
		}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/brands');
		}
		
		
		
	}
	
	public function delete_brand()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_brand_id($id);
	
			if($result['pk_brand_id'])
				
				{
		
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/brands/delete_brand',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/brands');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/brands');
		}
		
		
	}
	
	public function remove_brand()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			
			$return=$this->admin_model->remove_brand($id);
			
			
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_deleted','Item Deleted Successfully'));
				redirect('admin/brands');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/brands/edit_brand');
			}
		}
		
		else
		{
			$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/brands');
		}
		
	}
	
	
		
	/* 
   #######################################
   ADMIN GST MODULE 
   #######################################
   */
	
	
	
		public function gst()
	{
		
		$this->data['results']=$this->admin_model->get_gst();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/gst/gst',$this->data);
		$this->load->view('admin/templates/footer');
	}

	public function add_gst()
	{
		
		$this->form_validation->set_rules('gst_slab', 'Gst Name', 'required',
			array('required' =>  keyword_value('you_must_enter_gst_slab','You must enter Gst Name.'))
		);
		
		
		  if ($this->form_validation->run() == FALSE)
		{
			
			$this->load->view('admin/templates/header');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('admin/templates/topbar');
			$this->load->view('admin/gst/add_gst');
			$this->load->view('admin/templates/footer');
	
		}
		else
		{
			$data['gst_slab']=$this->input->post('gst_slab');
			$data['gst_value']=$this->input->post('gst_value');
			$data['active']=$this->input->post('active');
			
		
			
			$return=$this->admin_model->add_gst($data);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_added','Item Added Successfully'));
				redirect('admin/gst');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/gst/add_gst');
			}
		}
				
	
	}
	
	public function edit_gst()
	{
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_gst_id($id);
	
			if($result['pk_gst_id'])
				
				{
		
		
					$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/gst/edit_gst',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/gst');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/gst');
		}
	}
	
	
	public  function update_gst()
	{
		
		$id=$this->input->post('id');
		if($id)
		{
			
		$this->form_validation->set_rules('gst_slab', 'Gst Name', 'required',
			array('required' =>  keyword_value('you_must_enter_gst_slab','You must enter Gst Name.'))
		);
		
		
		 if ($this->form_validation->run() == FALSE)
		{
			
		$this->data['results']=$result;
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/gst/edit_gst',$this->data);
		$this->load->view('admin/templates/footer');
		
		}
		else
		{
			
			$data['gst_slab']=$this->input->post('gst_slab');
			$data['gst_value']=$this->input->post('gst_value');
			$data['active']=$this->input->post('active');
			$data['pk_gst_id']=$id;
		
			
			$return=$this->admin_model->edit_gst($data);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_updated','Item Updated Successfully'));
				redirect('admin/gst');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/gst/edit_gst');
			}
			
			
		}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/gst');
		}
		
		
		
	}
	
	public function delete_gst()
	{
		
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_gst_id($id);
	
			if($result['pk_gst_id'])
				
				{
		
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/gst/delete_gst',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/gst');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/gst');
		}
		
		
	}
	
	public function remove_gst()
	{
		$id=$this->input->post('id');
		if($id)
		{
			
			$return=$this->admin_model->remove_gst($id);
			
			
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_deleted','Item Deleted Successfully'));
				redirect('admin/gst');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/gst/edit_gst');
			}
		}
		
		else
		{
			$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/gst');
		}
		
	}
	
		/* 
   #######################################
   ADMIN COLOR MODULE 
   #######################################
   */
   
	
	
	public function color()
	{
		
		$this->data['results']=$this->admin_model->get_color();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/color/color',$this->data);
		$this->load->view('admin/templates/footer');
	}
	
	public function add_color()
	{
		
		$this->form_validation->set_rules('color_name', 'Color Name', 'required',
			array('required' =>  keyword_value('you_must_enter_color_name','You must enter Color Name.'))
		);
		
		
		  if ($this->form_validation->run() == FALSE)
		{
			
			$this->load->view('admin/templates/header');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('admin/templates/topbar');
			$this->load->view('admin/color/add_color');
			$this->load->view('admin/templates/footer');
	
		}
		else
		{
			$data['color_name']=$this->input->post('color_name');
			$data['color_value']=$this->input->post('color_value');
			$data['active']=$this->input->post('active');
		
			
			$return=$this->admin_model->add_color($data);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_added','Item Added Successfully'));
				redirect('admin/color');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/color/add_color');
			}
		}
				
	
	}
	
	public function edit_color()
	{
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_color_id($id);
	
			if($result['pk_color_id'])
				
				{
		
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/color/edit_color',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/color');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/color');
		}
	}
	
	
	public  function update_color()
	{
		
		$id=$this->input->post('id');
		if($id)
		{
			
		$this->form_validation->set_rules('color_name', 'Color Name', 'required',
			array('required' =>  keyword_value('you_must_enter_color_name','You must enter Color Name.'))
		);
		
		
		 if ($this->form_validation->run() == FALSE)
		{
			
		$this->data['results']=$result;
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/color/edit_color',$this->data);
		$this->load->view('admin/templates/footer');
		
		}
		else
		{
			
			$data['color_name']=$this->input->post('color_name');
			$data['color_value']=$this->input->post('color_value');
			$data['active']=$this->input->post('active');
			$data['pk_color_id']=$id;
		
			
			$return=$this->admin_model->edit_color($data);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_updated','Item Updated Successfully'));
				redirect('admin/color');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/color/edit_color');
			}
			
			
		}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/color');
		}
		
		
		
	}
	
	public function delete_color()
	{
		
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_color_id($id);
	
			if($result['pk_color_id'])
				
				{
		
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/color/delete_color',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/color');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/color');
		}
		
		
	}
	
	public function remove_color()
	{
		$id=$this->input->post('id');
		if($id)
		{
			
			$return=$this->admin_model->remove_color($id);
			
			
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_deleted','Item Deleted Successfully'));
				redirect('admin/color');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/color/edit_color');
			}
		}
		
		else
		{
			$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/color');
		}
		
	}
	
		/* 
   #######################################
   ADMIN SIZE MODULE 
   #######################################
   */
	
	public function size()
	{
		
		$this->data['results']=$this->admin_model->get_size();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/size/size',$this->data);
		$this->load->view('admin/templates/footer');
	}
	
	public function add_size()
	{
		
		$this->form_validation->set_rules('size_name', 'Size Name', 'required',
			array('required' =>  keyword_value('you_must_enter_size_name','You must enter Size Name.'))
		);
		
		
		  if ($this->form_validation->run() == FALSE)
		{
			
			$this->load->view('admin/templates/header');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('admin/templates/topbar');
			$this->load->view('admin/size/add_size');
			$this->load->view('admin/templates/footer');
	
		}
		else
		{
			$data['size_name']=$this->input->post('size_name');
			$data['size_value']=$this->input->post('size_value');
			$data['active']=$this->input->post('active');
			
		
			
			$return=$this->admin_model->add_size($data);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_added','Item Added Successfully'));
				redirect('admin/size');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/size/add_size');
			}
		}
				
	
	}
	
	public function edit_size()
	{
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_size_id($id);
	
			if($result['pk_size_id'])
				
				{
		
		
					$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/size/edit_size',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/size');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/size');
		}
	}
	
	
	public  function update_size()
	{
		
		$id=$this->input->post('id');
		if($id)
		{
			
		$this->form_validation->set_rules('size_name', 'Size Name', 'required',
			array('required' =>  keyword_value('you_must_enter_size_name','You must enter Size Name.'))
		);
		
		
		 if ($this->form_validation->run() == FALSE)
		{
			
		$this->data['results']=$result;
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/size/edit_size',$this->data);
		$this->load->view('admin/templates/footer');
		
		}
		else
		{
			
			$data['size_name']=$this->input->post('size_name');
			$data['size_value']=$this->input->post('size_value');
			$data['active']=$this->input->post('active');
			$data['pk_size_id']=$id;
		
			
			$return=$this->admin_model->edit_size($data);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_updated','Item Updated Successfully'));
				redirect('admin/size');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/size/edit_size');
			}
			
			
		}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/size');
		}
		
		
		
	}
	
	public function delete_size()
	{
		
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_size_id($id);
	
			if($result['pk_size_id'])
				
				{
		
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/size/delete_size',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/size');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/size');
		}
		
		
	}
	
	public function remove_size()
	{
		$id=$this->input->post('id');
		if($id)
		{
			
			$return=$this->admin_model->remove_size($id);
			
			
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_deleted','Item Deleted Successfully'));
				redirect('admin/size');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/size/edit_size');
			}
		}
		
		else
		{
			$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/size');
		}
		
	}
	
	
	/* 
   #######################################
   ADMIN PRODUCTS MODULE 
   #######################################
   */
   
   public function products()
	{

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/products/products');
		$this->load->view('admin/templates/footer');
	}
	
	public function product_list()
	{
	
      $list = $this->admin_model->get_products();
      $data = array();
      $no = $this->input->post('start');
      foreach ($list as $ro) {
      $no++;
      $row = array();
	  if($ro->product_image)
	  {
		$row[] = '<img src="'.base_url('uploads/product/'.$ro->product_image).'" width="100px">';
		
	  }
	  else
	  {
		 $row[] = 'No Image'; 
	  }
      $row[] = $ro->product_name;
	  $row[] = $ro->discount_price?$ro->discount_price:$ro->original_price;
	  $row[] = $ro->quantity;
      if($ro->active==1){$row[] = 'Active';} else{$row[] = 'Inactive';}
		
		 $row[] = form_open('admin/edit_product',array('class'=>'d-inline')).'
				   <input type="hidden" name="id" value="'.$ro->pk_product_id.'"> 
				   <button  class="btn btn-primary" type="submit">'.keyword_value('edit','Edit').'</button>
				   </form>'.form_open('admin/delete_product',array('class'=>'d-inline')).'
				   <input type="hidden" name="id" value="'.$ro->pk_product_id.'"> 
				   <button class="btn btn-primary" type="submit">'.keyword_value('delete','Delete').'</button>
				   </form>';
      $data[] = $row;
      }
      $output = array(
      "draw" => $this->input->post('draw'),
      "recordsTotal" => $this->admin_model->products_count_all(),
      "recordsFiltered" => $this->admin_model->products_count_filtered(),
      "data" => $data,
      );
      //output to json format
      echo json_encode($output);
      }
	  
	  
	  public function add_product()
	{
		
		if($this->session->user_type=='admin' && !can_add_products())
			
			{
				$this->session->set_flashdata('msg','You have reached your package limit. Upgrade to add more');
				redirect('admin/products');
				
			}
		
		$this->form_validation->set_rules('product_name', 'Product Name', 'required',
			array('required' =>  keyword_value('you_must_enter_product_name','You must Enter Product Name.'))
		);
		
		$this->form_validation->set_rules('product_sku', 'Product SKU', 'required',
			array('required' =>  keyword_value('you_must_enter_product_sku','You must Enter Product SKU.'))
		);
		
		$this->form_validation->set_rules('product_category', 'Product Category', 'required',
			array('required' =>  keyword_value('you_must_enter_product_category','You must Select Product Category.'))
		);
		
		$this->form_validation->set_rules('product_description', 'Product Description', 'required',
			array('required' =>  keyword_value('you_must_enter_product_description','You must Enter Product Description.'))
		);
		
		$this->form_validation->set_rules('fk_gst_id', 'GST Slab', 'required',
			array('required' =>  keyword_value('you_must_enter_fk_gst_id','You must Select GST Slab.'))
		);
		
		
		  if ($this->form_validation->run() == FALSE)
		{
			$this->data['brands']=$this->admin_model->get_brands();
			$this->data['cross']=$this->admin_model->get_cross_products();
			$this->data['gst']=$this->admin_model->get_gst();
			$this->data['categories']=$this->admin_model->get_product_cats();
			
			if($this->session->user_type=='superadmin')
			{
				$this->data['admins']=$this->admin_model->get_admins();
				
			}
			
			
			$this->load->view('admin/templates/header');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('admin/templates/topbar');
			$this->load->view('admin/products/add_product',$this->data);
			$this->load->view('admin/templates/footer');
	
		}
		else
		{
			
			$data['product_name']=$this->input->post('product_name');
			$data['product_sku']=$this->input->post('product_sku');
			$data['product_description']=$this->input->post('product_description');
			$data['product_brand']=$this->input->post('product_brand');
			$data['product_specifications']=$this->input->post('product_specifications');
			if($this->session->user_type=='admin')
			{
				$data['cross_sell']=$this->input->post('cross_sell');
				
			}
			$data['meta_title']			=	$this->input->post('meta_title');
			$data['meta_keyword']		=	$this->input->post('meta_keyword');
			$data['meta_description']	=	$this->input->post('meta_description');
			$data['is_cod']				=	$this->input->post('is_cod');
			$data['ordering']			=	$this->input->post('ordering');
			$data['fk_gst_id']			=	$this->input->post('fk_gst_id');
			$data['fk_admin_id']		=	$this->input->post('cid')?$this->input->post('cid'):$this->session->pk_admin_id;
			$data['product_category']	=	$this->input->post('product_category');
			$data['active']				=	$this->input->post('active');
			$data['created_by']			=	$this->session->pk_admin_id;
			
			$return=$this->admin_model->add_product($data);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('product_added','Product Added Successfully'));
			$id=$return['id'];
			$result=$this->admin_model->check_product_id($id);
			$this->data['brands']=$this->admin_model->get_brands();
			$this->data['cross']=$this->admin_model->get_cross_products();
			$this->data['gst']=$this->admin_model->get_gst(true);
			$this->data['categories']=$this->admin_model->get_product_cats();
			$this->data['colors']=$this->admin_model->get_color(true);
			$this->data['sizes']=$this->admin_model->get_size(true);
	
			if($result['pk_product_id'])
				
				{
			$this->data['brands']=$this->admin_model->get_brands();
			$this->data['cross']=$this->admin_model->get_cross_products();
			$this->data['gst']=$this->admin_model->get_gst(true);
			$this->data['categories']=$this->admin_model->get_product_cats();
			$this->data['gallery']=$this->admin_model->get_product_gallery($id);
			
			if($this->session->user_type=='superadmin')
			{
				$this->data['admins']=$this->admin_model->get_admins();
				
			}
		
				$this->data['results']=$result;
				$this->data['galleryf']=true;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/products/edit_product',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/products');
				}
				
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('product_not_added','Action was not Successfull, Please try again'));
				redirect('admin/products/add_product');
			}
		}
	}
	
	public function edit_product()
	{
		$id=$this->input->post('id');
		if($id)
		{
			
			$result=$this->admin_model->check_product_id($id);
			$this->data['brands']=$this->admin_model->get_brands();
			$this->data['cross']=$this->admin_model->get_cross_products();
			$this->data['gst']=$this->admin_model->get_gst(true);
			$this->data['categories']=$this->admin_model->get_product_cats();
			$this->data['colors']=$this->admin_model->get_color(true);
			$this->data['sizes']=$this->admin_model->get_size(true);
	
			if($result['pk_product_id'])
			{
		
			$this->data['brands']=$this->admin_model->get_brands();
			$this->data['cross']=$this->admin_model->get_cross_products();
			$this->data['gst']=$this->admin_model->get_gst(true);
			$this->data['categories']=$this->admin_model->get_product_cats();
			$this->data['gallery']=$this->admin_model->get_product_gallery($id);
			
			if($this->session->user_type=='superadmin')
			{
				$this->data['admins']=$this->admin_model->get_admins();
				
			}
		
				$this->data['results']=$result;
				$this->data['galleryf']=false;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/products/edit_product',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/products');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/products');
		}
	}
	
	
	
	public  function update_product()
	{
		
		$id=$this->input->post('id');
		if($id)
		{
			
			
		$this->form_validation->set_rules('product_name', 'Product Name', 'required',
			array('required' =>  keyword_value('you_must_enter_product_name','You must Enter Product Name.'))
		);
		
		$this->form_validation->set_rules('product_sku', 'Product SKU', 'required',
			array('required' =>  keyword_value('you_must_enter_product_sku','You must Enter Product SKU.'))
		);
		
		$this->form_validation->set_rules('product_category', 'Product Category', 'required',
			array('required' =>  keyword_value('you_must_enter_product_category','You must Select Product Category.'))
		);
		
		$this->form_validation->set_rules('product_description', 'Product Description', 'required',
			array('required' =>  keyword_value('you_must_enter_product_description','You must Enter Product Description.'))
		);
		
		$this->form_validation->set_rules('fk_gst_id', 'GST Slab', 'required',
			array('required' =>  keyword_value('you_must_enter_fk_gst_id','You must Select GST Slab.'))
		);

		
		 if ($this->form_validation->run() == FALSE)
		{
			
			$this->data['brands']=$this->admin_model->get_brands();
			$this->data['cross']=$this->admin_model->get_cross_products();
			$this->data['gst']=$this->admin_model->get_gst();
			$this->data['categories']=$this->admin_model->get_product_cats();
			$this->data['colors']=$this->admin_model->get_color();
			$this->data['sizes']=$this->admin_model->get_size();
			
			
			if($this->session->user_type=='superadmin')
			{
				$this->data['admins']=$this->admin_model->get_admins();
				
			}
			
	
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/products/edit_product',$this->data);
		$this->load->view('admin/templates/footer');
		
		}
		else
		{
		

			$data['product_name']=$this->input->post('product_name');
			$data['product_slug']=$this->input->post('product_slug');
			$data['product_sku']=$this->input->post('product_sku');
			$data['product_description']=$this->input->post('product_description');
			$data['product_brand']=$this->input->post('product_brand');
			$data['product_specifications']=$this->input->post('product_specifications');
			if($this->session->user_type=='admin')
			{
				$data['cross_sell']=$this->input->post('cross_sell');
				
			}
			$data['meta_title']			=	$this->input->post('meta_title');
			$data['meta_keyword']		=	$this->input->post('meta_keyword');
			$data['meta_description']	=	$this->input->post('meta_description');
			$data['is_cod']				=	$this->input->post('is_cod');
			$data['ordering']			=	$this->input->post('ordering');
			$data['fk_gst_id']			=	$this->input->post('fk_gst_id');
			$data['fk_admin_id']		=	$this->input->post('cid')?$this->input->post('cid'):$this->session->pk_admin_id;
			$data['product_category']	=	$this->input->post('product_category');
			$data['active']				=	$this->input->post('active');
			
			
			
			$sizes=$this->input->post('add_size');
			$colors=$this->input->post('add_color');
			$org_price=$this->input->post('add_original_price');
			$dis_price=$this->input->post('add_discount_price');
			$quantity=$this->input->post('add_quantity');
			$img_array=array();
			$insert_data = array();
			if(!empty($_FILES['add_product_image']['name']) && count(array_filter($_FILES['add_product_image']['name'])) > 0){ 
                $filesCount = count($_FILES['add_product_image']['name']); 
                for($i = 0; $i < $filesCount; $i++){ 
					if($_FILES['add_product_image']['name'][$i])
					{
                    $_FILES['file']['name']     = $_FILES['add_product_image']['name'][$i]; 
                    $_FILES['file']['type']     = $_FILES['add_product_image']['type'][$i]; 
                    $_FILES['file']['tmp_name'] = $_FILES['add_product_image']['tmp_name'][$i]; 
                    $_FILES['file']['error']     = $_FILES['add_product_image']['error'][$i]; 
                    $_FILES['file']['size']     = $_FILES['add_product_image']['size'][$i]; 
                     
                    // File upload configuration 
                    $uploadPath = 'uploads/product/'; 
                    $config['upload_path'] = $uploadPath; 
                    $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                    $config['max_size']    = '1000'; 
                    //$config['max_width'] = '1024'; 
                    //$config['max_height'] = '768'; 
                     
                    // Load and initialize upload library 
                    $this->load->library('upload', $config); 
                    $this->upload->initialize($config); 
                     
                    // Upload file to server 
                    if($this->upload->do_upload('file')){ 
                        // Uploaded file data 
                        $fileData = $this->upload->data(); 
                        $img_array[]=$fileData['file_name']; 
                    }
						else{
							$img_array[]='default.jpg'; 
						}
                }
						else{
						$img_array[]='default.jpg'; 
						}	
				
				}
				
				
			}
			else{
						$img_array[]='default.jpg'; 
						}
			if(count($org_price)>0)
			{
			foreach($org_price as $key=>$value)
			{
				if($value)
				{
				 $insert_data[]  = array(
				    'fk_product_id' => $id,
                    'fk_color_id' => $colors[$key],
					'product_image'=>$img_array[$key],
                    'fk_size_id' => $sizes[$key],
                    'original_price' => $value,
                    'discount_price' => $dis_price[$key],
					'quantity' => $quantity[$key]
                );
				
				}
				
			}
			}
			
			
			$return=$this->admin_model->edit_product($data,$id);
			
			if(!empty($insert_data))
			{
				$this->admin_model->pricing_product($insert_data,$id);
			}
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('Product_updated','Product Updated Successfully'));
				redirect('admin/products');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/products/edit_product');
			}
			
			
		}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/products');
		}
		
		
		
	}
	
	
	
	 
	
	public function delete_product()
	{
		
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_product_id($id);
	
			if($result['pk_product_id'])
				
				{
		
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/products/delete_product',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/products');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/products');
		}
		
		
	}
	
	public function remove_product()
	{
		$id=$this->input->post('id');
		if($id)
		{
			
			$return=$this->admin_model->remove_product($id);
			
			
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_deleted','Item Deleted Successfully'));
				redirect('admin/products');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/products');
			}
		}
		
		else
		{
			$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/products');
		}
		
	}
	
	
	public function update_product_ajax()
	{
		$id=$this->input->post('id');
		$table=$this->input->post('table');
		$column=$this->input->post('column');
		$value=$this->input->post('value');
		
		if(@$id && @$table && @$column)
		{
			
			$chk=$this->admin_model->update_product_ajax($id,$table,$column,$value);
			echo $chk;
		
			
		}
		
		echo false;
		
	}
	
		public function update_service_ajax()
	{
		$id=$this->input->post('id');
		$table=$this->input->post('table');
		$column=$this->input->post('column');
		$value=$this->input->post('value');
		
		if(@$id && @$table && @$column)
		{
			
			$chk=$this->admin_model->update_service_ajax($id,$table,$column,$value);
			echo $chk;
		
			
		}
		
		echo false;
		
	}
	
	 public function product_ajax_upload()  
      {  
		$id=$this->input->post('id');
		$table=$this->input->post('table');
		$column=$this->input->post('column');
		
		if(@$id && @$table && @$column)
			
			{
				

           if(isset($_FILES["file"]["name"]))  
           {  
                $config['upload_path'] = './uploads/product/';  
                $config['allowed_types'] = 'jpg|jpeg|png|gif';  
                $this->load->library('upload', $config);  
                if(!$this->upload->do_upload("file"))  
                {  
       
				echo json_encode(array('status'=>false,'msg'=>$this->upload->display_errors()));	
				return false;				
                }  
                else  
                {  
                     $data = $this->upload->data();
					 $this->admin_model->update_product_ajax($id,$table,$column,$data["file_name"]);
					  echo json_encode(array('status'=>true,'src'=>base_url().'uploads/product/'.$data["file_name"]));
					  return true;
                }  
           }  
		   
			}
	  echo json_encode(array('status'=>false,'msg'=>'Invalid Request'));
	
	  }
	  
	  public function product_ajax_default()
	  {
		  
		$id=$this->input->post('id');
		$table=$this->input->post('table');
		$column=$this->input->post('column');
		
		if(@$id && @$table)
			
			{
			
				$id=$this->admin_model->update_product_default($id,$table);
				if($id)
				{
					echo json_encode(array('status'=>true)); 
					return true;
				}
				
			}
				echo json_encode(array('status'=>false));  
		  
		  
	  }
	  
	  	  public function service_ajax_default()
	  {
		  
		$id=$this->input->post('id');
		$table=$this->input->post('table');
		$column=$this->input->post('column');
		
		if(@$id && @$table)
			
			{
			
				$id=$this->admin_model->update_service_default($id,$table);
				if($id)
				{
					echo json_encode(array('status'=>true)); 
					return true;
				}
				
			}
				echo json_encode(array('status'=>false));  
		  
		  
	  }
	  
	  	  public function remove_gallery_ajax()
	  {
		  
		$id=$this->input->post('id');
		
		if(@$id)
			
			{
			
				$id=$this->admin_model->remove_gallery_ajax($id);
				if($id)
				{
					echo json_encode(array('status'=>true)); 
					return true;
				}
				
			}
				echo json_encode(array('status'=>false));  
		  
		  
	  }
	  
	  
	    public function remove_pricing_ajax()
	  {
		  
		$id=$this->input->post('id');
		
		if(@$id)
			
			{
			
				$id=$this->admin_model->remove_pricing_ajax($id);
				if($id)
				{
					echo json_encode(array('status'=>true)); 
					return true;
				}
				
			}
				echo json_encode(array('status'=>false));  
		  
		  
	  }
	
	
	
	
	/* 
   #######################################
   ADMIN ADS MODULE 
   #######################################
   */
   
   
	
	public function ads()
	{
		is_superadmin();
		$this->data['results']=$this->admin_model->get_ads();
		$this->data['admins']=$this->admin_model->get_admins();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/ads/ads',$this->data);
		$this->load->view('admin/templates/footer');
	}

	public function add_ad()
	{

		is_superadmin();
		$this->load->helper('file');
		$this->form_validation->set_rules('advertisement_text', 'Advertisement Name', 'required',
			array('required' =>  keyword_value('you_must_enter_ad_name','You must Enter Ad Name.'))
		);
		
		$this->form_validation->set_rules('start_time', 'Start Time', 'required',
			array('required' =>  keyword_value('you_must_enter_start_time','You must Enter Ad Start Time.'))
		);
		
		$this->form_validation->set_rules('end_time', 'End Time', 'required',
			array('required' =>  keyword_value('you_must_enter_end_time','You must Enter Ad End Time.'))
		);
		
		
		$this->form_validation->set_rules('display_page', 'Display Page', 'required',
			array('required' =>  keyword_value('you_must_enter_display_page','You must select Display Page.'))
		);
		
		$this->form_validation->set_rules('display_section', 'Display Section', 'required',
			array('required' =>  keyword_value('you_must_enter_display_section','You must select Display Section.'))
		);
		
		$this->form_validation->set_rules('fk_admin_id', 'Admin User', 'required',
			array('required' =>  keyword_value('you_must_enter_fk_admin_id','You must select User.'))
		);
		
		
		
		
		if (empty($_FILES['advertisement_banner']['name']))
		{
			$this->form_validation->set_rules('advertisement_banner', 'Document', 'required',
			array('required' =>  keyword_value('you_must_select_ad_media','You must select Ad media.')));
		}
		
		
		  if ($this->form_validation->run() == FALSE)
		{
			
			$this->data['cities']=$this->admin_model->get_cities();
			$this->data['cats']=$this->admin_model->get_business_cats();
			$this->data['admins']=$this->admin_model->get_admins();
			
	
			$this->load->view('admin/templates/header');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('admin/templates/topbar');
			$this->load->view('admin/ads/add_ad',$this->data);
			$this->load->view('admin/templates/footer');
	
		}
		else
		{
			$file=$error=null;
			
			 $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
			 $mime = get_mime_by_extension($_FILES['advertisement_banner']["name"]);
			
			if($_FILES['advertisement_banner']["name"])
			{
				
			  $config['upload_path']   = './uploads/adverts/'; 
			  $config['allowed_types'] = 'gif|jpg|png|jpeg|mp4|3gp'; 
			  $config['max_size']      = 2048;
			  $this->load->library('upload', $config);
				   if ( ! $this->upload->do_upload('advertisement_banner')) {
			 $error = implode('<br>',$this->upload->display_errors()); 
		
		  }else { 


			$uploadedImage = $this->upload->data();
			$file=$uploadedImage['file_name'];
      } 
			}
			
			if($file)
			{
				$data['display_type']='video'; 
			$data['advertisement_video']=$file; 
			
			 if(in_array($mime,$allowed_mime_type_arr))
			 {
				$data['display_type']='image'; 
				$data['advertisement_banner']=$file; 				
			 }
			}
			
			
			
			$data['advertisement_text']=$this->input->post('advertisement_text');
			$data['start_time']=strtotime($this->input->post('start_time'));
			$data['end_time']=strtotime($this->input->post('end_time'));
			$data['display_page']=$this->input->post('display_page');
			$data['display_section']=$this->input->post('display_section');

			$data['display_locations']=$this->input->post('display_locations');
			$data['display_categories']=$this->input->post('display_categories');
			$data['fk_admin_id']=$this->input->post('fk_admin_id');
			$data['active']=$this->input->post('active');
			
			$return=$this->admin_model->add_ad($data);
		
			if($return['status']==true && !$error)
			{
				$this->session->set_flashdata('msg', keyword_value('item_added','Item Added Successfully'));
				redirect('admin/ads');
			}
			else if($return['status']==true && $error)
			{
				$this->session->set_flashdata('msg', $error);
				redirect('admin/ads');
				
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/add_ad');
			}
		}
				
	
	}
	
		public function edit_ad()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			
			
			$result=$this->admin_model->check_ad_id($id);
	
			if($result['pk_advertisement_id'])
				
				{
				$this->data['cities']=$this->admin_model->get_cities();
				$this->data['cats']=$this->admin_model->get_business_cats();
				$this->data['admins']=$this->admin_model->get_admins();
				$this->data['result']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/ads/edit_ad',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/ads');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/ads');
		}
	}
	
		public function update_ad()
	{
		$this->load->helper('file');
		is_superadmin();
		$id=$this->input->post('id');
		
		$result=$this->admin_model->check_ad_id($id);
		$this->form_validation->set_rules('advertisement_text', 'Advertisement Name', 'required',
			array('required' =>  keyword_value('you_must_enter_ad_name','You must Enter Ad Name.'))
		);
		
		$this->form_validation->set_rules('start_time', 'Start Time', 'required',
			array('required' =>  keyword_value('you_must_enter_start_time','You must Enter Ad Start Time.'))
		);
		
		$this->form_validation->set_rules('end_time', 'End Time', 'required',
			array('required' =>  keyword_value('you_must_enter_end_time','You must Enter Ad End Time.'))
		);
		
		
		$this->form_validation->set_rules('display_page', 'Display Page', 'required',
			array('required' =>  keyword_value('you_must_enter_display_page','You must select Display Page.'))
		);
		
		$this->form_validation->set_rules('display_section', 'Display Section', 'required',
			array('required' =>  keyword_value('you_must_enter_display_section','You must select Display Section.'))
		);
		
		$this->form_validation->set_rules('fk_admin_id', 'Admin User', 'required',
			array('required' =>  keyword_value('you_must_enter_fk_admin_id','You must select User.'))
		);
		
		
		

		
		
		  if ($this->form_validation->run() == FALSE)
		{
			
			$this->data['cities']=$this->admin_model->get_cities();
			$this->data['cats']=$this->admin_model->get_business_cats();
			$this->data['admins']=$this->admin_model->get_admins();
			$this->data['result']=$result;
	
			$this->load->view('admin/templates/header');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('admin/templates/topbar');
			$this->load->view('admin/ads/edit_ad',$this->data);
			$this->load->view('admin/templates/footer');
	
		}
		else
		{
			$file=$error=null;
			
			 $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
			 $mime = get_mime_by_extension($_FILES['advertisement_banner']["name"]);
			
			if($_FILES['advertisement_banner']["name"])
			{
				
			  $config['upload_path']   = './uploads/adverts/'; 
			  $config['allowed_types'] = 'gif|jpg|png|jpeg|mp4|3gp'; 
			  $config['max_size']      = 2048;
			  $this->load->library('upload', $config);
				   if ( ! $this->upload->do_upload('advertisement_banner')) {
			 $error = implode('<br>',$this->upload->display_errors()); 
		
		  }else { 


			$uploadedImage = $this->upload->data();
			$file=$uploadedImage['file_name'];
      } 
			}
			
			if($file)
			{
				$data['display_type']='video'; 
			$data['advertisement_video']=$file; 
			
			 if(in_array($mime,$allowed_mime_type_arr))
			 {
				$data['display_type']='image'; 
				$data['advertisement_banner']=$file; 				
			 }
			}
			
			
			
			$data['advertisement_text']=$this->input->post('advertisement_text');
			$data['start_time']=strtotime($this->input->post('start_time'));
			$data['end_time']=strtotime($this->input->post('end_time'));
			$data['display_page']=$this->input->post('display_page');
			$data['display_section']=$this->input->post('display_section');

			$data['display_locations']=implode(',',$this->input->post('display_locations'));
			$data['display_categories']=implode(',',$this->input->post('display_categories'));
			$data['fk_admin_id']=$this->input->post('fk_admin_id');
			$data['active']=$this->input->post('active');
	
			$return=$this->admin_model->update_ad($id,$data);
		
			if($return['status']==true && !$error)
			{
				$this->session->set_flashdata('msg', keyword_value('item_updated','Item Updated Successfully'));
				redirect('admin/ads');
			}
			else if($return['status']==true && $error)
			{
				$this->session->set_flashdata('msg', $error);
				redirect('admin/ads');
				
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/ads');
			}
		}
		
		
	
	}
	public function delete_ad()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_ad_id($id);
	
			if($result['pk_advertisement_id'])
				
				{
		
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/ads/delete_ad',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/ads');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/ads');
		}
		
		
	}
	
	public function remove_ad()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			
			$return=$this->admin_model->remove_ad($id);
			
			
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_deleted','Item Deleted Successfully'));
				redirect('admin/ads');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('Action was not Successfull, Please try again'));
				redirect('admin/delete_ads');
			}
		}
		
		else
		{
			$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/ads');
		}
		
	}
	
		/* 
   #######################################
   ADMIN BANNER MODULE 
   #######################################
   */
	
	public function banners()
	{
		is_superadmin();
		$this->data['results']=$this->admin_model->get_banners();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/banners/banners',$this->data);
		$this->load->view('admin/templates/footer');
	}
	
	public function add_banner()
	{

		is_superadmin();
	
			$this->form_validation->set_rules('active', 'Status', 'required',
			array('required' =>  keyword_value('you_must_select_ad_media','You must select Banner Image.')));
		
		
		
		  if ($this->form_validation->run() == FALSE)
		{
			
	
			$this->load->view('admin/templates/header');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('admin/templates/topbar');
			$this->load->view('admin/banners/add_banner');
			$this->load->view('admin/templates/footer');
	
		}
		else
		{
			$image=$error=null;
			if($_FILES['banner_image']["name"])
			{
				$this->load->library('upload');
			  $config['upload_path']   = './uploads/banners/'; 
			  $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
			  $config['max_size']      = 1024;
			  $this->upload->initialize($config);
			if ( ! $this->upload->do_upload('banner_image')) {
			 $error = implode('<br>',$this->upload->display_errors()); 
			}else { 
					$uploadedImage = $this->upload->data();
					$image=$uploadedImage['file_name'];
			} 
			}
			
			$data['banner_text']=$this->input->post('banner_text');
			$data['banner_order']=$this->input->post('banner_order');
			
			if($image)
			{
				$data['banner_image']=$image;
			}
			$data['active']=$this->input->post('active');
			$data['fk_admin_id']=$this->session->pk_admin_id;
			
			$return=$this->admin_model->add_banner($data);
		
			if($return['status']==true && !$error)
			{
				$this->session->set_flashdata('msg', keyword_value('item_added','Banner Added Successfully'));
				redirect('admin/banners');
			}
			else if($return['status']==true && $error)
			{
				$this->session->set_flashdata('msg', '2'.$error);
				redirect('admin/banners');
				
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/banners/add_banner');
			}
		}
				
	
	}
	
	public function edit_banner()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			
			
			$result=$this->admin_model->check_banner_id($id);
	
			if($result['pk_banner_id'])
				
				{
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/banners/edit_banner',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/banners');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/banners');
		}
	}
	
	
	public  function update_banner()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			$this->load->library('upload');
			
		$this->form_validation->set_rules('active', 'Active', 'required',
			array('required' =>  keyword_value('you_must_select_status','You must select Status.'))
		);
		
		 if ($this->form_validation->run() == FALSE)
		{
	
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/banners/edit_banner',$this->data);
		$this->load->view('admin/templates/footer');
		
		}
		else
		{
		
			$image=$error=null;
			if($_FILES['banner_image']["name"])
			{
				$this->load->library('upload');
			  $config['upload_path']   = './uploads/banners/'; 
			  $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
			  $config['max_size']      = 1024;
			 $this->upload->initialize($config);
				   if ( ! $this->upload->do_upload('banner_image')) {
			 $error = implode('<br>',$this->upload->display_errors()); 
	
		
		  }else { 


			$uploadedImage = $this->upload->data();
			$image=$uploadedImage['file_name'];
      } 
			}
			

			$data['banner_text']=$this->input->post('banner_text');
			$data['banner_order']=$this->input->post('banner_order');
			
			if($image)
			{
				$data['banner_image']=$image;
			}
			
	
			$data['active']=$this->input->post('active');
			$data['fk_admin_id']=$this->session->pk_admin_id;
			
		
			
			$return=$this->admin_model->edit_banner($id,$data);
		
			if($return['status']==true && !$error)
			{
				$this->session->set_flashdata('msg', keyword_value('item_updated','Item Updated Successfully'));
				redirect('admin/banners');
			}
			else if($return['status']==true && $error)
			{
				$this->session->set_flashdata('msg', $error);
				redirect('admin/banners');
				
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/brands/edit_banner');
			}
			
			
		}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/banners');
		}
		
		
		
	}
	
	public function delete_banner()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_banner_id($id);
	
			if($result['pk_banner_id'])
				
				{
		
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/banners/delete_banner',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/banners');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/banners');
		}
		
		
	}
	
	public function remove_banner()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			
			$return=$this->admin_model->remove_banner($id);
			
			
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_deleted','Item Deleted Successfully'));
				redirect('admin/banners');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/banners/edit_banner');
			}
		}
		
		else
		{
			$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/banners');
		}
		
	}
	
	
		/* 
   #######################################
   ADMIN services MODULE 
   #######################################
   */
   
   public function services()
	{

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/services/services');
		$this->load->view('admin/templates/footer');
	}
	
	public function service_list()
	{
	
      $list = $this->admin_model->get_services();
      $data = array();
      $no = $this->input->post('start');
      foreach ($list as $ro) {
      $no++;
      $row = array();
	  if($ro->service_banners){
	  $row[] = '<img src="'.base_url('uploads/service/'.$ro->service_banners).'" width="100px"><br>'.$ro->service_name;
	  }
	else{
		 $row[] = $ro->service_name;
	}
	$row[] = $ro->discount_price.' Onwards	';
      $row[] = $ro->service_description;
	  
      if($ro->active==1){$row[] = 'Active';} else{$row[] = 'Inactive';}
		
		 $row[] = form_open('admin/edit_service',array('class'=>'d-inline')).'
				   <input type="hidden" name="id" value="'.$ro->pk_service_id.'"> 
				   <button  class="btn btn-primary" type="submit">'.keyword_value('edit','Edit').'</button>
				   </form>'.form_open('admin/delete_service',array('class'=>'d-inline')).'
				   <input type="hidden" name="id" value="'.$ro->pk_service_id.'"> 
				   <button class="btn btn-primary" type="submit">'.keyword_value('delete','Delete').'</button>
				   </form>';
      $data[] = $row;
      }
      $output = array(
      "draw" => $this->input->post('draw'),
      "recordsTotal" => $this->admin_model->services_count_all(),
      "recordsFiltered" => $this->admin_model->services_count_filtered(),
      "data" => $data,
      );
      //output to json format
      echo json_encode($output);
      }
	  
	  
	  public function add_service()
	{

			if($this->session->user_type=='admin' && !can_add_services())
			
			{
				$this->session->set_flashdata('msg','You have reached your package limit. Upgrade to add more');
				redirect('admin/services');
				
			}

		
		$this->form_validation->set_rules('service_name', 'Service Name', 'required',
			array('required' =>  keyword_value('you_must_enter_service_name','You must Enter Service Name.'))
		);
		
		/*
		$this->form_validation->set_rules('service_pricing', 'Service Pricing', 'required',
			array('required' =>  keyword_value('you_must_enter_service_pricing','You must Select Service Pricing.'))
		);
		
		*/
		
		$this->form_validation->set_rules('service_category', 'Service Category', 'required',
			array('required' =>  keyword_value('you_must_enter_service_category','You must Select Service Category.'))
		);
		
		$this->form_validation->set_rules('service_description', 'Service Description', 'required',
			array('required' =>  keyword_value('you_must_enter_service_description','You must Enter Service Description.'))
		);
		
		$this->form_validation->set_rules('fk_gst_id', 'GST Slab', 'required',
			array('required' =>  keyword_value('you_must_enter_fk_gst_id','You must Select GST Slab.'))
		);

		
		
		  if ($this->form_validation->run() == FALSE)
		{
			$this->data['gst']=$this->admin_model->get_gst(true);
			$this->data['categories']=$this->admin_model->get_service_cats();
			
			if($this->session->user_type=='superadmin')
			{
				$this->data['admins']=$this->admin_model->get_admins();
				
			}
			
			$this->load->view('admin/templates/header');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('admin/templates/topbar');
			$this->load->view('admin/services/add_service',$this->data);
			$this->load->view('admin/templates/footer');
	
		}
		else
		{
			$img=$err=null;
			if(isset($_FILES["service_banner"]["name"]))  
           {  
                $config['upload_path'] = './uploads/service/';  
                $config['allowed_types'] = 'jpg|jpeg|png|gif';  
                $this->load->library('upload', $config);  
                if(!$this->upload->do_upload("service_banner"))  
                {  
    
				$err=$this->upload->display_errors();					
                }  
                else  
                {  
                     $imgdata = $this->upload->data();
					  $img=$imgdata["file_name"];
				
                }  
           }  
		   
			
			$data['service_name']=$this->input->post('service_name');
			//$data['service_pricing']=$this->input->post('service_pricing');
			$data['service_description']=$this->input->post('service_description');;
			$data['service_features']=$this->input->post('service_features');
			$data['meta_title']			=	$this->input->post('meta_title');
			$data['meta_keywords']		=	$this->input->post('meta_keyword');
			$data['meta_description']	=	$this->input->post('meta_description');
			$data['ordering']			=	$this->input->post('ordering');
			$data['fk_gst_id']			=	$this->input->post('fk_gst_id');
			$data['fk_admin_id']		=	$this->input->post('cid')?$this->input->post('cid'):$this->session->pk_admin_id;
			$data['service_category']	=	$this->input->post('service_category');
			$data['active']				=	$this->input->post('active');
			$data['created_by']			=	$this->session->pk_admin_id;
			
			if($img)
			{
				$data['service_banners']				=	$img;
			}
			
			$return=$this->admin_model->add_service($data);
			
			if(@$return['id'])
			{
				
			$service_variation		=	$this->input->post('service_variation');
			$service_subvariation	=	$this->input->post('service_subvariation');
			$org_price				=	$this->input->post('original_price');
			$dis_price				=	$this->input->post('discount_price');
			//$quantity				=	$this->input->post('quantity');
			
			if(count($org_price)>0)
			{
			foreach($org_price as $key=>$value)
			{
				if($value)
				{
				 $insert_data[]  = array(
				    'fk_service_id' => $return['id'],
                    'service_variation' => $service_variation[$key],
					'service_subvariation'=>$service_subvariation[$key],
                    'original_price' => $value,
                    'discount_price' => $dis_price[$key],
					//'quantity' => $quantity[$key]
                );
				
				}
				
			}
			}
			
			
				if(!empty($insert_data))
				{
					$this->admin_model->pricing_service($insert_data);
				}

			}
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('service_added','service Added Successfully'));
				redirect('admin/services');
			
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('service_not_added','Action was not Successfull, Please try again'));
				redirect('admin/add_service');
			}
		}
				
	
	}
	
	
	
	public function edit_service()
	{
		$id=$this->input->post('id');
		if($id)
		{
			
			
			$result=$this->admin_model->check_service_id($id);
			$this->data['gst']=$this->admin_model->get_gst(true);
			$this->data['categories']=$this->admin_model->get_service_cats();
			$this->data['pricing']=$this->admin_model->get_service_pricing($id);
	
			if($result['pk_service_id'])
				
		{

			
			if($this->session->user_type=='superadmin')
			{
				$this->data['admins']=$this->admin_model->get_admins();
			}
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/services/edit_service',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/services');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/services');
		}
	}
	
	
	
	public  function update_service()
	{
		
		$id=$this->input->post('id');
		if($id)
		{
			
			
		$this->form_validation->set_rules('service_name', 'Service Name', 'required',
			array('required' =>  keyword_value('you_must_enter_service_name','You must Enter Service Name.'))
		);
		
		/*
		$this->form_validation->set_rules('service_pricing', 'Service Pricing', 'required',
			array('required' =>  keyword_value('you_must_enter_service_pricing','You must Select Service Pricing.'))
		);
		*/
		$this->form_validation->set_rules('service_category', 'Service Category', 'required',
			array('required' =>  keyword_value('you_must_enter_service_category','You must Select Service Category.'))
		);
		
		$this->form_validation->set_rules('service_description', 'Service Description', 'required',
			array('required' =>  keyword_value('you_must_enter_service_description','You must Enter Service Description.'))
		);
		
		$this->form_validation->set_rules('fk_gst_id', 'GST Slab', 'required',
			array('required' =>  keyword_value('you_must_enter_fk_gst_id','You must Select GST Slab.'))
		);
		
		
		 if ($this->form_validation->run() == FALSE)
		{
			

			$this->data['gst']=$this->admin_model->get_gst(true);
			$this->data['categories']=$this->admin_model->get_service_cats();

			
			
			if($this->session->user_type=='superadmin')
			{
				$this->data['admins']=$this->admin_model->get_admins();
				
			}
			
	
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/services/edit_service',$this->data);
		$this->load->view('admin/templates/footer');
		
		}
		else
		{
			
			$img=$err=null;
			if(isset($_FILES["service_banner"]["name"]))  
           {  
                $config['upload_path'] = './uploads/service/';  
                $config['allowed_types'] = 'jpg|jpeg|png|gif';  
                $this->load->library('upload', $config);  
                if(!$this->upload->do_upload("service_banner"))  
                {  
    
				$err=$this->upload->display_errors();					
                }  
                else  
                {  
                     $imgdata = $this->upload->data();
					  $img=$imgdata["file_name"];
				
                }  
           }  
		   
		   
		
			$data['service_name']=$this->input->post('service_name');
			//$data['service_pricing']=$this->input->post('service_pricing');
			$data['service_description']=$this->input->post('service_description');;
			$data['service_features']=$this->input->post('service_features');
			$data['service_slug']		=	$this->input->post('service_slug');
			$data['meta_title']			=	$this->input->post('meta_title');
			
			$data['meta_keywords']		=	$this->input->post('meta_keyword');
			$data['meta_description']	=	$this->input->post('meta_description');
			$data['ordering']			=	$this->input->post('ordering');
			$data['fk_gst_id']			=	$this->input->post('fk_gst_id');
			$data['fk_admin_id']		=	$this->input->post('cid')?$this->input->post('cid'):$this->session->pk_admin_id;
			$data['service_category']	=	$this->input->post('service_category');
			$data['active']				=	$this->input->post('active');
			if($img)
			{
				$data['service_banners']				=	$img;
			}
			
			
			$service_variation=$this->input->post('service_variation');
			$service_subvariation=$this->input->post('service_subvariation');
			$org_price=$this->input->post('original_price');
			$dis_price=$this->input->post('discount_price');
			//$quantity=$this->input->post('quantity');

			
			$return=$this->admin_model->edit_service($data,$id);
			
			if(count($org_price)>0)
			{
			foreach($org_price as $key=>$value)
			{
				if($value)
				{
				 $insert_data[]  = array(
				    'fk_service_id' => $id,
                    'service_variation' => $service_variation[$key],
					'service_subvariation'=>$service_subvariation[$key],
                    'original_price' => $value,
                    'discount_price' => $dis_price[$key],
					//'quantity' => $quantity[$key]
                );
				
				}
				
			}
			}
			
			if(!empty($insert_data))
			{
				$this->admin_model->pricing_service($insert_data);
			}
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('service_updated','Service Updated Successfully'));
				redirect('admin/services');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/services');
			}
			
			
		}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/services');
		}
		
		
		
	}
	
	
	
	 
	
	public function delete_service()
	{
		
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_service_id($id);
	
			if($result['pk_service_id'])
				
				{
		
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/services/delete_service',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/services');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/services');
		}
		
		
	}
	
	public function remove_service()
	{
		$id=$this->input->post('id');
		if($id)
		{
			
			$return=$this->admin_model->remove_service($id);
			
			
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_deleted','Item Deleted Successfully'));
				redirect('admin/services');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/services');
			}
		}
		
		else
		{
			$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/services');
		}
		
	}  
	
	
	/* 
   #######################################
   ADMIN Product Categories MODULE 
   #######################################
   */
	
	public function procategory()
	{
		is_superadmin();
		$this->data['results']=$this->admin_model->get_procategory();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/procategory/procategory',$this->data);
		$this->load->view('admin/templates/footer');
	}
	
	public function add_procategory()
	{

		is_superadmin();
		$this->form_validation->set_rules('category_name', 'Category Name', 'required',
			array('required' =>  keyword_value('you_must_enter_category_name','You must Enter Category Name.'))
		);
		
		
		
		  if ($this->form_validation->run() == FALSE)
		{
			
	        $this->data['procats']=$this->admin_model->get_procategory();
			$this->load->view('admin/templates/header');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('admin/templates/topbar');
			$this->load->view('admin/procategory/add_procategory',$this->data);
			$this->load->view('admin/templates/footer');
	
		}
		else
		{
			$image=$error=null;
			if($_FILES['category_image']["name"])
			{
			  $config['upload_path']   = './uploads/category/'; 
			  $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
			  $config['max_size']      = 1024;
			  $this->load->library('upload', $config);
				   if ( ! $this->upload->do_upload('category_image')) {
			 $error = implode('<br>',$this->upload->display_errors()); 
		
		  }else { 


			$uploadedImage = $this->upload->data();
			$image=$uploadedImage['file_name'];
      } 
			}
			
			$data['category_name']=$this->input->post('category_name');
			$data['category_icon']=$this->input->post('category_icon');
			$data['parent_category']=$this->input->post('parent_category');
			$data['meta_title']=$this->input->post('meta_title');
			$data['meta_keywords']=$this->input->post('meta_keywords');
			$data['meta_description']=$this->input->post('meta_description');
			$data['ordering']=$this->input->post('ordering');
			
			if($image)
			{
				$data['category_image']=$image;
			}
			$data['active']=$this->input->post('active');
			$data['created_by']=$this->session->pk_admin_id;
			
			
			$return=$this->admin_model->add_procategory($data);
		
			if($return['status']==true && !$error)
			{
				$this->session->set_flashdata('msg', keyword_value('item_added','Item Added Successfully'));
				redirect('admin/procategory');
			}
			else if($return['status']==true && $error)
			{
				$this->session->set_flashdata('msg', $error);
				redirect('admin/procategory');
				
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/procategory');
			}
		}
				
	
	}
	
	public function edit_procategory()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			
			
			$result=$this->admin_model->check_procategory_id($id);
	
			if($result['pk_category_id'])
				
				{
		
				$this->data['results']=$result;
				$this->data['procats']=$this->admin_model->get_procategory();
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/procategory/edit_procategory',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/procategory');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/procategory');
		}
	}
	
	
	public function update_procategory()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			$this->load->library('upload');
			
		$this->form_validation->set_rules('category_name', 'Category Name', 'required',
			array('required' =>  keyword_value('you_must_enter_category_name','You must Enter Category Name.'))
		);
		
		 if ($this->form_validation->run() == FALSE)
		{
	$this->data['procats']=$this->admin_model->get_procategory();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/procategory/edit_procategory',$this->data);
		$this->load->view('admin/templates/footer');
		
		}
		else
		{
			
			$image=$error=null;
			if($_FILES['category_image']["name"])
			{
			  $config['upload_path']   = './uploads/category/'; 
			  $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
			  $config['max_size']      = 1024;
			  $this->load->library('upload', $config);
				   if ( ! $this->upload->do_upload('category_image')) {
			 $error = implode('<br>',$this->upload->display_errors()); 
		
		  }else { 


			$uploadedImage = $this->upload->data();
			$image=$uploadedImage['file_name'];
      } 
			}
			
			$data['category_name']=$this->input->post('category_name');
			$data['category_icon']=$this->input->post('category_icon');
			$data['category_slug']=$this->input->post('category_slug');
			$data['parent_category']=$this->input->post('parent_category');
			$data['meta_title']=$this->input->post('meta_title');
			$data['meta_keywords']=$this->input->post('meta_keywords');
			$data['meta_description']=$this->input->post('meta_description');
			$data['ordering']=$this->input->post('ordering');
			
			if($image)
			{
				$data['category_image']=$image;
			}
			$data['active']=$this->input->post('active');
			
		
			
			$return=$this->admin_model->edit_procategory($id,$data);
		
			if($return['status']==true && !$error)
			{
				$this->session->set_flashdata('msg', keyword_value('item_updated','Item Updated Successfully'));
				redirect('admin/procategory');
			}
			else if($return['status']==true && $error)
			{
				$this->session->set_flashdata('msg', $error);
				redirect('admin/procategory');
				
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/procategory');
			}
			
			
		}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/procategory');
		}
		
		
		
	}
	
	public function delete_procategory()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_procategory_id($id);
	
			if($result['pk_category_id'])
				
				{
		
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/procategory/delete_procategory',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/procategory');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/procategory');
		}
		
		
	}
	
	public function remove_procategory()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			
			$return=$this->admin_model->remove_procategory($id);
			
			
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_deleted','Item Deleted Successfully'));
				redirect('admin/procategory');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/procategory');
			}
		}
		
		else
		{
			$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/procategory');
		}
		
	}
	
	
	/* 
   #######################################
   ADMIN Busniess Categories MODULE 
   #######################################
   */
	
	public function bizcategory()
	{
		is_superadmin();
		$this->data['results']=$this->admin_model->get_bizcategory();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/bizcategory/bizcategory',$this->data);
		$this->load->view('admin/templates/footer');
	}
	
	public function add_bizcategory()
	{

		is_superadmin();
		$this->form_validation->set_rules('category_name', 'Category Name', 'required',
			array('required' =>  keyword_value('you_must_enter_category_name','You must Enter Category Name.'))
		);
		
		
		
		  if ($this->form_validation->run() == FALSE)
		{
			
	        $this->data['procats']=$this->admin_model->get_bizcategory();
			$this->load->view('admin/templates/header');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('admin/templates/topbar');
			$this->load->view('admin/bizcategory/add_bizcategory',$this->data);
			$this->load->view('admin/templates/footer');
	
		}
		else
		{
			$image=$error=null;
			if($_FILES['category_image']["name"])
			{
			  $config['upload_path']   = './uploads/category/'; 
			  $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
			  $config['max_size']      = 1024;
			  $this->load->library('upload', $config);
				   if ( ! $this->upload->do_upload('category_image')) {
			 $error = implode('<br>',$this->upload->display_errors()); 
		
		  }else { 


			$uploadedImage = $this->upload->data();
			$image=$uploadedImage['file_name'];
      } 
			}
			
			$data['category_name']=$this->input->post('category_name');
			$data['category_icon']=$this->input->post('category_icon');
			$data['parent_category']=$this->input->post('parent_category');
			$data['meta_title']=$this->input->post('meta_title');
			$data['meta_keywords']=$this->input->post('meta_keywords');
			$data['meta_description']=$this->input->post('meta_description');
			$data['ordering']=$this->input->post('ordering');
			
			if($image)
			{
				$data['category_image']=$image;
			}
			$data['active']=$this->input->post('active');
			$data['created_by']=$this->session->pk_admin_id;
			
			
			$return=$this->admin_model->add_bizcategory($data);
		
			if($return['status']==true && !$error)
			{
				$this->session->set_flashdata('msg', keyword_value('item_added','Item Added Successfully'));
				redirect('admin/bizcategory');
			}
			else if($return['status']==true && $error)
			{
				$this->session->set_flashdata('msg', $error);
				redirect('admin/bizcategory');
				
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/bizcategory');
			}
		}
				
	
	}
	
	public function edit_bizcategory()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			
			
			$result=$this->admin_model->check_bizcategory_id($id);
	
			if($result['pk_category_id'])
				
				{
		
				$this->data['results']=$result;
				$this->data['procats']=$this->admin_model->get_bizcategory();
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/bizcategory/edit_bizcategory',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/bizcategory');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/bizcategory');
		}
	}
	
	
	public function update_bizcategory()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			$this->load->library('upload');
			
		$this->form_validation->set_rules('category_name', 'Category Name', 'required',
			array('required' =>  keyword_value('you_must_enter_category_name','You must Enter Category Name.'))
		);
		
		 if ($this->form_validation->run() == FALSE)
		{
	$this->data['procats']=$this->admin_model->get_bizcategory();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/bizcategory/edit_bizcategory',$this->data);
		$this->load->view('admin/templates/footer');
		
		}
		else
		{
			
			$image=$error=null;
			if($_FILES['category_image']["name"])
			{
			  $config['upload_path']   = './uploads/category/'; 
			  $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
			  $config['max_size']      = 1024;
			  $this->load->library('upload', $config);
				   if ( ! $this->upload->do_upload('category_image')) {
			 $error = implode('<br>',$this->upload->display_errors()); 
		
		  }else { 


			$uploadedImage = $this->upload->data();
			$image=$uploadedImage['file_name'];
      } 
			}
			
			$data['category_name']=$this->input->post('category_name');
			$data['category_icon']=$this->input->post('category_icon');
			$data['category_slug']=$this->input->post('category_slug');
			$data['parent_category']=$this->input->post('parent_category');
			$data['meta_title']=$this->input->post('meta_title');
			$data['meta_keywords']=$this->input->post('meta_keywords');
			$data['meta_description']=$this->input->post('meta_description');
			$data['ordering']=$this->input->post('ordering');
			
			if($image)
			{
				$data['category_image']=$image;
			}
			$data['active']=$this->input->post('active');
			
		
			
			$return=$this->admin_model->edit_bizcategory($id,$data);
		
			if($return['status']==true && !$error)
			{
				$this->session->set_flashdata('msg', keyword_value('item_updated','Item Updated Successfully'));
				redirect('admin/bizcategory');
			}
			else if($return['status']==true && $error)
			{
				$this->session->set_flashdata('msg', $error);
				redirect('admin/bizcategory');
				
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/bizcategory');
			}
			
			
		}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/bizcategory');
		}
		
		
		
	}
	
	public function delete_bizcategory()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_bizcategory_id($id);
	
			if($result['pk_category_id'])
				
				{
		
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/bizcategory/delete_bizcategory',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/bizcategory');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/bizcategory');
		}
		
		
	}
	
	public function remove_bizcategory()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			
			$return=$this->admin_model->remove_bizcategory($id);
			
			
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_deleted','Item Deleted Successfully'));
				redirect('admin/bizcategory');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/bizcategory');
			}
		}
		
		else
		{
			$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/bizcategory');
		}
		
	}
	
	/* 
   #######################################
   ADMINS MODULE 
   #######################################
   */
	
	public function admins()
	{
		is_superadmin();
		$this->data['results']=$this->admin_model->get_admins_profile();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/admins/admins',$this->data);
		$this->load->view('admin/templates/footer');
	}
	
	public function add_admin()
	{

		is_superadmin();
		$this->form_validation->set_rules('admin_name', 'Admin Name', 'required',
			array('required' =>  keyword_value('enter_admin_name','You must enter Admin Name.'))
		);
		
		$this->form_validation->set_rules('admin_mobile', 'Admin Mobile', 'trim|required|is_unique[tbl_admin.admin_mobile]',
			array('required' =>  keyword_value('enter_admin_mobile','Please enter admin mobile.'))
		);
		
		$this->form_validation->set_rules('admin_email', 'Admin Email', 'trim|required|valid_email|is_unique[tbl_admin.admin_email]',
			array('required' =>  keyword_value('enter_admin_email','Please Enter admin email.'))
		);
		
		
		
		  if ($this->form_validation->run() == FALSE)
		{
			
			$this->data['packages']=$this->admin_model->get_packages_active();
			$this->load->view('admin/templates/header');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('admin/templates/topbar');
			$this->load->view('admin/admins/add_admin',$this->data);
			$this->load->view('admin/templates/footer');
	
		}
		else
		{
			
			$data['admin_name']=$this->input->post('admin_name');
			$data['admin_mobile']=$this->input->post('admin_mobile');
			$data['admin_email']=$this->input->post('admin_email');
			$data['active']=$this->input->post('active');
			
			$data2['profile_package']=$this->input->post('profile_package');
			
			$return=$this->admin_model->add_admin($data,$data2);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_added','Admin Created Successfully'));
				redirect('admin/admins');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/admins/');
			}
		}
				
	
	}
	
	public function edit_admin()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_admin_id($id);
			if($result['pk_admin_id'])
				{
				$this->data['results']=$result;
				$this->data['cats']=$this->admin_model->get_business_cats();
				$this->data['states']=$this->admin_model->get_states();
				$this->data['cities']=$this->admin_model->get_cities();
				$this->data['packages']=$this->admin_model->get_packages_active();
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/admins/edit_admin',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/admins');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/admins');
		}
	}
	
	
	public  function update_admin()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{	
		$this->form_validation->set_rules('admin_name', 'Admin Name', 'required',
			array('required' =>  keyword_value('enter_admin_name','You must enter Admin Name.'))
		);
		
		$this->form_validation->set_rules('admin_mobile', 'Admin Mobile', 'trim|required',
			array('required' =>  keyword_value('enter_admin_mobile','Please enter admin mobile.'))
		);
		
		$this->form_validation->set_rules('admin_email', 'Admin Email', 'trim|required|valid_email',
			array('required' =>  keyword_value('enter_admin_email','Please Enter admin email.'))
		);
		
		 if ($this->form_validation->run() == FALSE)
		{
	
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/admins/edit_admin',$this->data);
		$this->load->view('admin/templates/footer');
		
		}
		else
		{
	
			$data1['admin_name']=$this->input->post('admin_name');
			$data1['admin_mobile']=$this->input->post('admin_mobile');
			$data1['admin_email']=$this->input->post('admin_email');
			$data1['active']=$this->input->post('active');
			
			
			//$data2['profile_name']=$this->input->post('profile_name');
			$data2['profile_categories']=implode(',',$this->input->post('profile_categories'));
			//$data2['profile_contact']=$this->input->post('profile_contact');
			//$data2['profile_address']=$this->input->post('profile_address');
			//$data2['profile_banner']=$this->input->post('profile_banner');
			//$data2['profile_type']=$this->input->post('profile_type');
			$data2['profile_states']=implode(',',$this->input->post('profile_states'));
			$data2['profile_cities']=implode(',',$this->input->post('profile_cities'));
			$data2['profile_package']=$this->input->post('profile_package');
			
			
		
			
			$return=$this->admin_model->edit_admin($id,$data1);
			$this->admin_model->edit_adminprofile($id,$data2);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_updated','Admin Updated Successfully'));
				redirect('admin/admins');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/admins');
			}
			
			
		}
		
		}
		else
		{
			$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/admins');
		}
		
		
		
	}
	
	public function delete_admin()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_admin_id($id);
	
			if($result['pk_admin_id'])
				
				{
		
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/admins/delete_admin',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/admins');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/admins');
		}
		
		
	}
	
	public function remove_admin()
	{
		is_superadmin();
		$id=$this->input->post('id');
		if($id)
		{
			
			$return=$this->admin_model->remove_admin($id);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_deleted','Item Deleted Successfully'));
				redirect('admin/admins');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/admins');
			}
		}
		
		else
		{
			$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/admins');
		}
		
	}
	
	
	
   /* 
   #######################################
   ADMIN PACKAGE MODULE 
   #######################################
   */
	
	public function packages()
	{
		is_superadmin();
		$this->data['results']=$this->admin_model->get_packages();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/packages/packages',$this->data);
		$this->load->view('admin/templates/footer');
	}
	
	public function add_package()
	{
		
		$this->form_validation->set_rules('package_name', 'Package Name', 'required',
			array('required' =>  keyword_value('you_must_enter_package_name','You must enter %s.'))
		);
		
		
		$this->form_validation->set_rules('package_validity', 'Package Validity', 'required',
			array('required' =>  keyword_value('you_must_enter_package_validity','You must enter %s.'))
		);
		
		
		$this->form_validation->set_rules('package_products', 'Package Products', 'required',
			array('required' =>  keyword_value('you_must_enter_package_products','You must enter %s.'))
		);
		
		
		$this->form_validation->set_rules('package_services', 'Package Services', 'required',
			array('required' =>  keyword_value('you_must_enter_package_services','You must enter %s.'))
		);
		
		
		  if ($this->form_validation->run() == FALSE)
		{
			
			$this->load->view('admin/templates/header');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('admin/templates/topbar');
			$this->load->view('admin/packages/add_package');
			$this->load->view('admin/templates/footer');
	
		}
		else
		{
			$data['package_name']=$this->input->post('package_name');
			$data['package_description']=$this->input->post('package_description');
			$data['package_validity']=$this->input->post('package_validity');
			$data['package_category']=$this->input->post('package_category');
			$data['package_products']=$this->input->post('package_products');
			$data['package_services	']=$this->input->post('package_services');
			$data['show_price']=$this->input->post('show_price');
			$data['show_features']=$this->input->post('show_features');
			$data['active']=$this->input->post('active');
			
		
			
			$return=$this->admin_model->add_package($data);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_added','Package Added Successfully'));
				redirect('admin/packages');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/packages');
			}
		}
				
	
	}
	
	public function edit_package()
	{
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_package_id($id);
	
			if($result['pk_package_id'])
				
				{
		
		
					$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/packages/edit_package',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/packages');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/packages');
		}
	}
	
	
	public  function update_package()
	{
		
		$id=$this->input->post('id');
		if($id)
		{
			
		$this->form_validation->set_rules('package_name', 'Package Name', 'required',
			array('required' =>  keyword_value('you_must_enter_package_name','You must enter %s.'))
		);
		
		
		$this->form_validation->set_rules('package_validity', 'Package Validity', 'required',
			array('required' =>  keyword_value('you_must_enter_package_validity','You must enter %s.'))
		);
		
		
		$this->form_validation->set_rules('package_products', 'Package Products', 'required',
			array('required' =>  keyword_value('you_must_enter_package_products','You must enter %s.'))
		);
		
		
		$this->form_validation->set_rules('package_services', 'Package Services', 'required',
			array('required' =>  keyword_value('you_must_enter_package_services','You must enter %s.'))
		);
		
		
		
		 if ($this->form_validation->run() == FALSE)
		{
			
		$this->data['results']=$result;
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/packages/edit_package',$this->data);
		$this->load->view('admin/templates/footer');
		
		}
		else
		{
			
			$data['package_name']=$this->input->post('package_name');
			$data['package_description']=$this->input->post('package_description');
			$data['package_validity']=$this->input->post('package_validity');
			$data['package_products']=$this->input->post('package_products');
			$data['package_services	']=$this->input->post('package_services');
			$data['show_price']=$this->input->post('show_price');
			$data['package_category']=$this->input->post('package_category');
			$data['show_features']=$this->input->post('show_features');
			$data['active']=$this->input->post('active');
		
			
			$return=$this->admin_model->edit_package($id,$data);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_updated','Package Updated Successfully'));
				redirect('admin/packages');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/packages');
			}
			
			
		}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/packages');
		}
		
		
		
	}
	
	public function delete_package()
	{
		
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_package_id($id);
	
			if($result['pk_package_id'])
				
				{
		
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/packages/delete_package',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/packages');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/packages');
		}
		
		
	}
	
	public function remove_package()
	{
		$id=$this->input->post('id');
		if($id)
		{
			
			$return=$this->admin_model->remove_package($id);
			
			
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_deleted','Item Deleted Successfully'));
				redirect('admin/packages');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/packages');
			}
		}
		
		else
		{
			$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/packages');
		}
		
	}
	
	
	/* 
   #######################################
   PROFILE MODULE 
   #######################################
   */
	
	public function profile()
	{
		$id=$this->session->pk_admin_id;
		if($id)
		{
			$result=$this->admin_model->check_admin_id($id);
			if($result['pk_admin_id'])
				{
				$this->data['results']=$result;
				$this->data['cats']=$this->admin_model->get_business_cats();
				$this->data['states']=$this->admin_model->get_states();
				$this->data['cities']=$this->admin_model->get_cities();
				$this->data['packages']=$this->admin_model->get_packages_active();
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/profile/profile',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin');
		}
	}
	
	
	public  function update_profile()
	{

		$id=$this->session->pk_admin_id;
		if($id)
		{	
		$this->form_validation->set_rules('admin_name', 'Admin Name', 'required',
			array('required' =>  keyword_value('enter_admin_name','You must enter Admin Name.'))
		);
		
		$this->form_validation->set_rules('admin_mobile', 'Admin Mobile', 'trim|required',
			array('required' =>  keyword_value('enter_admin_mobile','Please enter admin mobile.'))
		);
		
		$this->form_validation->set_rules('admin_email', 'Admin Email', 'trim|required|valid_email',
			array('required' =>  keyword_value('enter_admin_email','Please Enter admin email.'))
		);
		
		 if ($this->form_validation->run() == FALSE)
		{
	
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/profile/profile',$this->data);
		$this->load->view('admin/templates/footer');
		
		}
		else
		{
			
			$image=$error=null;
			if($_FILES['profile_banner']["name"])
			{
			  $config['upload_path']   = './uploads/banners/'; 
			  $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
			  $config['max_size']      = 1024;
			  $this->load->library('upload', $config);
				   if ( ! $this->upload->do_upload('profile_banner')) {
			 $error = implode('<br>',$this->upload->display_errors()); 
		
		  }else { 


			$uploadedImage = $this->upload->data();
			$image=$uploadedImage['file_name'];
      } 
			}
			
			
	
			$data1['admin_name']=$this->input->post('admin_name');
			$data1['admin_mobile']=$this->input->post('admin_mobile');
			$data1['admin_email']=$this->input->post('admin_email');
			$data1['active']=$this->input->post('active');
			
			
			$data2['profile_name']=$this->input->post('profile_name');
			$data2['profile_categories']=implode(',',$this->input->post('profile_categories'));
			$data2['profile_contact']=$this->input->post('profile_contact');
			$data2['profile_address']=$this->input->post('profile_address');
			if($image)
			{
				$data2['profile_banner']=$image;
			}
			//$data2['profile_type']=$this->input->post('profile_type');
			$data2['profile_states']=implode(',',$this->input->post('profile_states'));
			$data2['profile_cities']=implode(',',$this->input->post('profile_cities'));
			//$data2['profile_package']=$this->input->post('profile_package');
			
			
		
			
			$return=$this->admin_model->edit_admin($id,$data1);
			$this->admin_model->edit_adminprofile($id,$data2);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_updated','Admin Updated Successfully'));
				redirect('admin/profile');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/profile');
			}
			
		}
		
		}
		else
		{
			$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/profile');
		}
	
	}
	
	
	/* 
   #######################################
   EMAILS MODULE 
   #######################################
   */
   
   	public function emails()
	{
		is_superadmin();
		$this->data['results']=$this->admin_model->get_email_templates();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/emails/emails',$this->data);
		$this->load->view('admin/templates/footer');
	}
	
	public function edit_email()
	{
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_email_id($id);
			if($result['pk_template_id'])
				{
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/emails/edit_email',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin');
		}
	}
	
	
	public  function update_email()
	{

		$id=$this->input->post('id');
		if($id)
		{	
		$this->form_validation->set_rules('template_name', 'Template Name', 'required',
			array('required' =>  keyword_value('enter_template_name','You must enter Template Name.'))
		);
		
		$this->form_validation->set_rules('template', 'Email Template', 'required',
			array('required' =>  keyword_value('enter_admin_template','Please enter Email Template.'))
		);
		
		 if ($this->form_validation->run() == FALSE)
		{
	
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/emails/edit_email',$this->data);
		$this->load->view('admin/templates/footer');
		
		}
		else
		{
	
			$data1['template_name']=$this->input->post('template_name');
			$data1['template_subject']=$this->input->post('template_subject');
			$data1['template']=$this->input->post('template');
			
			
			
			$return=$this->admin_model->edit_email($id,$data1);
		
			if($return['status']==true)
			{
				$this->session->set_flashdata('msg', keyword_value('item_updated','Email template Updated Successfully'));
				redirect('admin/emails');
			}
			else
			{
				
				$this->session->set_flashdata('msg', keyword_value('item_not_added','Action was not Successfull, Please try again'));
				redirect('admin/emails');
			}
			
		}
		
		}
		else
		{
			$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/emails');
		}
	
	}
	
	
	/* 
   #######################################
   Orders MODULE 
   #######################################
   */	
   
   public function orders()
	{

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/templates/topbar');
		$this->load->view('admin/orders/orders');
		$this->load->view('admin/templates/footer');
	}
	
	public function order_list()
	{
	
      $list = $this->admin_model->get_orders();
      $data = array();
      $no = $this->input->post('start');
      foreach ($list as $ro) {
		$details=$this->admin_model->get_order_details($ro->pk_order_id);
		$ttqty=$ttgtotal=0;
		foreach($details as $det){
		$ttqty+=	$det['quantity'];
		$ttgtotal+=$det['grandtotal'];
		}
      $no++;
      $row = array();
      $row[] = $ro->order_number;
	  $row[] = $ro->txn_id;
	  $row[] = $ttqty; //order_status
	  $row[] = '₹'.$ttgtotal; // $ro->grand_total
	  $row[] = date('d M,Y',$ro->invoice_date);
	  $row[] = $ro->user;
	  $row[] = $ro->status;

		
		 $row[] = form_open('admin/edit_order',array('class'=>'d-inline')).'
				   <input type="hidden" name="id" value="'.$ro->pk_order_id.'"> 
				   <button  class="btn btn-primary" type="submit">'.keyword_value('view','View').'</button>
				   </form>';
      $data[] = $row;
      }
      $output = array(
      "draw" => $this->input->post('draw'),
      "recordsTotal" => $this->admin_model->orders_count_all(),
      "recordsFiltered" => $this->admin_model->orders_count_filtered(),
      "data" => $data,
      );
      //output to json format
      echo json_encode($output);
      }
	
	
	
	public function edit_order()
	{
		$fid=$this->session->flashdata('order_id');
		$id=$this->input->post('id')?$this->input->post('id'):$fid;
		if($id)
		{
			
			$result=$this->admin_model->check_order_id($id);
			
	
			if($result['pk_order_id'])
			{
		
			$this->data['order_details']=$this->admin_model->get_order_details($id);
				//echo '<pre>';var_dump($this->data['order_details']);die();
		
				$this->data['results']=$result;
				$this->load->view('admin/templates/header');
				$this->load->view('admin/templates/sidebar');
				$this->load->view('admin/templates/topbar');
				$this->load->view('admin/orders/edit_order',$this->data);
				$this->load->view('admin/templates/footer');
		
				}
				else
				{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
					redirect('admin/orders');
				}
		
		}
		else
		{
					$this->session->set_flashdata('msg', keyword_value('invalid_action','Invalid Action'));
			redirect('admin/orders');
		}
	}
	 

	
	public function update_order()
	{
		if($this->session->pk_admin_id)
		{
			$detail_id=$this->input->post('id');
			$order_id=$this->input->post('oid');
			$data['tracking_company']=$this->input->post('tracking_carrier');
			$data['tracking_number']=$this->input->post('tracking_number');
			$data['order_status']=$this->input->post('order_status');
			

			if($this->admin_model->update_order_details($data,$detail_id))
			{
				$this->session->set_flashdata('msg', 'Order was updated successfully');
				$this->session->set_flashdata('order_id',$order_id);
				redirect('admin/edit_order/');
			}
			
			else
			{
				$this->session->set_flashdata('msg', 'Action was not successfull');
				$this->session->set_flashdata('order_id',$order_id);
				redirect('admin/edit_order/');
				
			}
			
			
		}
		
		
	}
	
	

	

}
