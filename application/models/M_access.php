<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_access extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	function login($data){
		$username = $data['username'];
		$password = md5($data['password']);
		
        $query = $this->db->query("select * from dev_admin where username='".$username."' AND password='".$password."'");
		$result = $query->row();
		
		if(!empty($result)){
			$this->session->set_userdata = $result;
			redirect(base_url('index.php/home'));
		}else{
			$x = false;
		}
		return $x;
		
    }
	
	public function logout(){
		
	}
   
   
	
	
}