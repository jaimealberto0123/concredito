<?php
	#SE TOMA UN ARCHIVO DE DEFINICIONES, EL QUE SEA, SOLO PARA TOMAR LA CONEXION
	include_once("empresa/definiciones.php");
	include_once("lib/Users.php");

	function validate_user($data){
		if(isset($data["login"])){
			if(isset($data["password"])){
				$usuario = trim(get_replace($data["login"]));
				$pass = trim(get_replace($data["password"]));
				$users = new Users();
				$response = $users->get_users_conexion($usuario, $pass);
				$data = $response["data"];
			}
		}
		return $data;
	}
	
	function get_session($id){
		session_start();
		$_SESSION["session"] = $id;
	}

	function get_replace($string){
		$string = str_replace(" ", "", $string);
		$string = str_replace("(", "", $string);
		$string = str_replace(")", "", $string);
		$string = str_replace("*", "", $string);
		$string = str_replace(";", "", $string);
		$string = str_replace("=", "", $string);
		$string = str_replace("!", "", $string);
		$string = str_replace("¡", "", $string);
		$string = str_replace("'", "", $string);
		$string = str_replace('"', "", $string);
		$string = str_replace("#", "", $string);
		$string = str_replace("$", "", $string);
		$string = str_replace("%", "", $string);
		$string = str_replace("&", "", $string);
		$string = str_replace("/", "", $string);
		$string = str_replace("?", "", $string);
		$string = str_replace("¿", "", $string);
		$string = str_replace("+", "", $string);
		$string = str_replace("-", "", $string);
		$string = str_replace("-", "", $string);
		$string = str_replace("localhost", "", $string);
		$string = str_replace("root", "", $string);
		return $string;
	}

?>