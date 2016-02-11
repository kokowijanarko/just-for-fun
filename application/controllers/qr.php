<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qr extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
		$this->load->model('m_qrcode');
		//$this->load->model('m_home');
		//$this->load->model('m_access');
		
    }
	
	public function contoh1(){		
		$data['view'] = 'pages/qr_contoh1';
		$this->load->view('index', $data);
	}

	public function generate_qr(){
		$this->m_qrcode->generate($_POST);
		$data['view'] = 'pages/qr_contoh1';
		$this->load->view('index', $data);
	}
	
}
