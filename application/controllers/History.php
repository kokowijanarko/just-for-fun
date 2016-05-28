<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('message');
		$this->load->model('M_history');
		
    }
	
	public function index(){
		if(!isset($this->session->userdata['data'])){			
			redirect(base_url('index.php/home/login'));
		}else{			
			redirect(base_url('index.php/history/view_inv'));
		}
	}

	public function history_read(){
		if(isset($_GET['msg'])){
			$data['message'] = $this->message->getMessage($_GET['msg']);
		}
		$data['hst'] = $this->M_history->getInvHistory();
		//var_dump($data);die();
		$data['view'] = 'pages/history_view';
		$this->load->view('index', $data);
	}

	public function history_add(){
		$data['opt'] = $this->M_history->getInvCategory();
		$data['type'] = $this->M_history->getInvType();
		$data['view'] = 'pages/form_tambah_history';
		$this->load->view('index', $data);
	}

	public function history_add_process(){		
		$data['inv_name'] = $this->input->post('nama_history');
		$data['inv_date_procurement'] = date('Y-m-d', strtotime($this->input->post('tanggal_diterima')));
		$data['inv_type_id'] = $this->input->post('type');
		$data['inv_category_id'] = $this->input->post('category');
		$data['inv_desc'] = $this->input->post('deskripsi');
		$result = $this->M_history->tambah_history($data);
		
		if($result == true){
			redirect(site_url('history/view_inv?msg=Am1'));
		}else{
			unset($_POST);
			redirect(site_url('history/view_inv?msg=Am0'));
		}
	}

	public function history_delete($inv_id){
		$result = $this->M_history->delete_history($inv_id);
		if($result == true){
			redirect(site_url('history/view_inv?msg=Dm1'));
		}else{
			unset($_POST);
			redirect(site_url('history/view_inv?msg=Dm0'));
		}
	}

	public function history_edit($inv_id){
		$data['inv_res'] = $this->M_history->getInvById($inv_id);
		$data['category'] = $this->M_history->getInvCategory();
		$data['type'] = $this->M_history->getInvType();
		$data['view'] = 'pages/form_edit_history';
		$this->load->view('index', $data);
	}

	public function history_edit_process(){
		$data['inv_name'] = $this->input->post('nama_history');
		$data['inv_date_procurement'] = date('Y-m-d', strtotime($this->input->post('tanggal_diterima')));
		$data['inv_type_id'] = $this->input->post('type');
		$data['inv_category_id'] = $this->input->post('category');
		$data['inv_desc'] = $this->input->post('deskripsi');
		$inv_id=$this->input->post('id_history');
		$result = $this->M_history->do_edit_history($inv_id, $data);
		
		if($result == true){
			redirect(site_url('history/view_inv?msg=Em1'));
		}else{
			unset($_POST);
			redirect(site_url('history/view_inv?msg=Em0'));
		}
	}
   
}
