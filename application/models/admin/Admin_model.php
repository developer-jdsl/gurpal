<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_Model {
    public function __construct() {
        $this->load->database();
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
   
   function get_business_cats()
  {
	 $cats=$this->db->get_where('tbl_business_category',array('is_deleted'=>0,'active'=>1));
	   if($cats)
	   {
		  return $cats->result_array(); 
	   }
	   
	   return null;  
	  
  }
   
   function add_state($data=null)
   {
	   if($data)
	   {
		   $this->db->insert('tbl_states',array('state_name'=>$data['state_name'],'active'=>$data['active'],'fk_country_id'=>$data['fk_country_id'],'meta_title'=>$data['meta_title'],'meta_description'=>$data['meta_description'],'meta_keywords'=>$data['meta_keywords']));
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
		   $id=$this->db->update('tbl_states',array('state_name'=>$data['state_name'],'active'=>$data['active'],'fk_country_id'=>$data['fk_country_id'],'meta_title'=>$data['meta_title'],'meta_description'=>$data['meta_description'],'meta_keywords'=>$data['meta_keywords']));
		   
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
		   $arr=array('city_name'=>$data['city_name'],'active'=>$data['active'],'fk_state_id'=>$data['fk_state_id'],'meta_title'=>$data['meta_title'],'meta_description'=>$data['meta_description'],'meta_keywords'=>$data['meta_keywords']);
		   if($data['city_image'])
		   {
			$arr['city_image']=$data['city_image'];
		   }
		   $this->db->insert('tbl_cities',$arr);
		   $id=$this->db->insert_id();
		    $slug=$this->create_slug($id,'pk_city_id','tbl_cities','city_slug',$data['city_name'],true);
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
		   	   $slug=!empty($data['city_slug'])?$data['city_slug']:$data['city_name'];
		   $data['city_slug']=  $this->create_slug($data['pk_city_id'],'pk_city_id','tbl_cities','city_slug',$slug);
		   $arr=array('city_name'=>$data['city_name'],'active'=>$data['active'],'fk_state_id'=>$data['fk_state_id'],'meta_title'=>$data['meta_title'],'meta_description'=>$data['meta_description'],'city_slug'=>$data['city_slug'],'meta_keywords'=>$data['meta_keywords']);
		   if($data['city_image'])
		   {
			   $arr['city_image']=$data['city_image'];
		   }
		   $this->db->where(array('pk_city_id'=>$data['pk_city_id']));
		   $id=$this->db->update('tbl_cities', $arr);
		   
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
   
    /* 
   #######################################
   ADMIN Brands MODULE 
   #######################################
   */
  
   function get_brands()
   {
	  
	   $brands=$this->db->get_where('tbl_brands',array('is_deleted'=>'0'));
	   if($brands)
	   {
		  return $brands->result_array(); 
	   }
	   
	   return null;
	   
   }
   
   function add_brand($data=null)
   {
	   if($data)
	   {
		   
		   $this->db->insert('tbl_brands',array('brand_name'=>$data['brand_name'],'brand_image'=>$data['brand_image'],'active'=>$data['active'],'created_by'=>$data['created_by']));
		   $id=$this->db->insert_id();
		   $slug=$this->create_slug($id,'pk_brand_id','tbl_brands','brand_slug',$data['brand_name'],true);
		   if($id && $slug)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function edit_brand($data=null)
   {
	   if($data)
	   {
		   
		   $insert_arr=array('brand_name'=>$data['brand_name'],'active'=>$data['active']);
		   if(isset($data['brand_image']) && !empty($data['brand_image']))
		   {
			 $insert_arr['brand_image']=  $data['brand_image'];
		   }
		   $slug=!empty($data['brand_slug'])?$data['brand_slug']:$data['brand_name'];
		   $insert_arr['brand_slug']=  $this->create_slug($data['pk_brand_id'],'pk_brand_id','tbl_brands','brand_slug',$slug);
		   
		   $this->db->where(array('pk_brand_id'=>$data['pk_brand_id']));
		   $id=$this->db->update('tbl_brands',$insert_arr);
		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function remove_brand($id)
   {
	   if($id)
	   {
		   $this->db->where(array('pk_brands_id'=>$id));
		   $rid=$this->db->delete('tbl_brands');
		   
		   if($rid)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   
   function check_brand_id($id=null)
   {
	   if($id)
	   {
		  $return=$this->db->get_where('tbl_brands',array('pk_brand_id'=>$id)); 
		  if($return)
		  {
			$return=$return->row_array();
			if($return['pk_brand_id'])
			{
				
				return $return;
			}
		  }
		   
	   }
	   
	   return false;
   }
   
    /* 
   #######################################
   ADMIN GST MODULE 
   #######################################
   */
   
    function get_gst($active=false)
   {
	   $data=array('is_deleted'=>0);
	   if($active)
	   {
		$data['active']=1;	
	   }
	   $gst=$this->db->get_where('tbl_gst',$data);
	   if($gst)
	   {
		  return $gst->result_array(); 
	   }
	   
	   return null;
	   
   }
   
   

   function add_gst($data=null)
   {
	   if($data)
	   {
		   $this->db->insert('tbl_gst',array('gst_slab'=>$data['gst_slab'],'gst_value'=>$data['gst_value'],'active'=>$data['active']));
		   $id=$this->db->insert_id();
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function edit_gst($data=null)
   {
	   if($data)
	   {
		   $this->db->where(array('pk_gst_id'=>$data['pk_gst_id']));
		   $id=$this->db->update('tbl_gst',array('gst_slab'=>$data['gst_slab'],'gst_value'=>$data['gst_value'],'active'=>$data['active']));
		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function remove_gst($id)
   {
	   if($id)
	   {
		   $this->db->where(array('pk_gst_id'=>$id));
		   $rid=$this->db->update('tbl_gst',array('active'=>0));
		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   
   function check_gst_id($id=null)
   {
	   if($id)
	   {
		  $return=$this->db->get_where('tbl_gst',array('pk_gst_id'=>$id)); 
		  if($return)
		  {
			$return=$return->row_array();
			if($return['pk_gst_id'])
			{
				
				return $return;
			}
		  }
		   
	   }
	   
	   return false;
   }
   
      
     
   /* 
   #######################################
   ADMIN COLOR MODULE 
   #######################################
   */ 
   
   
   function get_color($active=false)
   {
	   $data['is_deleted']=0;
	   if($active)
	   {
		 $data['active']=1;  
	   }
	   $color=$this->db->get_where('tbl_color',$data);
	   if($color)
	   {
		  return $color->result_array(); 
	   }
	   
	   return null;
	   
   }
   
   function add_color($data=null)
   {
	   if($data)
	   {
		   $this->db->insert('tbl_color',array('color_name'=>$data['color_name'],'color_value'=>$data['color_value'],'active'=>$data['active']));
		   $id=$this->db->insert_id();
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function edit_color($data=null)
   {
	   if($data)
	   {
		   $this->db->where(array('pk_color_id'=>$data['pk_color_id']));
		   $id=$this->db->update('tbl_color',array('color_name'=>$data['color_name'],'color_value'=>$data['color_value'],'active'=>$data['active']));
		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function remove_color($id)
   {
	   if($id)
	   {
		   $this->db->where(array('pk_color_id'=>$id));
		   $rid=$this->db->update('tbl_color',array('active'=>0));
		   
		   if($rid)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   
   function check_color_id($id=null)
   {
	   if($id)
	   {
		  $return=$this->db->get_where('tbl_color',array('pk_color_id'=>$id,'active'=>1)); 
		  if($return)
		  {
			$return=$return->row_array();
			if($return['pk_color_id'])
			{
				
				return $return;
			}
		  }
		   
	   }
	   
	   return false;
   }
   
   /* 
   #######################################
   ADMIN SIZE MODULE 
   #######################################
   */ 
   
    function get_size($active=false)
   {
	   $data=array('is_deleted'=>0);
	   if($active)
	   {
		   $data['active']=1;
	   }
	   $size=$this->db->get_where('tbl_size',$data);
	   if($size)
	   {
		  return $size->result_array(); 
	   }
	   
	   return null;
	   
   }
   
   
   function add_size($data=null)
   {
	   if($data)
	   {
		   $this->db->insert('tbl_size',array('size_name'=>$data['size_name'],'size_value'=>$data['size_value'],'active'=>$data['active']));
		   $id=$this->db->insert_id();
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function edit_size($data=null)
   {
	   if($data)
	   {
		   $this->db->where(array('pk_size_id'=>$data['pk_size_id']));
		   $id=$this->db->update('tbl_size',array('size_name'=>$data['size_name'],'size_value'=>$data['size_value'],'active'=>$data['active']));
		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function remove_size($id)
   {
	   if($id)
	   {
		   $this->db->where(array('pk_size_id'=>$id));
		   $rid=$this->db->update('tbl_size',array('active'=>0));
		   
		   if($rid)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   
   function check_size_id($id=null)
   {
	   if($id)
	   {
		  $return=$this->db->get_where('tbl_size',array('pk_size_id'=>$id,'active'=>1)); 
		  if($return)
		  {
			$return=$return->row_array();
			if($return['pk_size_id'])
			{
				
				return $return;
			}
		  }
		   
	   }
	   
	   return false;
   }
   
   
   
   
   /* 
   #######################################
   ADMIN PRODUCTS MODULE 
   #######################################
   */
  
  
   
    private function _get_products_query()
    {
        $this->db->select('p.*,pp.*,pc.category_name,b.brand_name,a.admin_name');
        $this->db->from('tbl_products as p');
		$this->db->join('tbl_product_pricing as pp','p.pk_product_id=pp.fk_product_id','left');
		$this->db->join('tbl_product_category as pc','p.product_category=pc.pk_category_id','left');
		$this->db->join('tbl_brands as b','p.product_brand=b.pk_brand_id','left');
		$this->db->join('tbl_admin as a','p.fk_admin_id=a.pk_admin_id','left');
		if($this->session->user_type=='admin')
		{
			$this->db->where(array('p.is_deleted'=>0,'p.fk_admin_id'=>$this->session->pk_admin_id));
		}
		$this->db->where(array('pp.is_default'=>1));
		$colums=array('p.product_name','pc.category_name');
        
        $i = 0;
        foreach ($colums as $item) // loop column
        {
            if(@$_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, @$_POST['search']['value']);
                }
                if(count($colums) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $column[$i] = $item; // set column array variable to order processing
            $i++;
        }
      
    }

    function get_products()
    {
        $this->_get_products_query();
        if($this->input->post('length') != -1)
        $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }

    function products_count_filtered()
    {
        $this->_get_products_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

     function products_count_all()
    {
		$this->db->where('is_deleted',0);
        $this->db->from('tbl_products');
        return $this->db->count_all_results();
    }
	
	
	function get_cross_products()
	{
		
		if($this->session->user_type=='admin')
		{
		$this->db->select('p.product_name,pp.product_image,pp.discount_price,pp.original_price');
        $this->db->from('tbl_products as p');
		$this->db->join('tbl_product_pricing as pp','p.pk_product_id=pp.fk_product_id','inner');
		$this->db->where(array('pp.is_default'=>1,'p.active'=>1,'is_deleted'=>0,'p.fk_admin_id'=>$this->session->pk_admin_id));
		$results=$this->db->get();
		if($results)
		{
			return $results->result_array();
		}
			
		}
		 return false;
	}
	
	
	function get_admins()
	{
		$this->db->select('pk_admin_id,admin_name');
		$this->db->from('tbl_admin');
		$this->db->where(array('active'=>1,'is_super'=>0,'is_deleted'=>0));
		$results=$this->db->get();	
		if($results)
		{
			return $results->result_array();
		}
		return false;
	}
	
		function get_admins_profile()
	{
		$this->db->select('a.pk_admin_id,a.admin_name,a.active,a.admin_email,a.admin_mobile,p.*');
		$this->db->from('tbl_admin as a');
		$this->db->join('tbl_admin_profile as p','a.pk_admin_id=p.fk_admin_id','left');
		$this->db->where(array('a.active'=>1,'a.is_super'=>0,'a.is_deleted'=>0));
		$results=$this->db->get();	
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
   
    function add_product($data=null)
   {
	   if($data)
	   {  
			
		   $this->db->insert('tbl_products',$data);
		   $id=$this->db->insert_id();
		   $this->create_slug($id,'pk_product_id','tbl_products','product_slug',$data['product_name'],true);
		   if($id)
		   {
				return array('status'=>true,'id'=>$id);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
     function check_product_id($id=null)
   {
	   if($id)
	   {
		  $return=$this->db->get_where('tbl_products',array('pk_product_id'=>$id)); 
		  if($return)
		  {
			$return=$return->row_array();
			if($return['pk_product_id'])
			{
				
				return $return;
			}
		  }
		   
	   }
	   
	   return false;
   }
   
    function edit_product($data=null,$id=null)
   {
	   if($data && $id)
	   {
		   
		   
		   if($data['product_slug'])
		   {
			  $data['product_slug']= $this->create_slug($id,'pk_product_id','tbl_products','product_slug',$data['product_slug']);
		   }
		   else
		   {
			   $data['product_slug']= $this->create_slug($id,'pk_product_id','tbl_products','product_slug',$data['product_name']);
		   }
		   
		   $id=$this->db->update('tbl_products',$data,array('pk_product_id' => $id));
		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   

   
   function remove_product($id)
   {
	   if($id)
	   {
		   $imgs=$this->db->get_where('tbl_product_pricing',array('fk_product_id'=>$id));
		   if($imgs)
		   {
			   $imgs=$imgs->result_array();
			   
			   foreach($imgs as $img){
				
				unlink(".uploads/product/".$img['product_image']);				
				   
			   }
			   
		   }
		   
		   $this->db->where(array('fk_product_id'=>$id));
		   $this->db->delete('tbl_product_pricing');
		   
		   $this->db->where(array('pk_product_id'=>$id));
		   $rid=$this->db->delete('tbl_products');
		   
		   
		   
		   if($rid)
		   {
				return true;
		   }
		   
		   return false;
	   }
	   
   }
   
     function get_product_gallery($id)
   {
	   if($id)
	   {
		   $rid=$this->db->get_where('tbl_product_pricing',array('fk_product_id'=>$id));
		   
		   if($rid)
		   {
				$rid=$rid->result_array();
				return $rid;
		   }
		   
		   
	   }
	   return false;
   }
   
 
   function pricing_product($insert_data=null,$id)
   {
	   if($insert_data)
	   {
		   $chk=$this->db->get_where('tbl_product_pricing',array('is_default'=>1,'fk_product_id'=>$id));

		   if($chk->num_rows()==0)
		   {
			  $insert_data[0]['is_default']=1; 
		   }
		
		  $this->db->insert_batch('tbl_product_pricing',$insert_data);
		  
	   }
	   
   }
   
   
    function pricing_service($insert_data=null)
   {
	  
		   
	   if($insert_data)
	   {
		    $chk=$this->db->get_where('tbl_service_pricing',array('is_default'=>1,'fk_service_id'=>$insert_data['fk_service_id']));
		   if($chk->num_rows()==0)
		   {
			  $insert_data[0]['is_default']=1; 
		   }
		   
		   foreach($insert_data as $data)
		   
		   {
		  $this->db->insert('tbl_service_pricing',$data);
		   }
		  
	   }
	   
   }
   
   function update_product_ajax($id,$table,$column,$value)
   {
	   
	 $this->db->where(array('pk_price_id'=>$id));
	 $id=$this->db->update('tbl_'.$table,array($column=>$value));
	 if($id)
	 {
		 return true;
	 }
	  return false;
	   
   }
   
      function update_service_ajax($id,$table,$column,$value)
   {
	   
	 $this->db->where(array('pk_pricing_id'=>$id));
	 $id=$this->db->update('tbl_'.$table,array($column=>$value));
	 if($id)
	 {
		 return true;
	 }
	  return false;
	   
   }
   
   
   function update_product_default($id,$table)
   {
	 $this->db->update('tbl_'.$table,array('is_default'=>0));
	 
	 $this->db->where(array('pk_price_id'=>$id));
	 $id=$this->db->update('tbl_'.$table,array('is_default'=>1));
	 
	 if($id)
	 {
		 return true;
	 }
	  return false;
		
	   
   }
   
   
      
   function update_service_default($id,$table)
   {
	 $this->db->update('tbl_'.$table,array('is_default'=>0));
	 
	 $this->db->where(array('pk_pricing_id'=>$id));
	 $id=$this->db->update('tbl_'.$table,array('is_default'=>1));
	 
	 if($id)
	 {
		 return true;
	 }
	  return false;
		
	   
   }
      function remove_gallery_ajax($id)
   {
	   if($id)
	   {
		   $imgs=$this->db->get_where('tbl_product_pricing',array('fk_products_id'=>$id));
		   if($imgs)
		   {
			   $imgs=$imgs->result_array();
			   
			   foreach($imgs as $img){
				
				unlink(".uploads/product/".$img['product_image']);				
				   
			   }
			   
		   }
		   
		   $this->db->where(array('fk_product_id'=>$id));
		   $rid=$this->db->delete('tbl_product_pricing');
		   
		
		   if($rid)
		   {
				return true;
		   }
		   
		   return false;
	   }
	   
   }
   
   
         function remove_pricing_ajax($id)
   {
	   if($id)
	   {
		  
		   
		   $this->db->where(array('fk_service_id'=>$id));
		   $rid=$this->db->delete('tbl_service_pricing');
		   
		
		   if($rid)
		   {
				return true;
		   }
		   
		   return false;
	   }
	   
   }
   
    function create_slug($id=null,$key=null,$table=null,$column=null,$name=null,$insert=false)
{
    $count = 0;
    $slug_name = $name = url_title($name,'-',true);
    while(true) 
    {
		$where=array($column=>$slug_name,$key.'!='=>$id);
        $this->db->from($table)->where($where);
        if ($this->db->count_all_results() == 0) break;
        $slug_name = $name . '-' . (++$count);
    }
	if($insert==true)
	{
	$this->db->where($key,$id);
	return $this->db->update($table,array($column=>$slug_name));
	}
	else
	{
		return $slug_name;
	}
    
}

/* 
   #######################################
   ADMIN ADS MODULE 
   #######################################
   */
  
  
  function get_advertisements($page=null,$section=null)
  {
	$this->db->select('*');
	$this->db->from('tbl_advertisement');
	
	if($page)
	{
		$this->db->where('display_page',$page);
	}
	
	if($section)
	{
		$this->db->where('display_section',$section);
	}
	
	$ads=$this->db->get();
	
	 if($ads)
	   {
		  return $ads->result_array(); 
	   }
	   
	   return null;
	   
	  
  }
   function get_ads()
   {
	  
	   $ads=$this->db->get_where('tbl_advertisement',array('is_deleted'=>'0'));
	   if($ads)
	   {
		  return $ads->result_array(); 
	   }
	   
	   return null;
	   
   }
   
   function add_ad($data=null)
   {
	   if($data)
	   {
		   
		   $this->db->insert('tbl_advertisement',$data);
		   $id=$this->db->insert_id();
		   if($id && $slug)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function update_ad($id,$data=null)
   {
	   if($data)
	   {
		 
		   $this->db->where(array('pk_advertisement_id'=>$id));
		   $id=$this->db->update('tbl_advertisement',$data);

		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function remove_ad($id)
   {
	   if($id)
	   {
		   $this->db->where(array('pk_advertisement_id'=>$id));
		   $rid=$this->db->delete('tbl_advertisement');
		   
		   if($rid)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   
   function check_ad_id($id=null)
   {
	   if($id)
	   {
		  $return=$this->db->get_where('tbl_advertisement',array('pk_advertisement_id'=>$id)); 
		  if($return)
		  {
			$return=$return->row_array();
			if($return['pk_advertisement_id'])
			{
				
				return $return;
			}
		  }
		   
	   }
	   
	   return false;
   }
   
   
    /* 
   #######################################
   ADMIN banner MODULE 
   #######################################
   */
  
   function get_banners()
   {
	  
	   $brands=$this->db->get_where('tbl_banners',array('is_deleted'=>0));
	   if($brands)
	   {
		  return $brands->result_array(); 
	   }
	   
	   return null;
	   
   }
   
   function get_banners_active()
   {
	  
	   $brands=$this->db->get_where('tbl_banners',array('active'=>'1','is_deleted'=>0));
	   if($brands)
	   {
		  return $brands->result_array(); 
	   }
	   
	   return null;
	   
   }
   
   function add_banner($data=null)
   {
	   if($data)
	   {
		   
		   $this->db->insert('tbl_banners',$data);
		   $id=$this->db->insert_id();
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function edit_banner($id,$data=null)
   {
	   if($data)
	   {
		   		   
		   $this->db->where(array('pk_banner_id'=>$id));
		   $id=$this->db->update('tbl_banners',$data);
		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function remove_banner($id)
   {
	   if($id)
	   {
		   $this->db->where(array('pk_banner_id'=>$id));
		   $rid=$this->db->delete('tbl_banners');
		   
		   if($rid)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   
   function check_banner_id($id=null)
   {
	   if($id)
	   {
		  $return=$this->db->get_where('tbl_banners',array('pk_banner_id'=>$id)); 
		  if($return)
		  {
			$return=$return->row_array();
			if($return['pk_banner_id'])
			{
				
				return $return;
			}
		  }
		   
	   }
	   
	   return false;
   }
   
    /* 
   #######################################
   ADMIN Service MODULE 
   #######################################
   */
  
  
   
    private function _get_services_query()
    {
        $this->db->select('s.*,b.category_name,a.admin_name,p.discount_price,p.original_price');
        $this->db->from('tbl_services as s');
		$this->db->join('tbl_service_pricing as p','s.pk_service_id=p.fk_service_id','inner');
		$this->db->join('tbl_business_category as b','s.service_category=b.pk_category_id','left');
		$this->db->join('tbl_admin as a','s.fk_admin_id=a.pk_admin_id','left');
		if($this->session->user_type=='admin')
		{
			$this->db->where(array('s.is_deleted'=>0,'s.fk_admin_id'=>$this->session->pk_admin_id,'p.is_default'=>1));
		}
		
		else
			
		{
			$this->db->where(array('p.is_default'=>1));
		}
	
		$colums=array('s.service_name','b.category_name');
        
        $i = 0;
        foreach ($colums as $item) // loop column
        {
            if(@$_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, @$_POST['search']['value']);
                }
                if(count($colums) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $column[$i] = $item; // set column array variable to order processing
            $i++;
        }
      
    }

    function get_services()
    {
        $this->_get_services_query();
        if($this->input->post('length') != -1)
        $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }

    function services_count_filtered()
    {
        $this->_get_products_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

     function services_count_all()
    {
		$this->db->where('is_deleted',0);
        $this->db->from('tbl_services');
        return $this->db->count_all_results();
    }
	
	
	function get_service_pricing($id)
	{
		$results=$this->db->get_where('tbl_service_pricing',array('fk_service_id'=>$id));
		if($results)
		{
			return $results->result_array();
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
   
    function add_service($data=null)
   {
	   if($data)
	   {  
			
		   $this->db->insert('tbl_services',$data);
		   $id=$this->db->insert_id();
		   $this->create_slug($id,'pk_service_id','tbl_services','service_slug',$data['service_name'],true);
		   if($id)
		   {
				return array('status'=>true,'id'=>$id);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
     function check_service_id($id=null)
   {
	   if($id)
	   {
		  $return=$this->db->get_where('tbl_services',array('pk_service_id'=>$id)); 
		  if($return)
		  {
			$return=$return->row_array();
			if($return['pk_service_id'])
			{
				
				return $return;
			}
		  }
		   
	   }
	   
	   return false;
   }
   
    function edit_service($data=null,$id=null)
   {
	   if($data && $id)
	   {
		   
		   if($data['service_slug'])
		   {
			  $data['service_slug']= $this->create_slug($id,'pk_service_id','tbl_services','service_slug',$data['service_slug']);
		   }
		   else
		   {
			   $data['service_slug']= $this->create_slug($id,'pk_service_id','tbl_services','service_slug',$data['service_name']);
		   }
		   
		   $id=$this->db->update('tbl_services',$data,array('pk_service_id'=>$id));
		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   

   
   function remove_service($id)
   {
	   if($id)
	   {
		   $imgs=$this->db->get_where('tbl_services',array('pk_service_id'=>$id));
		   if($imgs)
		   {
			   $imgs=$imgs->result_array();
			   
			   foreach($imgs as $img){
				   if($img['service_banners']){
				
				unlink(".uploads/service/".$img['service_banners']);				
				   }
			   }
			   
		   }
		   
		   $this->db->where(array('pk_service_id'=>$id));
		   $rid=$this->db->delete('tbl_services');
		   
		   
		   
		   if($rid)
		   {
				return true;
		   }
		   
		   return false;
	   }
	   
   }
   
    /* 
   #######################################
   ADMIN peoduct catgeory MODULE 
   #######################################
   */
  
   function get_procategory()
   {
	  
	   $brands=$this->db->get_where('tbl_product_category',array('is_deleted'=>'0'));
	   if($brands)
	   {
		  return $brands->result_array(); 
	   }
	   
	   return null;
	   
   }
   
   function add_procategory($data=null)
   {
	   if($data)
	   {
		    
		   $this->db->insert('tbl_product_category',$data);
		   $id=$this->db->insert_id();
		   $this->create_slug($id,'pk_category_id','tbl_product_category','category_slug',$data['category_name'],true);
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function edit_procategory($id=null,$data=null)
   {
	   if($data && $id)
	   {
		   
			if($data['category_slug'])
			{
				$data['category_slug']=$this->create_slug($id,'pk_category_id','tbl_product_category','category_slug',$data['category_slug'],false);
			}
			else
			{
				$data['category_slug']=$this->create_slug($id,'pk_category_id','tbl_product_category','category_slug',$data['category_name'],false);
			}
		  
		   
		   $this->db->where(array('pk_category_id'=>$id));
		   $id=$this->db->update('tbl_product_category',$data);
		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function remove_procategory($id)
   {
	   if($id)
	   {
		   $this->db->where(array('pk_category_id'=>$id));
		   $rid=$this->db->delete('tbl_product_category');
		   
		   if($rid)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   
   function check_procategory_id($id=null)
   {
	   if($id)
	   {
		  $return=$this->db->get_where('tbl_product_category',array('pk_category_id'=>$id)); 
		  if($return)
		  {
			$return=$return->row_array();
			if($return['pk_category_id'])
			{
				
				return $return;
			}
		  }
		   
	   }
	   
	   return false;
   }
  
   /* 
   #######################################
   ADMIN business catgeory MODULE 
   #######################################
   */
  
   function get_bizcategory()
   {
	  
	   $brands=$this->db->get_where('tbl_business_category',array('is_deleted'=>'0'));
	   if($brands)
	   {
		  return $brands->result_array(); 
	   }
	   
	   return null;
	   
   }
   
   function add_bizcategory($data=null)
   {
	   if($data)
	   {
		    
		   $this->db->insert('tbl_business_category',$data);
		   $id=$this->db->insert_id();
		   $this->create_slug($id,'pk_category_id','tbl_business_category','category_slug',$data['category_name'],true);
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function edit_bizcategory($id=null,$data=null)
   {
	   if($data && $id)
	   {
		   
			if($data['category_slug'])
			{
				$data['category_slug']=$this->create_slug($id,'pk_category_id','tbl_business_category','category_slug',$data['category_slug'],false);
			}
			else
			{
				$data['category_slug']=$this->create_slug($id,'pk_category_id','tbl_business_category','category_slug',$data['category_name'],false);
			}
		  
		   
		   $this->db->where(array('pk_category_id'=>$id));
		   $id=$this->db->update('tbl_business_category',$data);
		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function remove_bizcategory($id)
   {
	   if($id)
	   {
		   $this->db->where(array('pk_category_id'=>$id));
		   $rid=$this->db->delete('tbl_business_category');
		   
		   if($rid)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   
   function check_bizcategory_id($id=null)
   {
	   if($id)
	   {
		  $return=$this->db->get_where('tbl_business_category',array('pk_category_id'=>$id)); 
		  if($return)
		  {
			$return=$return->row_array();
			if($return['pk_category_id'])
			{
				
				return $return;
			}
		  }
		   
	   }
	   
	   return false;
   }

   /* 
   #######################################
   ADMINs MODULE 
   #######################################
   */
  

function add_admin($data=null,$data2=null)
   {
	   
	   
	   if($data)
	   {
		    
		   $this->db->insert('tbl_admin',$data);
		   $id=$this->db->insert_id();
		   
		   $this->db->insert('tbl_admin_profile',array('fk_admin_id'=>$id,'profile_package'=>$data2['profile_package']));
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   
      function check_admin_id($id=null)
   {
	   if($id)
	   {
		$this->db->select('a.pk_admin_id,a.admin_name,a.active,a.admin_email,a.admin_mobile,p.*');
		$this->db->from('tbl_admin as a');
		$this->db->join('tbl_admin_profile as p','a.pk_admin_id=p.fk_admin_id','left');
		$this->db->where(array('a.is_super'=>0,'a.is_deleted'=>0,'a.pk_admin_id'=>$id));
		$results=$this->db->get();	
		if($results)
		{
			return $results->row_array();
		}
		
	   }
	   
	   return false;
   }
   
   
   function edit_admin($id=null,$data=null)
   {
	   if($data && $id)
	   {
		   
		   $this->db->where(array('pk_admin_id'=>$id));
		   $id=$this->db->update('tbl_admin',$data);
		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   
   function edit_adminprofile($id=null,$data=null)
   {
	   if($data && $id)
	   {
		   
		   $this->db->where(array('fk_admin_id'=>$id));
		   $id=$this->db->update('tbl_admin_profile',$data);
		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   
   /* 
   #######################################
   ADMIN Package MODULE 
   #######################################
   */ 
   
    function get_packages()
   {
	   $package=$this->db->get_where('tbl_packages',array('is_deleted'=>0));
	   if($package)
	   {
		  return $package->result_array(); 
	   }
	   
	   return null;
	   
   }
   
       function get_packages_active()
   {
	   $package=$this->db->get_where('tbl_packages',array('is_deleted'=>0,'active'=>1));
	   if($package)
	   {
		  return $package->result_array(); 
	   }
	   
	   return null;
	   
   }
   
   function add_package($data=null)
   {
	   if($data)
	   {
		   $this->db->insert('tbl_packages',$data);
		   $id=$this->db->insert_id();
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function edit_package($id=null ,$data=null)
   {
	   if($data && $id)
	   {
		   $this->db->where(array('pk_package_id'=>$id));
		   $id=$this->db->update('tbl_packages',$data);
		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   function remove_package($id)
   {
	   if($id)
	   {
		   $this->db->where(array('pk_package_id'=>$id));
		   $rid=$this->db->update('tbl_packages',array('active'=>0,'is_deleted'=>1));
		   
		   if($rid)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   
   function check_package_id($id=null)
   {
	   if($id)
	   {
		  $return=$this->db->get_where('tbl_packages',array('pk_package_id'=>$id)); 
		  if($return)
		  {
			$return=$return->row_array();
			if($return['pk_package_id'])
			{
				
				return $return;
			}
		  }
		   
	   }
	   
	   return false;
   }
   
     
   /* 
   #######################################
   ADMIN Emails MODULE 
   #######################################
   */  
   
    function get_email_templates()
   {
	   $emails=$this->db->get('tbl_email_templates');
	   if($emails)
	   {
		  return $emails->result_array(); 
	   }
	   
	   return null;
	   
   }
   
      function check_email_id($id=null)
   {
	   if($id)
	   {
		  $return=$this->db->get_where('tbl_email_templates',array('pk_template_id'=>$id)); 
		  if($return)
		  {
			$return=$return->row_array();
			if($return['pk_template_id'])
			{
				
				return $return;
			}
		  }
		   
	   }
	   
	   return false;
   }
   
   
    function edit_email($id=null ,$data=null)
   {
	   if($data && $id)
	   {
		   $this->db->where(array('pk_template_id'=>$id));
		   $id=$this->db->update('tbl_email_templates',$data);
		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
       function delete_email($id=null)
   {
	   if($id)
	   {
		   $this->db->where(array('pk_template_id'=>$id));
		   $id=$this->db->delete('tbl_email_templates');
		   
		   if($id)
		   {
				return array('status'=>true);
		   }
		   
		   return array('status'=>false);
	   }
	   
   }
   
   
   function get_users()
   {
	   
	$return=$this->db->get_where('tbl_user',array('1'=>'1')); 
		  if($return)
		  {
			return $return->result_array();
			
		  }
		  return false;
   }
   
   /*************
   Orders MOdule
   **************/
 
   
    private function _get_orders_query()
    {
			$this->db->distinct('o.pk_order_id');
			$this->db->select('o.*, CONCAT(u.user_firstname," ",u.user_lastname) AS user');	  
			$this->db->from('tbl_orders as o');
			$this->db->join('tbl_order_details as od','o.pk_order_id=od.fk_order_id','inner');
			$this->db->join('tbl_product_pricing as pp','pp.pk_price_id=od.fk_pricing_id and od.order_type="product"','left');
			$this->db->join('tbl_products as p','p.pk_product_id=pp.fk_product_id and od.order_type="product"','left');
			$this->db->join('tbl_service_pricing as sp','sp.pk_pricing_id=od.fk_pricing_id and od.order_type="service"','left');
			$this->db->join('tbl_services as s','s.pk_service_id=sp.fk_service_id and od.order_type="service"','left');
			$this->db->join('tbl_user as u','o.fk_user_id=u.pk_user_id','inner');
			
			if( $this->session->user_type=='admin')
			{
				$this->db->group_start();
				$this->db->where(array('p.fk_admin_id'=>$this->session->pk_admin_id));
				$this->db->or_where(array('s.fk_admin_id'=>$this->session->pk_admin_id));
				$this->db->group_end();
			}
			
		$colums=array('o.order_number','o.txn_id');
        
        $i = 0;
        foreach ($colums as $item) // loop column
        {
            if(@$_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, @$_POST['search']['value']);
                }
                if(count($colums) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $column[$i] = $item; // set column array variable to order processing
            $i++;
        }
      
    }

    function get_orders()
    {
        $this->_get_orders_query();
        if($this->input->post('length') != -1)
        $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }

    function orders_count_filtered()
    {
        $this->_get_orders_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

     function orders_count_all()
    {
		$this->db->where('1','1');
        $this->db->from('tbl_orders');
        return $this->db->count_all_results();
    }
	
	     function check_order_id($id=null)
   {
	   if($id)
	   {
		  $return=$this->db->get_where('tbl_orders',array('pk_order_id'=>$id)); 
		  if($return)
		  {
			$return=$return->row_array();
			if($return['pk_order_id'])
			{
				
				return $return;
			}
		  }
		   
	   }
	   
	   return false;
   }
   
   
   function get_order_details($id=false)
   {
	   if($id)
	   {
		 
			$this->db->select('o.*,od.*,p.product_name,c.color_name,ps.size_name,s.service_name,sp.service_variation,sp.service_subvariation,CONCAT(u.user_firstname," ",u.user_lastname) AS user');	  
			$this->db->from('tbl_orders as o');
			$this->db->join('tbl_order_details as od','o.pk_order_id=od.fk_order_id','inner');
			$this->db->join('tbl_product_pricing as pp','pp.pk_price_id=od.fk_pricing_id and od.order_type="product"','left');
			$this->db->join('tbl_products as p','p.pk_product_id=pp.fk_product_id and od.order_type="product"','left');
			$this->db->join('tbl_color as c','pp.fk_color_id=c.pk_color_id and od.order_type="product"','left');
			$this->db->join('tbl_size as ps','pp.fk_size_id=ps.pk_size_id and od.order_type="product"','left');
			$this->db->join('tbl_service_pricing as sp','sp.pk_pricing_id=od.fk_pricing_id and od.order_type="service"','left');
			$this->db->join('tbl_services as s','s.pk_service_id=sp.fk_service_id and od.order_type="service"','left');
			$this->db->join('tbl_user as u','o.fk_user_id=u.pk_user_id','inner');
			
			if( $this->session->user_type=='admin')
			{
				$this->db->group_start();
				$this->db->where(array('p.fk_admin_id'=>$this->session->pk_admin_id));
				$this->db->or_where(array('s.fk_admin_id'=>$this->session->pk_admin_id));
				$this->db->group_end();
			}  
			
			$this->db->where('o.pk_order_id',$id);
			 $query = $this->db->get();
			return $query->result_array();
		   
	   }
	   return false;
   }
  
}
