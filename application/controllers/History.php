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
			redirect(base_url('index.php/history/history_read'));
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
		$data['inventories'] = $this->M_history->getInvInventory();
		$data['conditions'] = $this->M_history->getInvCondition();
		$data['users'] = $this->M_history->getDevUser();
		$data['view'] = 'pages/history_insert';
		$this->load->view('index', $data);
	}

	public function history_add_process(){	
		$data['history_inv_id'] = $this->input->post('nama_inventaris');
		$data['history_condition_id'] = $this->input->post('kondisi');
		$data['history_desc'] = $this->input->post('keterangan');
		$data['history_insert_user_id'] = $this->input->post('petugas');
		$data['history_insert_timestamp'] = date('Y-m-d H:i:s');
		$result = $this->M_history->addHistory($data);
		
		if($result == true){	
			redirect(site_url('history/history_read?msg=Am1'));
		}else{
			unset($_POST);
			redirect(site_url('history/history_read?msg=Am0'));
		}
	}

	public function history_delete($history_id){
		$result = $this->M_history->deleteHistory($history_id);
		if($result == true){
			redirect(site_url('history/history_read?msg=Dm1'));
		}else{
			unset($_POST);
			redirect(site_url('history/history_read?msg=Dm0'));
		}
	}

	public function history_edit($history_id){
		//var_dump($history_id); die();
		$data['inventories'] = $this->M_history->getInvInventory();
		$data['conditions'] = $this->M_history->getInvCondition();
		$data['users'] = $this->M_history->getDevUser();
		$data['hists'] = $this->M_history->getHistoryById($history_id);
		//var_dump($data['hists']); die();
		$data['view'] = 'pages/history_edit';
		$this->load->view('index', $data);
	}

	public function history_edit_process(){
		$data['history_inv_id'] = $this->input->post('nama_inventaris');
		$data['history_condition_id'] = $this->input->post('kondisi');
		$data['history_desc'] = $this->input->post('keterangan');
		$data['history_insert_user_id'] = $this->input->post('petugas');
		$data['history_insert_timestamp'] = date('Y-m-d H:i:s');
		$history_id=$this->input->post('id_history');
		//var_dump($history_id); die();
		$result = $this->M_history->editHistory($history_id, $data);
		
		if($result == true){
			redirect(site_url('history/history_read?msg=Em1'));
		}else{
			unset($_POST);
			redirect(site_url('history/history_read?msg=Em0'));
		}
	}
   
}
