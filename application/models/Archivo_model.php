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
		$this->db->select('*');
		$this->db->where('nombre',$nombre);
		$g = $this->db->get('imagen');
		if ($g->num_rows() > 0)
			return $g->result()[0]->id;
		else
			return 0;
	}

	private function tagExiste($tag){
		$this->db->select('*');
		$this->db->where('nombre',$tag);
		$g = $this->db->get('tag');
		if ($g->num_rows() > 0)
			return $g->result()[0]->id;
		else
			return 0;
	}

	private function insertarTags($id_imagen){
		$cadena  = preg_replace( "([ ]+)","-",$_POST['tags']);
		$split = explode("-", $cadena);
		foreach ($split as $token) {
			$id_tag = $this->tagExiste($token);
			if ($id_tag > 0){
				$data['id_tag'] = $id_tag;
				$data['id_imagen'] = $id_imagen;
				$this->db->insert('tag_imagen', $data);
			}
			else{
				$data['nombre'] = $token;
				$this->db->insert('tag', $data);
				$data_img['id_tag'] = $this->tagExiste($token);
				$data_img['id_imagen'] = $id_imagen;
				$this->db->insert('tag_imagen', $data_img);	
			}
		}
	}

	public function recuperarImagenes(){
		$this->db->select('thumbnail');
		$g = $this->db->get('imagen');
		return $g->result_array();
	}

	public function insertarImagen(){
    	/*
		do {
			$this->nombre = $this->random_nombre($_POST['nombre'], 7);
    	} while ($this->nombreExiste($this->nombre) != 0);
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
		$this->archivo = "imageStorage/".$this->nombre.$extension;
		$origen = $_FILES['imagen']['tmp_name']; 
		$destino =  realpath(".")."\\imageStorage\\".$this->nombre.$extension;
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
		$config['new_image'] = realpath(".")."\\imageThumbnails\\".$this->nombre.$extension;
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = TRUE;
		$config['height'] = 150;
		$CI->image_lib->initialize($config);
        $CI->image_lib->resize();
        $CI->image_lib->clear();
        $this->thumbnail = "imageThumbnails/".$this->nombre."_thumb".$extension;
    	
   		//recorte de la imagen para dejar todos los thumbnails iguales
		$original_size = getimagesize(realpath(".")."\\imageThumbnails\\".$this->nombre."_thumb".$extension);
		$desplazamiento = 150;
		if ($original_size[0] > 150)
			$desplazamiento = ($original_size[0] -150) / 2;
		$config['source_image'] = realpath(".")."\\imageThumbnails\\".$this->nombre."_thumb".$extension;
		$config['maintain_ratio'] = FALSE;
		$config['new_image'] = realpath(".")."\\imageThumbnails\\".$this->nombre.$extension;
		$config['width'] = 150;
		$config['height'] = 150;
		$config['x_axis'] = $desplazamiento;
		$CI->image_lib->initialize($config);
		$CI->image_lib->crop();
		$CI->image_lib->clear();

    	$this->db->insert('imagen',$this);
    	*/
    	$this->insertarTags(41);
    	//return $status;
	}
}
?>