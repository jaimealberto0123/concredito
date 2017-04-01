<?PHP
	include_once("Controller.php");

	class Users{

		public function Users(){
			
		}

		public function get_users_conexion($usuario, $pass){
			$controller = new Controller();
			$query = "
				SELECT 
					id, 
					username, 
					password AS 'pass', 
					MD5('".$pass."') AS 'pass2'
				FROM
					tb_empleados 
				WHERE 
					(username = '".$usuario."')
				";
			return $controller->select_uno_db($query);
		}

	}

?>