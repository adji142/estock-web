<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class API_Demografi extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelsExecuteMaster');
		$this->load->model('GlobalVar');
		$this->load->model('Apps_mod');
	}

	public function ReadProfinsi()
	{
		$MobileToken = $this->input->post('MobileToken');
		$Kriteria = $this->input->post('Kriteria');
		$data =array();
		if ($this->ModelsExecuteMaster->GetToken($MobileToken)) {
			$SQL ="SELECT prov_id AS ID, prov_name AS Title FROM dem_provinsi WHERE 1 = 1";
			if ($Kriteria != "") {
				$SQL .= " AND prov_name LIKE '%".$Kriteria."%'";
			}
			$SQL .= " ORDER BY prov_id";
			$rs = $this->db->query($SQL);
			$data = $rs->result();
		}
		echo json_encode($data);
	}

	public function ReadKota()
	{
		$MobileToken = $this->input->post('MobileToken');
		$ProvID = $this->input->post('ProvID');
		$Kriteria = $this->input->post('Kriteria');
		$data =array();
		if ($this->ModelsExecuteMaster->GetToken($MobileToken)) {
			$SQL ="SELECT city_id AS ID, city_name AS Title FROM dem_kota WHERE prov_id ='".$ProvID."' ";
			if ($Kriteria != "") {
				$SQL .= " AND city_name LIKE '%".$Kriteria."%'";
			}
			$SQL .= " ORDER BY city_id";
			$rs = $this->db->query($SQL);
			$data = $rs->result();
		}
		echo json_encode($data);
	}
	public function ReadKecamatan()
	{
		$MobileToken = $this->input->post('MobileToken');
		$KotaID = $this->input->post('KotaID');
		$Kriteria = $this->input->post('Kriteria');
		$data =array();
		if ($this->ModelsExecuteMaster->GetToken($MobileToken)) {
			$SQL ="SELECT dis_id AS ID, dis_name AS Title FROM dem_kecamatan WHERE city_id ='".$KotaID."' ";
			if ($Kriteria != "") {
				$SQL .= " AND dis_name LIKE '%".$Kriteria."%'";
			}
			$SQL .= " ORDER BY dis_id";
			$rs = $this->db->query($SQL);
			$data = $rs->result();
		}
		echo json_encode($data);
	}
	public function ReadKelurahan()
	{
		$MobileToken = $this->input->post('MobileToken');
		$KecID = $this->input->post('KecID');
		$Kriteria = $this->input->post('Kriteria');
		$data =array();
		if ($this->ModelsExecuteMaster->GetToken($MobileToken)) {
			$SQL ="SELECT subdis_id AS ID, subdis_name AS Title FROM dem_kelurahan WHERE dis_id ='".$KecID."' ";
			if ($Kriteria != "") {
				$SQL .= " AND subdis_name LIKE '%".$Kriteria."%'";
			}
			$SQL .= " ORDER BY subdis_id";
			$rs = $this->db->query($SQL);
			$data = $rs->result();
		}
		echo json_encode($data);
	}
}