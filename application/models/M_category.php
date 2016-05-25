<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_category extends CI_Model
{
	
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
	
	public function addCategory($data){	
		$result = false;
		if(!empty($data)){
			$execute = $this->db->insert('inv_ref_category', $data);	
			$result = true;
		}
		return $result;
	}
	
	function select_all(){
		$query = $this->db->query("SELECT * FROM inv_ref_category");
		$result = $query->result();
		return $result;
	}
	

	function select_by_id($id){
		$this->db->select('*');
		$this->db->from('inv_ref_category');
		$this->db->where('category_id', $id);
		return $this->db->get();
	}

	public function editCategory($category_id, $data){
		//var_dump($category_id);die();
		//var_dump($data);die();
		$this->db->where('category_id', $category_id);
		$this->db->update('inv_ref_category', $data);
	}
	
	
	public function deleteCategory($category_id){
		$result = false;
		if(!empty($category_id)){
			$execute = $this->db->delete('inv_ref_category', array('category_id' => $category_id));
			$result = true;
		}		
		return $result;		
	}
	
	
	
	
}