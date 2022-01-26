<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Setting extends CI_Controller {
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

		$SettingID = $this->input->post('SettingID');
		$rs = $this->ModelsExecuteMaster->FindData(array('SettingID'=>$SettingID),'appsetting');

		if ($rs->num_rows()>0) {
			$data['success'] = true;
			$data['data'] = $rs->result();
		}
		else{
			$data['message'] = 'No Record Found';
		}
		echo json_encode($data);
	}
	public function Add()
	{
		$data = array('success' => false ,'message'=>array(),'data' => array());
		$SettingID = $this->input->post('SettingID');
		$SettingValue = $this->input->post('SettingValue');

		$errorNo = 0;
		$errorMessage = '';
		$this->db->trans_begin();

		try {
			$this->ModelsExecuteMaster->DeleteData(array('SettingID'=>$SettingID),'appsetting');
			$param = array(
				'SettingID'	=> $SettingID,
				'SettingValue' => $SettingValue
			);
			$rs = $this->ModelsExecuteMaster->ExecInsert($param,'appsetting');
			if (!$rs) {
				$undone = $this->db->error();
				$errorNo = -10001;
				$errorMessage = "Failed Exec Statement :" .$undone['message'];

				goto jump;
			}
		} catch (Exception $e) {
			$errorNo = -20001;
			$errorMessage = "Failed Exception : ".$e->getMessage();

			goto jump;
		}

		jump:
		if ($errorNo == 0) {
			$this->db->trans_commit();
			$data['success'] = true;
		}
		else{
			$this->db->trans_rollback();
			$data['message'] = "Error: ".$errorNo." - ".$errorMessage;
		}

		echo json_encode($data);
	}
}