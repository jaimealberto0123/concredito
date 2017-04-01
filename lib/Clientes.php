<?PHP
	include_once("Controller.php");

	class Clientes{

		public function Clientes(){
			
		}

		public function get_ultimo_elemento(){
			$controller = new Controller();
			$query = "
				SELECT * FROM tb_clientes ORDER BY id DESC LIMIT 1
			";
			return $controller->select_uno_db($query);
		}

		public function get_clientes(){
			$controller = new Controller();
			$query = "
				SELECT
					id,
					nombre,
					apellido1,
					apellido2,
					rfc
				FROM
					tb_clientes
				WHERE
					nombre <> ''
				ORDER BY
					nombre
			";
			return $controller->select_varios_db($query);
		}

		public function update_cliente_by_id($id, $nombre, $apellido1, $apellido2, $rfc){
			$controller = new Controller();
			$query = "
				UPDATE tb_clientes
				SET 
					nombre = '".$nombre."',
					apellido1 = '".$apellido1."',
					apellido2 = '".$apellido2."',
					rfc = '".$rfc."'
				WHERE
					id = ".$id.";
			";
			return $controller->update_bd($query);
		}

		public function get_cliente_by_id($id){
			$controller = new Controller();
			$query = "
				SELECT
					id,
					nombre,
					apellido1,
					apellido2,
					rfc
				FROM
					tb_clientes
				WHERE
					id = ".$id."
			";
			return $controller->select_uno_db($query);
		}

		public function insert_cliente(){
			$controller = new Controller();
			$query = "
				INSERT INTO tb_clientes (
					nombre,
					apellido1,
					apellido2,
					rfc
				)
				VALUES(
					NULL,
					NULL,
					NULL,
					NULL
				);
			";
			return $controller->insert_bd($query);
		}

	}

?>

