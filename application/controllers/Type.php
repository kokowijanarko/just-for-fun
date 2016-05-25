<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
		$this->load->model('M_type');
		
    }
	
	public function index(){
		if(!isset($this->session->userdata['data'])){			
			redirect(base_url('index.php/home/login'));
		}else{			
			redirect(base_url('index.php/type/type_read'));
		}
	}

	public function type_read(){
		$data['typ'] = $this->M_type->select_all();
		$data['view'] = 'pages/type_view';
		$this->load->view('index', $data);
	}

	public function type_add(){
		$data['view'] = 'pages/type_insert';
		$this->load->view('index', $data);
	}

	public function type_add_process(){
		$data['type_code'] = $this->input->post('kode_tipe');
		$data['type_name'] = $this->input->post('nama_tipe');
		$data['type_desc'] = $this->input->post('keterangan');
		$this->M_type->addType($data);
		$this->type_read();
	}

	public function type_delete($type_id){
		$this->M_type->deleteType($type_id);
		$this->type_read();
	}

	public function type_edit($type_id){
		$data['type_res'] = $this->M_type->select_by_id($type_id)->row();
		$data['view'] = 'pages/type_edit';
		$this->load->view('index', $data);
	}

	public function type_edit_process(){
		//var_dump($_POST);die();
		$data['type_code'] = $this->input->post('kode_tipe');
		$data['type_name'] = $this->input->post('nama_tipe');
		$data['type_desc'] = $this->input->post('keterangan');
		$type_id=$this->input->post('id_tipe');
		//var_dump($type_id);die();
		$this->M_type->editType($type_id, $data);
		$this->type_read();
	}
   
}
