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
		if($data['vid'])
		{
			$this->db->where('pp.product_variation',$data['vid']);
		}
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
	
	
function get_rows_count($from=false,$to=false,$category,$order_by=false,$limit=false,$page=false)
	{
		
		$product_cat=get_product_category_slug($category);
		$this->db->select('COUNT(pk_product_id) as count');
        $this->db->from('tbl_products as p');
		$this->db->join('tbl_product_pricing as pp','p.pk_product_id=pp.fk_product_id','left');
		$this->db->join('tbl_size as s','s.pk_size_id=pp.fk_size_id','left');
		$this->db->join('tbl_color as c','c.pk_color_id=pp.fk_color_id','left');
		$this->db->join('tbl_product_category as pc','p.product_category=pc.pk_category_id','left');
		$this->db->join('tbl_brands as b','p.product_brand=b.pk_brand_id','left');
		$this->db->join('tbl_admin as a','p.fk_admin_id=a.pk_admin_id','left');
		$this->db->join('tbl_gst as g','p.fk_gst_id=g.pk_gst_id','left');
		$this->db->where(array('p.active'=>1,'p.is_deleted'=>0,'pp.is_default'=>1));
		if($from && $to)
			{
				$this->db->group_start();
				$this->db->where('pp.original_price>=',$from);
				$this->db->or_where('pp.discount_price>=',$from);
				$this->db->group_end();
				
				$this->db->group_start();
				$this->db->where('pp.original_price<=',$to);
				$this->db->or_where('pp.discount_price<=',$to);
				$this->db->group_end();
			}

			if($product_cat)
			{
				foreach($product_cat as $cat)
				{
					$this->db->group_start();
							$this->db->like('pc.pk_category_id',$cat, 'before');   
							$this->db->or_like('pc.pk_category_id',$cat, 'after');   
							$this->db->or_like('pc.pk_category_id',$cat, 'none');    
							$this->db->or_like('pc.pk_category_id',$cat, 'both'); 
					$this->db->group_end();
				}
	
			}
			
			if($order_by)
			{
				if($order_by=='name')
				{
					
					$this->db->order_by('p.product_name','ASC');
				}
				else if($order_by=='price')
				{

						$this->db->order_by('pp.discount_price', 'ASC');
						$this->db->order_by('pp.original_price', 'ASC');
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
	
		function get_rows_product($from=false,$to=false,$category,$order_by=false,$limit=false,$page=false)
	{
		
		$product_cat=get_product_category($category);
		$this->db->select('p.*,pp.*,pc.category_name,b.brand_name,a.admin_name,c.color_name,c.color_value,s.size_name,s.size_value,g.gst_slab');
        $this->db->from('tbl_products as p');
		$this->db->join('tbl_product_pricing as pp','p.pk_product_id=pp.fk_product_id','left');
		$this->db->join('tbl_size as s','s.pk_size_id=pp.fk_size_id','left');
		$this->db->join('tbl_color as c','c.pk_color_id=pp.fk_color_id','left');
		$this->db->join('tbl_product_category as pc','p.product_category=pc.pk_category_id','left');
		$this->db->join('tbl_brands as b','p.product_brand=b.pk_brand_id','left');
		$this->db->join('tbl_admin as a','p.fk_admin_id=a.pk_admin_id','left');
		$this->db->join('tbl_gst as g','p.fk_gst_id=g.pk_gst_id','left');
		$this->db->where(array('p.active'=>1,'p.is_deleted'=>0,'pp.is_default'=>1));
		
		if($from && $to)
			{
				$this->db->group_start();
				$this->db->where('pp.original_price>=',$from);
				$this->db->or_where('pp.discount_price>=',$from);
				$this->db->group_end();
				
				$this->db->group_start();
				$this->db->where('pp.original_price<=',$to);
				$this->db->or_where('pp.discount_price<=',$to);
				$this->db->group_end();
			}
			
						if($product_cat)
			{
				
					$this->db->group_start();
							$this->db->like('p.product_category',$product_cat, 'before');   
							$this->db->or_like('p.product_category',$product_cat, 'after');   
							$this->db->or_like('p.product_category',$product_cat, 'none');    
							$this->db->or_like('p.product_category',$product_cat, 'both'); 
					$this->db->group_end();
			
			}
			
			if($order_by)
			{
				if($order_by=='name')
				{
					
					$this->db->order_by('p.product_name','ASC');
				}
				else if($order_by=='price')
				{

						$this->db->order_by('pp.discount_price', 'ASC');
						$this->db->order_by('pp.original_price', 'ASC');
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
   

   