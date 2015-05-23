<?php

	/**
	* 
	*/
	class Archivos extends CI_Controller
	{
		
		public function index()
		{
			$data['titulo'] = "Pagina principal";
			$this->load->view("templates/header", $data);
			$this->load->view("archivos/index");
			$this->load->view("templates/footer");
		}

		public function Agregar(){
			$data['titulo'] = "Nuevo archivo";
			$this->load->view("templates/header", $data);
			$this->load->view("archivos/agregar");
			$this->load->view("templates/footer");
		}
	}
?>