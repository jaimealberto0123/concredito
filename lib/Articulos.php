<?PHP
	include_once("Controller.php");

	class Articulos{

		public function Articulos(){
			
		}

		public function get_ultimo_elemento(){
			$controller = new Controller();
			$query = "
				SELECT * FROM tb_articulos ORDER BY id DESC LIMIT 1
			";
			return $controller->select_uno_db($query);
		}

		public function get_articulos(){
			$controller = new Controller();
			$query = "
				SELECT
					id,
					descripcion,
					modelo,
					precio,
					existencia,
					fecha_registro
				FROM
					tb_articulos
				WHERE
					descripcion <> ''
				ORDER BY
					descripcion
			";
			return $controller->select_varios_db($query);
		}

		public function update_articulo_by_id($id, $descripcion, $modelo, $precio, $existencia){
			$controller = new Controller();
			$query = "
				UPDATE tb_articulos
				SET 
					descripcion = '".$descripcion."',
					modelo = '".$modelo."',
					precio = '".$precio."',
					existencia = '".$existencia."',
					fecha_registro = NOW()
				WHERE
					id = ".$id.";
			";
			return $controller->update_bd($query);
		}

		public function get_articulo_by_id($id){
			$controller = new Controller();
			$query = "
				SELECT
					id,
					descripcion,
					modelo,
					precio,
					existencia,
					fecha_registro
				FROM
					tb_articulos
				WHERE
					id = ".$id."
			";
			return $controller->select_uno_db($query);
		}

		public function insert_articulo(){
			$controller = new Controller();
			$query = "
				INSERT INTO tb_articulos (
					descripcion,
					modelo,
					precio,
					existencia,
					fecha_registro
				)
				VALUES(
					NULL,
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

