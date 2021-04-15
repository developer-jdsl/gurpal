<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Authentication_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
   
   function login($email,$pass)
   {
	   $return_array=array('status'=>false,'msg'=>'');
	   $this->db->select('a.*,ap.*');
	   $this->db->from('tbl_admin as a');
	   $this->db->join('tbl_admin_profile as ap','a.pk_admin_id=ap.fk_admin_id','left');
	   $this->db->where(array('a.admin_email'=>$email,'a.admin_password'=>$pass));
	   $return=$this->db->get();
	   $return=$return->row();
	   
	  
	   if(isset($return->pk_admin_id))
	   {
		   
		   if($return->active==1)
		   {
			  
			  
		  $session_arr=array('pk_admin_id'=>$return->pk_admin_id,
							 'user_type'=>'admin',
							 'user_data'=>$return);
							 
			if($return->is_super==1)
			  {
				 $session_arr['user_type']='superadmin';
			  }
			  
			  $this->session->set_userdata($session_arr);
			  
			    $return_array['status']=true;
				
		   }
		else{
			  $return_array['msg']=keyword_value('your_acccount_disabled','Your Account is disabled'); 
		}	
	   }
	   else
	   {
		  $return_array['msg']=keyword_value('invalid_email_password','Invaild Email/password combination'); 
	   }
	   
	   return $return_array;
	   
   }
}
