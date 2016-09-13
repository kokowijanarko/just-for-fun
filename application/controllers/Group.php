<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
		$this->load->model('M_group');
		$this->load->model('m_category');
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
	
	
	public function view(){
		//var_dump($this->session->userdata['msg']);
		if(isset($this->session->userdata['msg'])){
			$data['message'] = $this->session->userdata['msg'];
		}
		$data['group'] = $this->M_group->getGroup();
		$this->load->view('pages/group_view', $data);
	}

	public function input($id=null){
		$data = array();
		if(!is_null($id)){
			$data['group'] = $this->M_group->getGroupById($id);	
		}
		$data['category'] = $this->m_category->select_all();
		//var_dump($data);
		$this->load->view('pages/group_input', $data);
	}

	public function process(){
		var_dump($_POST);
		$this->db->trans_start();
		if($_POST['group_id'] == ''){
			
			$data['is_container'] = $this->input->post('is_container');
			$data['group_category_id'] = $this->input->post('group_category');
			$data['group_name'] = $this->input->post('group_name');
			$data['group_desc'] = $this->input->post('group_desc');
			$result = $this->M_group->addGroup($data);
			
			if($result){
				$msg = '
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> berhasil!</h4>
						Tambah Data Group Berhasil.
					</div>			
				';
				$this->session->set_flashdata(array('msg'=>$msg));
			}else{
				$msg = '
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Gagal!</h4>
						Tambah Data Group Gagal.
					</div>			
				';
				$this->session->set_flashdata(array('msg'=>$msg));				
			}			
		}else{
			//$data['class_id'] = $this->input->post('class_id');
			$data['group_name'] = $this->input->post('group_name');
			$data['is_container'] = $this->input->post('is_container');
			$data['group_category_id'] = $this->input->post('group_category');			
			$data['group_desc'] = $this->input->post('group_desc');
			$result = $this->M_group->editGroup($this->input->post('group_id'), $data);
			
			if($result){
				$msg = '
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> berhasil!</h4>
						Edit Data Group Berhasil.
					</div>			
				';
				$this->session->set_flashdata('msg', $msg);
			}else{
				$msg = '
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Gagal!</h4>
						Edit Data Group Gagal.
					</div>			
				';
				$this->session->set_flashdata('msg', $msg);				
			}
			
		}		
		var_dump($result);
		var_dump($this->db->last_query());
		//die;
		$this->db->trans_complete($result);
		redirect(site_url('group/view'));
	}

	public function do_delete($class_id){
		$result = $this->M_group->deleteGroup($class_id);
		if($result){
			$msg = '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> berhasil!</h4>
					Hapus Data Group Berhasil.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);
		}else{
			$msg = '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Hapus Data Group Gagal.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);				
		}
		redirect(site_url('group/view'));
	}

	public function edit($class_id){
		$data['class_res'] = $this->M_group->select_by_id($class_id)->row();
		$data['category'] = $this->M_group->getCat();
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
		$this->M_group->editType($class_id, $data);
		$this->class_read();
	}
	
	
   
}
