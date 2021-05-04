<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
	
	function get_products($limit=false)
	{
		$this->db->select('p.*,pp.*,pc.category_name,b.brand_name,a.admin_name,c.color_name,c.color_value,s.size_name,s.size_value');
        $this->db->from('tbl_products as p');
		$this->db->join('tbl_product_pricing as pp','p.pk_product_id=pp.fk_product_id','left');
		$this->db->join('tbl_size as s','s.pk_size_id=pp.fk_size_id','left');
		$this->db->join('tbl_color as c','c.pk_color_id=pp.fk_color_id','left');
		$this->db->join('tbl_product_category as pc','p.product_category=pc.pk_category_id','left');
		$this->db->join('tbl_brands as b','p.product_brand=b.pk_brand_id','left');
		$this->db->join('tbl_admin as a','p.fk_admin_id=a.pk_admin_id','left');
		$this->db->where(array('p.active'=>1,'p.is_deleted'=>0));
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
		
	$this->db->select('p.*,pp.*,pc.category_name,b.brand_name,a.admin_name,c.color_name,c.color_value,s.size_name,s.size_value');
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
	
	
	function get_services($limit=false)
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
					$this->db->or_like('ap.profile_cities',$cdata['cid'], 'before');  
					$this->db->or_like('ap.profile_cities',$cdata['cid'], 'after');  
					$this->db->or_like('ap.profile_cities',$cdata['cid'], 'none');  
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
				 $this->db->like('ap.profile_cities',$cdata['sid'], 'before');   
				  $this->db->or_like('ap.profile_cities',$cdata['sid'], 'after');   
				  $this->db->or_like('ap.profile_cities', $cdata['sid'], 'none');    
				  $this->db->or_like('ap.profile_cities',$cdata['sid'], 'both');   
						 
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
		$this->db->select('s.*,b.category_name,p.*,ap.profile_states,ap.profile_cities');
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
	
	
}
   

   