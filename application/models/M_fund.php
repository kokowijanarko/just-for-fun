<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_fund extends CI_Model
{
	
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
	
	public function addFund($data){	
		$result = $this->db->insert('inv_ref_fund', $data);	
		return $result;
	}
	
	function getFund(){
		$query = $this->db->query("SELECT * FROM inv_ref_fund");
		$result = $query->result();
		return $result;
	}
	
	function getFundById($id){
		$query = $this->db->query("SELECT * FROM inv_ref_fund WHERE fund_id=". $id);
		$result = $query->row();
		return $result;
	}

	function select_by_id($id){
		$this->db->select('*');
		$this->db->from('inv_ref_fund');
		$this->db->where('fund_id', $id);
		return $this->db->get();
	}

	public function editGroup($fund_id, $data){
		//var_dump($fund_id);die();
		//var_dump($data);die();
		$result = $this->db->where('fund_id', $fund_id);
		$result = $this->db->update('inv_ref_fund', $data);
		return $result;
	}
	
	
	public function deleteGroup($fund_id){
		$result = $this->db->delete('inv_ref_fund', array('fund_id' => $fund_id));
		return $result;		
	}
	
}