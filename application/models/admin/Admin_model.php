<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
   
   
   function get_banners()
   {
	   
	   
   }
   
   /* 
   #######################################
   ADMIN STATE MODULE
   #######################################
   */
   function get_states()
   {
	   $states=$this->db->get_where('tbl_states',array('is_deleted'=>0));
	   if($states)
	   {
		  return $states->result_array(); 
	   }
	   
	   return null;
	   
   }
   
   function add_state($data=null)
   {
	   if($data)
	   {
		   $this->db->insert('tbl_states',array('state_name'=>$data['state_name'],'active'=>$data['active'],'fk_country_id'=>$data['fk_country_id']));
		   $id=$this->db->insert_id();
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function edit_state($data=null)
   {
	   if($data)
	   {
		   $this->db->where(array('pk_state_id'=>$data['pk_state_id']));
		   $id=$this->db->update('tbl_states',array('state_name'=>$data['state_name'],'active'=>$data['active'],'fk_country_id'=>$data['fk_country_id']));
		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function remove_state($id)
   {
	   if($id)
	   {
		   $this->db->where(array('pk_state_id'=>$id));
		   $rid=$this->db->update('tbl_states',array('is_deleted'=>1));
		   
		   if($rid)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   
   function check_state_id($id=null)
   {
	   if($id)
	   {
		  $return=$this->db->get_where('tbl_states',array('pk_state_id'=>$id,'is_deleted'=>0)); 
		  if($return)
		  {
			$return=$return->row_array();
			if($return['pk_state_id'])
			{
				
				return $return;
			}
		  }
		   
	   }
	   
	   return false;
   }
   
   /* 
   #######################################
   ADMIN CITY MODULE 
   #######################################
   */
  
   function get_cities()
   {
	  
	   $this->db->select('c.*,s.state_name');
	   $this->db->from('tbl_cities as c');
	   $this->db->join('tbl_states as s','c.fk_state_id=s.pk_state_id','inner');
	   $this->db->where(array('c.is_deleted'=>0));
	   $cities=$this->db->get();
	   if($cities)
	   {
		  return $cities->result_array(); 
	   }
	   
	   return null;
	   
   }
   
   function add_city($data=null)
   {
	   if($data)
	   {
		   $this->db->insert('tbl_cities',array('city_name'=>$data['city_name'],'active'=>$data['active'],'fk_state_id'=>$data['fk_state_id']));
		   $id=$this->db->insert_id();
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function edit_city($data=null)
   {
	   if($data)
	   {
		   $this->db->where(array('pk_city_id'=>$data['pk_city_id']));
		   $id=$this->db->update('tbl_cities',array('city_name'=>$data['city_name'],'active'=>$data['active'],'fk_state_id'=>$data['fk_state_id']));
		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function remove_city($id)
   {
	   if($id)
	   {
		   $this->db->where(array('pk_city_id'=>$id));
		   $rid=$this->db->update('tbl_cities',array('is_deleted'=>1));
		   
		   if($rid)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   
   function check_city_id($id=null)
   {
	   if($id)
	   {
		  $return=$this->db->get_where('tbl_cities',array('pk_city_id'=>$id,'is_deleted'=>0)); 
		  if($return)
		  {
			$return=$return->row_array();
			if($return['pk_city_id'])
			{
				
				return $return;
			}
		  }
		   
	   }
	   
	   return false;
   }
   
 
  
}
