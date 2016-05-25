<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_type extends CI_Model
{
	
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
	
	public function addType($data){	
		$result = false;
		if(!empty($data)){
			$execute = $this->db->insert('inv_ref_type', $data);	
			$result = true;
		}
		return $result;
	}
	
	function select_all(){
		$query = $this->db->query("SELECT * FROM inv_ref_type");
		$result = $query->result();
		return $result;
	}

	function select_by_id($id){
		$this->db->select('*');
		$this->db->from('inv_ref_type');
		$this->db->where('type_id', $id);
		return $this->db->get();
	}

	public function editType($type_id, $data){
		//var_dump($type_id);die();
		//var_dump($data);die();
		$this->db->where('type_id', $type_id);
		$this->db->update('inv_ref_type', $data);
	}
	
	
	public function deleteType($type_id){
		$result = false;
		if(!empty($type_id)){
			$execute = $this->db->delete('inv_ref_type', array('type_id' => $type_id));
			$result = true;
		}		
		return $result;		
	}
	
	
	
	
}