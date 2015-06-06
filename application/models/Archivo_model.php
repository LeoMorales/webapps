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

	private function random_nombre($nombre, $length) {
	    $key = '';
	    $keys = array_merge(range(0, 9), range('a', 'z'));

	    for ($i = 0; $i < $length; $i++) {
	        $key .= $keys[array_rand($keys)];
	    }
    	return $key."-".$nombre;
	}

	private function nombreExiste($nombre){
		$this->db->select('nombre');
		$this->db->where('nombre',$nombre);
		$g = $this->db->get('imagen');
		return $g->num_rows(); 
	}

	public function recuperarImagenes(){
		$this->db->select('thumbnail');
		$g = $this->db->get('imagen');
		return $g->result_array();
	}

	public function insertarImagen(){
		do {
			$nombreEnBase = $this->random_nombre($_POST['nombre'], 7);
    	} while ($this->nombreExiste($nombreEnBase) != 0);
    	$this->nombre = $_POST['nombre'];
		$this->descripcion = $_POST['desc'] ;
		$this->publico = 0;
		if (isset($_POST['public']))
			$this->publico = 1;
		date_default_timezone_set("America/Argentina/Buenos_Aires");
		$this->fecha =  date('Y-m-d H:i:s', time());
		$this->propietario = 1;
		
		//creacion de la imagen
		$extension = image_type_to_extension(exif_imagetype($_FILES['imagen']['tmp_name']));
		if ($extension == ".jpeg")
			$extension = ".jpg";
		$this->archivo = "imageStorage/".$nombreEnBase.$extension;
		$origen = $_FILES['imagen']['tmp_name']; 
		$destino =  realpath(".")."\\imageStorage\\".$nombreEnBase.$extension;
		if (copy($origen,$destino)) {
            $status = "<div class='alert alert-success' role='alert'>El archivo fue cargado con exito</div>";
        } else {
            $status = "<div class='alert alert-danger' role='alert'>Error al subir archivo</div>";
        }
    	
    	//creacion del thumbnail
    	$CI = get_instance();
    	$CI->load->library('image_lib');
    	$config['image_library'] = 'gd2';
		$config['source_image'] = $destino;
		$config['new_image'] = realpath(".")."\\imageThumbnails\\".$nombreEnBase.$extension;
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = TRUE;
		$config['height'] = 150;
		$CI->image_lib->initialize($config);
        $CI->image_lib->resize();
        $CI->image_lib->clear();
        $this->thumbnail = "imageThumbnails/".$nombreEnBase."_thumb".$extension;
    	
   		//recorte de la imagen para dejar todos los thumbnails iguales
		$original_size = getimagesize(realpath(".")."\\imageThumbnails\\".$nombreEnBase."_thumb".$extension);
		$desplazamiento = 150;
		if ($original_size[0] > 150)
			$desplazamiento = ($original_size[0] -150) / 2;
		$config['source_image'] = realpath(".")."\\imageThumbnails\\".$nombreEnBase."_thumb".$extension;
		$config['maintain_ratio'] = FALSE;
		$config['new_image'] = realpath(".")."\\imageThumbnails\\".$nombreEnBase.$extension;
		$config['width'] = 150;
		$config['height'] = 150;
		$config['x_axis'] = $desplazamiento;
		$CI->image_lib->initialize($config);
		$CI->image_lib->crop();
		$CI->image_lib->clear();

    	$this->db->insert('imagen',$this);
    	return $status;
	}
}
?>