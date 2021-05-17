<?php defined('BASEPATH') OR exit('No direct script access allowed');

function keyword_value($key,$value)
{
	return $value;
}

function is_superadmin()
{
	$CI = & get_instance();
	if($CI->session->user_type!='superadmin')
	{
		show_404();
	}
	
	return true;
	
}

function is_authenticated()
{
	$CI = & get_instance();
	if($CI->session->user_type)
	{
		if($CI->session->user_type!='admin' && $CI->session->user_type!='superadmin')
		{
			redirect('authentication/admin');
		}
		
	}
	
	else
		
		{
			redirect('authentication/admin');
		}
	return true;
}

function check_login()
{
	$CI = & get_instance();
	if($CI->session->user_type)
	{
		if($CI->session->user_type=='admin' || $CI->session->user_type=='superadmin')
		{
			redirect('authentication/admin');
		}
		
		if($CI->session->user_type=='user')
		{
			redirect('authentication/user');
		}
		
	}
	
	return true;
}


function get_limit($type=null)
{
	if($type)
	{
		
		$CI = & get_instance();
		$select='p.package_'.$type.' as limit';
		$CI->db->select($select);
		$CI->db->from('tbl_admin as a');
		$CI->db->join('tbl_admin_profile as ap','a.pk_admin_id=ap.fk_admin_id','left');
		$CI->db->join('tbl_packages as p','ap.profile_package=p.pk_package_id','left');
		$CI->db->where(array('a.pk_admin_id'=>$CI->session->pk_admin_id));
		$return=$CI->db->get();
		$return=$return->row_array();
		
		return $return['limit'];
	
	}
	
	
}


function get_current_products()
{
	$CI = & get_instance();
	$CI->db->where(array('fk_admin_id'=>$CI->session->pk_admin_id,'is_deleted'=>0));
	$pro_cur_limit=$CI->db->count_all_results('tbl_products');
	$pro_tot_limit=get_limit('products');
	if($pro_cur_limit<=$pro_tot_limit)
	{
		return true;
	}
	
	return false;
}

function can_add_products()
{
	$CI = & get_instance();
	$CI->db->where(array('fk_admin_id'=>$CI->session->pk_admin_id,'is_deleted'=>0));
	$pro_cur_limit=$CI->db->count_all_results('tbl_products');
	$pro_tot_limit=get_limit('products');
	if($pro_cur_limit<$pro_tot_limit)
	{
		return true;
	}
	
	return false;
}

function can_add_services()
{
	$CI = & get_instance();
	$CI->db->where(array('fk_admin_id'=>$CI->session->pk_admin_id,'is_deleted'=>0));
	$ser_cur_limit=$CI->db->count_all_results('tbl_services');
	$ser_tot_limit=get_limit('services');
	if($ser_cur_limit<$ser_tot_limit)
	{
		return true;
	}
	
	return false;
}

function sendemail($data)
{	
	if(count($data)>0)
	{
		if($data['to'])
		{
		$CI = & get_instance();
		$CI->load->library('email');
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] ='html';
		if(@$data['batch_mode'])
		{
			$config['bcc_batch_mode']=TRUE;
			$config['bcc_batch_size']=$data['batch_size']?$data['batch_size']:50;
		}

		$CI->email->initialize($config);
		if(@$data['from'])
		{
			$CI->email->from($data['from'], 'Gurpal');
		}
		else
		{
			$CI->email->from('no_reply@jhelumchenab.com', 'Gurpal');
		}
	
		$CI->email->to($data['to']);
		if($data['subject'])
		{
			$CI->email->subject($data['subject']);
		}
		if($data['message'])
		{
			$CI->email->message($data['message']);
		}
		
		return $CI->email->send();
		
		}
	}
	
	return false;
}

function get_email_template($tid=null)
{
	if($tid)
	{
		$CI = & get_instance();	
		$ret=$CI->db->get_where('tbl_email_templates',array('template_id'=>$tid));
		if($ret)
		{
			return $ret->row_array();
		}
	}
	
	return '';
}

function get_cart_data()
{
	$CI = & get_instance();	

	if($CI->session->cart_data)
	{
		return $CI->session->cart_data;
	}
	
	else
	{
		
		return false;
	}
	
	
}


