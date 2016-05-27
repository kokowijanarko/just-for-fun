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
			redirect(base_url('index.php/inventory/view_inv'));
		}
	}

	public function view_inv(){
		if(isset($_GET['msg'])){
			$data['message'] = $this->message->getMessage($_GET['msg']);
		}
		$data['inven'] = $this->M_inventory->select_all();
		$data['view'] = 'pages/inventory_view';
		$this->load->view('index', $data);
	}

	public function tambah_inventory(){
		$data['opt'] = $this->M_inventory->getInvCategory();
		$data['type'] = $this->M_inventory->getInvType();
		$data['view'] = 'pages/form_tambah_inventory';
		$this->load->view('index', $data);
	}

	public function proses_tambah_inventory(){		
		$data['inv_name'] = $this->input->post('nama_inventory');
		$data['inv_date_procurement'] = date('Y-m-d', strtotime($this->input->post('tanggal_diterima')));
		$data['inv_type_id'] = $this->input->post('type');
		$data['inv_category_id'] = $this->input->post('category');
		$data['inv_desc'] = $this->input->post('deskripsi');
		$result = $this->M_inventory->tambah_inventory($data);
		
		if($result == true){
			redirect(site_url('inventory/view_inv?msg=Am1'));
		}else{
			unset($_POST);
			redirect(site_url('inventory/view_inv?msg=Am0'));
		}
	}

	public function delete_inventory($inv_id){
		$result = $this->M_inventory->delete_inventory($inv_id);
		if($result == true){
			redirect(site_url('inventory/view_inv?msg=Dm1'));
		}else{
			unset($_POST);
			redirect(site_url('inventory/view_inv?msg=Dm0'));
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
			redirect(site_url('inventory/view_inv?msg=Em1'));
		}else{
			unset($_POST);
			redirect(site_url('inventory/view_inv?msg=Em0'));
		}
	}
   
}
