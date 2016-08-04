<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_qrcode extends CI_Model
{
	
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('ciqrcode');
    }

	function generate($data){
		var_dump($data);
		
		//generate information into QR-code
		header("Content-Type: image/png");
		$params['data'] = 'nama:'.$data['name'].'|username: '.$data['username'].' |password: '.md5($data['password']).' |alamat:'.$data['alamat'];
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'xxx.png';
		$this->ciqrcode->generate($params);
		echo '<img src="'.base_url().'tes.png" />';
    }
   
   
	
	
}