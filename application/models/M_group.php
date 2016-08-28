<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_group extends CI_Model
{
	
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
	
	public function addGroup($data){	
		$result = $this->db->insert('inv_ref_group', $data);	
		return $result;
	}
	
	function getGroup(){
		$query = $this->db->query("SELECT * FROM inv_ref_group");
		$result = $query->result();
		return $result;
	}
	
	function getGroupById($id){
		$query = $this->db->query("SELECT * FROM inv_ref_group WHERE group_id=". $id);
		$result = $query->row();
		return $result;
	}

	function select_by_id($id){
		$this->db->select('*');
		$this->db->from('inv_ref_group');
		$this->db->where('group_id', $id);
		return $this->db->get();
	}

	public function editGroup($group_id, $data){
		//var_dump($group_id);die();
		//var_dump($data);die();
		$result = $this->db->where('group_id', $group_id);
		$result = $this->db->update('inv_ref_group', $data);
		return $result;
	}
	
	
	public function deleteGroup($group_id){
		$result = $this->db->delete('inv_ref_group', array('group_id' => $group_id));
		return $result;		
	}
	
}