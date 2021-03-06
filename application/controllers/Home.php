<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

class home extends CI_Controller {

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
		// require APPPATH.'libraries/phpmailer/src/Exception.php';
  //       require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
  //       require APPPATH.'libraries/phpmailer/src/SMTP.php';
	}
	public function Test()
	{
		$reciept = "prasetyoajiw@gmail.com";
		$subject = "Notifikasi Pembayaran";
		$body = $this->ModelsExecuteMaster->DefaultBody();
		$body .= $this->ModelsExecuteMaster->Email_payment('202108705495986');
		try {
			$this->ModelsExecuteMaster->SendSpesificEmail($reciept,$subject,$body);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		// try {
		// 	$rs = $this->ModelsExecuteMaster->ExecInsert(array('Nomor'=>'1001'),'ttest');
		// 	if ($rs) {
		// 		print_r('done');
		// 	}
		// 	else{
		// 		goto jump;	
		// 		// var_dump();
		// 	}
		// } catch (Exception $e) {
		// 	jump:
		// 	$undone = $this->db->error();
		// 	print_r('undone'.$undone['message']);
		// }
		// $data = array('success' => false ,'message'=>array(),'Nomor' => '');
		$CreatedOn = date("Y-m-d h:i:sa");
		// echo (substr(date("Y",$CreatedOn), 2,4).date("m",$CreatedOn)."1");
		echo date("m");

		// $Kolom = $this->input->post('Kolom');
		// $Table = $this->input->post('Table');
		// $Prefix = $this->input->post('Prefix');

		// $Kolom = 'ArticleCode';
		// $Table = 'articlewarna';
		// $Prefix = '1';

		// $SQL = "SELECT RIGHT(MAX(".$Kolom."),3)  AS Total FROM " . $Table . " WHERE LEFT(" . $Kolom . ", LENGTH('".$Prefix."')) = '".$Prefix."'";

		// // var_dump($SQL);
		// $rs = $this->db->query($SQL);

		// $temp = $rs->row()->Total + 1;

		// $nomor = $Prefix.str_pad($temp, 3,"0",STR_PAD_LEFT);
		// if ($nomor != '') {
		// 	$data['success'] = true;
		// 	$data['nomor'] = $nomor;
		// }
		// echo json_encode($data);

		
	}
	public function index()
	{
		$this->load->view('Dashboard');
	}
	// --------------------------------------- Master ----------------------------------------------------
	public function permission()
	{
		$this->load->view('V_Auth/permission');
	}
	public function role()
	{
		$this->load->view('V_Auth/roles');
	}
	public function permissionrole($value)
	{
		$rs = $this->ModelsExecuteMaster->FindData(array('id'=>$value),'roles');
		$data['roleid'] = $value;
		$data['rolename'] = $rs->row()->rolename;
		$this->load->view('V_Auth/permissionrole',$data);	
	}
	public function user()
	{
		$this->load->view('V_Auth/users');
	}

	// Master Data

	public function mstr_kategori()
	{
		$this->load->view('V_MasterData/kategori');
	}
	public function mstr_satuan()
	{
		$this->load->view('V_MasterData/satuan');
	}
	public function mstr_itemdata()
	{
		$this->load->view('V_MasterData/itemmasterdata');
	}
	public function mstr_termin()
	{
		$this->load->view('V_MasterData/terminpenjualan');
	}
	public function mstr_promo()
	{
		$this->load->view('V_Banner/banner');
	}
	public function mstr_customerdata()
	{
		$this->load->view('V_MasterData/customerdata');
	}


	// Trx
	public function trx_Faktur()
	{
		$this->load->view('V_Trx/transaksipenjualan');
	}
	public function trx_SJ()
	{
		$this->load->view('V_Trx/suratjalan');
	}

	// Setting
	public function setting_Cutoff()
	{
		$this->load->view('V_Tools/cutoffsetting');
	}
}
