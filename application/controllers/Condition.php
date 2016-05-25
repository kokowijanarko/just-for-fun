<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Condition extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
		$this->load->model('M_condition');
		
    }
	
	public function index(){
		if(!isset($this->session->userdata['data'])){			
			redirect(base_url('index.php/home/login'));
		}else{			
			redirect(base_url('index.php/Condition/condition_read'));
		}
	}

	public function condition_read(){
		$data['cond'] = $this->M_condition->select_all();
		$data['view'] = 'pages/condition_view';
		$this->load->view('index', $data);
	}

	public function condition_add(){
		$data['view'] = 'pages/condition_insert';
		$this->load->view('index', $data);
	}

	public function condition_add_process(){
		$data['cond_code'] = $this->input->post('kode_kondisi');
		$data['cond_name'] = $this->input->post('nama_kondisi');
		$data['cond_desc'] = $this->input->post('keterangan');
		$this->M_condition->addCondition($data);
		$this->condition_read();
	}

	public function condition_delete($cond_id){
		$this->M_condition->deleteCondition($cond_id);
		$this->condition_read();
	}

	public function condition_edit($cond_id){
		$data['cond_res'] = $this->M_condition->select_by_id($cond_id)->row();
		$data['view'] = 'pages/condition_edit';
		$this->load->view('index', $data);
	}

	public function condition_edit_process(){
		//var_dump($_POST);die();
		$data['cond_code'] = $this->input->post('kode_kondisi');
		$data['cond_name'] = $this->input->post('nama_kondisi');
		$data['cond_desc'] = $this->input->post('keterangan');
		$cond_id=$this->input->post('id_kondisi');
		//var_dump($cond_id);die();
		$this->M_condition->editCondition($cond_id, $data);
		$this->condition_read();
	}
   
}