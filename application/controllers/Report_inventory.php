<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_inventory extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('message');
        $this->load->model('m_condition');
		$this->load->model('m_inventory');
		$this->load->library('rep_pdf');
		
    }
	
	public function index(){
		$data['periode'] = date('F Y');
		$data['opt'] = $this->m_inventory->getInvCategory();
		$data['type'] = $this->m_inventory->getInvType();
		$this->load->view('pages/report_form', $data);
	}
	
	public function print_form(){
		$data['opt'] = $this->m_inventory->getInvCategory();
		$data['type'] = $this->m_inventory->getInvType();
		$this->load->view('pages/print_inv_label', $data);
	}
	
	public function print_report(){
		$filter = $_POST;		
		$filter['periode'] = date('Y-m', strtotime($filter['tanggal_diterima']));
		$inventory = $this->m_inventory->getInventoryByCat($filter);
		//var_dump($inventory, $this->db->last_query());die;
		
		$PDF = $this->rep_pdf;
		
		$mPDF = new $PDF(
			'', 
			array(330, 296), 
			7, 
			'Helvetica',
			15, //l
			15, //r
			16, //t
			16, //b
			9, 
			9, 
			'L'
		);
		//var_dump($mPDF);
		
		// $mPDF->SetHTMLFooter('
		// <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
		  // <tr>
			// <td width="33%">
			// </span></td>
			// <td width="33%" align="center" style="font-weight: bold; font-style: italic;">
			  
			// </span></td>
			// <td width="33%" style="text-align: right; ">Laporan Inventaris - '. $filter['periode'] .' {PAGENO}
			// </span></td>
		  // </tr>
		// </table>
		// ');
		
		if(!empty($inventory)){
			$ref_condition = $this->m_condition->select_all();
		
				$row = '';
				$no = 1;
				
			foreach($inventory as $val){
				$cond = '';
				foreach($ref_condition as $condition){
					$cond_name = strtolower($condition->cond_name);
					$cond_name = str_replace(' ', '_', $cond_name);
					$cond .= '						
						<td style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: center; ">
							<span style="font-size:10pt;">
								'. $val->$cond_name.'
							</span>
						</td>
					';
					//var_dump($cond_name);
				}
				$row .= '
					<tr>
						<td style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: left; "><span style="font-size:10pt;">'. $no .'</span></td>
						<td style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: left; "><span style="font-size:10pt;">'. $val->class .'</span></td>
						<td style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: left; "><span style="font-size:10pt;">'. $val->category .'</span></td>
						<td style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: left; "><span style="font-size:10pt;">'. $val->group .'</span></td>
						<td style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: left; "><span style="font-size:10pt;">'. $val->type .'</span></td>
						<td style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: left; "><span style="font-size:10pt;">'. $val->count_total .'</span></td>
						'. $cond .'
					</tr>				
				';
				$no++;
			}
		}else{
			foreach($inventory as $val){
				foreach($ref_condition as $condition){				
					$cond .= '						
						<td style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: center; ">
							<span style="font-size:10pt;">
								-
							</span>
						</td>
					';
					//var_dump($cond_name);
				}
				$row = '
					<tr>
						<td style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: left; "><span style="font-size:10pt;">1</span></td>
						<td style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: left; "><span style="font-size:10pt;">-</span></td>
						<td style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: left; "><span style="font-size:10pt;">-</span></td>
						<td style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: left; "><span style="font-size:10pt;">-</span></td>
						<td style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: left; "><span style="font-size:10pt;">-</span></td>
						<td style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: left; "><span style="font-size:10pt;">-</span></td>
						'. $cond .'
					</tr>				
				';
			}
		}
		
		
		foreach($ref_condition as $condition){		
			$kondisi .= '<td width="5%" style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: center; "><span style="font-size:10pt;">'. $condition->cond_name .'</span></td>
			';
			
		}
		$html_body = '
			<b><span style=" font-size:10pt;">Daftar Inventaris Periode '. date('M Y', strtotime($filter['tanggal_diterima'])).'</span></b>
			<br /><br />
			<table width="100%" width="100%" cellpadding="0" cellPadding="0" border="1" style="font-family:Times New Roman; border-collapse:collapse;">
				
				<tr>
					<td width="5%" style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: center; "><span style="font-size:10pt;">NO</span></td>
					<td width="5%" style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: center; "><span style="font-size:10pt;">Golongan</span></td>
					<td width="5%" style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: center; "><span style="font-size:10pt;">Kategori</span></td>
					<td width="5%" style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: center; "><span style="font-size:10pt;">Group</span></td>
					<td width="5%" style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: center; "><span style="font-size:10pt;">Tipe</span></td>
					<td width="5%" style="border-left:1px solid; border-bottom:1px solid;padding:2px;text-align: center; "><span style="font-size:10pt;">Jumlah Inv.</span></td>
					'. $kondisi .'
					
				</tr>
				'. $row .'
			</table>
		
		';
		
		//var_dump($html_body);die;
		$mPDF->WriteHTML($html_body);
        $mPDF->Output('Laporan Inventaris Periode '. date('Y-M', strtotime($filter['tanggal_diterima'])) .' '. date('His dmY') .'.pdf', 'D');
        exit;
	}
	
	public function print_inv_label(){
		$filter = $_POST;	
		//var_dump($filter);	die;	
		$inventory = $this->m_inventory->getInv($filter);
		//var_dump($inventory, $this->db->last_query());die;
		
		$mPDF = $this->rep_pdf;
		
		$mPDF = new $mPDF('', 'A4');
		
		if(!empty($inventory)){
			$row = '';
			$no = 1;
				
			foreach($inventory as $val){
				$row .= '
					
					<div style="position: relative; width: 250px; height: 100px; border: 2px solid; float=right;">
						<table>
							<tr>
								<th colspan="3"><span style="font-size:150%">'. $val->inv_name .' <br> '. $val->inv_number .'</span></th>								
							</tr>
							<tr>
								<td><span style="font-size:150%">Tanggal Pengadaan</span></td>
								<td><span style="font-size:150%">:</span></td>
								<td><span style="font-size:150%">'. $val->inv_date_procurement .'</span></td>
							</tr>
							<tr>
								<td><span style="font-size:150%">Kategori</span></td>
								<td><span style="font-size:150%">:</span></td>
								<td><span style="font-size:150%">'. $val->category_name .'</span></td>
							</tr>
							<tr>
								<td><span style="font-size:150%">Tipe</span></td>
								<td><span style="font-size:150%">:</span></td>
								<td><span style="font-size:150%">'. $val->type_name .'</span></td>
							</tr>						
						</table>
					</div>
					<br />
					<br />
					<br />
					<br />					
				';
			}
		}		
		$html_body = '
		<div>
		'. $row .'
		</div>
		';
		
		//var_dump($html_body);die;
		$mPDF->WriteHTML($html_body);
        $mPDF->Output('Label Inventaris.pdf', 'D');
        exit;
	}


}
