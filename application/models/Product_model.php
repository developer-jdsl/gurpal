<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
	
	function get_variation_details($data)
	{
		$this->db->select('p.*,pp.*,pc.category_name,b.brand_name,a.admin_name,c.color_name,c.color_value,s.size_name,s.size_value,g.gst_slab');
        $this->db->from('tbl_products as p');
		$this->db->join('tbl_product_pricing as pp','p.pk_product_id=pp.fk_product_id','left');
		$this->db->join('tbl_size as s','s.pk_size_id=pp.fk_size_id','left');
		$this->db->join('tbl_color as c','c.pk_color_id=pp.fk_color_id','left');
		$this->db->join('tbl_product_category as pc','p.product_category=pc.pk_category_id','left');
		$this->db->join('tbl_brands as b','p.product_brand=b.pk_brand_id','left');
		$this->db->join('tbl_admin as a','p.fk_admin_id=a.pk_admin_id','left');
		$this->db->join('tbl_gst as g','p.fk_gst_id=g.pk_gst_id','left');
		
		$this->db->where(array('p.active'=>1,'p.is_deleted'=>0,'p.pk_product_id'=>$data['pid'],'s.pk_size_id'=>$data['sid'],'c.pk_color_id'=>$data['cid']));
		$records=$this->db->get();
		if($records->num_rows()>0)
		{
			return $records->row_array();
		}
		
		return false;	
		
		
	}
	
	function get_variation_detail($data)
	{
		
		$this->db->select('p.*,pp.*,pc.category_name,b.brand_name,a.admin_name,c.color_name,c.color_value,s.size_name,s.size_value,g.gst_slab');
        $this->db->from('tbl_products as p');
		$this->db->join('tbl_product_pricing as pp','p.pk_product_id=pp.fk_product_id','left');
		$this->db->join('tbl_size as s','s.pk_size_id=pp.fk_size_id','left');
		$this->db->join('tbl_color as c','c.pk_color_id=pp.fk_color_id','left');
		$this->db->join('tbl_product_category as pc','p.product_category=pc.pk_category_id','left');
		$this->db->join('tbl_brands as b','p.product_brand=b.pk_brand_id','left');
		$this->db->join('tbl_admin as a','p.fk_admin_id=a.pk_admin_id','left');
		$this->db->join('tbl_gst as g','p.fk_gst_id=g.pk_gst_id','left');
		
		$this->db->where(array('p.active'=>1,'p.is_deleted'=>0,'pp.pk_price_id'=>$data['pid']));
		$records=$this->db->get();
		if($records->num_rows()>0)
		{
			return $records->row_array();
		}
		
		return false;
		
	}
	
	
}
   

   