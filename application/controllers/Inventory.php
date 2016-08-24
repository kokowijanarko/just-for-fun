<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('message');
		$this->load->model('M_inventory');
		
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
		$data['inven'] = $this->M_inventory->select_all();
		$this->load->view('pages/inventory_view', $data);
	}

	public function inventory_add(){
		$data['opt'] = $this->M_inventory->getInvCategory();
		$data['type'] = $this->M_inventory->getInvType();
		$this->load->view('pages/inventory_insert', $data);
	}

	public function inventory_add_process(){	
		$count = $this->M_inventory->countRow();
		//var_dump($count); die();
		$counters = $count->counter;
		//var_dump($counters); die();
		$jumlah = $this->input->post('jumlah');
		//var_dump($jumlah); die();
		$prefix = 1;
		
		$this->db->trans_start();
		$result = $this->M_inventory->getLastNamePrefix($this->input->post('nama_inventaris'));			
		if(!empty($result->last_prefix) || !is_null($result->last_prefix)){
			$prefix = $result->last_prefix;
		}
		//var_dump($result, $prefix);die;
		
		
		for ($i=1; $i <= $jumlah; $i++) {
			$nama = $this->input->post('nama_inventaris');
			$data['inv_name'] = $nama.' '.($prefix++);
			$data['inv_date_procurement'] = date('Y-m-d', strtotime($this->input->post('tanggal_diterima')));
			$data['inv_date_expired'] = date('Y-m-d', strtotime($this->input->post('tanggal_expired')));
			$data['inv_type_id'] = $this->input->post('tipe');
			$data['inv_category_id'] = $this->input->post('kategori');
			$data['inv_store_place_in_use'] = $this->input->post('store_place_in_use');
			$data['inv_store_place_after_use'] = $this->input->post('store_place_after_use');
			$data['inv_desc'] = $this->input->post('deskripsi');
			$data['inv_number'] = $counters+$i.'/'.date('Y/m/d', strtotime($this->input->post('tanggal_diterima')));
	 		$result = $result && $this->M_inventory->addInventory($data);
		}
		var_dump($this->db->last_query());die;
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
		//$data['view'] = 'pages/form_edit_inventory';
		$this->load->view('pages/inventory_edit', $data);
	}

	public function proses_edit_inventory(){
		$data['inv_name'] = $this->input->post('nama_inventory');
		$data['inv_date_procurement'] = date('Y-m-d', strtotime($this->input->post('tanggal_diterima')));
		$data['inv_date_expired'] = date('Y-m-d', strtotime($this->input->post('tanggal_expired')));
		$data['inv_type_id'] = $this->input->post('type');
		$data['inv_category_id'] = $this->input->post('category');
		$data['inv_store_place_in_use'] = $this->input->post('store_place_in_use');
		$data['inv_store_place_after_use'] = $this->input->post('store_place_after_use');
		$data['inv_desc'] = $this->input->post('deskripsi');
		$inv_id=$this->input->post('id_inventory');
		$result = $this->M_inventory->do_edit_inventory($inv_id, $data);
		
		if($result == true){
			redirect(site_url('inventory/inventory_read?msg=Em1'));
		}else{
			unset($_POST);
			redirect(site_url('inventory/inventory_read?msg=Em0'));
		}
	}
   
}
