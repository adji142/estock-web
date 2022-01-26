<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Transaksi extends CI_Controller {

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

	public function ReadHeader()
	{
		$data = array('success' => false ,'message'=>array(),'data' => array());

		$TglAwal = $this->input->post('TglAwal');
		$TglAkhir = $this->input->post('TglAkhir');
		$StatusTrx = $this->input->post('StatusTrx');
		$KodeCustomer = $this->input->post('KodeCustomer');
		$NoTransaksi = $this->input->post('NoTransaksi');

		$SQL = "
			SELECT 
				a.NoTransaksi,
				DATE(TglTransaksi)		TglFaktur,
				DATE(TglJatuhTempo)		TglJatuhTempo,
				a.KodeCustomer,
				b.NamaCustomer,
				a.NamaTermin,
				a.AlamatPengiriman,
				a.Koordinat							ShowMap,
				a.NoTlp								'No.Tlp',
				a.PaymentTypeName,
				a.StatusDocument,
				a.Printed
			FROM penjualanheader a
			LEFT JOIN masterpelanggan b on a.KodeCustomer = b.KodeCustomer
			WHERE DATE(TglTransaksi) BETWEEN '$TglAwal' AND '$TglAkhir'
		";
		if ($StatusTrx != "") {
			$SQL .= " AND a.StatusDocument = '$StatusTrx' ";
		}

		if ($KodeCustomer != "") {
			$SQL .= " AND a.KodeCustomer = '$KodeCustomer' ";
		}

		if ($NoTransaksi != "") {
			$SQL .= " AND a.NoTransaksi = '$NoTransaksi' ";
		}
		$rs = $this->db->query($SQL);

		if ($rs->num_rows() > 0) {
			$data['success'] = true;
			$data['data'] = $rs->result();
		}

		echo json_encode($data);
	}

	public function ReadDetail()
	{
		$data = array('success' => false ,'message'=>array(),'data' => array());

		$NoTransaksi = $this->input->post('NoTransaksi');

		$SQL = "
			SELECT 
				a.NoTransaksi,
				a.KodeItem,
				a.NamaItem,
				a.Qty * b.QtyMinimum Qty,
				a.NamaSatuan,
				FORMAT(a.Harga,2)Harga,
				FORMAT(a.LineTotal - (a.LineTotal * a.Disc / 100),2) LineTotal,
				a.Disc
			FROM penjualandetail a
			LEFT JOIN itemmasterdata b on a.KodeItem = b.KodeItem
			WHERE a.NoTransaksi = '$NoTransaksi'
		";

		$rs = $this->db->query($SQL);

		if ($rs->num_rows() > 0) {
			$data['success'] = true;
			$data['data'] = $rs->result();
		}

		echo json_encode($data);
	}
	public function UpdateStatus()
	{
		$data = array('success' => false ,'message'=>array(),'data' => array());

		$NoTransaksi = $this->input->post('NoTransaksi');
		$KodeCustomer = $this->input->post('KodeCustomer');
		$Status = $this->input->post('Status');
		$Keterangan = $this->input->post('Keterangan');

		$errorNo = 0;
		$errorMessage = '';

		$this->db->trans_begin();

		try {
			$param = array(
				'StatusDocument' => $Status,
				'Remark'		 => $Keterangan." : ".$this->session->userdata('NamaUser')
			);
			$rs = $this->ModelsExecuteMaster->ExecUpdate($param,array('NoTransaksi'=>$NoTransaksi),'penjualanheader');
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
								"title" => "EStock Apps # Update Status Pesanan",
								"body" => "Pesanan anda sudah dikonfirmasi oleh admin, Pesanan akan segera dikirim "
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

	public function UpdateDiscount()
	{
		$data = array('success' => false ,'message'=>array(),'data' => array());

		$NoTransaksi = $this->input->post('NoTransaksiDiskon');
		$KodeItem = $this->input->post('KodeItem');
		$Disc = $this->input->post('Disc');

		$errorNo = 0;
		$errorMessage = '';

		$this->db->trans_begin();

		try {
			$param = array(
				'Disc' => $Disc
			);
			$rs = $this->ModelsExecuteMaster->ExecUpdate($param,array('NoTransaksi'=>$NoTransaksi,'KodeItem'=>$KodeItem),'penjualandetail');
			if (!$rs) {
				$undone = $this->db->error();
				$ErrorMessage = "Sistem Gagal Melakukan Pemrosesan Data : ".$undone['message'];
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
	public function UpdatePrinted()
	{
		$data = array('success' => false ,'message'=>array(),'data' => array());
		$NoTransaksi = $this->input->post('NoTransaksi');

		$param = array(
			'Printed'	=> "1"
		);

		$rs = $this->ModelsExecuteMaster->ExecUpdate($param,array('NoTransaksi'=>$NoTransaksi),'penjualanheader');

		$data['success'] = true;

		echo json_encode($data);
	}
}
