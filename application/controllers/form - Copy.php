<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
		//$this->load->model('m_form');
		//$this->load->model('m_home');
		//$this->load->model('m_access');
		
    }
	
	public function formview(){		
		$data['view'] = 'pages/formnya';
		$this->load->view('index', $data);
	}

	
}
