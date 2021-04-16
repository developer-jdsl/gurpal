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
	
	
	public function brands()
	{
		$this->data['results']=$this->admin_model->get_banners();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/topbar');
		$this->load->view('admin/brands',$this->data);
		$this->load->view('admin/footer');
	}
	
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
	
	
	
}