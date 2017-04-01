<?PHP
	include_once("Controller.php");

	class Ventas{

		public function Ventas(){
			
		}

		public function get_ventas(){
			$controller = new Controller();
			$query = "
				SELECT
					a.id,
					a.id_cliente,
					b.nombre,
					b.apellido1,
					b.apellido2,
					b.rfc,
					a.total,
					a.fecha,
					a.estatus
				FROM
					tb_ventas a
					INNER JOIN tb_clientes b ON b.id = a.id_cliente
				ORDER BY
					a.fecha DESC
			";
			return $controller->select_varios_db($query);
		}

		public function get_cliente_by_nombre($nombre){
			$controller = new Controller();
			$query = "
				SELECT
					id,
					TRIM(CONCAT(IFNULL(nombre, ''), ' ', IFNULL(apellido1, ''), ' ', IFNULL(apellido2, ''))) AS 'nombre',
					rfc
				FROM
					tb_clientes
				WHERE
					TRIM(CONCAT(IFNULL(nombre, ''), ' ', IFNULL(apellido1, ''), ' ', IFNULL(apellido2, ''))) LIKE '".trim($nombre)."'
				LIMIT 1
			";
			return $controller->select_uno_db($query);
		}

		public function get_articulo_by_nombre($nombre){
			$controller = new Controller();
			$query = "
				SELECT
					id,
					descripcion,
					modelo,
					precio,
					existencia
				FROM
					tb_articulos
				WHERE
					descripcion <> ''
					AND descripcion LIKE '".$nombre."'
				ORDER BY
					descripcion
			";
			return $controller->select_uno_db($query);
		}

		public function get_articulo_by_id($id){
			$controller = new Controller();
			$query = "
				SELECT
					id,
					descripcion,
					modelo,
					precio,
					existencia
				FROM
					tb_articulos
				WHERE
					id = '".$id."'
			";
			return $controller->select_uno_db($query);
		}

		public function get_venta_by_id($id){
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
					tb_ventas
				WHERE
					id = ".$id."
			";
			return $controller->select_uno_db($query);
		}

		public function get_ultimo_elemento(){
			$controller = new Controller();
			$query = "
				SELECT * FROM tb_ventas ORDER BY id DESC LIMIT 1
			";
			return $controller->select_uno_db($query);
		}

		public function insert_venta(){
			$controller = new Controller();
			$query = "
				INSERT INTO tb_ventas(
					id_cliente,
					total,
					tasa,
					enganche,
					enganche_venta,
					bonificacion_venta,
					plazo_maximo,
					abono,
					mensualidades,
					fecha,
					estatus
				)
				VALUES(
					NULL,
					NULL,
					NULL,
					NULL,
					NULL,
					NULL,
					NULL,
					NULL,
					NULL,
					NULL,
					'1'
				);
			";
			return $controller->insert_bd($query);
		}

		public function update_venta_by_id($id, $id_cliente, $total, $tasa, $enganche, $enganche_venta, $bonificacion_venta, $plazo_maximo, $abono, $mensualidades){
			$controller = new Controller();
			$query = "
				UPDATE tb_ventas 
				SET 
					id_cliente = '".$id_cliente."',
					total = '".$total."',
					tasa = '".$tasa."',
					enganche = '".$enganche."',
					enganche_venta = '".$enganche_venta."',
					bonificacion_venta = '".$bonificacion_venta."',
					plazo_maximo = '".$plazo_maximo."',
					abono = '".$abono."',
					mensualidades = '".$mensualidades."',
					fecha = now(),
					estatus = '0'
				WHERE
					id = ".$id.";
			";
			return $controller->update_bd($query);
		}

		public function insert_venta_articulo($id_venta, $id_articulo, $precio){
			$controller = new Controller();
			$query = "
				INSERT INTO tb_ventas_articulos (
					id_venta,
					id_articulo,
					precio
				)
				VALUES(				
					'".$id_venta."',
					'".$id_articulo."',
					'".$precio."'
				);
			";
			return $controller->insert_bd($query);
		}

		public function get_lista_clientes(){
			$controller = new Controller();
			$query = "
				SELECT
					id,
					nombre,
					apellido1,
					apellido2
				FROM
					tb_clientes
				WHERE
					nombre <> ''
				ORDER BY
					nombre
			";
			return $controller->select_varios_db($query);
		}

		public function get_lista_articulos(){
			$controller = new Controller();
			$query = "
				SELECT
					id,
					descripcion
				FROM
					tb_articulos
				WHERE
					descripcion <> ''
				ORDER BY
					descripcion
			";
			return $controller->select_varios_db($query);
		}

		public function bajar_existencia($id_articulo, $cantidad){
			$controller = new Controller();
			$query = "
				UPDATE tb_articulos 
				SET 
					existencia = (existencia - ".$cantidad.") 
				WHERE	
					id = ".$id_articulo."
				LIMIT 1
			";
			return $controller->update_bd($query);
		}

	}

?>

