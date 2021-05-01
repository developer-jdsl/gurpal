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
	
	
}
   

   