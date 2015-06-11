<?php


	/**
	* 
	*/
	class Home extends CI_Controller
	{
		public
		function index()
		{
			session_start();
			if (!isset($_SESSION['user_token'])){
				$data['titulo'] = "Session OFF";
			}
			else{
				$data['titulo'] = "Session ON";
			}
			$this->load->view("templates/header", $data);
			$this->load->view("home/index");
			$this->load->view("templates/footer");

		}
	}
?>