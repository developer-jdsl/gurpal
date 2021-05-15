<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
	
	function get_products($limit=false,$dt=false)
	{
		$this->db->select('p.*,pp.*,pc.category_name,pc.pk_category_id,b.brand_name,a.admin_name,c.color_name,c.color_value,s.size_name,s.size_value');
        $this->db->from('tbl_products as p');
		$this->db->join('tbl_product_pricing as pp','p.pk_product_id=pp.fk_product_id','left');
		$this->db->join('tbl_size as s','s.pk_size_id=pp.fk_size_id','left');
		$this->db->join('tbl_color as c','c.pk_color_id=pp.fk_color_id','left');
		$this->db->join('tbl_product_category as pc','p.product_category=pc.pk_category_id','left');
		$this->db->join('tbl_brands as b','p.product_brand=b.pk_brand_id','left');
		$this->db->join('tbl_admin as a','p.fk_admin_id=a.pk_admin_id','left');
		$this->db->where(array('p.active'=>1,'p.is_deleted'=>0));
		
		if(@$dt['search'])
		{
			$this->db->group_start();
			$this->db->like('p.product_name', $dt['search'], 'before'); 
			$this->db->or_like('p.product_name', $dt['search'], 'after'); 
			$this->db->or_like('p.product_name', $dt['search'], 'both'); 
			$this->db->or_like('p.product_name', $dt['search'], 'none'); 
			$this->db->group_end();
		}
		if($limit)
			{
				$this->db->limit($limit);
			}
		
		$records=$this->db->get();
		if($records->num_rows()>0)
		{
			return $records->result_array();
		}
		
		return false;
		
	}
	
		function get_related_products($limit=5,$cat_id,$pro_id)
	{
		$this->db->select('p.*,pp.*,pc.category_name,b.brand_name,a.admin_name,c.color_name,c.color_value,s.size_name,s.size_value');
        $this->db->from('tbl_products as p');
		$this->db->join('tbl_product_pricing as pp','p.pk_product_id=pp.fk_product_id','left');
		$this->db->join('tbl_size as s','s.pk_size_id=pp.fk_size_id','left');
		$this->db->join('tbl_color as c','c.pk_color_id=pp.fk_color_id','left');
		$this->db->join('tbl_product_category as pc','p.product_category=pc.pk_category_id','left');
		$this->db->join('tbl_brands as b','p.product_brand=b.pk_brand_id','left');
		$this->db->join('tbl_admin as a','p.fk_admin_id=a.pk_admin_id','left');
		$this->db->where(array('p.active'=>1,'p.is_deleted'=>0,'pc.pk_category_id'=>$cat_id,'p.pk_product_id!='=>$pro_id));
		

		if($limit)
			{
				$this->db->limit($limit);
			}
		
		$records=$this->db->get();
		if($records->num_rows()>0)
		{
			return $records->result_array();
		}
		
		return false;
		
	}
	
	function get_product_by_slug($slug)
	{
		
	$this->db->select('p.*,pp.*,pc.category_name,pc.pk_category_id,b.brand_name,a.admin_name,c.color_name,c.color_value,s.size_name,s.size_value');
        $this->db->from('tbl_products as p');
		$this->db->join('tbl_product_pricing as pp','p.pk_product_id=pp.fk_product_id','left');
		$this->db->join('tbl_size as s','s.pk_size_id=pp.fk_size_id','left');
		$this->db->join('tbl_color as c','c.pk_color_id=pp.fk_color_id','left');
		$this->db->join('tbl_product_category as pc','p.product_category=pc.pk_category_id','left');
		$this->db->join('tbl_brands as b','p.product_brand=b.pk_brand_id','left');
		$this->db->join('tbl_admin as a','p.fk_admin_id=a.pk_admin_id','left');
		$this->db->where(array('p.active'=>1,'p.is_deleted'=>0,'p.product_slug'=>$slug));
		$records=$this->db->get();
		if($records->num_rows()>0)
		{
			return $records->row_array();
		}
		
		return false;	
		
	}
	
	
	function get_product_gallery($id)
	{
		$this->db->select('pp.*,c.color_name,c.color_value,s.size_name,s.size_value');
	    $this->db->from('tbl_product_pricing as pp');
		$this->db->join('tbl_size as s','s.pk_size_id=pp.fk_size_id','left');
		$this->db->join('tbl_color as c','c.pk_color_id=pp.fk_color_id','left');	
		$this->db->where(array('pp.fk_product_id'=>$id));
		$records=$this->db->get();
	
		if($records->num_rows())
		{
			return $records->result_array();
		}
		
		return false;	
		
	}
	
	
	function get_services($limit=false,$dt=false)
	{
		$cdata=get_city_state_id($this->session->city);
		
		$this->db->select('s.*,b.category_name,p.*,ap.profile_states,ap.profile_cities');
        $this->db->from('tbl_services as s');
		$this->db->join('tbl_service_pricing as p','s.pk_service_id=p.fk_service_id','inner');
		$this->db->join('tbl_business_category as b','s.service_category=b.pk_category_id','left');
		$this->db->join('tbl_admin as a','s.fk_admin_id=a.pk_admin_id','left');
		$this->db->join('tbl_admin_profile as ap','ap.fk_admin_id=a.pk_admin_id','left');
		$this->db->where(array('s.active'=>1,'s.is_deleted'=>0,'p.is_default'=>1));
			$this->db->group_start();
				
				  if(@$cdata['sid'] && @$cdata['cid'])
				 {
					$this->db->like('ap.profile_states',$cdata['sid'], 'before');   
					$this->db->or_like('ap.profile_states',$cdata['sid'], 'after');   
					$this->db->or_like('ap.profile_states', $cdata['sid'], 'none');    
					$this->db->or_like('ap.profile_states',$cdata['sid'], 'both');  
					
					if(@$dt['city'])
						{
						$this->db->or_like('ap.profile_cities',$dt['city'], 'before');   
						  $this->db->or_like('ap.profile_cities',$dt['city'], 'after');   
						  $this->db->or_like('ap.profile_cities', $dt['city'], 'none');    
						  $this->db->or_like('ap.profile_cities',$dt['city'], 'both');   	
							
						}
						else
						{
						 $this->db->or_like('ap.profile_cities',$cdata['cid'], 'before');   
						  $this->db->or_like('ap.profile_cities',$cdata['cid'], 'after');   
						  $this->db->or_like('ap.profile_cities', $cdata['cid'], 'none');    
						  $this->db->or_like('ap.profile_cities',$cdata['cid'], 'both');   
						}
				 }
				 
				 else  if(@$cdata['sid'] && !@$cdata['cid'])
				 {
					$this->db->like('ap.profile_states',$cdata['sid'], 'before');   
					$this->db->or_like('ap.profile_states',$cdata['sid'], 'after');   
					$this->db->or_like('ap.profile_states', $cdata['sid'], 'none');    
					$this->db->or_like('ap.profile_states',$cdata['sid'], 'both');  
				 }
				 else if(!@$cdata['sid'] && @$cdata['cid'])
					 
					 {
						if(@$dt['city'])
						{
						$this->db->like('ap.profile_cities',$dt['city'], 'before');   
						  $this->db->or_like('ap.profile_cities',$dt['city'], 'after');   
						  $this->db->or_like('ap.profile_cities', $dt['city'], 'none');    
						  $this->db->or_like('ap.profile_cities',$dt['city'], 'both');   	
							
						}
						else
						{
						 $this->db->like('ap.profile_cities',$cdata['cid'], 'before');   
						  $this->db->or_like('ap.profile_cities',$cdata['cid'], 'after');   
						  $this->db->or_like('ap.profile_cities', $cdata['cid'], 'none');    
						  $this->db->or_like('ap.profile_cities',$cdata['cid'], 'both');   
						}
						 
					 }
			$this->db->group_end();
			
			
			
			if(@$dt['search'])
		{
			$this->db->group_start();
			$this->db->like('s.service_name', $dt['search'], 'before'); 
			$this->db->or_like('s.service_name', $dt['search'], 'after'); 
			$this->db->or_like('s.service_name', $dt['search'], 'both'); 
			$this->db->or_like('s.service_name', $dt['search'], 'none'); 
			$this->db->group_end();
		}
			if($limit)
			{
				$this->db->limit($limit);
			}
			
		$records=$this->db->get();
		if($records->num_rows()>0)
		{
			return $records->result_array();
		}
		
		return false;
	}
	
		function get_related_services($limit=5,$cat_id,$ser_id)
	{
		$cdata=get_city_state_id($this->session->city);
		
		$this->db->select('s.*,b.category_name,p.*,ap.profile_states,ap.profile_cities');
        $this->db->from('tbl_services as s');
		$this->db->join('tbl_service_pricing as p','s.pk_service_id=p.fk_service_id','inner');
		$this->db->join('tbl_business_category as b','s.service_category=b.pk_category_id','left');
		$this->db->join('tbl_admin as a','s.fk_admin_id=a.pk_admin_id','left');
		$this->db->join('tbl_admin_profile as ap','ap.fk_admin_id=a.pk_admin_id','left');
		$this->db->where(array('s.active'=>1,'s.is_deleted'=>0,'p.is_default'=>1,'b.pk_category_id'=>$cat_id,'s.pk_service_id!='=>$ser_id));
			$this->db->group_start();
				
				  if(@$cdata['sid'] && @$cdata['cid'])
				 {
					$this->db->like('ap.profile_states',$cdata['sid'], 'before');   
					$this->db->or_like('ap.profile_states',$cdata['sid'], 'after');   
					$this->db->or_like('ap.profile_states', $cdata['sid'], 'none');    
					$this->db->or_like('ap.profile_states',$cdata['sid'], 'both');  
					$this->db->or_like('ap.profile_cities',$cdata['cid'], 'before');   
					$this->db->or_like('ap.profile_cities',$cdata['cid'], 'after');   
					$this->db->or_like('ap.profile_cities', $cdata['cid'], 'none');    
					$this->db->or_like('ap.profile_cities',$cdata['cid'], 'both');  
				 }
				 
				 else  if(@$cdata['sid'] && !@$cdata['cid'])
				 {
					$this->db->like('ap.profile_states',$cdata['sid'], 'before');   
					$this->db->or_like('ap.profile_states',$cdata['sid'], 'after');   
					$this->db->or_like('ap.profile_states', $cdata['sid'], 'none');    
					$this->db->or_like('ap.profile_states',$cdata['sid'], 'both');  
				 }
				 else if(!@$cdata['sid'] && @$cdata['cid'])
					 
					 {
						
						 $this->db->like('ap.profile_cities',$cdata['cid'], 'before');   
						  $this->db->or_like('ap.profile_cities',$cdata['cid'], 'after');   
						  $this->db->or_like('ap.profile_cities', $cdata['cid'], 'none');    
						  $this->db->or_like('ap.profile_cities',$cdata['cid'], 'both');   
						
						 
					 }
			$this->db->group_end();
			
	
			if($limit)
			{
				$this->db->limit($limit);
			}
			
		$records=$this->db->get();
		if($records->num_rows()>0)
		{
			return $records->result_array();
		}
		
		return false;
	}
	
	function get_service_by_slug($slug,$city)
	{
		$cdata=get_city_state_id($city);
		$this->db->select('s.*,b.category_name,b.pk_category_id,p.*,ap.profile_states,ap.profile_cities');
        $this->db->from('tbl_services as s');
		$this->db->join('tbl_service_pricing as p','s.pk_service_id=p.fk_service_id','inner');
		$this->db->join('tbl_business_category as b','s.service_category=b.pk_category_id','left');
		$this->db->join('tbl_admin as a','s.fk_admin_id=a.pk_admin_id','left');
		$this->db->join('tbl_admin_profile as ap','ap.fk_admin_id=a.pk_admin_id','left');
		$this->db->where(array('s.active'=>1,'s.is_deleted'=>0,'s.service_slug'=>$slug));
		
		$this->db->group_start();
				
				  if(@$cdata['sid'] && @$cdata['cid'])
				 {
				  $this->db->like('ap.profile_states',$cdata['sid'], 'before');   
				  $this->db->or_like('ap.profile_states',$cdata['sid'], 'after');   
				  $this->db->or_like('ap.profile_states', $cdata['sid'], 'none');    
				  $this->db->or_like('ap.profile_states',$cdata['sid'], 'both');  
					$this->db->or_like('ap.profile_cities',$cdata['cid'], 'before');  
					$this->db->or_like('ap.profile_cities',$cdata['cid'], 'after');  
					$this->db->or_like('ap.profile_cities',$cdata['cid'], 'none');  
					$this->db->or_like('ap.profile_cities',$cdata['cid'], 'both');  
				 }
				 
				 else  if(@$cdata['sid'] && !@$cdata['cid'])
				 {
				  $this->db->like('ap.profile_states',$cdata['sid'], 'before');   
				  $this->db->like('ap.profile_states',$cdata['sid'], 'after');   
				  $this->db->like('ap.profile_states', $cdata['sid'], 'none');    
				  $this->db->like('ap.profile_states',$cdata['sid'], 'both');  
				 }
				 else if(!@$cdata['sid'] && @$cdata['cid'])
					 
					 {
				 $this->db->like('ap.profile_cities',$cdata['sid'], 'before');   
				  $this->db->like('ap.profile_cities',$cdata['sid'], 'after');   
				  $this->db->like('ap.profile_cities', $cdata['sid'], 'none');    
				  $this->db->like('ap.profile_cities',$cdata['sid'], 'both');   
						 
					 }
			$this->db->group_end();
			
		$records=$this->db->get();
		if($records->num_rows()>0)
		{
			return $records->row_array();
		}
		
		return false;	
		
	}
	
	
	function get_service_gallery($id)
	{
		$this->db->select('s.*');
	    $this->db->from('tbl_service_pricing as s');
		$this->db->where(array('s.fk_service_id'=>$id));
		$records=$this->db->get();
	
		if($records->num_rows())
		{
			return $records->result_array();
		}
		
		return false;	
		
	}
	
	
	function get_banners($type=null)
	{
		$where=array('active'=>1);
		if($type)
		{
			$where['banner_placement']=$type;
		}
		$records=$this->db->get_where('tbl_banners',$where);
	
		if($records->num_rows()>0)
		{
			return $records->result_array();
		}
		
		return false;	 
		
	}
	
	function get_brands()
	{
		
		$records=$this->db->get_where('tbl_brands',array('active'=>1));
		if($records->num_rows()>0)
		{
			return $records->result_array();
		}
		
		return false;
		
	}
	
	function get_advertisements($page=null,$section=null,$location=null,$category=null)
	{
		$time=time();
		$this->db->select('*');
		$this->db->from('tbl_advertisement');
		$this->db->where(array('active'=>1,'start_time>'=>$time,'end_time<'=>$time,'is_deleted'=>0));
		if($page)
		{
			$this->db->where('display_page',$page);	
		}
		
		if($section)
		{
			$this->db->where('display_section',$page);	
		}
		
		$records=$this->db->get();
		if($records->num_rows()>0)
		{
			return $records->result_array();
		}
		
		return false;
		
	}
	
	
	
		function get_service_cats()
	{
		$results=$this->db->get_where('tbl_business_category',array('active'=>1,'is_deleted'=>0));
		if($results)
		{
			return $results->result_array();
		}
		return false;
	}
	
		function get_product_cats()
	{
		$results=$this->db->get_where('tbl_product_category',array('active'=>1,'is_deleted'=>0));
		if($results)
		{
			return $results->result_array();
		}
		return false;
	}
	
	function get_cities()
	{
		$results=$this->db->get_where('tbl_cities',array('active'=>1,'is_deleted'=>0));
		if($results)
		{
			return $results->result_array();
		}
		return false;
	}
	
	
	function set_city($city)
	
	{
		if($this->session->city)
		{
			$this->session->city=$city;
		}
		
		else
			{
				$this->session->set_userdata('city',$city);
				
			}
	}
   
   function is_valid_city($city)
   {
	 $res=$this->db->get_where('tbl_cities',array('city_slug'=>$city,'active'=>1));  
	 if($res)
	 {
		 $res=$res->row_array();
		 if($res['pk_city_id'])
		 {
			 return $res;
		 }
		 
	 }
	  return false; 
   }
   
   function get_user_profile()
   {
	$res=$this->db->get_where('tbl_user',array('pk_user_id'=>$this->session->front_user_id,'active'=>1));  
	 if($res)
	 {
		 $res=$res->row_array();
		 if($res['pk_user_id'])
		 {
			 return $res;
		 }
		 
	 }
	  return false;    
   }
   
      function get_user_addresses()
   {
	   $this->db->select('up.*,c.pk_city_id,c.city_name,s.pk_state_id,s.state_name');
	   $this->db->from('tbl_user_profile as up');
	   $this->db->join('tbl_states as s','up.profile_state=s.pk_state_id','inner');
	   $this->db->join('tbl_cities as c','up.profile_city=c.pk_city_id','inner');
	   $this->db->where('up.fk_user_id',$this->session->front_user_id);
		$res=$this->db->get();  
	 if($res)
	 {
		 $res=$res->result_array();
		 if($res)
		 {
			 return $res;
		 }
		 
	 }
	  return false;    
   }
   
   
   function update_profile($data)
   {
	   $this->db->where(array('pk_user_id'=>$this->session->front_user_id));
	   return $this->db->update('tbl_user',$data);
   }
   
   function profile_check_email($data)
   {
	  $this->db->select('pk_user_id');
	  $this->db->from('tbl_user');
	  $this->db->where('pk_user_id!=',$this->session->front_user_id);
	  $this->db->where('user_email=',$data['user_email']);
	  $res=$this->db->get();
	  if($res)
	  {
		  $res=$res->row_array();
		  if($res['pk_user_id'])
		  {
			  return false;
			  
		  }
		  else
		  {
			  return true;
		  }
		  
		  
	  }
	  
	  return false;
	   
   }
   
   function get_states()
   {
	   $res=$this->db->get_where('tbl_states',array('active'=>1,'is_deleted'=>0));
	   if($res)
	   {
		   return $res->result_array();
	   }
	   return false;
   }
   

   
      function profile_check_phone($data)
   {
	  $this->db->select('pk_user_id');
	  $this->db->from('tbl_user');
	  $this->db->where('pk_user_id!=',$this->session->front_user_id);
	  $this->db->where('user_phone=',$data['user_phone']);
	  $res=$this->db->get();
	  if($res)
	  {
		  $res=$res->row_array();
		  if($res['pk_user_id'])
		  {
			  return false;
			  
		  }
		  else
		  {
			  return true;
		  }
		  
		  
	  }
	  
	  return false;
	   
   }
   
   function add_address($data)
   {
	   if($data['is_default']==1)
	   {
		   $this->db->where('fk_user_id',$this->session->front_user_id);
		   $this->db->update('tbl_user_profile',array('is_default'=>0));

		  
	   }
	   
	    return $this->db->insert('tbl_user_profile',$data);
	   
   }
   
      function edit_address($id,$data)
   {
	   if($data['is_default']==1)
	   {
		   $this->db->where('fk_user_id',$this->session->front_user_id);
		   $this->db->update('tbl_user_profile',array('is_default'=>0));
		   
			
	   }
	   $this->db->where('pk_profile_id',$id);
		   return $this->db->update('tbl_user_profile',$data);
	   
   }
   
   function get_payment_methods()
   {
	   
	  $res=$this->db->get_where('tbl_payment_method',array('active'=>1));
	   if($res)
	   {
		   return $res->result_array();
	   }
	   return false; 
   }
	function add_user_address($data2)
	{
		$this->db->insert('tbl_user_profile',$data2);
		$id=$this->db->insert_id();
	   if($id)
	   {
		return $id;
	   }
	   
	   return null;
		
	}
	
	function add_user_order($data)
	{
		$this->db->insert('tbl_orders',$data);
		$id=$this->db->insert_id();
	   if($id)
	   {
		return $id;
	   }
	   
	   return null;
		
	}
	
	function generate_order_id($id)
	{
		$oid='OR-'.sprintf("%06d", $id);
		return $this->db->update('tbl_orders',array('order_number'=>$oid),array('pk_order_id'=>$id));
		
	}
	
	function add_order_details($data)
	{
		$this->db->insert_batch('tbl_order_details',$data);
	}
	
	
	function get_user_orders()
	{
		
		$res=$this->db->get_where('tbl_orders',array('fk_user_id'=>$this->session->front_user_id));
		 if($res)
	   {
		   return $res->result_array();
	   }
	   return false; 
	
	}
	
		   function get_order_details_frontend($id=false)
   {
	   if($id)
	   {
		 
			$this->db->select('o.*,od.*,p.product_name,c.color_name,ps.size_name,s.service_name,sp.service_variation,sp.service_subvariation,CONCAT(u.user_firstname," ",u.user_lastname) AS user,u.user_email');	  
			$this->db->from('tbl_orders as o');
			$this->db->join('tbl_order_details as od','o.pk_order_id=od.fk_order_id','inner');
			$this->db->join('tbl_product_pricing as pp','pp.pk_price_id=od.fk_pricing_id and od.order_type="product"','left');
			$this->db->join('tbl_products as p','p.pk_product_id=pp.fk_product_id and od.order_type="product"','left');
			$this->db->join('tbl_color as c','pp.fk_color_id=c.pk_color_id and od.order_type="product"','left');
			$this->db->join('tbl_size as ps','pp.fk_size_id=ps.pk_size_id and od.order_type="product"','left');
			$this->db->join('tbl_service_pricing as sp','sp.pk_pricing_id=od.fk_pricing_id and od.order_type="service"','left');
			$this->db->join('tbl_services as s','s.pk_service_id=sp.fk_service_id and od.order_type="service"','left');
			$this->db->join('tbl_user as u','o.fk_user_id=u.pk_user_id','inner');	
			$this->db->where(array('o.order_number'=>$id,'u.pk_user_id'=>$this->session->front_user_id));
			 $query = $this->db->get();
			return $query->result_array();
		   
	   }
	   return false;
   }
	
	   function get_order_details($id=false)
   {
	   if($id)
	   {
		 
			$this->db->select('o.*,od.*,p.product_name,c.color_name,ps.size_name,s.service_name,sp.service_variation,sp.service_subvariation,CONCAT(u.user_firstname," ",u.user_lastname) AS user,u.user_email');	  
			$this->db->from('tbl_orders as o');
			$this->db->join('tbl_order_details as od','o.pk_order_id=od.fk_order_id','inner');
			$this->db->join('tbl_product_pricing as pp','pp.pk_price_id=od.fk_pricing_id and od.order_type="product"','left');
			$this->db->join('tbl_products as p','p.pk_product_id=pp.fk_product_id and od.order_type="product"','left');
			$this->db->join('tbl_color as c','pp.fk_color_id=c.pk_color_id and od.order_type="product"','left');
			$this->db->join('tbl_size as ps','pp.fk_size_id=ps.pk_size_id and od.order_type="product"','left');
			$this->db->join('tbl_service_pricing as sp','sp.pk_pricing_id=od.fk_pricing_id and od.order_type="service"','left');
			$this->db->join('tbl_services as s','s.pk_service_id=sp.fk_service_id and od.order_type="service"','left');
			$this->db->join('tbl_user as u','o.fk_user_id=u.pk_user_id','inner');	
			$this->db->where('o.pk_order_id',$id);
			 $query = $this->db->get();
			return $query->result_array();
		   
	   }
	   return false;
   }
   	   function get_order_admin($id=false)
   {
	   if($id)
	   {
		 
			$this->db->select('o.order_number,o.pk_order_id,od.fk_admin_id');	  
			$this->db->from('tbl_orders as o');
			$this->db->join('tbl_order_details as od','o.pk_order_id=od.fk_order_id','inner');	
			$this->db->where('o.pk_order_id',$id);
			 $query = $this->db->get();
			return $query->result_array();
		   
	   }
	   return false;
   }
   
   	   function get_order_details_admin($id=false,$aid=false)
   {
	   if($id && $aid)
	   {
		 
			$this->db->select('o.*,od.*,p.product_name,c.color_name,ps.size_name,s.service_name,sp.service_variation,sp.service_subvariation,CONCAT(u.user_firstname," ",u.user_lastname) AS user,u.user_email');	  
			$this->db->from('tbl_orders as o');
			$this->db->join('tbl_order_details as od','o.pk_order_id=od.fk_order_id','inner');
			$this->db->join('tbl_product_pricing as pp','pp.pk_price_id=od.fk_pricing_id and od.order_type="product"','left');
			$this->db->join('tbl_products as p','p.pk_product_id=pp.fk_product_id and od.order_type="product"','left');
			$this->db->join('tbl_color as c','pp.fk_color_id=c.pk_color_id and od.order_type="product"','left');
			$this->db->join('tbl_size as ps','pp.fk_size_id=ps.pk_size_id and od.order_type="product"','left');
			$this->db->join('tbl_service_pricing as sp','sp.pk_pricing_id=od.fk_pricing_id and od.order_type="service"','left');
			$this->db->join('tbl_services as s','s.pk_service_id=sp.fk_service_id and od.order_type="service"','left');
			$this->db->join('tbl_user as u','o.fk_user_id=u.pk_user_id','inner');	
			$this->db->where(array('o.pk_order_id'=>$id,'od.fk_admin_id'=>$aid));
			 $query = $this->db->get();
			return $query->result_array();
		   
	   }
	   return false;
   }
   	
}
   

   