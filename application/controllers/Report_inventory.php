<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_inventory extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('message');
        $this->load->library('Excel');
		$this->load->model('M_inventory');
		
    }
	
	public function index(){
		$data['periode'] = date('F Y');
		$data['opt'] = $this->M_inventory->getInvCategory();
		$data['type'] = $this->M_inventory->getInvType();
		$this->load->view('pages/report_form', $data);
	}
	
	public function print_report(){
		var_dump($_POST);
		$filter = $_POST;
		
		$filter['periode'] = date('Y-m', strtotime($filter['tanggal_diterima']));
		var_dump($filter);die;
		$inventory = $this->M_inventory->getInventory($filter);
	}


}
