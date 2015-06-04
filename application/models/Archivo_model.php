<?php
class Archivo_model extends CI_Model{
	var $nombre = "";
	var $descripcion = "";
	var $publico = "";
	var $fecha = "";
	var $archivo = "";
	var $thumbnail = "";
	var $propietario = "";

	public function __construct(){
		$this->load->database();
	}

	public function recuperarImagenes(){
		$this->db->select('thumbnail');
		$g = $this->db->get('imagen');
		return $g->result_array();
	}

	public function insertarImagen(){
		$this->nombre = $_POST['nombre'];
		$this->descripcion = $_POST['desc'] ;
		$this->publico = 0;
		if (isset($_POST['public']))
			$this->publico = 1;
		date_default_timezone_set("America/Argentina/Buenos_Aires");
		$this->fecha =  date('Y-m-d H:i:s', time());
		$this->propietario = 1;
		//creacion de la imagen en disco
		$extension = image_type_to_extension(exif_imagetype($_FILES['imagen']['tmp_name']));
		if ($extension == ".jpeg")
			$extension = ".jpg";
		$this->archivo = "/imageStorage/".$this->nombre.$extension;
		$origen = $_FILES['imagen']['tmp_name']; 
		$destino =  realpath(".")."\\imageStorage\\".$this->nombre.$extension;
		if (copy($origen,$destino)) {
            $status = "<div class='alert alert-success' role='alert'>El archivo fue cargado con exito</div>";
        } else {
            $status = "<div class='alert alert-danger' role='alert'>Error al subir archivo</div>";
        }
    	//creacion del thumbnail en disco
    	//TODO: ver que pasa con la colicion 
    	//TODO: evaluar recordar las imagenes para que la galeria se vea bien
    	$CI = get_instance();
    	$CI->load->library('image_lib');
    	$config['image_library'] = 'gd2';
		$config['source_image'] = $destino;
		$config['new_image'] = realpath(".")."\\imageThumbnails\\".$this->nombre.$extension;
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = TRUE;
		$config['width'] = 200;
		$config['height'] = 150;
		$CI->image_lib->initialize($config);
        $CI->image_lib->resize();
        $CI->image_lib->clear();
        $this->thumbnail = "/imageThumbnails/".$this->nombre."_thumb".$extension;
    	
    	$this->db->insert('imagen',$this);
    	return $status;
	}
}
?>