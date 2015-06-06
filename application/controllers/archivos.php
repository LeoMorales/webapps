<?php

	/**
	* 
	*/
	class Archivos extends CI_Controller{
		
		public function index(){
			$this->load->model('archivo_model');
			$this->load->helper('html');
			$data['titulo'] = "Pagina principal";
			$data['imagenes'] = $this->archivo_model->recuperarImagenes();
			$this->load->view("templates/header", $data);
			$this->load->view("archivos/index", $data);
			$this->load->view("templates/footer");
		}

		public function Agregar(){
			if($this->input->post()){
				$this->load->model('archivo_model');
				$data['respuesta'] = $this->archivo_model->insertarImagen();
			}
			$data['titulo'] = "Nuevo archivo";
			$this->load->view("templates/header", $data);
			$this->load->view("archivos/agregar", $data);
			$this->load->view("templates/footer");
		}
	}
?>