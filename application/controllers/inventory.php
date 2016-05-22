<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
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
		$data['inven'] = $this->M_inventory->select_all();
		$data['view'] = 'pages/inventory_view';
		$this->load->view('index', $data);
	}

	public function tambah_inventory(){
		$data['opt'] = $this->M_inventory->select_category();
		$data['view'] = 'pages/form_tambah_inventory';
		$this->load->view('index', $data);
	}

	public function proses_tambah_inventory(){
		$data['inv_name'] = $this->input->post('nama_inventory');
		$data['inv_condition_id'] = $this->input->post('kondisi');
		$data['inv_date_procurement'] = $this->input->post('tanggal_diterima');
		$data['inv_type_id'] = $this->input->post('tipe');
		$data['inv_parent'] = $this->input->post('parent');
		$data['inv_desc'] = $this->input->post('deskripsi');
		$this->M_inventory->tambah_inventory($data);
		$this->view_inv();
	}

	public function delete_inventory($inv_id){
		$this->M_inventory->delete_inventory($inv_id);
		$this->view_inv();
	}

	public function edit_inventory($inv_id){
		$data['inv_res'] = $this->M_inventory->select_by_id($inv_id)->row();
		$data['view'] = 'pages/form_edit_inventory';
		$this->load->view('index', $data);
	}

	public function proses_edit_inventory(){
		//var_dump($_POST);die();
		//$data['inv_id'] = $this->input->post('inv_id');
		$data['inv_name'] = $this->input->post('nama_inventory');
		$data['inv_condition_id'] = $this->input->post('kondisi');
		$data['inv_date_procurement'] = $this->input->post('tanggal_diterima');
		$data['inv_type_id'] = $this->input->post('tipe');
		//$data['inv_parent'] = $this->input->post('tipe');
		$data['inv_desc'] = $this->input->post('deskripsi');
		$inv_id=$this->input->post('inv_id');
		$this->M_inventory->do_edit_inventory($inv_id, $data);
		$this->view_inv();
	}
   
}
