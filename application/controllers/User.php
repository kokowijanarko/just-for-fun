<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('message');
		$this->load->model('M_user');
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
		$data['user_name'] = $this->input->post('user_name');
		$data['user_username'] = $this->input->post('username');
		$data['user_pass'] = md5($this->input->post('password'));
		$data['user_desc'] = $this->input->post('keterangan');
		$data['user_level'] = $this->input->post('level');
		
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
		//var_dump($_POST);die;
		$data['user_name'] = $this->input->post('user_name');
		$data['user_username'] = $this->input->post('user_username');
		$data['user_desc'] = $this->input->post('user_desc');
		$data['user_level'] = $this->input->post('level');
		$id=$this->input->post('user_id');
		$result = $this->M_user->editUser($id, $data);
		
		if($result == true){
			redirect(site_url('user/user_read?msg=Em1'));
		}else{
			unset($_POST);
			redirect(site_url('user/user_read?msg=Em0'));
		}
	}
   
}
