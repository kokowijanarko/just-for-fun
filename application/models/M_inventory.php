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
	
	public function getInventoryByCat($filter){
		$this->load->model('m_condition');
		
		if(is_array($filter)){
			extract($filter);
		}
		$query = "
			SELECT 
				b.`inv_id` AS `id`,
				b.`inv_name` AS `name`,
				b.`inv_number` AS `number`,
				b.`inv_date_procurement` AS `date_procurment`,
				e.`category_name` AS `category`,
				c.`type_name` AS `type`,
				--cond--
				(COUNT(b.`inv_id`)) AS count_total
				
			FROM inv_history a
			JOIN inv_inventory b ON b.`inv_id` = a.`history_inv_id`
			JOIN inv_ref_category e ON e.`category_id` = b.`inv_category_id`
			JOIN inv_ref_type c ON c.`type_id` = b.`inv_type_id`
			JOIN inv_ref_condition d ON d.`cond_id` = a.`history_condition_id`
			WHERE 
				1 = 1
				--key--
			GROUP BY c.`type_id`
		";
		
		$key = '';
		
		if(!empty($periode)){
			$key .= " AND b.`inv_date_procurement` LIKE '$periode%'";
		}
		if(!empty($kategori) && $kategori !== 'all'){
			$key .= " AND b.`inv_category_id` = $kategori";
		}
		if(!empty($tipe) && $tipe !== 'all'){
			$key .= " AND b.`inv_type_id` = $tipe";
		}
		
		$ref_condition = $this->m_condition->select_all();
		
		
		$cond = '';
		foreach($ref_condition as $val){
			$cond_name = strtolower($val->cond_name);
			$cond_name = str_replace(' ', '_', $cond_name);
			$cond .= "
				(SELECT COUNT(aa.`history_id`) 
				FROM inv_history aa
				JOIN inv_inventory bb ON bb.`inv_id` = aa.`history_inv_id`
				WHERE  history_condition_id='". $val->cond_id ."'
					AND bb.`inv_type_id` = c.`type_id`) AS `". $cond_name ."`, 			
			";
		}
		//var_dump($cond);
		
		$query = str_replace('--key--', $key, $query);
		$query = str_replace('--cond--', $cond, $query);
		//var_dump($query);die;
		$sql = $this->db->query($query);
		$result = $sql->result();
		return $result;
	}
	
	
	public function getLastNamePrefix($name){
		$sql = $this->db->query("SELECT MAX(inv_name) AS last_prefix FROM inv_inventory WHERE inv_name LIKE '".$name."%'");
		return $sql->row();
	}
}