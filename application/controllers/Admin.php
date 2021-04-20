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
			
			$data['fk_state_id']=$this->input->post('state_name');
			$data['city_name']=$this->input->post('city_name');
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
	  $row[] = '<img src="'.base_url('uploads/product/'.$ro->product_image).'" width="100px">';
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
			$this->data['gst']=$this->admin_model->get_gst();
			$this->data['categories']=$this->admin_model->get_product_cats();
			$this->data['colors']=$this->admin_model->get_color();
			$this->data['sizes']=$this->admin_model->get_size();
	
			if($result['pk_product_id'])
				
				{
			$this->data['brands']=$this->admin_model->get_brands();
			$this->data['cross']=$this->admin_model->get_cross_products();
			$this->data['gst']=$this->admin_model->get_gst();
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
			$this->data['gst']=$this->admin_model->get_gst();
			$this->data['categories']=$this->admin_model->get_product_cats();
			$this->data['colors']=$this->admin_model->get_color();
			$this->data['sizes']=$this->admin_model->get_size();
	
			if($result['pk_product_id'])
				
				{
					
					
			$this->data['brands']=$this->admin_model->get_brands();
			$this->data['cross']=$this->admin_model->get_cross_products();
			$this->data['gst']=$this->admin_model->get_gst();
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
				$this->admin_model->pricing_product($insert_data);
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

			$data['display_locations']=$this->input->post('display_locations');
			$data['display_categories']=$this->input->post('display_categories');
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
		
		
		
		if (empty($_FILES['banner_image']['name']))
		{
			$this->form_validation->set_rules('banner_image', 'Document', 'required',
			array('required' =>  keyword_value('you_must_select_ad_media','You must select Banner Image.')));
		}
		
		
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
			  $config['upload_path']   = './uploads/banners/'; 
			  $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
			  $config['max_size']      = 1024;
			  $this->load->library('upload', $config);
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
				$this->session->set_flashdata('msg', $error);
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
			  $config['upload_path']   = './uploads/banners/'; 
			  $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
			  $config['max_size']      = 1024;
			  $this->load->library('upload', $config);
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
	
	
		
}
