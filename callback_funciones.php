<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	include_once("funciones.php");

	if(isset($_REQUEST["main"])){

		$_REQUEST = quitar_caracteres_especiales($_REQUEST);

		if($_REQUEST["main"] == "OH30K0001"){
			$code = get_pantalla_articulos($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0002"){
			$code = get_modal_formulario_agregar_articulo($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0003"){
			$code = set_agregar_articulo($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0004"){
			$code = get_modal_formulario_modificar_articulo($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0005"){
			$code = set_modificar_articulo($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0006"){
			$code = get_actualizar_fila_articulo($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0007"){
			$code = get_pantalla_clientes($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0008"){
			$code = get_modal_formulario_agregar_cliente($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0009"){
			$code = set_agregar_cliente($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0010"){
			$code = get_modal_formulario_modificar_cliente($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0011"){
			$code = set_modificar_cliente($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0012"){
			$code = get_actualizar_fila_cliente($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0013"){
			$code = get_modal_formulario_configuracion($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0014"){
			$code = set_guardar_configuracion($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0015"){
			$code = get_pantalla_ventas($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0016"){
			$code = get_modal_formulario_agregar_venta($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0017"){
			$code = get_informacion_cliente($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0018"){
			$code = get_informacion_articulo($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0019"){
			$code = get_informacion_articulo_by_id($_REQUEST);
			echo json_encode($code);
		}
		else if($_REQUEST["main"] == "OH30K0020"){
			$code = set_agregar_venta($_REQUEST);
			echo json_encode($code);
		}
		
		#--------------------------------------------------------------------------------------------

		else{
			echo json_encode("
				<center>
					<div class='jumbotron'>
						<h2>ERROR 404 NOT FOUND:</h2>
						<h3>Option required is not available for the moment, wait a few minutes and try again later</h3>
					</div>
				</center>
			");	
		}
	}
	else{
		echo json_encode("
			<center>
				<div class='jumbotron'>
					<h2>ERROR 404 NOT FOUND:</h2>
					<h3>Option required is not available for the moment, wait a few minutes and try again later</h3>
				</div>
			</center>
		");
	}
?>