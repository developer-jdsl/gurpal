<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
		public function __construct(){
		parent::__construct();
		 $this->load->model('home_model');
		
 	}
		 

	public function index()
	{
		$this->data['products']=$this->home_model->get_products();
		$this->data['banners']=$this->home_model->get_banners();
		$this->data['brands']=$this->home_model->get_banners_active();
		$this->data['advertisements']=$this->home_model->get_advertisements('home','left_sidebar');
		
		echo '<h1 align="center">Homepage</h1>';
		
	}
}
