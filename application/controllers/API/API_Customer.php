<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class API_Customer extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelsExecuteMaster');
		$this->load->model('GlobalVar');
		$this->load->model('Apps_mod');
	}

	public function NewCustomerFromApps()
	{
		$data = array('success' => false ,'message'=>array(),'data' => array());

		$errorNo = 0;
		$errorMessage = '';

		$KodeCustomer = $this->input->post('KodeCustomer');
		$NamaCustomer = $this->input->post('NamaCustomer');
		$KodeTermin = $this->input->post('KodeTermin');
		$NamaTermin = $this->input->post('NamaTermin');
		$NoTlp = $this->input->post('NoTlp');
		$NoTlp2 = $this->input->post('NoTlp2');
		$Email = $this->input->post('Email');
		$Provinsi = $this->input->post('Provinsi');
		$Kota = $this->input->post('Kota');
		$Kelurahan = $this->input->post('Kelurahan');
		$Kecamatan = $this->input->post('Kecamatan');
		$KodePos = $this->input->post('KodePos');
		$AddressCode = $this->input->post('AddressCode');
		$Alamat = $this->input->post('Alamat');
		$Koordinat = $this->input->post('Koordinat');
		$ContactPerson = $this->input->post('ContactPerson');
		$NamaInstansi = $this->input->post('NamaInstansi');
		$SaldoPiutang = 0;
		$isMitra = 0;
		$isActive = 1;
		$Verified = 0;
		$VerifiedBy = '';
		$VerifiedOn = NULL;
		$PotonganPersen = 0;
		$PotonganRupiah = 0;
		$TempToken = $this->input->post('TempToken');

		$CreatedOn = date("Y/m/d hh:mm:ss");

		$MobileToken = $this->input->post('MobileToken');
		$this->db->trans_begin();

		if ($this->ModelsExecuteMaster->GetToken($MobileToken)) {
			try {

				$param = array(
					'KodeCustomer' => $KodeCustomer,
					'NamaCustomer' => $NamaCustomer,
					'KodeTermin' => $KodeTermin,
					'NamaTermin' => $NamaTermin,
					'NoTlp' => $NoTlp,
					'NoTlp2' => $NoTlp2,
					'Email' => $Email,
					'Provinsi' => $Provinsi,
					'Kota' => $Kota,
					'Kelurahan' => $Kelurahan,
					'Kecamatan' => $Kecamatan,
					'KodePos' => $KodePos,
					'AddressCode' => $AddressCode,
					'Alamat' => $Alamat,
					'Koordinat' => $Koordinat,
					'ContactPerson' => $ContactPerson,
					'NamaInstansi' => $NamaInstansi,
					'SaldoPiutang' => $SaldoPiutang,
					'isMitra' => $isMitra,
					'isActive' => $isActive,
					'Verified' => $Verified,
					'VerifiedBy' => $VerifiedBy,
					'VerifiedOn' => $VerifiedOn,
					'PotonganPersen' => $PotonganPersen,
					'PotonganRupiah' => $PotonganRupiah,
					'TempToken' => $TempToken,
					'CreatedOn' => $CreatedOn,
				);

				$rs = $this->ModelsExecuteMaster->ExecInsert($param,'masterpelanggan');
				if (!$rs) {
					$undone = $this->db->error();

					$errorNo = -1000;
					$errorMessage = "Sistem Gagal Melakukan Pemrosesan Data : " .$undone['message'];
					goto jump;
				}
			} catch (Exception $e) {
				$errorNo = 69;
				$errorMessage = "Exception Runtime Error : ". $e->getMessage();
				goto jump;
			}
		}
		else{
			$errorNo = 403;
			$errorMessage = "UnAutorize Device";
		}

		jump:
		if ($error == 0) {
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