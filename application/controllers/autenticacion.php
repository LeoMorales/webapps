<?php

	/**
	* 
	*/
	class Autenticacion extends CI_Controller
	{
		
		public function hello()
		{
			require_once('FirePHPCore/FirePHP.class.php');
			$firephp = FirePHP::getInstance(true);
			require_once('FirePHPCore/fb.php');
			$firephp->setEnabled(true);  // or FB::
	 

			//Recuperamos los datos:
			$token = $this->input->post('token');
			$nombre = $this->input->post('nombre');
			$email = $this->input->post('email');

			$url_google = "https://www.googleapis.com/oauth2/v1/tokeninfo?id_token=";

			//Preguntamos a Google si es valido con curl
			// Get cURL resource
			$url = $url_google.$token;
			$handler = curl_init($url);
			curl_setopt($handler, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($handler, CURLOPT_URL, $url);
			curl_setopt($handler, CURLOPT_HTTPGET, true);
			curl_setopt($handler, CURLOPT_HTTPHEADER, array(
			    'Content-Type: application/json',
			    'Accept: application/json'
			));
			// Will return the response, if false it print the response
			curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec ($handler);
			if (!$response)
				$firephp->log(curl_error($handler));
			curl_close($handler);  
			
			if ($user = $this->give_me_the_user($response)){
				$data['email'] = $user;
				$data['nombre'] = $nombre;
				// echo "<center><h4>Hola ".$nombre."! (".$email.") </h4></center>";
				$this->load->view("autenticacion/bienvenido", $data);
			}
		}

		private function give_me_the_user($un_json){
			// {
			//  "issuer": "accounts.google.com",
			//  "issued_to": "247475190591-e59sg0qhf5j10udhp805nt3lsmoucu10.apps.googleusercontent.com",
			//  "audience": "247475190591-e59sg0qhf5j10udhp805nt3lsmoucu10.apps.googleusercontent.com",
			//  "user_id": "101075227843275652232",
			//  "expires_in": 3071,
			//  "issued_at": 1433444044,
			//  "email": "leo.moralesr23@gmail.com",
			//  "email_verified": true
			// }
			require_once('FirePHPCore/FirePHP.class.php');
			$firephp = FirePHP::getInstance(true);
			require_once('FirePHPCore/fb.php');
			$firephp->setEnabled(true);  // or FB::
	 
			$firephp->log("DECODIFICANDO:");
			$firephp->log($un_json);
			$respuesta = json_decode($un_json);
			$firephp->log("DECODIFICADO:");
			$firephp->log($respuesta);
			if ($respuesta->email_verified) {
				//Existe en la BAse?
				return $this->user_del_modelo($respuesta->email);
			}

		}

		private function user_del_modelo($un_email){
			//PRECONDICION: un_email es un email valido de google.
			//Fijarse en el modelo si está en la Base, si no existe lo crea.
			$user = $un_email;
			return $user;
		}

		
	}
?>