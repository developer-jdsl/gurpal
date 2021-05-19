<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check extends CI_Controller {
	
		public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
		 $this->data['cities']			=	$this->home_model->get_cities();
		 construct_init();
		
 	}

	
		public function index($slug)
	{
		
		if($slug)
		{
			$get=$this->db->get_where('tbl_pages',array('page_slug'=>$slug,'active'=>1,'is_deleted'=>0));
			if($get)
			{
			 $get=$get->row_array();
			 $this->data['products']			=	$this->home_model->get_products(6);
			$this->data['services']			=	$this->home_model->get_services(6);
			$this->data['banners']			=	$this->home_model->get_banners();
			$this->data['brands']			=	$this->home_model->get_brands();
			$this->data['advertisements']	=	$this->home_model->get_advertisements('home','left_sidebar');
			$this->data['categories']		=	$this->home_model->get_service_cats();
			$this->data['pro_categories']	=	$this->home_model->get_product_cats();
			$this->data['title']			=   $get['meta_title'];
			$this->data['meta_keywords']	=   $get['meta_keywords'];
			$this->data['meta_description']	=   $get['meta_description'];
			$this->data['content']			=   $get['page_content'];
			
			$this->load->view('public/templates/header',$this->data);
			//$this->load->view('public/templates/sidebar',$this->data);
			$this->load->view('public/page',$this->data);
			$this->load->view('public/templates/footer',$this->data);
			 
				
			}
			
			else
			
			{
				show_404();
			}
		
	
		}
		
		
	}
}
