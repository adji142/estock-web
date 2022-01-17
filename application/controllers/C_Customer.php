<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Customer extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
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

		$KodeCustomer = $this->input->post('KodeCustomer');

		$SQL = "";
		$SQL .= "SELECT 
					a.KodeCustomer,
					a.NamaCustomer,
					a.NoTlp,
					a.Email,
					a.NamaInstansi,
					a.ContactPerson,
					a.NamaTermin,
					b.Provinsi,
					b.Kota,
					b.Kelurahan,
					b.Kecamatan,
					b.KodePos,
					b.Alamat,
					CONCAT(UPPER(b.Alamat),' ', UPPER(b.Kecamatan), ' ', UPPER(b.Kelurahan), ' ', UPPER(b.Kota), ' ', UPPER(b.Provinsi), ' ', UPPER(b.KodePos)) FullAddress,
					b.Koordinat,
					a.SaldoPiutang,
					a.PotonganPersen,
					a.PotonganRupiah,
					CASE WHEN a.isMitra = 1 THEN 'MITRA' ELSE '' END Mitra,
					Verified,
					CASE WHEN a.Verified = 1 THEN 'VERIFIED' ELSE 'NOT VERIFIED' END VerifiedName,
					a.VerifiedBy,
					a.VerifiedOn,
					a.Remark
				FROM masterpelanggan a
				INNER JOIN alamatpelanggan b on a.KodeCustomer = b.KodeCustomer AND b.isDefault = 1 WHERE 1 = 1 ";
		if ($KodeCustomer != "") {
			$SQL .= " AND a.KodeCustomer = '".$KodeCustomer."' ";
		}

		$rs = $this->db->query($SQL);

		if ($rs->num_rows() > 0) {
			$data['success'] = true;
			$data['data'] = $rs->result();
		}

		echo json_encode($data);
	}

	public function verifikasiCustomer()
	{
		$data = array('success' => false ,'message'=>array(),'data' => array());

		$KodeCustomer = $this->input->post('KodeCustomer');
		$verifikasi = $this->input->post('verifikasi');
		$Keterangan = $this->input->post('Keterangan');
		$FireBaseToken = $this->input->post('FireBaseToken');

		$errorNo = 0;
		$errorMessage = '';

		$this->db->trans_begin();

		$param = array(
			'Verified' => $verifikasi,
			'VerifiedBy' => $this->session->userdata('NamaUser'),
			'VerifiedOn' => date("Y-m-d h:i:sa"),
			'Remark' => $Keterangan
		);
		try {
			$rs = $this->ModelsExecuteMaster->ExecUpdate($param,array('KodeCustomer'=>$KodeCustomer),'masterpelanggan');
			if (!$rs) {
				$undone = $this->db->error();
				$ErrorMessage = "Sistem Gagal Melakukan Pemrosesan Data : ".$undone['message'];
				goto jump;
			}
			else{
				$rs_user = $this->ModelsExecuteMaster->FindData(array('RecordOwnerID'=>$KodeCustomer),'users');
				if ($rs_user->num_rows() > 0) {
					$token = $rs_user->row()->token;

					if ($token != '') {
						if ($verifikasi == "1") {
							$messageNotification = array(
								'to' => $token,
								'notification' => array(
									"title" => "EStock Apps # Update Status Pendaftaran",
									"body" => "Pendaftaran Anda disetujui"
								)
							);
						}
						else{
							$messageNotification = array(
								'to' => $token,
								'notification' => array(
									"title" => "EStock Apps # Update Status Pendaftaran",
									"body" => "Pendaftaran Anda batal disetujui disetujui Karena : ". $Keterangan
								)
							);
						}
						$this->ModelsExecuteMaster->PushNotification($messageNotification);
					}
				}
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

	public function RejectCustomer()
	{
		$data = array('success' => false ,'message'=>array(),'data' => array());

		$KodeCustomer = $this->input->post('KodeCustomer_Reject');
		$Keterangan = $this->input->post('Keterangan_Reject');

		$errorNo = 0;
		$errorMessage = '';

		$this->db->trans_begin();

		$param = array(
			'Verified' => 99,
			'VerifiedBy' => $this->session->userdata('NamaUser'),
			'VerifiedOn' => date("Y-m-d h:i:sa"),
			'Remark' => $Keterangan
		);
		try {
			$rs = $this->ModelsExecuteMaster->ExecUpdate($param,array('KodeCustomer'=>$KodeCustomer),'masterpelanggan');
			if (!$rs) {
				$undone = $this->db->error();
				$ErrorMessage = "Sistem Gagal Melakukan Pemrosesan Data : ".$undone['message'];
				goto jump;
			}
			else{
				$rs_user = $this->ModelsExecuteMaster->FindData(array('RecordOwnerID'=>$KodeCustomer),'users');
				if ($rs_user->num_rows() > 0) {
					$token = $rs_user->row()->token;

					if ($token != '') {
						$messageNotification = array(
							'to' => $token,
							'notification' => array(
								"title" => "EStock Apps # Update Status Pendaftaran",
								"body" => "Pendaftaran Anda belum disetujui Karena : ".$Keterangan
							)
						);
						$this->ModelsExecuteMaster->PushNotification($messageNotification);
					}
				}
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

	public function setMitra()
	{
		$data = array('success' => false ,'message'=>array(),'data' => array());

		$KodeCustomer = $this->input->post('KodeCustomer');
		$isMitra = $this->input->post('isMitra');
		$PotonganRupiah = $this->input->post('PotonganRupiah');
		$PotonganPersen = $this->input->post('PotonganPersen');

		$errorNo = 0;
		$errorMessage = '';

		$this->db->trans_begin();
		$param = array(
			'isMitra'		=> $isMitra,
			'PotonganPersen'=> $PotonganPersen,
			'PotonganRupiah'=> $PotonganRupiah
		);
		try {
			$rs = $this->ModelsExecuteMaster->ExecUpdate($param,array('KodeCustomer'=>$KodeCustomer),'masterpelanggan');
			if (!$rs) {
				$undone = $this->db->error();
				$ErrorMessage = "Sistem Gagal Melakukan Pemrosesan Data : ".$undone['message'];
				goto jump;
			}
		} catch (Exception $e) {
			$undone = $this->db->error();
			$ErrorMessage = "Sistem Gagal Melakukan Pemrosesan Data : ".$undone['message'];
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