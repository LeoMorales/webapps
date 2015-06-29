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

	private function random_file($nombre, $length) {
	    $key = '';
	    $keys = array_merge(range(0, 9), range('a', 'z'));

	    for ($i = 0; $i < $length; $i++) {
	        $key .= $keys[array_rand($keys)];
	    }
    	return $key."-".$nombre;
	}

	public function archivoExiste($archivo){
		$this->db->select('*');
		$imagen = "imageStorage/".$archivo;
		$this->db->where('archivo',$imagen);
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

	private function incrementarReferencias($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$g = $this->db->get('tag');
		$referencias = $g->result()[0]->referencias;
		$data['referencias'] = $referencias + 1;
		$this->db->where('id', $id);
		$this->db->update('tag', $data);
	}

	private function insertarTags($id_imagen){
		$cadena  = preg_replace( "([ ]+)","-",$_POST['tags']);
		$split = explode("-", $cadena);
		foreach ($split as $token) {
			$data = [];
			$id_tag = $this->tagExiste($token);
			if ($id_tag > 0){
				$data['id_tag'] = $id_tag;
				$data['id_imagen'] = $id_imagen;
				$this->db->insert('tag_imagen', $data);
				$this->incrementarReferencias($id_tag);
			}
			else{
				$data['nombre'] = $token;
				$data['referencias'] = 1;
				$this->db->insert('tag', $data);
				$data_img['id_tag'] = $this->tagExiste($token);
				$data_img['id_imagen'] = $id_imagen;
				$this->db->insert('tag_imagen', $data_img);	
			}
		}
	}

	public function insertarImagen(){
		$extension = image_type_to_extension(exif_imagetype($_FILES['imagen']['tmp_name']));
		if ($extension == ".jpeg")
			$extension = ".jpg";
    	do {
    		$nombre_random = $this->random_file($_POST['nombre'], 7);
			$this->archivo = "imageStorage/".$nombre_random.$extension;
    	} while (file_exists($this->archivo));
    	$this->nombre = $_POST['nombre'];
		$this->descripcion = $_POST['desc'] ;
		$this->publico = 0;
		if (isset($_POST['public']))
			$this->publico = 1;
		date_default_timezone_set("America/Argentina/Buenos_Aires");
		$this->fecha =  date('Y-m-d H:i:s', time());
		if (isset($_SESSION['user_correo'])){
			$this->propietario = $_SESSION['user_correo'];
		}
		
		//creacion de la imagen
		$origen = $_FILES['imagen']['tmp_name']; 
		$destino =  realpath(".")."\\".$this->archivo;
		if (move_uploaded_file($origen,$destino))
        	$status = "<div class='alert alert-success' role='alert'>El archivo fue cargado con exito</div>";
        else{
            $status = "<div class='alert alert-danger' role='alert'>Error al subir archivo</div>";
            return $status;
        }
    	
    	//creacion del thumbnail
    	$CI = get_instance();
    	$CI->load->library('image_lib');
    	$config['image_library'] = 'gd2';
		$config['source_image'] = $destino;
		$config['new_image'] = realpath(".")."\\imageThumbnails\\".$nombre_random.$extension;
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = TRUE;
		$config['height'] = 150;
		$CI->image_lib->initialize($config);
        $CI->image_lib->resize();
        $CI->image_lib->clear();
        $this->thumbnail = "imageThumbnails/".$nombre_random."_thumb".$extension;
    	
   		//recorte de la imagen para dejar todos los thumbnails iguales
		$original_size = getimagesize(realpath(".")."\\imageThumbnails\\".$nombre_random."_thumb".$extension);
		$desplazamiento = 150;
		if ($original_size[0] > 150)
			$desplazamiento = ($original_size[0] -150) / 2;
		$config['source_image'] = realpath(".")."\\imageThumbnails\\".$nombre_random."_thumb".$extension;
		$config['maintain_ratio'] = FALSE;
		$config['new_image'] = realpath(".")."\\imageThumbnails\\".$nombre_random.$extension;
		$config['width'] = 150;
		$config['height'] = 150;
		$config['x_axis'] = $desplazamiento;
		$CI->image_lib->initialize($config);
		$CI->image_lib->crop();
		$CI->image_lib->clear();

    	$this->db->insert('imagen',$this);
    	$this->insertarTags($this->archivoExiste($nombre_random.$extension));
    	return $status;
	}

	public function buscarThumbnail($correo, $id){
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->where('propietario', $correo);
		$g = $this->db->get('imagen');
		if ($g->num_rows() > 0)
			return TRUE;
		else
			return FALSE;		
	}

	public function decrementarReferencias($imagen){
		$this->db->select('*');
		$this->db->from("tag");
		$this->db->join("tag_imagen ti", "tag.id = ti.id_tag");
		$this->db->where('id_imagen',$imagen);
		$g = $this->db->get();
		if ($g->num_rows() > 0){
			$ref = $g->result()[0]->referencias;
			$tag = $g->result()[0]->id_tag;
			if ($ref > 0){
				$data['referencias'] = $ref - 1;
               	$this->db->where('id', $tag);
				$this->db->update('tag', $data); 
			}
		}
	}

	public function eliminarImagen(){
		$existe = $this->buscarThumbnail($_SESSION['user_correo'], $_POST['id']);
		if ($existe){
			$this->decrementarReferencias($_POST['id']);
			$this->db->where('id_imagen', $_POST['id']);
			$this->db->delete('tag_imagen');
			$this->db->where('id', $_POST['id']);
			$this->db->delete('imagen');
		}
		return;
	}
}
?>