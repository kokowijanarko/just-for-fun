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
		$query = $this->db->query("
			SELECT
				a.`category_id`,
				a.`category_name`,
				a.`category_code`,
				a.`is_container`,
				a.`category_class_id`,
				a.`category_desc`,
				b.`class_name`
			FROM inv_ref_category a
			JOIN inv_ref_class b ON b.`class_id` = a.`category_class_id`");
		$result = $query->result();
		return $result;
	}
	

	function select_by_id($id){
		$query = $this->db->query("
			SELECT
				a.`category_id`,
				a.`category_name`,
				a.`category_code`,
				a.`is_container`,
				a.`category_class_id`,
				a.`category_desc`,
				b.`class_name`
			FROM inv_ref_category a
			JOIN inv_ref_class b ON b.`class_id` = a.`category_class_id`
			WHERE a.`category_id`=". $id);
		$result = $query->row();
		return $result;
	}

	public function editCategory($category_id, $data){
		$result = $this->db->where('category_id', $category_id);
		$result = $this->db->update('inv_ref_category', $data);
		return $result;
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