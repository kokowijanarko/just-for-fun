<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_history extends CI_Model
{
	
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
	
	public function getInvHistory(){
		$query = $this->db->query('select 
	a.history_insert_timestamp as history_date,
	a.history_desc as history_desc,
	b.user_name as history_user,
	c.cond_name as history_cond,
	d.inv_name as history_inv
from inv_history a
left join dev_user b ON b.user_id = a.history_insert_user_id
left join inv_ref_condition c on c.cond_id = a.history_condition_id
left join inv_inventory d on d.inv_id = a.history_inv_id');
		$result = $query->result();
		return $result;
	}
	
	public function addHistory($data){	
		$execute = $this->db->insert('inv_history', $data);	
		return $execute;
	}
	
	function selectAllHistory(){
		$query = $this->db->query("SELECT * FROM inv_history");
		$result = $query->result();
		return $result;
	}

	function getHistoryById($history_id){
		$result = $this->db->select('*');
		$result =$this->db->from('inv_history');
		$result =$this->db->where('history_id', $history_id);
		$result =$this->db->get();
		$result = $result->row();
		return $result;
	}

	public function editHistory($history_id,$data){
		$result = $this->db->update('inv_history', $data, array('history_id' => $inv_id));		
		return $result;
	}
	
	
	public function deleteHistory($history_id){
		$result = $this->db->delete('inv_history', array('history_id' => $history_id));
		return $result;		
	}
	
	
	
	
}