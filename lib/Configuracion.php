<?PHP
	include_once("Controller.php");

	class Configuracion{

		public function Configuracion(){
			
		}

		public function get_configuraciones(){
			$controller = new Controller();
			$query = "
				SELECT
					id,
					nombre,
					value
				FROM
					tb_configuracion
				ORDER BY
					id
			";
			return $controller->select_varios_db($query);
		}

		public function update_configuracion($financiamiento, $enganche, $plazo){
			$controller = new Controller();
			$query = "UPDATE tb_configuracion SET value = '".$financiamiento."' WHERE id = 1";
			$controller->update_bd($query);
			$query = "UPDATE tb_configuracion SET value = '".$enganche."' WHERE id = 2";
			$controller->update_bd($query);
			$query = "UPDATE tb_configuracion SET value = '".$plazo."' WHERE id = 3";
			return $controller->update_bd($query);
		}

	}

?>

