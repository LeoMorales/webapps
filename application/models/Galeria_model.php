<?php
class Galeria_model extends CI_model{

	//TODO contemplar tags con espacios
	public function __construct(){
		$this->load->database();
	}

	public function recuperarImagenes(){
		$this->db->select('id, nombre, archivo, thumbnail');
		$this->db->where('propietario !=', $_SESSION['user_correo']);
		$this->db->limit(12);	
		$g = $this->db->get('imagen');
		return $g->result_array();
	}

	public function recuperarImagenesPublicas(){
		$this->db->select('id, nombre, archivo, thumbnail');
		$this->db->where('publico', 1);
		$this->db->limit(12);
		$g = $this->db->get('imagen');
		return $g->result_array();
	}

	public function recuperarImagenesPropias(){
		$this->db->select('id, nombre, descripcion, publico, thumbnail, fecha');
		$this->db->where('propietario', $_SESSION['user_correo']);
		$this->db->limit(12);
		$g = $this->db->get('imagen');
		return $g->result_array();
	}

	public function recuperarTagsDeImagen($id_imagen){
		$this->db->select('nombre');
		$this->db->from("tag");
		$this->db->join("tag_imagen ti", "tag.id = ti.id_tag");
		$this->db->where('id_imagen',$id_imagen);
		$g = $this->db->get();
		
		return $g->result_array();
	}

	private function tagExiste($tag){
		$this->db->select('*');
		$this->db->like(array('nombre' => $tag));
		$g = $this->db->get('tag');
		if ($g->num_rows() > 0)
			return $g->result()[0]->id;
		else
			return 0;
	}

	public function recuperarImagenTag($tag){
		$id_tag = $this->tagExiste($tag);
		$arreglo = [];
		if ($id_tag > 0){
			$this->db->select('*');
			$this->db->from("imagen img");
			$this->db->join("tag_imagen ti", "img.id = ti.id_imagen");
			$this->db->where('id_tag',$id_tag);
			$this->db->where('propietario !=', $_SESSION['user_correo']);
			$this->db->limit(1000);
			$g = $this->db->get();
			foreach ($g->result() as $row){
				array_push($arreglo, $row->id_imagen);
			}
		}
		return $arreglo;
	}

	public function recuperarImagenPublicaTag($tag){
		$id_tag = $this->tagExiste($tag);
		$arreglo = [];
		if ($id_tag > 0){
			$this->db->select('*');
			$this->db->from("imagen img");
			$this->db->join("tag_imagen ti", "img.id = ti.id_imagen");
			$this->db->where('id_tag',$id_tag);
			$this->db->where('publico', 1);
			$this->db->limit(1000);
			$g = $this->db->get();
			foreach ($g->result() as $row){
				array_push($arreglo, $row->id_imagen);
			}
		}
		return $arreglo;
	}

	public function recuperarImagenPropiaTag($palabra){
		$id_tag = $this->tagExiste($palabra);
		$arreglo = [];
		if ($id_tag > 0){
			$this->db->select('*');
			$this->db->from("imagen img");
			$this->db->join("tag_imagen ti", "img.id = ti.id_imagen");
			$this->db->where('id_tag',$id_tag);
			$this->db->where('propietario =', $_SESSION['user_correo']);
			$this->db->limit(1000);
			$g = $this->db->get();
			foreach ($g->result() as $row){
				array_push($arreglo, $row->id_imagen);
			}
		}
		return $arreglo;
	}

	public function recuperarImagenPropiaNombre($palabra){
		$arreglo = [];
		$this->db->select('*');
		$this->db->from("imagen img");
		$this->db->like(array('nombre' => $palabra));
		$g = $this->db->get();
		foreach ($g->result() as $row){
			array_push($arreglo, $row->id);
		}
		return $arreglo;
	}

	public function recuperarImagenPropiaDescripcion($palabra){
		$arreglo = [];
		$this->db->select('*');
		$this->db->from("imagen img");
		$this->db->like(array('descripcion' => $palabra));
		$g = $this->db->get();
		foreach ($g->result() as $row){
			array_push($arreglo, $row->id);
		}
		return $arreglo;
	}

	private function devolverImagenes($data){
		$data = array_unique($data);
		$arreglo = [];
		foreach ($data as $id) {
			$this->db->select('*');
			$this->db->where('id',$id);
			$query = $this->db->get('imagen');
			$arreglo = array_merge($arreglo, $query->result_array());
		}
		return $arreglo;
	}

	public function filtrarImagenes(){
		$tags = explode(" ", trim($_POST['tags']));
		$imagenes = [];
		foreach ($tags as $tag) {
			if ($tag != "")
				$imagenes = array_merge($imagenes, $this->recuperarImagenTag($tag));
		}
		return $this->devolverImagenes($imagenes);
	}


	public function filtrarImagenesPublicas(){
		$tags = explode(" ", trim($_POST['tags']));
		$imagenes = [];
		foreach ($tags as $tag) {
			if ($tag != "")
				$imagenes = array_merge($imagenes, $this->recuperarImagenPublicaTag($tag));
		}
		return $this->devolverImagenes($imagenes);
	}

	public function filtrarImagenesPropias(){
		$criterio = explode(" ", trim($_POST['tags']));
		$imagenes = [];
		foreach ($criterio as $palabra) {
			if ($palabra != ""){
				$imagenes = array_merge($imagenes, $this->recuperarImagenPropiaTag($palabra));
				$imagenes = array_merge($imagenes, $this->recuperarImagenPropiaDescripcion($palabra));
				$imagenes = array_merge($imagenes, $this->recuperarImagenPropiaNombre($palabra));
			}
		}
		return $this->devolverImagenes($imagenes);
	}
}