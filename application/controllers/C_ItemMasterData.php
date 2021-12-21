<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_ItemMasterData extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelsExecuteMaster');
		$this->load->model('GlobalVar');
		$this->load->model('Apps_mod');
		$this->load->model('LoginMod');
	}

	public function Read()
	{
		$data = array('success' => false ,'message'=>array(),'data' => array());

		$KodeItem = $this->input->post('KodeItem');
		$script = $this->input->post('script');

		$SQL = "SELECT * FROM itemmasterdata WHERE 1=1 ";
		if ($KodeItem != "") {
			$SQL .=" AND KodeItem = '".$KodeItem."' ";
		}
		if ($script != "") {
			$SQL .= " AND ".$script." ";
		}

		$rs = $this->db->query($SQL);
		if ($rs) {
			$data['success'] = true;
			$data['data'] = $rs->result();
		}

		echo json_encode($data);
	}

	public function CRUD()
	{
		$data = array('success' => false ,'message'=>array(),'data' => array());

		$KodeItem = $this->input->post('KodeItem');
		$NamaItem = $this->input->post('NamaItem');
		$KodeSatuan = $this->input->post('KodeSatuan');
		$NamaSatuan = $this->ModelsExecuteMaster->FindData(array("KodeSatuan"=>$KodeSatuan),'tsatuan')->row()->NamaSatuan;
		$KodeKategori = $this->input->post('KodeKategori');
		$NamaKategori = $this->ModelsExecuteMaster->FindData(array("id"=>$KodeKategori),'tkategori')->row()->NamaKategori;
		$LastPrice = $this->input->post('LastPrice');
		$OtherPrice = $this->input->post('OtherPrice');
		$QtyMinimum = $this->input->post('QtyMinimum');
		$ImageLink = $this->input->post('ImageLink');
		$Description = $this->input->post('Description');
		$StatusPublikasi = $this->input->post('StatusPublikasi');
		$CreatedBy = $this->session->userdata('NamaUser');
		$CreatedOn = date("Y-m-d h:i:sa");
		$OldPrice = 0;
		$formtype = $this->input->post('formtype');

		$ErrorMessage = "";
		$picture_ext = '';
		// picture


		// Generate New KodeITem

		$Kolom = 'KodeItem';
		$Table = 'itemmasterdata';
		$Prefix = '1';

		$SQL = "SELECT RIGHT(MAX(".$Kolom."),5)  AS Total FROM " . $Table . " WHERE LEFT(" . $Kolom . ", LENGTH('".$Prefix."')) = '".$Prefix."'";

		// var_dump($SQL);
		$rs = $this->db->query($SQL);

		$temp = $rs->row()->Total + 1;

		$nomor = $Prefix.str_pad($temp, 5,"0",STR_PAD_LEFT);
		if ($nomor != '' && $KodeItem == '') {
			$KodeItem = $nomor;
		}

		// Upload image

		try {
			unset($config); 
			$date = date("ymd");
	        $config['upload_path'] = './localData/image';
	        $config['max_size'] = '60000';
	        $config['allowed_types'] = 'png|jpg|jpeg|gif';
	        $config['overwrite'] = TRUE;
	        $config['remove_spaces'] = TRUE;
	        $config['file_ext_tolower'] = TRUE;
	        $config['file_name'] = strtolower(str_replace(' ', '', $KodeItem));

	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);

	        if(!$this->upload->do_upload('Attachment')) {
	        	if ($formtype == 'edit' || $formtype == 'delete' || $formtype == 'Publish') {
	        		$x='';
	        	}
	        	else{
	        		$x = $this->upload->data();
		        	// var_dump($x);
		        	$data['success'] = false;
		            $data['message'] = $this->upload->display_errors();
		            goto jump;
	        	}
	        }else{
	            $dataDetails = $this->upload->data();
	            $picture_ext = $dataDetails['file_ext'];
	            if ($picture_ext == '.jpeg') {
	            	$picture_ext = '.jpg';
	            }
	        }	
		} catch (Exception $e) {
			$data['success'] = false;
			$data['message'] = $e->getMessage();
			goto jump;
		}

		if ($ImageLink == '') {
			$ImageLink = base_url().'localData/image/'.str_replace(' ', '', $KodeItem).''.strtolower($picture_ext);
		}

		if ($formtype == "edit") {
			$getLastPrice = $this->ModelsExecuteMaster->FindData(array('KodeItem'=>$KodeItem),'itemmasterdata')->row()->LastPrice;
			$getOldPrice = $this->ModelsExecuteMaster->FindData(array('KodeItem'=>$KodeItem),'itemmasterdata')->row()->OldPrice;
			if ($getLastPrice <> $LastPrice ) {
				$OldPrice = $getLastPrice;
			}
			else{
				if ($getOldPrice <> 0) {
					$OldPrice = $getOldPrice;
				}
			}
			
		}
		$param = array(
			'KodeItem' => $KodeItem,
			'NamaItem' => $NamaItem,
			'KodeSatuan' => $KodeSatuan,
			'NamaSatuan' => $NamaSatuan,
			'KodeKategori' => $KodeKategori,
			'NamaKategori' => $NamaKategori,
			'LastPrice' => $LastPrice,
			'OldPrice' => $OldPrice,
			'OtherPrice' => $OtherPrice,
			'QtyMinimum' => $QtyMinimum,
			'ImageLink' => $ImageLink,
			'Description' => $Description,
			'StatusPublikasi' => $StatusPublikasi,
			'CreatedBy' => $CreatedBy,
			'CreatedOn' => $CreatedOn
		);

		try {
			$this->db->trans_begin();
			if ($formtype == 'add') {
				$rs = $this->ModelsExecuteMaster->ExecInsert($param,'itemmasterdata');
				if ($rs) {
					$data['success'] = true;
				}
				else{
					$undone = $this->db->error();
					$ErrorMessage = "Sistem Gagal Melakukan Pemrosesan Data : ".$undone['message'];
					goto jump;
				}
			}
			elseif ($formtype =='edit') {
				$rs = $this->ModelsExecuteMaster->ExecUpdate($param,array('KodeItem'=> $KodeItem),'itemmasterdata');
				if ($rs) {
					$data['success'] = true;
				}
				else{
					$undone = $this->db->error();
					$ErrorMessage = "Sistem Gagal Melakukan Pemrosesan Data : ".$undone['message'];
					goto jump;
				}
			}
		} catch (Exception $e) {
			$ErrorMessage = $e->getMessage();
			goto jump;
		}

		jump:
		if ($ErrorMessage != "") {
			$this->db->trans_rollback();
			$data['message'] = $ErrorMessage;
		}
		else{
			$this->db->trans_commit();
			$data['success'] = true;
		}
		echo json_encode($data);
	}

	public function Getindex()
	{
		$data = array('success' => false ,'message'=>array(),'Nomor' => '');

		$Kolom = $this->input->post('Kolom');
		$Table = $this->input->post('Table');
		$Prefix = $this->input->post('Prefix');

		$SQL = "SELECT RIGHT(MAX(".$Kolom."),5)  AS Total FROM " . $Table . " WHERE LEFT(" . $Kolom . ", LENGTH('".$Prefix."')) = '".$Prefix."'";

		// var_dump($SQL);
		$rs = $this->db->query($SQL);

		$temp = $rs->row()->Total + 1;

		$nomor = $Prefix.str_pad($temp, 5,"0",STR_PAD_LEFT);
		if ($nomor != '') {
			$data['success'] = true;
			$data['nomor'] = $nomor;
		}
		echo json_encode($data);
	}
}