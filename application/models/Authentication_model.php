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
   
   
      
   function user_login($email,$pass)
   {
	   $return_array=array('status'=>false,'msg'=>'');
	   $this->db->select('u.*,up.*');
	   $this->db->from('tbl_user as u');
	   $this->db->join('tbl_user_profile as up','u.pk_user_id=up.fk_user_id','left');
	   $this->db->where(array('u.user_email'=>$email,'u.user_password'=>$pass));
	   $return=$this->db->get();
	   $return=$return->row();
	   
	  
	   if(isset($return->pk_user_id))
	   {
		   
		   if($return->active==1)
		   {
			  
			  
		  $session_arr=array('front_user_id'=>$return->pk_user_id,
							 'front_username'=>$return->user_firstname,
							 'front_user_data'=>$return);
							 
			
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
   
   public function update_email_otp($id,$otp)
   {
	    $time=strtotime("+15 minutes",time());
		$this->db->where('pk_admin_id',$id);
		$this->db->update('tbl_admin',array('otp'=>$otp,'otp_validity'=>$time));
	   
   }
   
      public function update_email_otp_user($id,$otp)
   {
	    $time=strtotime("+15 minutes",time());
		$this->db->where('pk_user_id',$id);
		$this->db->update('tbl_user',array('otp'=>$otp,'otp_validity'=>$time));
	   
   }
   
   
   public function get_otpdetails($otp)
   {
	 $det=$this->db->get_where('tbl_admin',array('otp'=>$otp));  
	 if($det)
	 {
		 return $det->row_array();
	 }
	 
	 return false;
	   
   }
   
      public function get_otpdetails_user($otp)
   {
	 $det=$this->db->get_where('tbl_user',array('otp'=>$otp));  
	 if($det)
	 {
		 return $det->row_array();
	 }
	 
	 return false;
	   
   }
   
   public function verify($id)
   
   {
	   $this->db->where('pk_admin_id',$id);
	   return $this->db->update('tbl_admin',array('is_verified'=>1,'otp'=>'','otp_validity'=>''));
	   
   }
   
     public function verify_user($id)
   
   {
	   $this->db->where('pk_user_id',$id);
	   return $this->db->update('tbl_user',array('is_verified'=>1,'otp'=>'','otp_validity'=>''));
	   
   }
   
   public function register($data)
   {
	   $this->db->insert('tbl_admin',$data);
	   $id=$this->db->insert_id();
	   $data2['fk_admin_id']=$id;
	   $data2['profile_package']=1; //free package
	   if($id)
	   {
		$this->db->insert('tbl_admin_profile',$data2);   
		return array('status'=>true);
		   
	   }
	   
	   return array('status'=>false);
   }
      public function user_register($data)
   {
	   
	   $this->db->insert('tbl_user',$data);
	   $id=$this->db->insert_id();
	   if($id)
	   {
		return array('status'=>true);
	   }
	   
	   return array('status'=>false);
   }
   
   
   public function send_reset_link($email)
   {
	   $return=array('status'=>false,'msg'=>'NA');
	   $result=$this->db->select('pk_admin_id')->from('tbl_admin')->where(array('admin_email'=>$email,'is_super'=>0,'active'=>1,'is_deleted'=>0))->get();
	   if($result)
	   {
		   $result=$result->row_array();
		   $this->load->helper('string');
		   $random=random_string('alnum',30);
		   $this->update_email_otp($result['pk_admin_id'],$random);
		   $rlink=base_url('authentication/reset_password/'.$random);
		   $template=get_email_template('admin_forgot');
		   
		   	$data['to']=$result['admin_email'];
			$data['subject']= $template['subject'];
			$find = array("{{LOGO}}","{{SITE_URL}}","{{SITE_NAME}}","{{ADMIN_NAME}}","{{VERIFY_LINK}}");
			$replace = array(LOGO,base_url(),SITE_NAME,$result['admin_name'],$rlink);
			$data['message']=str_replace($find,$replace,$template['template']);
			
			$ret=sendemail($data);
			if($ret)
			{
				$return['status']=true;
				$return['msg']=keyword_value('reset_link_success','Password reset link sent to your registered email. Link is valid for 15 mins ');
			}
			
			else
			{
				 $return['msg']=keyword_value('try_again','Please try again after sometime ');
			}
		   
	   }
	   else
	   {
		   $return['msg']=keyword_value('email_dont_exists','Email doesn\'t exists or your account is inactive/deleted');
		   
	   }
	   
	   return $return;
   }
   
   public function check_reset_hash($hash)
   
   {
	   $return=array('status'=>false,'msg'=>'NA');
	 $result=$this->db->get_where('tbl_admin',array('otp'=>$hash,'active'=>1,'is_deleted'=>0));  
	 if($result)
	 {
		 $result=$result->row_array();
		 return $result;
		 
	 }
	   
	  return array('pk_admin_is'=>NULL);
   }
   
   public function set_reset_password($id,$pass)
   {
	   $this->db->where('pk_admin_id',$id);
	   return $this->db->update('tbl_admin',array('admin_password'=>$pass));
	  
   }
   

}
