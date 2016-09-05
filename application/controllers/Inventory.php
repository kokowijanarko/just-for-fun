<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('message');
		$this->load->model('M_inventory');
		$this->load->model('m_history');
		
    }
	
	public function index(){
		if(!isset($this->session->userdata['data'])){			
			redirect(base_url('index.php/home/login'));
		}else{			
			redirect(base_url('index.php/inventory/inventory_read'));
		}
	}

	public function inventory_read(){
		if(isset($_GET['msg'])){
			$data['message'] = $this->message->getMessage($_GET['msg']);
		}
		$class_id=!empty($_POST['class'])?$_POST['class']:'all';
		$category_id=!empty($_POST['category'])?$_POST['category']:'all';
		$group_id=!empty($_POST['group'])?$_POST['group']:'all';
		$type_id=!empty($_POST['type'])?$_POST['type']:'all';
		$year=!empty($_POST['year'])?$_POST['year']:'all';
		$month=!empty($_POST['month'])?$_POST['month']:'all';
		$period = $year.'-'.$month;
		
		$data['filter'] = array('period'=>$period, 'year'=>$year, 'month'=>$month, 'type_id'=>$type_id, 'class_id'=>$class_id, 'category_id'=>$category_id, 'group_id'=>$group_id);
		$data['opt'] = $this->M_inventory->getInvCategory();
		$data['type'] = $this->M_inventory->getInvType();
		$data['class'] = $this->M_inventory->getInvClass();
		$data['group'] = $this->M_inventory->getInvGroup();
		$data['inven'] = $this->M_inventory->select_all('all',$type_id, $class_id, $category_id, $group_id, $period);
		// var_dump($_POST, $data['filter'], $this->db->last_query());
		$this->load->view('pages/inventory_view', $data);
	}

	public function inventory_add(){
		$data['opt'] = $this->M_inventory->getInvCategory();
		$data['type'] = $this->M_inventory->getInvType();
		$data['class'] = $this->M_inventory->getInvClass();
		$data['group'] = $this->M_inventory->getInvGroup();
		$data['storage'] = $this->M_inventory->select_all(1, null);
		//var_dump($this->db->last_query());die;
		$this->load->view('pages/inventory_insert', $data);
	}

	public function inventory_add_process(){	
		$count = $this->M_inventory->countRow();
		$counters = $count->counter;
		$jumlah =intval($this->input->post('jumlah'));
		$prefix = 0;
		
		$this->db->trans_start();
		$result = $this->M_inventory->getLastNamePrefix($this->input->post('nama_inventaris'));			
		
		$name = $this->M_inventory->getTypeName($this->input->post('tipe'));
		$name = $name->type_name;
		
		$inv_by_type = $this->M_inventory->select_all(null, $this->input->post('tipe'));
		//var_dump($this->db->last_query(), $inv_by_type);die;
		
		$count_inv = count($inv_by_type) == 0 ? 1 : count($inv_by_type);
		//var_dump($jumlah, $count_inv);
		//$x=0;
		for ($i=1; $i <= $jumlah; $i++) {
			//$nama = $this->input->post('nama_inventaris');
			$prefik = $count_inv++;
			$data['inv_name'] = $name;
			$data['inv_date_procurement'] = date('Y-m-d', strtotime($this->input->post('tanggal_diterima')));
			$data['inv_date_expired'] = date('Y-m-d', strtotime($this->input->post('tanggal_expired')));
			$data['inv_class_id'] = $this->input->post('class');
			$data['inv_category_id'] = $this->input->post('category');
			$data['inv_group_id'] = $this->input->post('group');
			$data['inv_type_id'] = $this->input->post('tipe');
			$data['inv_store_place_in_use'] = $this->input->post('store_place_in_use');
			$data['inv_store_place_after_use'] = $this->input->post('store_place_after_use');
			$data['inv_desc'] = $this->input->post('deskripsi');
			$data['inv_number'] = date('y.m', strtotime($this->input->post('tanggal_diterima'))).'.'.$data['inv_class_id'].'.'.$data['inv_category_id'].'.'.$data['inv_group_id'].'.'.$data['inv_type_id'].'.'. $prefik;
	 		
			$result = $result && $this->M_inventory->addInventory($data);			
			//var_dump($result, $this->db->last_query(), $prefik, $data);
			if($result){
				$id = $this->db->insert_id();
				$data_history['history_inv_id'] = $id;
				$data_history['history_condition_id'] = 1;
				$data_history['history_desc'] = '';
				$data_history['history_insert_user_id'] = $this->session->userdata('data')->user_id;
				$data_history['history_insert_timestamp'] = date('Y-m-d H:i:s');
				
				$result = $result && $this->m_history->addHistory($data_history);
				
			}
			//var_dump($this->db->last_query());
		}
		//var_dump($data);die;

		
		// die;		
		
		$this->db->trans_complete($result);
		if($result == true){
			redirect(site_url('inventory/inventory_read?msg=Am1'));
		}else{
			unset($_POST);
			redirect(site_url('inventory/inventory_read?msg=Am0'));
		}
	}

	public function delete_inventory($inv_id){
		$result = $this->M_inventory->delete_inventory($inv_id);
		if($result == true){
			redirect(site_url('inventory/inventory_read?msg=Dm1'));
		}else{
			unset($_POST);
			redirect(site_url('inventory/inventory_read?msg=Dm0'));
		}
	}

	public function edit_inventory($inv_id){
		$data['inv_res'] = $this->M_inventory->getInvById($inv_id);
		$data['category'] = $this->M_inventory->getInvCategory();
		$data['type'] = $this->M_inventory->getInvType();
		$data['class'] = $this->M_inventory->getInvClass();
		$data['group'] = $this->M_inventory->getInvGroup();
		$data['storage'] = $this->M_inventory->select_all(1, null);
		$this->load->view('pages/inventory_edit', $data);
	}

	public function proses_edit_inventory(){
		$data['inv_name'] = $this->input->post('nama_inventory');
		$data['inv_date_procurement'] = date('Y-m-d', strtotime($this->input->post('tanggal_diterima')));
		$data['inv_date_expired'] = date('Y-m-d', strtotime($this->input->post('tanggal_expired')));
		$data['inv_class_id'] = $this->input->post('class');
			$data['inv_category_id'] = $this->input->post('category');
			$data['inv_group_id'] = $this->input->post('group');
			$data['inv_type_id'] = $this->input->post('tipe');
		$data['inv_store_place_in_use'] = $this->input->post('store_place_in_use');
		$data['inv_store_place_after_use'] = $this->input->post('store_place_after_use');
		$data['inv_desc'] = $this->input->post('deskripsi');
		$inv_id=$this->input->post('id_inventory');
		$result = $this->M_inventory->do_edit_inventory($inv_id, $data);
		var_dump($result, $this->db->last_query());
		if($result == true){
			redirect(site_url('inventory/inventory_read?msg=Em1'));
		}else{
			unset($_POST);
			redirect(site_url('inventory/inventory_read?msg=Em0'));
		}
	}
	
	public function get_cat_by_class(){		
		//var_dump($_POST['class_id']);die;
		$category = $this->M_inventory->getCatByClass($_POST['class_id']);
		//var_dump($this->db->last_query());die;
		echo json_encode($category);
		exit;
	}
	
	public function get_group_by_cat(){		
		$group = $this->M_inventory->getGroupByCat($_POST['cat_id']);
		echo json_encode($group);
		exit;
	}
	
	public function get_type_by_group(){		
		$type = $this->M_inventory->getTypeByGroup($_POST['group_id']);
		echo json_encode($type);
		exit;
	}
   
}
