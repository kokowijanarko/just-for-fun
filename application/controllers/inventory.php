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
		$data['view'] = 'pages/form_tambah_inventory';
		$this->load->view('index', $data);
	}

	public function proses_tambah_inventory(){
		$data['kode_inventory'] = $this->input->post('kode_inventory');
		$data['nama_inventory'] = $this->input->post('nama_inventory');
		$data['kondisi'] = $this->input->post('kondisi');
		$data['tanggal_diterima'] = $this->input->post('tanggal_diterima');
		$this->M_inventory->tambah_inventory($data);
		$this->view_inv();
	}

	public function delete_inventory($kode_inventory){
		$this->M_inventory->delete_inventory($kode_inventory);
		$this->view_inv();
	}

	public function edit_inventory($kode_inventory){
		$data['inv_res'] = $this->M_inventory->select_by_id($kode_inventory)->row();
		$data['view'] = 'pages/form_edit_inventory';
		$this->load->view('index', $data);
	}

	public function proses_edit_inventory(){
		//var_dump($_POST);die();
		//$data['kode_inventory'] = $this->input->post('kode_inventory');
		$data['nama_inventory'] = $this->input->post('nama_inventory');
		$data['kondisi'] = $this->input->post('kondisi');
		$data['tanggal_diterima'] = $this->input->post('tanggal_diterima');
		$kode_inventory=$this->input->post('kode_inventory');
		$this->M_inventory->do_edit_inventory($kode_inventory, $data);
		$this->view_inv();
	}
   
}
