<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('message');
		$this->load->model('M_user');
		
    }
	
	public function index(){
		if(!isset($this->session->userdata['data'])){			
			redirect(base_url('index.php/home/login'));
		}else{			
			redirect(base_url('index.php/user/user_read'));
		}
	}

	public function user_read(){
		if(isset($_GET['msg'])){
			$data['message'] = $this->message->getMessage($_GET['msg']);
		}
		$data['users'] = $this->M_user->selectAllUser();
		$this->load->view('pages/user_view', $data);
	}

	public function user_add(){
		$this->load->view('pages/user_insert');
	}

	public function user_add_process(){	
		$data['name'] = $this->input->post('user_name');
		$data['username'] = $this->input->post('username');
		$data['password'] = md5($this->input->post('username'));
		$data['datetime_insert'] = date("Y-m-d h:i:s");
		$data['description'] = $this->input->post('keterangan');
	 	$result = $this->M_user->addUser($data);
	
		
		if($result == true){
			redirect(site_url('user/user_read?msg=Am1'));
		}else{
			unset($_POST);
			redirect(site_url('user/user_read?msg=Am0'));
		}
	}

	public function delete_user($id){
		$result = $this->M_user->deleteUser($id);
		if($result == true){
			redirect(site_url('user/user_read?msg=Dm1'));
		}else{
			unset($_POST);
			redirect(site_url('user/user_read?msg=Dm0'));
		}
	}

	public function edit_user($id){
		$data['user_res'] = $this->M_user->selectUserById($id);
		$this->load->view('pages/user_edit', $data);
	}

	public function edit_user_process(){
		$data['name'] = $this->input->post('user_name');
		$data['username'] = $this->input->post('username');
		$data['password'] = md5($this->input->post('username'));
		$data['description'] = $this->input->post('keterangan');
		$id=$this->input->post('id_user');
		$result = $this->M_user->editUser($id, $data);
		
		if($result == true){
			redirect(site_url('user/user_read?msg=Em1'));
		}else{
			unset($_POST);
			redirect(site_url('user/user_read?msg=Em0'));
		}
	}
   
}
