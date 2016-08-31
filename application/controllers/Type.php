<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
		$this->load->model('M_type');
		$this->load->model('m_group');
		
    }
	
	public function index(){
		if(!isset($this->session->userdata['data'])){			
			redirect(base_url('index.php/home/login'));
		}else{			
			redirect(base_url('index.php/type/type_read'));
		}
	}

	public function type_read(){
		if(isset($this->session->userdata['msg'])){
			$data['message'] = $this->session->userdata['msg'];
		}
		$data['typ'] = $this->M_type->select_all();
		$this->load->view('pages/type_view', $data);
	}

	public function type_add(){
		$data['group'] = $this->m_group->getGroup();
		//var_dump($data);
		$this->load->view('pages/type_insert', $data);
	}

	public function type_add_process(){
		$data['type_code'] = $this->input->post('kode_tipe');
		$data['type_name'] = $this->input->post('nama_tipe');
		$data['type_group_id'] = $this->input->post('group');
		$data['type_desc'] = $this->input->post('keterangan');
		$result = $this->M_type->addType($data);
		if($result){
			$msg = '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> berhasil!</h4>
					Tambah Data Tipe Berhasil.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);
		}else{
			$msg = '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Tambah Data Tipe Gagal.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);				
		}
		redirect(site_url('type/type_read'));
	}

	public function type_delete($type_id){
		$result = $this->M_type->deleteType($type_id);
		if($result){
			$msg = '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> berhasil!</h4>
					Hapus Data Tipe Berhasil.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);
		}else{
			$msg = '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Hapus Data Tipe Gagal.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);				
		}
		redirect(site_url('type/type_read'));
	}

	public function type_edit($type_id){
		$data['type_res'] = $this->M_type->select_by_id($type_id)->row();
		$data['group'] = $this->m_group->getGroup();
		$this->load->view('pages/type_edit', $data);
	}

	public function type_edit_process(){
		//var_dump($_POST);die();
		$data['type_code'] = $this->input->post('kode_tipe');
		$data['type_name'] = $this->input->post('nama_tipe');
		$data['type_group_id'] = $this->input->post('group');
		$data['type_desc'] = $this->input->post('keterangan');
		$type_id=$this->input->post('id_tipe');
		//var_dump($type_id);die();
		$result = $this->M_type->editType($type_id, $data);
		if($result){
			$msg = '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> berhasil!</h4>
					Edit Data Tipe Berhasil.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);
		}else{
			$msg = '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Edit Data Tipe Gagal.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);				
		}
		redirect(site_url('type/type_read'));
	}
	
	public function get_type_by_cat(){		
		$data_type = $this->M_type->getTypeByCat($_POST['category_id']);
		echo json_encode($data_type);
		exit;
	}
	public function get_storage_place(){		
		$data_type = $this->M_type->getTypeIsContainer();
		echo json_encode($data_type);
		exit;
	}
   
}
