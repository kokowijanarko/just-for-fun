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
		$data['view'] = 'pages/inventory_view';
		$this->load->view('index', $data);
	}

	public function inventory_add(){
		$data['opt'] = $this->M_inventory->getInvCategory();
		$data['type'] = $this->M_inventory->getInvType();
		$data['view'] = 'pages/inventory_insert';
		$this->load->view('index', $data);
	}

	public function inventory_add_process(){	
		$count = $this->M_inventory->countRow();
		//var_dump($count); die();
		$counters = $count->counter;
		//var_dump($counters); die();
		$jumlah = $this->input->post('jumlah');
		//var_dump($jumlah); die();
		for ($i=1; $i <= $jumlah; $i++) { 	
			$data['inv_name'] = $this->input->post('nama_inventaris');
			$data['inv_date_procurement'] = date('Y-m-d', strtotime($this->input->post('tanggal_diterima')));
			$data['inv_type_id'] = $this->input->post('tipe');
			$data['inv_category_id'] = $this->input->post('kategori');
			$data['inv_desc'] = $this->input->post('deskripsi');
			$data['inv_number'] = $counters+$i.'/'.date('Y/m/d', strtotime($this->input->post('tanggal_diterima')));
	 		$result = $this->M_inventory->addInventory($data);
		}
		//var_dump($this->db->last_query());
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
		$data['view'] = 'pages/form_edit_inventory';
		$this->load->view('index', $data);
	}

	public function proses_edit_inventory(){
		$data['inv_name'] = $this->input->post('nama_inventory');
		$data['inv_date_procurement'] = date('Y-m-d', strtotime($this->input->post('tanggal_diterima')));
		$data['inv_type_id'] = $this->input->post('type');
		$data['inv_category_id'] = $this->input->post('category');
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
