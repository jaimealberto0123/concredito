<?PHP
	
	class Controller{

		public function Controller(){

		}

		private function conectar_bd(){
			global $DB_SERVER, $DB_USER, $DB_PASS, $DB_NAME;
			$errorDbConexion = true;
			// Conexión con la base de datos
	        $mysqli = new mysqli($DB_SERVER, $DB_USER, $DB_PASS, $DB_NAME);
			// Verificamos si hay error al conectar
			if (mysqli_connect_error()) {
				$errorDbConexion = false;
			} 
			// Evitando problemas con acentos
			$mysqli->query('SET NAMES "utf8"');
	        if($errorDbConexion){
	            return $mysqli;
	        }
			else{
	            return false;
	        }
		}

		public function select_uno_db($query){
			
			$respuesta = array();
			$respuesta["error"] = "NO";
			$respuesta["success"] = true;
			$respuesta["error_message"] = "";
			$respuesta["response"] = "SI";
			$respuesta["data"] = array();
			$respuesta["count"] = 0;
			$mysqli = $this->conectar_bd();
			if($mysqli == false){
				$respuesta["error"] = "SI";
				$respuesta["success"] = false;
				$respuesta["error_message"] = "OCURRIO UN ERROR AL HACER CONEXION CON LA BADE DE DATOS";
				$respuesta["response"] = "NO";
			}
			else{
				try{
					$arreglo = array();
					if($result = $mysqli -> query($query)){
						$respuesta["data"] = json_decode(json_encode($result->fetch_object()), true);
						$respuesta["query"]= $query;
						$respuesta["count"] = 1;
					}
					else{
						$respuesta["error"] = "SI";
						$respuesta["success"] = false;
						$respuesta["codigo_error_conexion"] = $mysqli->connect_errno;
						$respuesta["error_message_conexion"] = $mysqli->connect_error;
						$respuesta["codigo_error"] = $mysqli -> errno;
						$respuesta["error_message"] = $mysqli -> error;
						$respuesta["query"] = $query;
					}
				}
				catch (Exception $e){
					$respuesta["error"] = "SI";
					$respuesta["success"] = false;
					$respuesta["codigo_error_conexion"] = $mysqli -> connect_errno;
					$respuesta["error_message_conexion"] = $mysqli -> connect_error;
					$respuesta["codigo_error"] = $mysqli -> errno;
					$respuesta["error_message"] = $mysqli -> error;
					$respuesta["query"] = $query;
				}
			}
			$mysqli->close();
			return $respuesta;
		}

		public function select_varios_db($query){
			$respuesta = array();
			$respuesta["error"] = "NO";
			$respuesta["success"] = true;
			$respuesta["error_message"] = "";
			$respuesta["response"] = "SI";
			$respuesta["data"] = array();
			$respuesta["count"] = 0;
			$mysqli = $this->conectar_bd();
			if($mysqli == false){
				$respuesta["error"] = "SI";
				$respuesta["success"] = false;
				$respuesta["error_message"] = "OCURRIO UN ERROR AL HACER CONEXION CON LA BADE DE DATOS.";
				$respuesta["response"] = "NO";
			}
			else{
				try{
					if($result = $mysqli -> query($query)){
						$respuesta["data"] = array();
						for($i = 0; $obj = $result -> fetch_object(); $i++){
							$respuesta["data"][$i] = json_decode(json_encode($obj), true);
						}
						$respuesta["query"]= $query;
						$respuesta["count"] = count($respuesta["data"]);
						$respuesta["success"] = true;
					}
					else{
						$respuesta["error"] = "SI";
						$respuesta["success"] = false;
						$respuesta["codigo_error_conexion"] = $mysqli -> connect_errno;
						$respuesta["error_message_conexion"] = $mysqli -> connect_error;
						$respuesta["codigo_error"] = $mysqli -> errno;
						$respuesta["error_message"] = $mysqli -> error;
						$respuesta["query"] = $query;
					}
				}
				catch (Exception $e){
					$respuesta["error"] = "SI";
					$respuesta["success"] = false;
					$respuesta["codigo_error_conexion"] = $mysqli -> connect_errno;
					$respuesta["error_message_conexion"] = $mysqli -> connect_error;
					$respuesta["codigo_error"] = $mysqli -> errno;
					$respuesta["error_message"] = $mysqli -> error;
					$respuesta["query"] = $query;
				}
			}
			$mysqli->close();
			return $respuesta;
		}

		public function insert_bd($query){
			try {
				$respuesta = array();
				$respuesta["error"] = "NO";
				$respuesta["success"] = true;
				$respuesta["error_message"] = "";
				$respuesta["response"] = "SI";
				$respuesta["data"] = array();
				$respuesta["insert_id"] = 0;
				$mysqli = $this->conectar_bd();
				if($mysqli == false){
					$respuesta["error"] = "SI";
					$respuesta["success"] = false;
					$respuesta["codigo_error_conexion"] = $mysqli -> connect_errno;
					$respuesta["error_message_conexion"] = $mysqli -> connect_error;
					$respuesta["codigo_error"] = $mysqli -> errno;
					$respuesta["error_message"] = $mysqli -> error;
					$respuesta["response"] = "NO";
				}
				else{
					try{
						$resultadoQuery = $mysqli -> query($query);
						if($mysqli -> errno == 0){
							$respuesta["error"] = "NO";
							$respuesta["success"] = true;
							$respuesta["response"] = "EL REGISTRO FUE GUARDADO EXITOSAMENTE";
							$respuesta["insert_id"] = $mysqli->insert_id;
						}
						else{
							$respuesta["error"] = "SI";
							$respuesta["success"] = false;
							$respuesta["codigo_error_conexion"] = $mysqli -> connect_errno;
							$respuesta["error_message_conexion"] = $mysqli -> connect_error;
							$respuesta["codigo_error"] = $mysqli -> errno;
							$respuesta["error_message"] = $mysqli -> error;
							$respuesta["query"] = $query;
						}
					}
					catch(Exception $e){
						$respuesta["error"] = "SI";
						$respuesta["success"] = false;
						$respuesta["error_message"] = "CAUGHT EXCEPTION: ".$e->getMessage()."";
					}
				}
			}
			catch (Exception $e){
				$respuesta["error"] = "SI";
				$respuesta["success"] = false;
				$respuesta["codigo_error_conexion"] = $mysqli -> connect_errno;
				$respuesta["error_message_conexion"] = $mysqli -> connect_error;
				$respuesta["codigo_error"] = $mysqli -> errno;
				$respuesta["error_message"] = $mysqli -> error;
				$respuesta["query"] = $query;
			}
			$respuesta["query"]= $query;
			$mysqli->close();
			return $respuesta;
		}

		public function update_bd($query){
			try {
				$respuesta = array();
				$respuesta["error"] = "NO";
				$respuesta["success"] = true;
				$respuesta["error_message"] = "";
				$respuesta["response"] = "SI";
				$respuesta["data"] = array();
				$mysqli = $this->conectar_bd();
				if($mysqli == false){
					$respuesta["error"] = "SI";
					$respuesta["success"] = false;
					$respuesta["codigo_error_conexion"] = $mysqli -> connect_errno;
					$respuesta["error_message_conexion"] = $mysqli -> connect_error;
					$respuesta["codigo_error"] = $mysqli -> errno;
					$respuesta["error_message"] = $mysqli -> error;
					$respuesta["response"] = "NO";
				}
				else{
					try{
						$resultadoQuery = $mysqli -> query($query);
						if($mysqli -> errno == 0){
							$respuesta["error"] = "NO";
							$respuesta["success"] = true;
							$respuesta["query"] = $query;
							$respuesta["response"] = "EL REGISTRO FUE MODIFICADO EXITOSAMENTE";
						}
						else{
							$respuesta["error"] = "SI";
							$respuesta["success"] = false;
							$respuesta["codigo_error_conexion"] = $mysqli -> connect_errno;
							$respuesta["error_message_conexion"] = $mysqli -> connect_error;
							$respuesta["codigo_error"] = $mysqli -> errno;
							$respuesta["error_message"] = $mysqli -> error;
							$respuesta["query"] = $query;
						}
					}
					catch(Exception $e){
						$respuesta["error"] = "SI";
						$respuesta["success"] = false;
						$respuesta["error_message"] = "CAUGHT EXCEPTION: ".$e->getMessage()."";
					}
				}
			}
			catch (Exception $e){
				$respuesta["error"] = "SI";
				$respuesta["success"] = false;
				$respuesta["error_message"] = "CAUGHT EXCEPTION: ".$e->getMessage()."";
			}
			$respuesta["query"] = $query;
			$mysqli->close();
			return $respuesta;
		}

	}
	
?>