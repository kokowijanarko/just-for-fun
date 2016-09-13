<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Condition extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
		$this->load->model('M_condition');
		if(empty($this->session->userdata('data')->user_id)){
			$msg = '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Anda Harus Login Dulu!</h4>
				</div>			
			';
			$this->session->set_flashdata(array('msg'=>$msg));
			// var_dump($msg, $this->session);die;
			redirect(site_url('home/login'));
		}
		
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
		//$data['view'] = 'pages/condition_view';
		$this->load->view('pages/condition_view', $data);
	}

	public function condition_add(){
		//$data['view'] = 'pages/condition_insert';
		$this->load->view('pages/condition_insert');
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
		//$data['view'] = 'pages/condition_edit';
		$this->load->view('pages/condition_edit', $data);
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
