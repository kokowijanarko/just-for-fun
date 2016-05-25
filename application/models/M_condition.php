<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_condition extends CI_Model
{
	
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
	
	public function addCondition($data){	
		$result = false;
		if(!empty($data)){
			$execute = $this->db->insert('inv_ref_condition', $data);	
			$result = true;
		}
		return $result;
	}
	
	function select_all(){
		$query = $this->db->query("SELECT * FROM inv_ref_condition");
		$result = $query->result();
		return $result;
	}
	
	function select_category(){
		$query = $this->db->query("SELECT type_id, type_name FROM inv_ref_type");
		$result = $query->result();
		return $result;
	}

	function select_by_id($id){
		$this->db->select('*');
		$this->db->from('inv_ref_condition');
		$this->db->where('cond_id', $id);
		return $this->db->get();
	}

	public function editCondition($cond_id, $data){
		//var_dump($cond_id);die();
		//var_dump($data);die();
		$this->db->where('cond_id', $cond_id);
		$this->db->update('inv_ref_condition', $data);
	}
	
	
	public function deleteCondition($cond_id){
		$result = false;
		if(!empty($cond_id)){
			$execute = $this->db->delete('inv_ref_condition', array('cond_id' => $cond_id));
			$result = true;
		}		
		return $result;		
	}
	
	
	
	
}