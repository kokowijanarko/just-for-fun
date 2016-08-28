<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Class_con extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
		$this->load->model('M_class');
		
    }
	
	
	public function view(){
		//var_dump($this->session->userdata['msg']);
		if(isset($this->session->userdata['msg'])){
			$data['message'] = $this->session->userdata['msg'];
		}
		$data['class'] = $this->M_class->getClass();
		$this->load->view('pages/class_view', $data);
	}

	public function input($id=null){
		$data = array();
		if(!is_null($id)){
			$data['class'] = $this->M_class->getClassById($id);	
		}
		//var_dump($data);
		$this->load->view('pages/class_input', $data);
	}

	public function process(){
		var_dump($_POST);
		$this->db->trans_start();
		if($_POST['class_id'] == ''){
			
			$data['class_name'] = $this->input->post('class_name');
			$data['class_desc'] = $this->input->post('class_desc');
			$result = $this->M_class->addClass($data);
			
			if($result){
				$msg = '
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> berhasil!</h4>
						Tambah Data Golongan Berhasil.
					</div>			
				';
				$this->session->set_flashdata(array('msg'=>$msg));
			}else{
				$msg = '
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Gagal!</h4>
						Tambah Data Golongan Gagal.
					</div>			
				';
				$this->session->set_flashdata(array('msg'=>$msg));				
			}			
		}else{
			//$data['class_id'] = $this->input->post('class_id');
			$data['class_name'] = $this->input->post('class_name');
			$data['class_desc'] = $this->input->post('class_desc');
			$result = $this->M_class->editClass($this->input->post('class_id'), $data);
			var_dump($result);
			if($result){
				$msg = '
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> berhasil!</h4>
						Edit Data Golongan Berhasil.
					</div>			
				';
				$this->session->set_flashdata('msg', $msg);
			}else{
				$msg = '
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Gagal!</h4>
						Edit Data Golongan Gagal.
					</div>			
				';
				$this->session->set_flashdata('msg', $msg);				
			}
			
		}		
		//var_dump($this->db->last_query());
		//die;
		$this->db->trans_complete($result);
		redirect(site_url('class_con/view'));
	}

	public function do_delete($class_id){
		$result = $this->M_class->deleteClass($class_id);
		if($result){
			$msg = '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> berhasil!</h4>
					Hapus Data Golongan Berhasil.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);
		}else{
			$msg = '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Hapus Data Golongan Gagal.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);				
		}
		redirect(site_url('class_con/view'));
	}

	public function edit($class_id){
		$data['class_res'] = $this->M_class->select_by_id($class_id)->row();
		$data['category'] = $this->M_class->getCat();
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
		$this->M_class->editType($class_id, $data);
		$this->class_read();
	}
	
	
   
}
