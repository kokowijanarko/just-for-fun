<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_class extends CI_Model
{
	
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
	
	public function addClass($data){	
		$result = $this->db->insert('inv_ref_class', $data);	
		return $result;
	}
	
	function getClass(){
		$query = $this->db->query("SELECT * FROM inv_ref_class");
		$result = $query->result();
		return $result;
	}
	
	function getClassById($id){
		$query = $this->db->query("SELECT * FROM inv_ref_class WHERE class_id=". $id);
		$result = $query->row();
		return $result;
	}

	function select_by_id($id){
		$this->db->select('*');
		$this->db->from('inv_ref_class');
		$this->db->where('class_id', $id);
		return $this->db->get();
	}

	public function editClass($class_id, $data){
		//var_dump($class_id);die();
		//var_dump($data);die();
		$result = $this->db->where('class_id', $class_id);
		$result = $this->db->update('inv_ref_class', $data);
		return $result;
	}
	
	
	public function deleteClass($class_id){
		$result = $this->db->delete('inv_ref_class', array('class_id' => $class_id));
		return $result;		
	}
	
}