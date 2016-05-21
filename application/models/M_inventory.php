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
			$execute = $this->db->insert('dev_inventory', $data);	
			$result = true;
		}
		return $result;
	}
	
	function select_all(){
		$query = $this->db->query("SELECT * FROM dev_inventory");
		$result = $query->result();
		return $result;
	}
	

	function select_by_id($kode_inventory){
		$this->db->select('*');
		$this->db->from('dev_inventory');
		$this->db->where('kode_inventory', $kode_inventory);
		return $this->db->get();
	}

	public function do_edit_inventory($kode_inventory,$data){
		$this->db->update('dev_inventory', $data, array('kode_inventory' => $kode_inventory));
			
		
	}
	
	
	public function delete_inventory($id){
		$result = false;
		if(!empty($id)){
			$execute = $this->db->delete('dev_inventory', array('kode_inventory' => $id));
			$result = true;
		}		
		return $result;		
	}
	
	
	
	
}