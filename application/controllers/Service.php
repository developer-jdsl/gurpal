<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {
	
		public function __construct(){
		parent::__construct();
		 $this->load->model('service_model');
		 $this->load->model('home_model');
		 $this->load->library('Ajax_pagination');
		 $this->data['cities']			=	$this->home_model->get_cities();
		 construct_init();
		 $this->per_page=18;
		
 	}
		 
		function _remap($method,$args)
	{
    	    if (method_exists($this, $method))
        { 
            $this->$method($args);
        }
    	else
        { 
            $this->index($method,$args);
        }
     
    }
	
		public function index($slug,$args)
	{
		
		if($slug)
		{
		$city=@$args[0];
		$tmp=$this->data['service']			=	$this->home_model->get_service_by_slug($slug,$city);
		if($this->data['service'])
		{
		
		$this->data['gallery']			=	$this->home_model->get_service_gallery($tmp['pk_service_id']);
		$this->data['featured_services']=	$this->home_model->get_services();
		//$this->data['services']		=	$this->home_model->get_services();
		//$this->data['banners']		=	$this->home_model->get_banners();
		$this->data['brands']			=	$this->home_model->get_brands();
		$this->data['advertisements']	=	$this->home_model->get_advertisements('home','left_sidebar');
		$this->data['categories']		=	$this->home_model->get_service_cats();
		$this->data['title']			=   $tmp['meta_title']?$tmp['meta_title']:DEFAULT_TITLE;
		$this->data['meta_keywords']	=   $tmp['meta_keywords']?$tmp['meta_keywords']:DEFAULT_KEYWORDS;
		$this->data['meta_description']	=   $tmp['meta_description']?$tmp['meta_description']:DEFAULT_DESCRIPTION;
		
		$this->load->view('public/templates/header',$this->data);
		$this->load->view('public/templates/sidebar',$this->data);
		$this->load->view('public/single_service',$this->data);
		$this->load->view('public/templates/footer',$this->data);
		}
		else
		{
			show_404();
			
		}
		
		}
		else
		{
			show_404();
		}
		
		//	var_dump($this->session);
		
	}
	
	
	public function list($data)
	{
		$city=$category=$page=0;
		$order	=	$this->input->get('sort_by')?$this->input->get('sort_by'):false;
		$from 	= 	$this->input->get('price_from')?$this->input->get('price_from'):false;
		$to 	= 	$this->input->get('price_to')?$this->input->get('price_to'):false;
		if(count($data)==3)
		{
			$city=$data[0];
			$category=$data[1]?$data[1]:'all';
			$page=$data[2]?$data[2]:0;
			$data = array();
			
			//total rows count
			$totalRec = $this->service_model->get_rows_count($from,$to,$city,$category,$order,$this->per_page,$page);
			
			//pagination configuration
			$config['target']      = '#service_ajax_div';
			$config['base_url']    = base_url('service/ajax_list');
			$config['total_rows']  = $totalRec;
			$config['per_page']    = $this->per_page;
			$config['link_func']   = 'service_ajax';
			$this->ajax_pagination->initialize($config);
			$this->data['categories']		=	$this->home_model->get_service_cats();
			$this->data['services'] 		= 	$this->service_model->get_rows_service($from,$to,$city,$category,$order,$this->per_page,$page);
			$this->data['city'] 			=	$city;
			$this->data['category'] 		=	$category;
			$this->load->view('public/templates/header',$this->data);
			$this->load->view('public/templates/service_sidebar',$this->data);
			$this->load->view('public/services',$this->data);
			$this->load->view('public/templates/footer',$this->data);
			
			
		}
		

		
	}
	
	function ajax_list(){ 
     
	 
        $page = $this->input->post('page');
		$city = $this->input->post('city');
		$category = $this->input->post('category');
		$from = $this->input->post('from')?$this->input->post('from'):false;
		$to = $this->input->post('to')?$this->input->post('to'):false;
        if(!$page){ 
            $offset = 0; 
        }else{ 
            $offset = $page; 
        } 
         
        // Set conditions for search and filter  
        $sortBy = $this->input->post('sort_by'); 

       
         
        // Get record count 
   
        $totalRec = $this->service_model->get_rows_count($from,$to,$city,$category,false,$this->per_page);
			//pagination configuration
			$config['target']      = '#service_ajax_div';
			$config['base_url']    = base_url('service/ajax_list');
			$config['total_rows']  = $totalRec;
			$config['per_page']    = $this->per_page;
			$config['link_func']   = 'service_ajax';
			$this->ajax_pagination->initialize($config);
    	//$data['categories']		=	$this->home_model->get_service_cats();
        $this->data['services'] = $this->service_model->get_rows_service($from,$to,$city,$category,$sortBy,$this->per_page,$page); 
		$this->data['pagination'] = $this->ajax_pagination->create_links();
         
        // Load the data list view 
        $this->load->view('public/services_ajax', $this->data, false); 
    } 
	
		public function add_to_cart()
	
	{
		$cart_data=$cur_data=array();
		$html=$html_li="";
		$updated=0;
		$data['sid']=$this->input->post('service_id');
		$details=$this->service_model->get_variation_details($data,array('city'=>null,'search'=>null));
		if($details)
		{
			if($this->session->cart_data)
			{
				$cart_data=$this->session->cart_data;
				
				foreach($cart_data as $key=>$cd)
				{
					if($cd['item_pid']==$details['pk_pricing_id'] && $cd['item_type']=='service')
					{
						$cart_data[$key]['item_qty']=$cd['item_qty']+1;	
						$updated=1;
						
					}
					
				}
				
			}
			if($updated==0)
			{
				$cur_data['item_name']=$details['service_name'];
				$cur_data['item_slug']=base_url('city/'.$this->session->city.'/service/'.$details['service_slug']);
				$cur_data['item_image']=base_url('uploads/service/'.$details['service_banners']);
				$cur_data['item_type']='service';
				$cur_data['item_qty']=1;
				$cur_data['item_price']=($details['discount_price']>0)?$details['discount_price']:$details['original_price'];
				$cur_data['item_gstrate']=$details['gst_slab'];
				$gst=number_format((((intval($details['gst_slab']))/100)*$cur_data['item_price']), 2, '.', '');
				$cur_data['item_gstvalue']=$gst;
				$cur_data['item_pid']=$details['pk_pricing_id'];
				$cur_data['item_var']=$details['service_variation'];
				$cur_data['item_subvar']=$details['service_subvariation'];
				$cart_data[]=$cur_data;	
			
			}
			
			if($this->session->cart_data)
			{
				$this->session->cart_data=$cart_data;
			}
			else
			{
				$this->session->set_userdata('cart_data',$cart_data);
			}
			
			$html.='<ul class="shopping-cart-items">';
			foreach($cart_data as $item) {
            $html_li.= '<li>
						<a href="'.$item['item_slug'].'">
							<img src="'.$item['item_image'].'" alt="'.$item['item_name'].'" title="'.$item['item_name'].'">
							<h5>'.$item['item_name'].'</h5><span class="shopping-cart-item-price">₹'.($item['item_qty']*$item['item_price']).'(x'.$item['item_qty'].')</span>
						</a>
					</li>';
			}
                                      
              $html.=$html_li.' </ul>';
			  
			if($html_li)
			{
			$html.=' <ul class="list-inline text-center">
			<li><a href="'.base_url('cart').'"><i class="fa fa-shopping-cart"></i> View Cart</a></li>
			<li><a href="'.base_url('checkout').'"><i class="fa fa-check-square"></i> Checkout</a></li>
			</ul>';
			}
			
			echo $html;
			
		}
		else
		{
				echo 'fail';
		}
		
	}
	
	
	public function add_to_cart_list()
	
	{
		$cart_data=$cur_data=array();
		$html=$html_li="";
		$updated=0;
		$data['pid']=$this->input->post('pid');
		$details=$this->service_model->get_variation_detail($data,array('city'=>null,'search'=>null));
		if($details)
		{
			if($this->session->cart_data)
			{
				$cart_data=$this->session->cart_data;
				
				foreach($cart_data as $key=>$cd)
				{
					if($cd['item_pid']==$details['pk_pricing_id'] && $cd['item_type']=='service')
					{
						$cart_data[$key]['item_qty']=$cd['item_qty']+1;	
						$updated=1;
						
					}
					
				}
				
			}
			if($updated==0)
			{
					$cur_data['item_name']=$details['service_name'];
					$cur_data['item_slug']=base_url('city/'.$this->session->city.'/service/'.$details['service_slug']);
					$cur_data['item_image']=base_url('uploads/service/'.$details['service_banners']);
					$cur_data['item_type']='service';
					$cur_data['item_qty']=1;
					$cur_data['item_price']=($details['discount_price']>0)?$details['discount_price']:$details['original_price'];
					$cur_data['item_gstrate']=$details['gst_slab'];
					$gst=number_format((((intval($details['gst_slab']))/100)*$cur_data['item_price']), 2, '.', '');
					$cur_data['item_gstvalue']=$gst;
					$cur_data['item_pid']=$details['pk_pricing_id'];
					$cur_data['item_var']=$details['service_variation'];
					$cur_data['item_subvar']=$details['service_subvariation'];
					$cart_data[]=$cur_data;	
			
			}
			
			if($this->session->cart_data)
			{
				$this->session->cart_data=$cart_data;
			}
			else
			{
				$this->session->set_userdata('cart_data',$cart_data);
			}
			
			$html.='<ul class="shopping-cart-items">';
			foreach($cart_data as $item) {
            $html_li.= '<li>
						<a href="'.$item['item_slug'].'">
							<img src="'.$item['item_image'].'" alt="'.$item['item_name'].'" title="'.$item['item_name'].'">
							<h5>'.$item['item_name'].'</h5><span class="shopping-cart-item-price">₹'.($item['item_qty']*$item['item_price']).'(x'.$item['item_qty'].')</span>
						</a>
					</li>';
			}
                                      
              $html.=$html_li.' </ul>';
			  
			if($html_li)
			{
			$html.=' <ul class="list-inline text-center">
			<li><a href="'.base_url('cart').'"><i class="fa fa-shopping-cart"></i> View Cart</a></li>
			<li><a href="'.base_url('checkout').'"><i class="fa fa-check-square"></i> Checkout</a></li>
			</ul>';
			}
			
			echo $html;
			
		}
		else
		{
				echo 'fail';
		}
		
	}
	
	
	public function remove_from_cart()
	
	{
		$cart_data=$cur_data=array();
		$html=$html_li="";
		$updated=$subt=$gst=0;
		$data['pid']=$this->input->post('pid');
		$details=$this->service_model->get_variation_detail($data,array('city'=>null,'search'=>null));
		$st=array('status'=>'fail','html'=>'','subtotal'=>0,'gst'=>0,'gtotal'=>0,'shipping'=>0);
		if($details)
		{
			if($this->session->cart_data)
			{
				$cart_data=$this->session->cart_data;
				
				foreach($cart_data as $key=>$cd)
				{
					if($cd['item_pid']==$data['pid'] && $cd['item_type']=='service')
					{
						unset($cart_data[$key]);
		
					}
					
				}
				
			}
			
			if($this->session->cart_data)
			{
				$this->session->cart_data=$cart_data;
				$st['status']='success';
			}
			else
			{
				$this->session->set_userdata('cart_data',$cart_data);
			}
			
			$html.='<ul class="shopping-cart-items">';
			foreach($cart_data as $item) {
            $html_li.= '<li>
						<a href="'.$item['item_slug'].'">
							<img src="'.$item['item_image'].'" alt="'.$item['item_name'].'" title="'.$item['item_name'].'">
							<h5>'.$item['item_name'].'</h5><span class="shopping-cart-item-price">₹'.($item['item_qty']*$item['item_price']).'(x'.$item['item_qty'].')</span>
						</a>
					</li>';
					$subt=$subt+($item['item_price']*$item['item_qty']);
				    $gst=$gst+($item['item_gstvalue']*$item['item_qty']);
			}
                                      
              $html.=$html_li.' </ul>';
			  
			if($html_li)
			{
			$html.=' <ul class="list-inline text-center">
			<li><a href="'.base_url('cart').'"><i class="fa fa-shopping-cart"></i> View Cart</a></li>
			<li><a href="'.base_url('checkout').'"><i class="fa fa-check-square"></i> Checkout</a></li>
			</ul>';
			}
			
			$st['html']=$html;
			$st['gst']=$gst;
			$st['subtotal']=$subt;
			$st['gtotal']=$st['gst']+$st['subtotal'];
			
		
		}
		
			echo json_encode($st);
	}
	

	
	
	
}
