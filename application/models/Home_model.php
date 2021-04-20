<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
	
	function get_products()
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
		$records=$this->db->get();
		if($records->num_rows()>0)
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
	
	
}
   

   