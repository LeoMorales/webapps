<?php 

class UsuarioModel extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	public function give_me_the_user_with($email){
		$query = $this->db->get_where('usuario', array('correo' => $email));
		return $query->row_array();
	}

	public function create_user($un_email, $un_username, $un_token){
		$data = array(
		   'username' => $un_username ,
		   'correo' => $un_email,
		   'token' => $un_token
		);
		$this->db->insert('usuario', $data);
		return $data;
	}
	
}

?>