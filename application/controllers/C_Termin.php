<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Termin extends CI_Controller {
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

		$id = $this->input->post('id');
		if ($id == '') {
			$rs = $this->ModelsExecuteMaster->FindData(array('IsActive'=>1),'ttermin');
		}
		else{
			$rs = $this->ModelsExecuteMaster->FindData(array('id'=>$id,'IsActive'=>1),'ttermin');
		}

		if ($rs->num_rows()>0) {
			$data['success'] = true;
			$data['data'] = $rs->result();
		}
		else{
			$data['message'] = 'No Record Found';
		}
		echo json_encode($data);
	}
	public function CRUD()
	{
		$data = array('success' => false ,'message'=>array(),'KodePromo' => '');

		$id = $this->input->post('id');
		$NamaTermin = $this->input->post('NamaTermin');
		$Hari = $this->input->post('Hari');
		$Toleransi = $this->input->post('Toleransi');
		$formtype = $this->input->post('formtype');

		$param = array(
			'id' => $id,
			'NamaTermin' => $NamaTermin,
			'Hari' => $Hari,
			'Toleransi' => $Toleransi,
			'IsActive' => 1
		);

		if ($formtype == "add") {
			$call_x = $this->ModelsExecuteMaster->ExecInsert($param,'ttermin');
			if ($call_x) {
				$this->db->trans_commit();
				$data['success'] = true;
			}
			else{
				$undone = $this->db->error();
				$data['message'] = "Sistem Gagal Melakukan Pemrosesan Data : ".$undone['message'];
			}
		}
		elseif ($formtype == "edit") {
			$rs = $this->ModelsExecuteMaster->ExecUpdate($param,array('id'=> $id),'ttermin');
				if ($rs) {
					$data['success'] = true;
				}
				else{
					$undone = $this->db->error();
					$data['message'] = "Sistem Gagal Melakukan Pemrosesan Data : ".$undone['message'];
				}
		}
		elseif ($formtype == "delete") {
			try {
				$SQL = "UPDATE ttermin SET IsActive = 0 WHERE id = '".$id."'";
				// var_dump($SQL);
				$rs = $this->db->query($SQL);
				if ($rs) {
					$data['success'] = true;
				}
				else{
					$undone = $this->db->error();
					$data['message'] = "Sistem Gagal Melakukan Pemrosesan Data : ".$undone['message'];
				}
			} catch (Exception $e) {
				$data['success'] = false;
				$data['message'] = "Gagal memproses data ". $e->getMessage();
			}
		}
		jumpx:
		echo json_encode($data);
	}
}