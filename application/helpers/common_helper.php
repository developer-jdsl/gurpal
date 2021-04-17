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
    
     
?>