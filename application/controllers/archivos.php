<?php

	/**
	* 
	*/
	class Archivos extends CI_Controller{
		
		public function index(){
			session_start();
			if (isset($_SESSION['user_correo'])){
				if ($this->input->is_ajax_request()){
					$this->load->helper(array('form', 'url'));
			        $this->load->library('form_validation');
			        $this->form_validation->set_rules('tags', 'TAGS', 'required');
					if ($this->form_validation->run() == FALSE){
			        	$data['result'] = [];
			        }else{
			        	$this->load->model('galeria_model');
						$data['result'] = $this->galeria_model->filtrarImagenes();
					}	
					echo json_encode($data);
				}else{
					$this->load->model('galeria_model');
					$this->load->helper('html');
					$data['titulo'] = "Pagina principal";
					$data['imagenes'] = $this->galeria_model->recuperarImagenes();
					$this->load->view("templates/header", $data);
					$this->load->view("archivos/index", $data);
					$this->load->view("templates/footer");
				}
			}else{
				if ($this->input->is_ajax_request()){
					$this->load->helper(array('form', 'url'));
			        $this->load->library('form_validation');
			        $this->form_validation->set_rules('tags', 'TAGS', 'required');
					if ($this->form_validation->run() == FALSE){
			        	$data['result'] = [];
			        }else{
			        	$this->load->model('galeria_model');
						$data['result'] = $this->galeria_model->filtrarImagenes();
					}	
					echo json_encode($data);
				}else{
					$this->load->model('galeria_model');
					$this->load->helper('html');
					$data['titulo'] = "Pagina principal";
					$data['imagenes'] = $this->galeria_model->recuperarImagenesPublicas();
					$this->load->view("templates/header", $data);
					$this->load->view("archivos/index", $data);
					$this->load->view("templates/footer");
				}
			}
		}

		public function Agregar(){
			session_start();
			if (!isset($_SESSION['user_correo']))
				redirect('Archivos');
			if($this->input->post()){
				$this->load->helper(array('form', 'url'));
		        $this->load->library('form_validation');
		        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
		        $this->form_validation->set_rules('desc', 'Descripcion', 'required');
		        $this->form_validation->set_rules('imagen', 'Imagen', 'callback_imagen');
		        $this->form_validation->set_rules('tags', 'Tags', 'required');
		        if ($this->form_validation->run() == FALSE){
			        $data['respuesta'] = "<div class='alert alert-danger' role='alert'>Los datos enviados erroneos</div>";
			    }else{
		        	$this->load->model('archivo_model');
					$data['respuesta'] = $this->archivo_model->insertarImagen();
				}
			}
			$data['titulo'] = "Nuevo archivo";
			$this->load->view("templates/header", $data);
			$this->load->view("archivos/agregar", $data);
			$this->load->view("templates/footer");
		}

		public function Propias(){
			session_start();
			if (!isset($_SESSION['user_correo'])){
				redirect('Archivos');
			}else{
				if ($this->input->is_ajax_request()){
					$this->load->helper(array('form', 'url'));
			        $this->load->library('form_validation');
			        $this->form_validation->set_rules('tags', 'TAGS', 'required');
					if ($this->form_validation->run() == FALSE){
			        	$data['result'] = [];
			        }else{
			        	$this->load->model('galeria_model');
						$data['result'] = $this->galeria_model->filtrarImagenes();
					}	
					echo json_encode($data);
				}else{
					$this->load->model('galeria_model');
					$this->load->helper('html');
					$data['titulo'] = "Pagina principal";
					$data['imagenes'] = $this->galeria_model->recuperarImagenesPropias();
					$this->load->view("templates/header", $data);
					$this->load->view("archivos/propias", $data);
					$this->load->view("templates/footer");
				}
			}
		}

		public function EliminarImagen(){
			session_start();
			if (isset($_SESSION['user_correo'])){
				$this->load->model('archivo_model');
				echo $this->archivo_model->eliminarImagen();
			}
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