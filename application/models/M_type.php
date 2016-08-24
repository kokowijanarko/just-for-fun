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
		$query = $this->db->query("		
		SELECT
			a.`type_category_id`,
			a.`type_code`,
			a.`type_desc`,
			a.`type_id`,
			a.`type_name`,
			b.`category_name`,
			b.`category_code`
		FROM inv_ref_type a
		JOIN inv_ref_category b ON b.`category_id` = a.`type_category_id`");
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
	
	public function getTypeBYCat($id_cat){
		$id = '';
		if(is_array($id_cat)){
			
			foreach($id_cat as $cat_id){
				$id .= " $cat_id";				
			}
			$id = trim($id);
			$id = str_replace(' ', ',', $id);
		}else{
			$id = $id_cat;
		}
		$qry = $this->db->query('SELECT * FROM inv_ref_type WHERE type_category_id IN ('. $id .')');
		$result = $qry->result();
		return $result;
	}
	
	public function getCat(){
		$qry = $this->db->query('SELECT * FROM inv_ref_category');
		$result = $qry->result();
		return $result;
	}
	
	public function getTypeIsContainer(){
		$qry = $this->db->query('
			SELECT
				a.`type_id`,
				a.`type_name`,
				a.`type_code`,
				a.`type_category_id`				
			FROM `inv_ref_type` a
			JOIN `inv_ref_category` b ON b.`category_id` = a.`type_category_id`
			WHERE b.`is_container`=1
		');
		$result = $qry->result();
		return $result;
	}
	
	
	
}