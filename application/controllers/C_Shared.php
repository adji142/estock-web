<!-- 
This part allow access 1 object for to many form
Developed by : AIS System
Developed Date : 15 Dec 2021
 -->
<?php 
	class C_Shared extends CI_Controller {
		function __construct()
		{
			parent::__construct();
			$this->load->model('ModelsExecuteMaster');
			$this->load->model('GlobalVar');
			$this->load->model('LoginMod');
		}

		public function Read()
		{
			$data = array('success' => false ,'message'=>array(),'data' =>array());
			$table = $this->input->post('table');
			$condition = $this->input->post('condition'); // array statement
			$script = $this->input->post('script');

			$condition = '{"fieldName":{"param0":"date","param1":"grp"},"fieldValue":{"param0":"now","param1":"1"}}';
			$wheredata = json_decode($condition, true);
			$wherestatement = "";

			$fieldName = $wheredata['fieldName'];
			$fieldValue = $wheredata['fieldValue'];
			// $data = array(
			// 	"fieldName" => array(
			// 		"param0" => "date",
			// 		"param1" => "grp"
			// 	),
			// 	"fieldValue" => array(
			// 		"param0" => "now",
			// 		"param1" => "1"
			// 	)
			// );
			// echo json_encode($data);
		}
	}
?>