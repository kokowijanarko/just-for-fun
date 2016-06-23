<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_inventory extends CI_Model
{
	
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
	
	public function getInvCategory(){
		$query = $this->db->query('select * from inv_ref_category');
		$result = $query->result();
		return $result;
	}
	
	public function countRow(){
		$query = $this->db->query('SELECT DISTINCT COUNT(*) as counter FROM inv_inventory');
		$result = $query->row();
		//print_r($result);die;
		return $result;
	}

	public function addInventory($data){	
		$execute = $this->db->insert('inv_inventory', $data);	
		return $execute;
	}
	
	function select_all(){
		$query = $this->db->query(
		"SELECT a.inv_name as inv_name, 
		a.inv_id as inv_id,
		a.inv_number as inv_number, 
		a.inv_date_procurement as inv_date, 
		b.category_name as category, 
		c.type_name as type 
		FROM inv_inventory a 
		JOIN inv_ref_category b ON b.category_id = a.inv_category_id
		JOIN inv_ref_type c ON c.type_id = a.inv_type_id");	
		//var_dump($this->db->last_query(), $query);die;
		$result = $query->result();
		return $result;
	}
	
	function getInvType(){
		$query = $this->db->query("SELECT type_id, type_name FROM inv_ref_type");
		$result = $query->result();
		return $result;
	}

	function getInvById($inv_id){
		$result = $this->db->select('*');
		$result =$this->db->from('inv_inventory');
		$result =$this->db->where('inv_id', $inv_id);
		$result =$this->db->get();
		$result = $result->row();
		return $result;
	}

	public function do_edit_inventory($inv_id,$data){
		$result = $this->db->update('inv_inventory', $data, array('inv_id' => $inv_id));		
		return $result;
	}
	
	
	public function delete_inventory($id){
		$result = $this->db->delete('inv_inventory', array('inv_id' => $id));
		return $result;		
	}
	
	
	
	
}