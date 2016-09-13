<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
		$this->load->model('M_category');
		$this->load->model('m_class');
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
			redirect(base_url('index.php/category/category_read'));
		}
	}

	public function category_read(){
		if(isset($this->session->userdata['msg'])){
			$data['message'] = $this->session->userdata['msg'];
		}
		$data['cat'] = $this->M_category->select_all();
		// $data['view'] = 'pages/category_view';
		$this->load->view('pages/category_view', $data);
	}

	public function category_add(){
		//$data['view'] = 'pages/category_insert';
		$data['class'] = $this->m_class->getClass();
		//var_dump($data);
		$this->load->view('pages/category_insert', $data);
	}

	public function category_add_process(){
		$data['category_code'] = $this->input->post('kode_kategori');
		$data['category_name'] = $this->input->post('nama_kategori');
		$data['category_class_id'] = $this->input->post('class');
		$data['category_desc'] = $this->input->post('keterangan');
		$result = $this->M_category->addCategory($data);
		if($result){
			$msg = '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> berhasil!</h4>
					Tambah Data Kategory Berhasil.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);
		}else{
			$msg = '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Tambah Data Kategory Gagal.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);				
		}
		redirect(site_url('category/category_read'));
	}

	public function category_delete($category_id){
		$result = $this->M_category->deleteCategory($category_id);
		
		if($result){
			$msg = '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> berhasil!</h4>
					Edit Data Kategory Berhasil.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);
		}else{
			$msg = '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Edit Data Kategory Gagal.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);				
		}
		redirect(site_url('category/category_read'));
	}

	public function category_edit($category_id){
		$data['category_res'] = $this->M_category->select_by_id($category_id);
		$data['class'] = $this->m_class->getClass();
		// var_dump($data);
		$this->load->view('pages/category_edit', $data);
	}

	public function category_edit_process(){
		//var_dump($_POST);die();
		$data['category_code'] = $this->input->post('kode_kategori');
		$data['category_name'] = $this->input->post('nama_kategori');
		$data['category_class_id'] = $this->input->post('class');
		$data['category_desc'] = $this->input->post('keterangan');
		$category_id=$this->input->post('id_kategori');
		//var_dump($category_id);die();
		$result = $this->M_category->editCategory($category_id, $data);
		if($result){
			$msg = '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> berhasil!</h4>
					Edit Data Kategory Berhasil.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);
		}else{
			$msg = '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Edit Data Kategory Gagal.
				</div>			
			';
			$this->session->set_flashdata('msg', $msg);				
		}
		redirect(site_url('category/category_read'));
	}
   
}
