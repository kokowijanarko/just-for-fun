<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
		$this->load->model('M_category');
		
    }
	
	public function index(){
		if(!isset($this->session->userdata['data'])){			
			redirect(base_url('index.php/home/login'));
		}else{			
			redirect(base_url('index.php/category/category_read'));
		}
	}

	public function category_read(){
		$data['cat'] = $this->M_category->select_all();
		// $data['view'] = 'pages/category_view';
		$this->load->view('pages/category_view', $data);
	}

	public function category_add(){
		//$data['view'] = 'pages/category_insert';
		$this->load->view('pages/category_insert');
	}

	public function category_add_process(){
		$data['category_code'] = $this->input->post('kode_kategori');
		$data['category_name'] = $this->input->post('nama_kategori');
		$data['is_container'] = $this->input->post('is_container');
		$data['category_desc'] = $this->input->post('keterangan');
		$this->M_category->addCategory($data);
		$this->category_read();
	}

	public function category_delete($category_id){
		$this->M_category->deleteCategory($category_id);
		$this->category_read();
	}

	public function category_edit($category_id){
		$data['category_res'] = $this->M_category->select_by_id($category_id)->row();
		//$data['view'] = 'pages/category_edit';
		$this->load->view('pages/category_edit', $data);
	}

	public function category_edit_process(){
		//var_dump($_POST);die();
		$data['category_code'] = $this->input->post('kode_kategori');
		$data['category_name'] = $this->input->post('nama_kategori');
		$data['is_container'] = $this->input->post('is_container');
		$data['category_desc'] = $this->input->post('keterangan');
		$category_id=$this->input->post('id_kategori');
		//var_dump($category_id);die();
		$this->M_category->editCategory($category_id, $data);
		$this->category_read();
	}
   
}
