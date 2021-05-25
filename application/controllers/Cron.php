<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {
	
		public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('authentication_model');
		$this->load->database();
 	}

	
		public function package_check()
	{
		$this->db->select('a.admin_name,a.admin_email,ap.profile_package_end,pa.package_name');
		$this->db->from('tbl_admin as a');
		$this->db->join('tbl_admin_profile as ap','a.pk_admin_id=ap.fk_admin_id','inner');
		$this->db->join('tbl_packages as pa','pa.pk_package_id=ap.fk_package_id','inner');
		$this->db->where(array('a.active'=>1,'a.is_verified'=>1,'is_super'=>0));
		$res=$this->db->get();
		if($res)
		{
			$res=$res->result_array();
			foreach($res as $r)
			{
				if($r['profile_package_end'])
				{
					$ttmp=strtotime($r['profile_package_end']);
					$today=time();
					
					$diff=(int)$ttmp - (int)$today;
					if($diff<604800 && $diff>0)
					{
						$template=get_email_template('package_expiry');
						$data['to']=$r['admin_email'];
						$find = array("{{LOGO}}","{{SITE_URL}}","{{ADMIN_NAME}}","{{PACKAGE_NAME}}","{{PACKAGE_EXPIRY}}");
						$replace = array(LOGO,base_url(),SITE_NAME,$r['admin_name'],$r['package_name'],$r['profile_package_end']);
						$data['subject']= str_replace($find,$replace,$template['subject']);
						$data['message']=str_replace($find,$replace,$template['template']);
						$ret=sendemail($data);	
						
						
					}
					
				}
				
				
			}
			
			
		}
	
		
		
	}
}
