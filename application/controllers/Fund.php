<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fund extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
		$this->load->model('m_fund');
		
    }
	
	
	public function view(){
		//var_dump($this->session->userdata['msg']);
		if(isset($this->session->userdata['msg'])){
			$data['message'] = $this->session->userdata['msg'];
		}
		$data['fund'] = $this->m_fund->getFund();
		// var_dump($data);die;
		$this->load->view('pages/fund_view', $data);
	}

	public function input($id=null){
		$data = array();
		if(!is_null($id)){
			$data['fund'] = $this->m_fund->getFundById($id);	
		}
		//var_dump($data);
		$this->load->view('pages/fund_input', $data);
	}

	public function process(){
		// var_dump($_POST);
		$this->db->trans_start();
		if($_POST['fund_id'] == ''){
			
			$data['fund_name'] = $this->input->post('fund_name');
			$data['fund_desc'] = $this->input->post('fund_desc');
			$data['insert_timestamp'] = date('Y-m-d H:i:s');
			$data['insert_user_id'] = $this->session->userdata('data')->user_id;
			
			$result = $this->m_fund->addFund($data);
			
			if($result){
				$msg = '
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> berhasil!</h4>
						Tambah Sumber Dana Berhasil.
					</div>			
				';
				$this->session->set_flashdata(array('msg'=>$msg));
			}else{
				$msg = '
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Gagal!</h4>
						Tambah Sumber Dana Gagal.
					</div>			
				';
				$this->session->set_flashdata(array('msg'=>$msg));				
			}			
		}else{
			//$data['class_id'] = $this->input->post('class_id');
			$data['fund_name'] = $this->input->post('fund_name');
			$data['fund_desc'] = $this->input->post('fund_desc');
			$data['update_timestamp'] = date('Y-m-d H:i:s');
			$data['update_user_id'] = $this->session->userdata('data')->user_id;
			$result = $this->m_fund->editGroup($this->input->post('fund_id'), $data);
			
			if($result){
				$msg = '
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> berhasil!</h4>
						Edit Sumber Dana Berhasil.
					</div>			
				';
				$this->session->set_flashdata('msg', $msg);
			}else{
				$msg = '
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Gagal!</h4>
						Edit Sumber Dana Gagal.
					</div>			
				';
				$this->session->set_flashdata('msg', $msg);				
			}
			
		}		
		// var_dump($result);
		// var_dump($this->db->last_query());
		// die;
		$this->db->trans_complete($result);
		
		redirect(site_url('fund/view'));
	}

	public function do_delete($class_id){
		$result = $this->m_fund->deleteGroup($class_id);
		if($result){
			$msg = '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> berhasil!</h4>
					Hapus Sumber Dana Berhasil.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);
		}else{
			$msg = '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Hapus Sumber Dana Gagal.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);				
		}
		redirect(site_url('fund/view'));
	}

	public function edit($class_id){
		$data['class_res'] = $this->m_fund->select_by_id($class_id)->row();
		$data['category'] = $this->m_fund->getCat();
		$this->load->view('pages/class_edit', $data);
	}

	public function do_edit(){
		//var_dump($_POST);die();
		$data['class_code'] = $this->input->post('kode_tipe');
		$data['class_name'] = $this->input->post('nama_tipe');
		$data['class_category_id'] = $this->input->post('category');
		$data['class_desc'] = $this->input->post('keterangan');
		$class_id=$this->input->post('id_tipe');
		//var_dump($class_id);die();
		$this->m_fund->editType($class_id, $data);
		$this->class_read();
	}
	
	
   
}
