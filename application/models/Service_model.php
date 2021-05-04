<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
	
	function get_variation_details($data)
	{
		$this->db->select('s.*,p.*,b.category_name,g.gst_slab');
        $this->db->from('tbl_services as s');
		$this->db->join('tbl_service_pricing as p','s.pk_service_id=p.fk_service_id','inner');
		$this->db->join('tbl_business_category as b','s.service_category=b.pk_category_id','left');
		$this->db->join('tbl_gst as g','s.fk_gst_id=g.pk_gst_id','left');
		$this->db->where(array('s.active'=>1,'s.is_deleted'=>0,'p.fk_service_id'=>$data['sid']));
		$records=$this->db->get();
		if($records->num_rows()>0)
		{
			return $records->row_array();
		}
		
		return false;	
		
		
	}
	
	function get_variation_detail($data)
	{
		
		$this->db->select('s.*,p.*,b.category_name,g.gst_slab');
        $this->db->from('tbl_services as s');
		$this->db->join('tbl_service_pricing as p','s.pk_service_id=p.fk_service_id','inner');
		$this->db->join('tbl_business_category as b','s.service_category=b.pk_category_id','left');
		$this->db->join('tbl_gst as g','s.fk_gst_id=g.pk_gst_id','left');
		$this->db->where(array('s.active'=>1,'s.is_deleted'=>0,'p.pk_pricing_id'=>$data['pid']));
		$records=$this->db->get();
		if($records->num_rows()>0)
		{
			return $records->row_array();
		}
		
		return false;
		
	}
	
	
	function get_rows_count($from=false,$to=false,$city,$category,$order_by=false,$limit=false,$page=false)
	{
		$cdata=get_city_state_id($city);
		$service_cat=get_service_category_slug($category);
		$this->db->select('COUNT(pk_service_id) as count');
        $this->db->from('tbl_services as s');
		$this->db->join('tbl_service_pricing as p','s.pk_service_id=p.fk_service_id','inner');
		$this->db->join('tbl_business_category as b','s.service_category=b.pk_category_id','left');
		$this->db->join('tbl_admin as a','s.fk_admin_id=a.pk_admin_id','left');
		$this->db->join('tbl_admin_profile as ap','ap.fk_admin_id=a.pk_admin_id','left');
		$this->db->where(array('s.active'=>1,'s.is_deleted'=>0,'p.is_default'=>1));
		if($from && $to)
			{
				$this->db->group_start();
				$this->db->where('p.original_price>=',$from);
				$this->db->or_where('p.discount_price>=',$from);
				$this->db->group_end();
				
				$this->db->group_start();
				$this->db->where('p.original_price<=',$to);
				$this->db->or_where('p.discount_price<=',$to);
				$this->db->group_end();
			}
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
			if($service_cat)
			{
			$this->db->group_start();
					$this->db->like('b.pk_category_id',$service_cat['pk_category_id'], 'before');   
					$this->db->or_like('b.pk_category_id',$service_cat['pk_category_id'], 'after');   
					$this->db->or_like('b.pk_category_id', $service_cat['pk_category_id'], 'none');    
					$this->db->or_like('b.pk_category_id',$service_cat['pk_category_id'], 'both');  
			
			$this->db->group_end();
	
			}
			
			if($order_by)
			{
				if($order_by=='name')
				{
					
					$this->db->order_by('s.service_name','ASC');
				}
				else if($order_by=='price')
				{

						$this->db->order_by('p.discount_price', 'ASC');
						$this->db->order_by('p.original_price', 'ASC');
				}
				
			
			}
			
			if(($page+1))
			{
				$this->db->limit($limit,($limit*$page));
				
			}
			
			$records=$this->db->get();

		if($records)
		{
			$records=$records->row_array();
			return $records['count'];
		}
		
		return false;


	}
	
		function get_rows_service($from=false,$to=false,$city,$category,$order_by=false,$limit=false,$page=false)
	{
		$cdata=get_city_state_id($city);
		$service_cat=get_service_category_slug($category);
		$this->db->select('s.*,b.category_name,p.*,ap.profile_states,ap.profile_cities');
        $this->db->from('tbl_services as s');
		$this->db->join('tbl_service_pricing as p','s.pk_service_id=p.fk_service_id','inner');
		$this->db->join('tbl_business_category as b','s.service_category=b.pk_category_id','left');
		$this->db->join('tbl_admin as a','s.fk_admin_id=a.pk_admin_id','left');
		$this->db->join('tbl_admin_profile as ap','ap.fk_admin_id=a.pk_admin_id','left');
		$this->db->where(array('s.active'=>1,'s.is_deleted'=>0,'p.is_default'=>1));
		
		if($from && $to)
			{
				$this->db->group_start();
				$this->db->where('p.original_price>=',$from);
				$this->db->or_where('p.discount_price>=',$from);
				$this->db->group_end();
				
				$this->db->group_start();
				$this->db->where('p.original_price<=',$to);
				$this->db->or_where('p.discount_price<=',$to);
				$this->db->group_end();
			}
			
			if(@$cdata['sid'] || @$cdata['cid'])
			{
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
			}
			if($service_cat)
			{
				$this->db->group_start();
					$this->db->like('b.pk_category_id',$service_cat['pk_category_id'], 'before');   
					$this->db->or_like('b.pk_category_id',$service_cat['pk_category_id'], 'after');   
					$this->db->or_like('b.pk_category_id', $service_cat['pk_category_id'], 'none');    
					$this->db->or_like('b.pk_category_id',$service_cat['pk_category_id'], 'both');  
				$this->db->group_end();
	
			}
			if($order_by)
			{
				if($order_by=='name')
				{
					
					$this->db->order_by('s.service_name','ASC');
				}
				else if($order_by=='price')
				{

						$this->db->order_by('p.discount_price', 'ASC');
						$this->db->order_by('p.original_price', 'ASC');
				}
				
			
			}
			
			
			if(($page+1))
			{
			
				$this->db->limit($limit,($limit*$page));
				
			}
		
		$records=$this->db->get();

		if($records->num_rows()>0)
		{
			return $records->result_array();
		}
		
		return false;

	}
	
	
}
   

   