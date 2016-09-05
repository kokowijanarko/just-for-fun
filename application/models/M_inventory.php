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
	
	function select_all($is_container=null, $type_id=null, $class_id=null, $category_id=null, $group_id=null, $period=null){
		$sql = 
		"SELECT a.inv_name AS inv_name, 
			a.inv_id AS inv_id,
			a.inv_number AS inv_number, 
			a.`inv_date_expired` AS date_expired,
			a.inv_date_procurement AS inv_date, 
			b.category_name AS category, 
			c.type_name AS `type`,
			a.`inv_store_place_after_use`,
			a.`inv_store_place_in_use`,
			a.inv_desc AS `desc`,
			d.`group_name` AS `group`,
			e.`class_name` AS `class`,
			(SELECT inv_name FROM `inv_inventory` WHERE `inv_id`=a.`inv_store_place_after_use`) AS `store_place_after_use`,
			(SELECT inv_name FROM `inv_inventory` WHERE `inv_id`=a.`inv_store_place_in_use`) AS `store_place_in_use`
		FROM inv_inventory a 
		JOIN inv_ref_category b ON b.category_id = a.inv_category_id
		JOIN inv_ref_type c ON c.type_id = a.inv_type_id
		JOIN `inv_ref_group` d ON d.`group_id` = a.`inv_group_id`
		JOIN `inv_ref_class` e ON e.`class_id` = a.`inv_class_id`
		WHERE 
			1=1
			---whr---
		";	
		
		$str = '';
		if(!is_null($is_container) && $is_container !== 'all'){
			$str .= ' AND d.`is_container` = 1'; 
		}
		
		if(!is_null($type_id) && $type_id !== 'all'){
			$str .= ' AND c.`type_id` ='. $type_id;
		}
		
		if(!is_null($class_id) && $class_id !== 'all'){
			$str .= ' AND e.`class_id` ='. $class_id;
		}
		
		if(!is_null($category_id) && $category_id !== 'all'){
			$str .= ' AND b.`category_id` ='. $category_id;
		}
		if(!is_null($group_id) && $group_id !== 'all'){
			$str .= ' AND d.`group_id` ='. $group_id;
		}
		if(!is_null($period) && $period !== 'all-all'){
			$period = explode('-', $period);
			if($period[0] !== 'all' && $period[1] !== 'all'){
				$str .= ' AND a.inv_date_procurement LIKE "%'.$period[0].'-'.$period[1].'%"';
			}elseif($period[0] == 'all' && $period[1] !== 'all'){
				$str .= ' AND a.inv_date_procurement LIKE "%'.$period[1].'%"';
			}elseif($period[0] !== 'all' && $period[1] == 'all'){
				$str .= ' AND a.inv_date_procurement LIKE "%'.$period[0].'%"';
			}
		}
		
		
		$sql = str_replace('---whr---', $str, $sql);
		$query = $this->db->query($sql);
		
		//var_dump($this->db->last_query(), $query, $is_container);die;
		$result = $query->result();
		return $result;
	}
	
	function getInvType(){
		$query = $this->db->query("SELECT type_id, type_name FROM inv_ref_type");
		$result = $query->result();
		return $result;
	}
	
	function getInvClass(){
		$query = $this->db->query("SELECT * FROM inv_ref_class");
		$result = $query->result();
		return $result;
	}
	function getInvGroup(){
		$query = $this->db->query("SELECT * FROM inv_ref_group");
		$result = $query->result();
		return $result;
	}
	
	function getCatByClass($id){
		$query = $this->db->query("SELECT * FROM inv_ref_category WHERE category_class_id=".$id);
		$result = $query->result();
		return $result;
	}
	
	function getGroupByCat($id){
		$query = $this->db->query("SELECT * FROM inv_ref_group WHERE group_category_id=".$id);
		$result = $query->result();
		return $result;
	}
	
	function getTypeByGroup($id){
		$query = $this->db->query("SELECT * FROM inv_ref_type WHERE type_group_id=".$id);
		$result = $query->result();
		return $result;
	}

	function getInvById($inv_id){
		$query = $this->db->query('
			SELECT a.inv_name AS inv_name, 
			a.inv_id AS inv_id,
			a.inv_number AS inv_number, 
			a.`inv_date_expired`,
			a.inv_date_procurement, 
			b.category_name AS category, 
			c.type_name AS `type`,
			a.`inv_store_place_after_use`,
			a.`inv_store_place_in_use`,
			a.inv_desc,
			a.inv_class_id,
			a.inv_group_id,
			a.inv_category_id,
			a.inv_type_id,
			d.`group_name` AS `group`,
			e.`class_name` AS `class`,
			(SELECT inv_name FROM `inv_inventory` WHERE `inv_id`=a.`inv_store_place_after_use`) AS `store_place_after_use`,
			(SELECT inv_name FROM `inv_inventory` WHERE `inv_id`=a.`inv_store_place_in_use`) AS `store_place_in_use`
		FROM inv_inventory a 
		JOIN inv_ref_category b ON b.category_id = a.inv_category_id
		JOIN inv_ref_type c ON c.type_id = a.inv_type_id
		JOIN `inv_ref_group` d ON d.`group_id` = a.`inv_group_id`
		JOIN `inv_ref_class` e ON e.`class_id` = a.`inv_class_id`
			WHERE a.`inv_id` = '. $inv_id);
		
		$result = $query->row();
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
		// var_dump($filter);
		$query = "
			SELECT 
				b.`inv_id` AS `id`,
				b.`inv_name` AS `name`,
				b.`inv_number` AS `number`,
				b.`inv_date_procurement` AS `date_procurment`,
				e.`category_name` AS `category`,
				c.`type_name` AS `type`,
				g.`class_name` AS `class`,
				f.`group_name` AS `group`,
				--cond--
				(SELECT COUNT(aa.`inv_id`) FROM inv_inventory aa WHERE aa.`inv_type_id` = b.`inv_type_id` AND inv_date_procurement = b.`inv_date_procurement`) AS count_total
				
			FROM inv_history a
			JOIN inv_inventory b ON b.`inv_id` = a.`history_inv_id`
			JOIN inv_ref_category e ON e.`category_id` = b.`inv_category_id`
			JOIN inv_ref_type c ON c.`type_id` = b.`inv_type_id`
			JOIN inv_ref_condition d ON d.`cond_id` = a.`history_condition_id`
			JOIN inv_ref_class g ON g.`class_id` = b.`inv_class_id`
			JOIN inv_ref_group f ON f.`group_id` = b.`inv_group_id`
			WHERE 
				1 = 1
				--key--
			GROUP BY c.`type_id`
			ORDER BY b.`inv_name`
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
		if(!empty($group) && $group !== 'all'){
			$key .= " AND f.`group_id` = $group";
		}
		if(!empty($class) && $class !== 'all'){
			$key .= " AND g.`class_id` = $class";
		}
		if(!is_null($period) && $period !== 'all-all'){
			$period = explode('-', $period);
			if($period[0] !== 'all' && $period[1] !== 'all'){
				$key .= ' AND b.inv_date_procurement LIKE "%'.$period.'%"';
			}elseif($period[0] == 'all' && $period[1] !== 'all'){
				$key .= ' AND b.inv_date_procurement LIKE "%'.$period[1].'%"';
			}elseif($period[0] !== 'all' && $period[1] == 'all'){
				$key .= ' AND b.inv_date_procurement LIKE "%'.$period[0].'%"';
			}
		}
		
		$ref_condition = $this->m_condition->select_all();
		
		
		$cond = '';
		foreach($ref_condition as $val){
			$cond_name = strtolower($val->cond_name);
			$cond_name = str_replace(' ', '_', $cond_name);
			$cond .= "
				IF(
					(SELECT COUNT(aa.`history_id`) 
					FROM inv_history aa
					JOIN inv_inventory bb ON bb.`inv_id` = aa.`history_inv_id`
					WHERE  history_condition_id='". $val->cond_id ."' AND bb.`inv_type_id` = c.`type_id` AND inv_date_procurement = b.`inv_date_procurement`) = 0,
					'-',
					(SELECT COUNT(aa.`history_id`) 
					FROM inv_history aa
					JOIN inv_inventory bb ON bb.`inv_id` = aa.`history_inv_id`
					WHERE  history_condition_id='". $val->cond_id ."' AND bb.`inv_type_id` = c.`type_id` AND inv_date_procurement = b.`inv_date_procurement`)						
				) AS `". $cond_name ."`, 			
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
	
	public function getInv($filter){
		if(is_array($filter)){
			extract($filter);
		}
		
		$query="
			SELECT
				a.`inv_name`,
				a.`inv_number`,
				a.`inv_date_procurement`,
				d.`class_name`,
				b.`category_name`,
				e.`group_name`,
				c.`type_name`,	
				IFNULL((SELECT CONCAT(inv_name, '|', inv_number) FROM `inv_inventory` WHERE `inv_id`=a.`inv_store_place_after_use`), '-') AS `store_place_after_use`,
				IFNULL((SELECT CONCAT(inv_name, '|', inv_number) FROM `inv_inventory` WHERE `inv_id`=a.`inv_store_place_in_use`), '-') AS `store_place_in_use`
			FROM `inv_inventory` a
			JOIN `inv_ref_category` b ON b.`category_id`=a.`inv_category_id`
			JOIN `inv_ref_type` c ON c.`type_id` = a.`inv_type_id`
			JOIN inv_ref_class d ON d.`class_id` = a.`inv_class_id`
			JOIN inv_ref_group e ON e.`group_id` = a.`inv_group_id`
			WHERE 1 = 1
				--key--
			GROUP BY a.`inv_id`
		";
		$key = '';
		if(!empty($category) && $category !== 'all'){
			$key .= " AND a.`inv_category_id` = $category";
		}
		if(!empty($class) && $class !== 'all'){
			$key .= " AND a.`inv_class_id` = $class";
		}
		if(!empty($group) && $group !== 'all'){
			$key .= " AND a.`inv_group_id` = $group";
		}
		if(!empty($tipe) && $tipe !== 'all'){
			$key .= " AND a.`inv_type_id` = $tipe";
		}
		if(!is_null($period) && $period !== 'all-all'){
			$period = explode('-', $period);
			if($period[0] !== 'all' && $period[1] !== 'all'){
				$key .= ' AND a.inv_date_procurement LIKE "%'.$period[0].'-'.$period[1].'%"';
			}elseif($period[0] == 'all' && $period[1] !== 'all'){
				$key .= ' AND a.inv_date_procurement LIKE "%'.$period[1].'%"';
			}elseif($period[0] !== 'all' && $period[1] == 'all'){
				$key .= ' AND a.inv_date_procurement LIKE "%'.$period[0].'%"';
			}
		}
		$query = str_replace('--key--', $key, $query);
		$sql = $this->db->query($query);
		$result = $sql->result();
		return $result;
	}
	
	public function getTypeName($id){
		$query = $this->db->query('SELECT type_name FROM inv_ref_type WHERE type_id='.$id);
		$result = $query->row();
		return $result;
	}
	
	
		
}