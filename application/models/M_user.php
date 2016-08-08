<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model
{
	
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
	
	public function addUser($data){	
		$result = false;
		if(!empty($data)){
			$execute = $this->db->insert('dev_user', $data);
			//var_dump($this->db->last_query());die;
			$result = true;
		}
		return $result;
	}
	
	function selectAllUser(){
		$query = $this->db->query("SELECT * FROM dev_user");
		$result = $query->result();
		return $result;
	}
	

	function selectUserById($id){
		$query = $this->db->query("SELECT * FROM dev_user WHERE user_id = $id");
		$result = $query->row();
		return $result;
	}

	public function editUser($id, $data){
		//var_dump($id);die();
		//var_dump($data);die();
		$this->db->where('user_id', $id);
		$this->db->update('dev_user', $data);
	}
	
	
	public function deleteUser($id){
		$result = false;
		if(!empty($id)){
			$execute = $this->db->delete('dev_user', array('user_id' => $id));
			//var_dump($this->db->last_query());die;
			$result = true;
		}		
		return $result;		
	}
	
	
	
	
}