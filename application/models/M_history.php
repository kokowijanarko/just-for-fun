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
		$query = $this->db->query('SELECT
	a.history_id AS history_id,
	a.history_insert_timestamp AS history_date,
	d.inv_number AS history_inv_number,
	a.history_desc AS history_desc,
	b.user_username AS history_user,
	c.cond_name AS history_cond,
	d.inv_name AS history_inv
	
FROM inv_history a
LEFT JOIN dev_user b ON b.user_id = a.history_insert_user_id
LEFT JOIN inv_ref_condition c ON c.cond_id = a.history_condition_id
LEFT JOIN inv_inventory d ON d.inv_id = a.history_inv_id');
		$result = $query->result();
		return $result;
	}
	
	public function addHistory($data){	
		$execute = $this->db->insert('inv_history', $data);	
		//var_dump($this->db->last_query()); die();
		return $execute;
	}

	function getHistoryById($history_id){
		$query = $this->db->query('select 
	a.history_inv_id as history_inv_id,
	a.history_condition_id as history_condition_id,
	a.history_id as history_id,
	a.history_insert_user_id as history_user_id,
	a.history_insert_timestamp as history_date,
	a.history_desc as history_desc,
	b.user_name as history_user,
	c.cond_name as history_cond,
	d.inv_name as history_inv
from inv_history a
left join dev_user b ON b.user_id = a.history_insert_user_id
left join inv_ref_condition c on c.cond_id = a.history_condition_id
left join inv_inventory d on d.inv_id = a.history_inv_id
where history_id ='.$history_id);
		$result = $query->row();
		return $result;
	}

	public function editHistory($history_id, $data){
		$result = $this->db->update('inv_history', $data, array('history_id' => $history_id));		
		return $result;
	}
	
	
	public function deleteHistory($history_id){
		$result = $this->db->delete('inv_history', array('history_id' => $history_id));
		return $result;		
	}
	
	function getInvInventory(){
		$query = $this->db->query("SELECT inv_id, inv_name, inv_number FROM inv_inventory");
		$result = $query->result();
		return $result;
	}
	
	function getInvCondition(){
		$query = $this->db->query("SELECT cond_id, cond_name FROM inv_ref_condition");
		$result = $query->result();
		return $result;
	}
	
	function getDevUser(){
		$query = $this->db->query("SELECT user_id, user_username FROM dev_user");
		$result = $query->result();
		return $result;
	}
	
}