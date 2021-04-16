<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('user_type') || $this->session->userdata('user_type')=='user'){
			redirect('authentication/admin');	
		}
		
		$this->load->model('admin/admin_model');
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		
 	}

	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/topbar');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
	}
	

	/* 
   #######################################
   ADMIN STATE MODULE 
   #######################################
   */
	
	
	public function states()
	{
		
		$this->data['results']=$this->admin_model->get_states();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/topbar');
		$this->load->view('admin/states/states',$this->data);
		$this->load->view('admin/footer');
	}
	
	public function add_state()
	{
		
		$this->form_validation->set_rules('state_name', 'State Name', 'required',
			array('required' =>  keyword_value('you_must_enter_state_name','You must enter State Name.'))
		);
		
		
		  if ($this->form_validation->run() == FALSE)
		{
			
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/topbar');
			$this->load->view('admin/states/add_state');
			$this->load->view('admin/footer');
	
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
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_state_id($id);
	
			if($result['pk_state_id'])
				
				{
		
		
					$this->data['results']=$result;
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/topbar');
				$this->load->view('admin/states/edit_state',$this->data);
				$this->load->view('admin/footer');
		
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
		
		$id=$this->input->post('id');
		if($id)
		{
			
		$this->form_validation->set_rules('state_name', 'State Name', 'required',
			array('required' =>  keyword_value('you_must_enter_state_name','You must enter State Name.'))
		);
		
		
		 if ($this->form_validation->run() == FALSE)
		{
			
		$this->data['results']=$result;
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/topbar');
		$this->load->view('admin/states/edit_state',$this->data);
		$this->load->view('admin/footer');
		
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
		
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_state_id($id);
	
			if($result['pk_state_id'])
				
				{
		
		
				$this->data['results']=$result;
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/topbar');
				$this->load->view('admin/states/delete_state',$this->data);
				$this->load->view('admin/footer');
		
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
		
		$this->data['results']=$this->admin_model->get_cities();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/topbar');
		$this->load->view('admin/cities/cities',$this->data);
		$this->load->view('admin/footer');
	}
	
	public function add_city()
	{
		
		$this->form_validation->set_rules('state_name', 'State Name', 'required',
			array('required' =>  keyword_value('you_must_select_state_name','You must select State Name.'))
		);
		$this->form_validation->set_rules('city_name', 'City Name', 'required',
			array('required' =>  keyword_value('you_must_enter_city_name','You must enter City Name.'))
		);
		
		
		  if ($this->form_validation->run() == FALSE)
		{
			
			$this->data['states']=$this->admin_model->get_states();
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/topbar');
			$this->load->view('admin/cities/add_city',$this->data);
			$this->load->view('admin/footer');
	
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
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_city_id($id);
	
			if($result['pk_city_id'])
				
				{
		
				$this->data['states']=$this->admin_model->get_states();
				$this->data['results']=$result;
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/topbar');
				$this->load->view('admin/cities/edit_city',$this->data);
				$this->load->view('admin/footer');
		
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
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/topbar');
		$this->load->view('admin/cities/edit_city',$this->data);
		$this->load->view('admin/footer');
		
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
		
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_city_id($id);
	
			if($result['pk_city_id'])
				
				{
		
		
				$this->data['results']=$result;
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/topbar');
				$this->load->view('admin/cities/delete_city',$this->data);
				$this->load->view('admin/footer');
		
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
		
		$this->data['results']=$this->admin_model->get_brands();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/topbar');
		$this->load->view('admin/brands/brands',$this->data);
		$this->load->view('admin/footer');
	}
	
	public function add_brand()
	{

		
		$this->form_validation->set_rules('brand_name', 'Brand Name', 'required',
			array('required' =>  keyword_value('you_must_enter_brand_name','You must Enter Brand Name.'))
		);
		
		
		
		  if ($this->form_validation->run() == FALSE)
		{
			
	
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/topbar');
			$this->load->view('admin/brands/add_brand');
			$this->load->view('admin/footer');
	
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
		$id=$this->input->post('id');
		if($id)
		{
			
			
			$result=$this->admin_model->check_brand_id($id);
	
			if($result['pk_brand_id'])
				
				{
		
				$this->data['results']=$result;
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/topbar');
				$this->load->view('admin/brands/edit_brand',$this->data);
				$this->load->view('admin/footer');
		
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
		
		$id=$this->input->post('id');
		if($id)
		{
			$this->load->library('upload');
			
		$this->form_validation->set_rules('brand_name', 'Brand Name', 'required',
			array('required' =>  keyword_value('you_must_enter_brand_name','You must Enter Brand Name.'))
		);
		
		 if ($this->form_validation->run() == FALSE)
		{
	
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/topbar');
		$this->load->view('admin/brands/edit_brand',$this->data);
		$this->load->view('admin/footer');
		
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
		
		$id=$this->input->post('id');
		if($id)
		{
			$result=$this->admin_model->check_brand_id($id);
	
			if($result['pk_brand_id'])
				
				{
		
		
				$this->data['results']=$result;
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/topbar');
				$this->load->view('admin/brands/delete_brand',$this->data);
				$this->load->view('admin/footer');
		
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
	
	
}
