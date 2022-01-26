<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_SuratJalan extends CI_Controller {

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

		$SQL = "
			SELECT 
				DISTINCT 
				b.NoTransaksi					NoInvoice,
				b.TglTransaksi 					TglInvoice,
				COALESCE(d.NoTransaksi,'')		NoSuratJalan,
				d.TglTransaksi 					TglSuratJalan,
				d.NamaExpedisi,
				d.NoPol,
				d.Printed,
				CASE WHEN d.StatusDocument IS NULL THEN 'Belum dikirim' ELSE d.StatusDocument END StatusDocument
			FROM penjualandetail a
			LEFT JOIN penjualanheader b on a.NoTransaksi = b.NoTransaksi
			LEFT JOIN suratjalandetail c on a.NoTransaksi = c.BaseRef AND a.RowID = c.BaseRowID and a.KodeItem = c.KodeItem
			LEFT JOIN suratjalanheader d on c.NoTransaksi = d.NoTransaksi
			WHERE DATE(b.TglTransaksi) BETWEEN '$TglAwal' AND '$TglAkhir'
			AND b.StatusDocument IN ('Dikonfirmasi','Dikirim','Diterima')
		";
		if ($StatusTrx != "") {
			$SQL .= " AND a.StatusDocument = '$StatusTrx' ";
		}

		if ($KodeCustomer != "") {
			$SQL .= " AND a.KodeCustomer = '$KodeCustomer' ";
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
				a.Qty 			  QtyInvoice,
				COALESCE(b.Qty,0) QtyKirim
			FROM penjualandetail a
			LEFT JOIN suratjalandetail b on a.NoTransaksi = b.BaseRef AND a.RowID = b.BaseRowID AND a.KodeItem = b.KodeItem
			WHERE a.NoTransaksi = '$NoTransaksi'
		";

		$rs = $this->db->query($SQL);

		if ($rs->num_rows() > 0) {
			$data['success'] = true;
			$data['data'] = $rs->result();
		}

		echo json_encode($data);
	}

	public function AddSuratJalan()
	{
		$data = array('success' => false ,'message'=>array(),'data' => array());
		$NoFaktur = $this->input->post('NoFaktur');
		$NamaExpedisi = $this->input->post('NamaExpedisi');
		$NoPol = $this->input->post('NoPol');

		$KodeCustomer = "";
		$errorNo = 0;
		$errorMessage = '';

		$this->db->trans_begin();

		try {
			// Generate No Transaksi
			$Kolom = 'NoTransaksi';
			$Table = 'suratjalanheader';
			$Prefix = 'SJ'.strval(date("Y")).strval(date("m"));

			$SQL = "SELECT RIGHT(MAX(".$Kolom."),8)  AS Total FROM " . $Table . " WHERE LEFT(" . $Kolom . ", LENGTH('".$Prefix."')) = '".$Prefix."'";

			// var_dump($SQL);
			$rs = $this->db->query($SQL);

			$temp = $rs->row()->Total + 1;

			$NoTransaksi = $Prefix.str_pad($temp, 8,"0",STR_PAD_LEFT);

			// var_dump($NoTransaksi);
			$fakturHeader = $this->ModelsExecuteMaster->FindData(array('NoTransaksi'=>$NoFaktur), 'penjualanheader')->row();

			$KodeCustomer = $fakturHeader->KodeCustomer;
			$header = array(
				'RowID' 		=> 0,
				'NoTransaksi' 	=> $NoTransaksi,
				'TglTransaksi' 	=> date("Y-m-d h:i:sa"),
				'KodeExpedisi' 	=> $NamaExpedisi,
				'NamaExpedisi' 	=> $NamaExpedisi,
				'NoPol' 		=> $NoPol,
				'AlamatKirim' 	=> $fakturHeader->AlamatPengiriman,
				'Koordinat' 	=> $fakturHeader->Koordinat,
				'StatusDocument'=> 'Dikirim',
				'CreatedBy' 	=> $this->session->userdata('NamaUser'),
				'CreatedOn' 	=> date("Y-m-d h:i:sa"),
				'Printed'		=> 0,
				'KodeCustomer'	=> $fakturHeader->KodeCustomer,
				'NamaPenerima'	=> '',
				'TglTerima'		=> "1999-01-01"
			);

			$rsheader = $this->ModelsExecuteMaster->ExecInsert($header,'suratjalanheader');
			if ($rsheader) {
				$fakturDetail = $this->ModelsExecuteMaster->FindData(array('NoTransaksi'=>$NoFaktur), 'penjualandetail')->result();
				foreach ($fakturDetail as $row) {
					$detail = array(
						'RowID' 		=> 0,
						'NoTransaksi' 	=> $NoTransaksi,
						'BaseRef' 		=> $row->NoTransaksi,
						'BaseRowID' 	=> $row->RowID,
						'KodeItem' 		=> $row->KodeItem,
						'NamaItem' 		=> $row->NamaItem,
						'Qty' 			=> $row->Qty
					);

					$rsDetail = $this->ModelsExecuteMaster->ExecInsert($detail,'suratjalandetail');

					if (!$rsDetail) {
						$undone = $this->db->error();
						$ErrorMessage = "Sistem Gagal Melakukan Pemrosesan Data : ".$undone['message'];
						goto jump;
					}
				}
			}
			else{
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

			$rs_user = $this->ModelsExecuteMaster->FindData(array('RecordOwnerID'=>$KodeCustomer),'users');
			if ($rs_user->num_rows() > 0) {
				$token = $rs_user->row()->token;
				if ($token != '') {
					$messageNotification = array(
						'to' => $token,
						'notification' => array(
							"title" => "EStock Apps # Update Status Pesanan",
							"body" => "Pesanan anda sudah Sudah dikirim "
						)
					);

					$this->ModelsExecuteMaster->PushNotification($messageNotification);
				}
			}
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

		$rs = $this->ModelsExecuteMaster->ExecUpdate($param,array('NoTransaksi'=>$NoTransaksi),'suratjalanheader');

		$data['success'] = true;

		echo json_encode($data);
	}

	public function UpdatePenerima()
	{
		$data = array('success' => false ,'message'=>array(),'data' => array());
		$NoTransaksi = $this->input->post('NoSuratJalan');
		$NamaPenerima = $this->input->post('Penerima');

		$param = array(
			'NamaPenerima'	=> $NamaPenerima,
			'TglTerima'		=> date("Y-m-d h:i:sa"),
			'StatusDocument'=> 'Diterima'
		);

		$rs = $this->ModelsExecuteMaster->ExecUpdate($param,array('NoTransaksi'=>$NoTransaksi),'suratjalanheader');
		// var_dump($rs);
		$data['success'] = true;

		echo json_encode($data);
	}
}