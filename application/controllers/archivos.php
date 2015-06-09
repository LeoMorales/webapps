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
				$this->load->helper(array('form', 'url'));
		        $this->load->library('form_validation');
		        //$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		        //$this->form_validation->set_rules('desc', 'Descripcion', 'required');
		        //$this->form_validation->set_rules('imagen', 'Imagen', 'callback_imagen');
		        $this->form_validation->set_rules('tags', 'Tags', 'required');
		        if ($this->form_validation->run() == FALSE)
			        {
			            $data['respuesta'] = "<div class='alert alert-danger' role='alert'>Los datos enviados erroneos</div>";
			        }
			        else
			        {
			        	$this->load->model('archivo_model');
						$data['respuesta'] = $this->archivo_model->insertarImagen();
			        }
			}
			$data['titulo'] = "Nuevo archivo";
			$this->load->view("templates/header", $data);
			$this->load->view("archivos/agregar", $data);
			$this->load->view("templates/footer");
		}

		// Funciones de validacion

		function imagen(){
			if ($_FILES['imagen']['error'] > 0)
				return false;
			else 
				return true;
		}
	}
?>