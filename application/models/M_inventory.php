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
	
	public function tambah_inventory($data){	
		$result = false;
		if(!empty($data)){
			$execute = $this->db->insert('inv_inventory', $data);	
			$result = true;
		}
		return $result;
	}
	
	function select_all(){
		$query = $this->db->query("SELECT * FROM inv_inventory");
		$result = $query->result();
		return $result;
	}
	
	function select_category(){
		$query = $this->db->query("SELECT type_id, type_name FROM inv_ref_type");
		$result = $query->result();
		return $result;
	}

	function select_by_id($inv_id){
		$this->db->select('*');
		$this->db->from('inv_inventory');
		$this->db->where('inv_id', $inv_id);
		return $this->db->get();
	}

	public function do_edit_inventory($inv_id,$data){
		$this->db->update('inv_inventory', $data, array('inv_id' => $inv_id));
			
		
	}
	
	
	public function delete_inventory($id){
		$result = false;
		if(!empty($id)){
			$execute = $this->db->delete('inv_inventory', array('inv_id' => $id));
			$result = true;
		}		
		return $result;		
	}
	
	
	
	
}