function  construct_init()
{
	
	$CI = & get_instance();	
	if(!$CI->session->city)
	{
		$r1=$CI->db->select('city_slug')->from('tbl_cities')->where(array('active'=>1,'is_deleted'=>0,'is_default'=>1))->get();
		if($r1)
		{
			$r1=$r1->row_array();
			$CI->session->set_userdata('city',$r1['city_slug']);
			
		}
		
		
	}
	
}
    
	
	function  get_city_state_id($city_slug=null)
	{
		if($city_slug)
		{
			$CI = & get_instance();	
				$r1=$CI->db->select('pk_city_id as cid,fk_state_id as sid')->from('tbl_cities')->where(array('active'=>1,'is_deleted'=>0,'city_slug'=>$city_slug))->get();
				if($r1)
				{
					$r1=$r1->row_array();
					return $r1;
				}
		}
		return false;
		
	}
	
	
	function get_service_category_slug($category)
	{
		$CI = & get_instance();	
		$row=$CI->db->get_where('tbl_business_category',array('active'=>1,'is_deleted'=>0,'category_slug'=>$category));
		if($row)
		{
			return $row->row_array();
		}
		
		return false;

	}	

	

	function get_product_category_slug($category)
	{
		$cats_ids=array();
		$CI = & get_instance();	
		$row=$CI->db->get_where('tbl_product_category',array('active'=>1,'is_deleted'=>0,'category_slug'=>$category));
		if($row)
		{
			$row=$row->row_array();
			if($row['pk_category_id'])
			{
				
				$rows=$CI->db->get_where('tbl_product_category',array('active'=>1,'is_deleted'=>0,'parent_category'=>$row['pk_category_id']));
				if($rows)
				{
					$rows=$rows->result_array();
					foreach ($rows as $r1)
					{
						$cats_ids[]=$r1['pk_category_id'];		
					}
					$cats_ids[]=$row['pk_category_id'];
				}
			}
			return $cats_ids;
		}
		
		return false;

	}
	
		function get_product_category($category)
	{
		$cats_ids=array();
		$CI = & get_instance();	
		$row=$CI->db->get_where('tbl_product_category',array('active'=>1,'is_deleted'=>0,'category_slug'=>$category));
		if($row)
		{
			$row=$row->row_array();
			if($row['pk_category_id'])
			{
				
				return $row['pk_category_id'];
			}
			
		}
		
		return false;

	}
	
	
	function product_cats_menu_li()
	{
		$html="<ul>";
	$CI = & get_instance();		
	$cats=$CI->db->get_where('tbl_product_category',array('active'=>1,'is_deleted'=>0,'parent_category'=>0));
	if($cats)
	{
		$cats=$cats->result_array();
		
		foreach($cats as $cat)
		{
		$html.="<li><a href='".base_url('products/'.$cat['category_slug'])."'>".$cat['category_name']."</a>";
		$cats1=$CI->db->get_where('tbl_product_category',array('active'=>1,'is_deleted'=>0,'parent_category'=>$cat['pk_category_id']));
		if($cats1)
		{
			$html.="<ul>";
			$cats1=$cats1->result_array();
			foreach($cats1 as $cat1)
			{
			$html.="<li><a href='".base_url('products/'.$cat1['category_slug'])."'>".$cat1['category_name']."</a>";	
			$cats2=$CI->db->get_where('tbl_product_category',array('active'=>1,'is_deleted'=>0,'parent_category'=>$cat1['pk_category_id']));
			
					if($cats2)
				{
					$html.="<ul>";
					$cats2=$cats2->result_array();
					
					foreach($cats2 as $cat2)
					{
						$html.="<li><a href='".base_url('products/'.$cat2['category_slug'])."'>".$cat2['category_name']."</a></li>";	
					}
					$html.="</ul>";
				}
		
			
			
			
				
			}
			$html.="</li></ul>";
		}
		
		}
		$html.="</li>";
	}
	$html.="</ul>";
	
	return $html;
	}
	
	function service_cats_menu_li()
	{
		$html="<ul>";
	$CI = & get_instance();		
	$cats=$CI->db->get_where('tbl_business_category',array('active'=>1,'is_deleted'=>0,'parent_category'=>0));
	if($cats)
	{
		$cats=$cats->result_array();
		
		foreach($cats as $cat)
		{
		$html.="<li><a href='".base_url('city/'.$CI->session->city.'/services/'.$cat['category_slug'])."'>".$cat['category_name']."</a>";
		$cats1=$CI->db->get_where('tbl_business_category',array('active'=>1,'is_deleted'=>0,'parent_category'=>$cat['pk_category_id']));
		if($cats1)
		{
			$html.="<ul>";
			$cats1=$cats1->result_array();
			foreach($cats1 as $cat1)
			{
			$html.="<li><a href='".base_url('city/'.$CI->session->city.'/services/'.$cat1['category_slug'])."'>".$cat1['category_name']."</a>";	
			$cats2=$CI->db->get_where('tbl_business_category',array('active'=>1,'is_deleted'=>0,'parent_category'=>$cat1['pk_category_id']));
			
					if($cats2)
				{
					$html.="<ul>";
					$cats2=$cats2->result_array();
					
					foreach($cats2 as $cat2)
					{
						$html.="<li><a href='".base_url('city/'.$CI->session->city.'/services/'.$cat2['category_slug'])."'>".$cat2['category_name']."</a></li>";	
					}
					$html.="</ul>";
				}
		
			
			
			
				
			}
			$html.="</li></ul>";
		}
		
		}
		$html.="</li>";
	}
	$html.="</ul>";
	
	return $html;
	}
	
	
	function get_popular_products($limit=false)
	{
		$CI = & get_instance();	
		$CI->db->select('p.*,pp.*,pc.category_name,b.brand_name,a.admin_name,c.color_name,c.color_value,s.size_name,s.size_value');
        $CI->db->from('tbl_products as p');
		$CI->db->join('tbl_product_pricing as pp','p.pk_product_id=pp.fk_product_id','left');
		$CI->db->join('tbl_size as s','s.pk_size_id=pp.fk_size_id','left');
		$CI->db->join('tbl_color as c','c.pk_color_id=pp.fk_color_id','left');
		$CI->db->join('tbl_product_category as pc','p.product_category=pc.pk_category_id','left');
		$CI->db->join('tbl_brands as b','p.product_brand=b.pk_brand_id','left');
		$CI->db->join('tbl_admin as a','p.fk_admin_id=a.pk_admin_id','left');
		$CI->db->where(array('p.active'=>1,'p.is_deleted'=>0));
		
		if($limit)
			{
				$CI->db->limit($limit);
			}
		
		$records=$CI->db->get();
		if($records->num_rows()>0)
		{
			return $records->result_array();
		}
		
		return false;
		
	}
	
	
		function state_ut_menu_li()
	{
		$html="<ul>";
	$CI = & get_instance();		
	$states=$CI->db->get_where('tbl_states',array('active'=>1,'is_deleted'=>0));
	if($states)
	{
		$states=$states->result_array();
		
		foreach($states as $row)
		{
		$html.="<li><a href='javascript:void(0)'>".$row['state_name']."</a>";
		$cities=$CI->db->get_where('tbl_cities',array('active'=>1,'is_deleted'=>0,'fk_state_id'=>$row['pk_state_id']));
		if($cities)
		{
			$html.="<ul>";
			$cities=$cities->result_array();
			foreach($cities as $row2)
			{
			$html.="<li><a href='".base_url('city/'.$row2['city_slug'])."'>".$row2['city_name']."</a>";	
			}
			$html.="</li></ul>";
		}
		
		}
		$html.="</li>";
	}
	$html.="</ul>";
	
	return $html;
	}
	
	function get_popular_services($limit)
	{
		$CI = & get_instance();	
		$cdata=get_city_state_id($CI->session->city);
		
		$CI->db->select('s.*,b.category_name,p.*,ap.profile_states,ap.profile_cities');
        $CI->db->from('tbl_services as s');
		$CI->db->join('tbl_service_pricing as p','s.pk_service_id=p.fk_service_id','inner');
		$CI->db->join('tbl_business_category as b','s.service_category=b.pk_category_id','left');
		$CI->db->join('tbl_admin as a','s.fk_admin_id=a.pk_admin_id','left');
		$CI->db->join('tbl_admin_profile as ap','ap.fk_admin_id=a.pk_admin_id','left');
		$CI->db->where(array('s.active'=>1,'s.is_deleted'=>0,'p.is_default'=>1));
			$CI->db->group_start();
				
				  if(@$cdata['sid'] && @$cdata['cid'])
				 {
					$CI->db->like('ap.profile_states',$cdata['sid'], 'before');   
					$CI->db->or_like('ap.profile_states',$cdata['sid'], 'after');   
					$CI->db->or_like('ap.profile_states', $cdata['sid'], 'none');    
					$CI->db->or_like('ap.profile_states',$cdata['sid'], 'both');  
					
					
						 $CI->db->or_like('ap.profile_cities',$cdata['cid'], 'before');   
						  $CI->db->or_like('ap.profile_cities',$cdata['cid'], 'after');   
						  $CI->db->or_like('ap.profile_cities', $cdata['cid'], 'none');    
						  $CI->db->or_like('ap.profile_cities',$cdata['cid'], 'both');   
						
				 }
				 
				 else  if(@$cdata['sid'] && !@$cdata['cid'])
				 {
					$CI->db->like('ap.profile_states',$cdata['sid'], 'before');   
					$CI->db->or_like('ap.profile_states',$cdata['sid'], 'after');   
					$CI->db->or_like('ap.profile_states', $cdata['sid'], 'none');    
					$CI->db->or_like('ap.profile_states',$cdata['sid'], 'both');  
				 }
				 else if(!@$cdata['sid'] && @$cdata['cid'])
					 
					 {
						
						 $CI->db->like('ap.profile_cities',$cdata['cid'], 'before');   
						  $CI->db->or_like('ap.profile_cities',$cdata['cid'], 'after');   
						  $CI->db->or_like('ap.profile_cities', $cdata['cid'], 'none');    
						  $CI->db->or_like('ap.profile_cities',$cdata['cid'], 'both');   
					
						 
					 }
			$CI->db->group_end();
			
			if($limit)
			{
				$CI->db->limit($limit);
			}
			
		$records=$CI->db->get();
		if($records->num_rows()>0)
		{
			return $records->result_array();
		}
		
		return false;
	}
	
	
	function get_admin_id_from_pid($pid=null)
	{
		if($pid)
		{
			
			$CI = & get_instance();	
			$CI->db->select('a.pk_admin_id');
			$CI->db->from('tbl_product_pricing as pp');
			$CI->db->join('tbl_products as p','p.pk_product_id=pp.fk_product_id','inner');
			$CI->db->join('tbl_admin as a','a.pk_admin_id=p.fk_admin_id','inner');
			$CI->db->where(array('pp.pk_price_id'=>$pid));
			$res=$CI->db->get();
			if($res)
			{
				$res=$res->row_array();
				return $res['pk_admin_id'];
			}

			return false;

		}			
		
	}
	
		function get_admin_id_from_sid($sid=null)
	{
		if($sid)
		{
			
			$CI = & get_instance();	
			$CI->db->select('a.pk_admin_id');
			$CI->db->from('tbl_service_pricing as sp');
			$CI->db->join('tbl_services as s','s.pk_service_id=sp.fk_service_id','inner');
			$CI->db->join('tbl_admin as a','a.pk_admin_id=s.fk_admin_id','inner');
			$CI->db->where(array('sp.pk_pricing_id'=>$sid));
			$res=$CI->db->get();
			if($res)
			{
				$res=$res->row_array();
				return $res['pk_admin_id'];
			}

			return false;

		}			
		
	}
	
	
	function get_admin_name_by_id($admin_id=null)
	{
		if($admin_id)
		{
			$CI = & get_instance();		
			$CI->db->select('admin_name,admin_email');	
			$CI->db->from('tbl_admin');
			$CI->db->where(array('pk_admin_id'=>$admin_id));
			$res=$CI->db->get();
			if($res)
			{
				return $res->row_array();
			}
		}
		
		return false;
		
	}
	
	
	function check_wishlist($type='product',$id)
	{	
		
		$CI = & get_instance();
		$uid=$CI->session->front_user_id?$CI->session->front_user_id:0;
		$records=$CI->db->get_where('tbl_wishlist',array('item_type'=>$type,'item_id'=>$id,'fk_user_id'=>$CI->session->front_user_id));
		
		if($records->num_rows()>0)
		{
			return true;
		}
		return false;
	}
?>