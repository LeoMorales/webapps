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
			if (isset($_SESSION['user_nombre'])){
				$data['nombre_del_usuario'] = $_SESSION['user_nombre'];
			}
			else{
				$data['nombre_del_usuario'] = "---";
			}
			$this->load->view("templates/header", $data);
			$this->load->view("home/index");
			$this->load->view("templates/footer");

		}

		public
		function Nosotros()
		{
			session_start();
			if (!isset($_SESSION['user_token'])){
				$data['titulo'] = "Session OFF";
			}
			else{
				$data['titulo'] = "Session ON";
			}
			if (isset($_SESSION['user_nombre'])){
				$data['nombre_del_usuario'] = $_SESSION['user_nombre'];
			}
			else{
				$data['nombre_del_usuario'] = "---";
			}

			
			$this->load->view("templates/header", $data);
			$this->load->view("home/nosotros");
			$this->load->view("templates/footer");

		}
	}
?>