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
	
     
?>