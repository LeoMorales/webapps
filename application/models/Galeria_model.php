<?php
class Galeria_model extends CI_model{

	//TODO contemplar tags con espacios
	//TODO tags key sensitive
	public function __construct(){
		$this->load->database();
	}

	public function recuperarImagenes(){
		$this->db->select('thumbnail');
		$g = $this->db->get('imagen');
		return $g->result_array();
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

	public function recuperarImagenTag($tag){
		$id_tag = $this->tagExiste($tag);
		$arreglo = [];
		if ($id_tag > 0){
			$this->db->select('id_imagen');
			$this->db->where('id_tag',$id_tag);
			$g = $this->db->get('tag_imagen');
			foreach ($g->result() as $row){
				array_push($arreglo, $row->id_imagen);
			}
		}
		return $arreglo;
	}

	private function devolverImagenes($data){
		$arreglo = [];
		foreach ($data as $id) {
			$this->db->select('thumbnail');
			$this->db->where('id',$id);
			$query = $this->db->get('imagen');
			$arreglo = array_merge($arreglo, $query->result_array());
		}
		return $arreglo;
	}

	public function filtrarImagenes(){
		$tags = explode(" ", $_POST['tags']);
		$imagenes = [];
		foreach ($tags as $tag) {
			$imagenes = $imagenes + $this->recuperarImagenTag($tag);
		}
		return $this->devolverImagenes($imagenes);
	}
}