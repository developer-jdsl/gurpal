<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
		public function __construct(){
		parent::__construct();
		 $this->load->model('home_model');
		 $this->data['cities']			=	$this->home_model->get_cities();
		 construct_init();
 	}
		 

	public function home2()
	{
		$this->data['products']			=	$this->home_model->get_products();
		$this->data['banners']			=	$this->home_model->get_banners();
		$this->data['brands']			=	$this->home_model->get_brands();
		$this->data['advertisements']	=	$this->home_model->get_advertisements('home','left_sidebar');
		
		
		$this->load->view('frontend/templates/header');
		$this->load->view('frontend/home');
		$this->load->view('frontend/templates/sidebar');
		$this->load->view('frontend/templates/footer');
		
		//	var_dump($this->session);
		
	}
	
	
		public function index()
	{
	
		$this->data['products']			=	$this->home_model->get_products();
		$this->data['services']			=	$this->home_model->get_services();
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
	
	
	public function cart()
	{
		$this->data['cart']				=	get_cart_data();
		$this->data['title']			=   DEFAULT_TITLE;
		$this->data['meta_keywords']	=   DEFAULT_KEYWORDS;
		$this->data['meta_description']	=   DEFAULT_DESCRIPTION;
		$this->load->view('public/templates/header',$this->data);
		$this->load->view('public/cart',$this->data);
		$this->load->view('public/templates/footer',$this->data);

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
	
	
	
	
}
