<?php

	function get_pantalla_ventas($data){
		$executer = new Ventas();
		$response = $executer->get_ventas();
		$arreglo = $response["data"];
		$codigo = array();
		$codigo["codigo"] = "
			<div class='ui container'>
				<h1 class='ui dividing header'> Ventas Registradas </h1>
				<div class='ui grid'>
					<div class='column' style='text-align: right'>
						<button class='ui primary button' onclick='get_modal_formulario_agregar_venta()'> <i class='add circle icon'></i>  Nueva Venta </button>
					</div>
				</div>
				<div class='ui grid'>
					<div class='column'>
		";
		if(count($arreglo) > 0){
			$codigo["codigo"] .= "
				<table class='ui celled striped table'>
					<thead>
						<tr>
							<th style='background: #2186cf; color: white;'> <center> Folio de Venta </center> </th>
							<th style='background: #2186cf; color: white;'> <center> Clave de Cliente </center> </th>
							<th style='background: #2186cf; color: white;'> Nombre del Cliente </th>
							<th style='background: #2186cf; color: white;'> Total </th>
							<th style='background: #2186cf; color: white;'> <center> Fecha </center> </th>
						</tr>
					</thead>
					<tbody>
			";
			for($i = 0; $i < count($arreglo); $i++){
				$obj = $arreglo[$i];
				$codigo["codigo"] .= "<tr id='tr_".$obj["id"]."'>".get_tr_table_venta($obj)."</tr>";
			}
			$codigo["codigo"] .= "
					</tbody>
				</table>
			";
		}
		else{
			$codigo["codigo"] .= "
				<table class='ui celled striped table'>
					<thead>
						<tr>
							<th style='background: #2186cf; color: white;'> <center> Folio de Venta </center> </th>
							<th style='background: #2186cf; color: white;'> <center> Clave de Cliente </center> </th>
							<th style='background: #2186cf; color: white;'> Nombre </th>
							<th style='background: #2186cf; color: white;'> Total </th>
							<th style='background: #2186cf; color: white;'> <center> Fecha </center> </th>
						</tr>
					</thead>
				</table>
			";
		}
		$codigo["codigo"] .= "
					</div>
				</div>
			</div>
		";
		return $codigo;
	}

	function get_tr_table_venta($obj){
		$html = "
				<td> <center> ".get_code_numeric($obj["id"])." </center> </td>
				<td> <center> ".get_code_numeric($obj["id_cliente"])." </center> </td>
				<td> ".$obj["nombre"]." ".$obj["apellido1"]." ".$obj["apellido2"]." </td>
				<td> ".$obj["total"]." </td>
				<td> <center> ".formato_fecha_master($obj["fecha"])." </center> </td>
		";
		return $html;
	}

	function get_actualizar_fila_venta($data){
		$codigo = array();
		$executer = new Ventas();
		$response = $executer->get_venta_by_id($data["id"]);
		$venta = $response["data"];
		if($response["error"] == "SI"){
			$codigo["message"] = "Ocurrio un error al obtener la información de la venta.";
			$codigo["error"] = 1;
		}
		else{
			$codigo["codigo"] = get_tr_table_venta($venta);
			$codigo["error"] = 0;
		}
		return $codigo;
	}

	function get_modal_formulario_agregar_venta($data){
		$codigo = array();
		$executer = new Ventas();
		
		$response = $executer->get_ultimo_elemento();
		$ultimo = $response["data"];
		$insert_id = 0;
		if(isset($ultimo["id"])){
			$insert_id = $ultimo["id"] + 1;
		}
		else{
			$insert_id = 1;
		}
		
		$response = $executer->get_lista_clientes();
		$clientes = array();
		for($i = 0; $i < count($response["data"]); $i++){
			$c = $response["data"][$i];
			$clientes[$i] = $c["nombre"]." ".$c["apellido1"]." ".$c["apellido2"];
		}
		$codigo["arreglo_clientes"] = $clientes;

		$response = $executer->get_lista_articulos();
		$articulos = array();
		for($i = 0; $i < count($response["data"]); $i++){
			$a = $response["data"][$i];
			$articulos[$i] = $a["descripcion"];
		}
		$codigo["arreglo_articulos"] = $articulos;

		$executer_configuracion = new Configuracion();
		$response = $executer_configuracion->get_configuraciones();
		$configuraciones = $response["data"];

		if($configuraciones[0]["value"] == "" OR $configuraciones[1]["value"] == "" OR $configuraciones[2]["value"] == ""){
			$codigo["error"] = 1;
			$codigo["title"] = "<i class='warning sign icon'></i> Faltan configuraciones...";
			$codigo["body"] = "
				<div class='ui container'>
					<center>
						<h2 class='ui icon header'>
						<i class='settings icon'></i>
						<div class='content'>
							No es posible realizar ventas. 
							<div class='sub header'> Es necesario realizar la configuraciones para realizar ventas. </div>
						</div>
						</h2>
					</center>
				</div>
			";
			$codigo["footer"] = "
				<div class='ui red deny left labeled icon button'>
					<i class='remove icon'></i>
					Cerrar
				</div>
				<div onclick='get_modal_formulario_configuracion()' class='ui green deny left labeled icon button'>
					<i class='settings icon'></i>
					Ir a la Configuración
				</div>
			";
		}
		else{
			$codigo["error"] = 0;
			$codigo["title"] = "<i class='add circle icon'></i>";
			$codigo["body"] = "
				<div class='ui container'>
					<h3 class='ui dividing header'> Clave: ".get_code_numeric($insert_id)." </h3>
					<div class='ui grid'>
						<div class='column'>
							<form id='formulario_ventas' name='formulario_ventas'>
								<input id='id' name='id' type='hidden' value='".$insert_id."'>
								<input type='hidden' id='tasa' name='tasa' value='".$configuraciones[0]["value"]."'>
								<input type='hidden' id='enganche' name='enganche' value='".$configuraciones[1]["value"]."'>
								<input type='hidden' id='plazo' name='plazo' value='".$configuraciones[2]["value"]."'>
								<div class='ui form'>
									<div class='three fields'>
										<div id='clientes_search' class='inline field ui search'>
											<label class='big'> Cliente </label>
											<input type='text' id='input_cliente' name='input_cliente' class='prompt' placeholder='Cliente'>
											<div class='results'></div>
										</div>
										<div class='inline field'>
											<div id='rfc' name='rfc' class='ui left pointing large label'> </div>
											<input type='hidden' id='id_cliente' name='id_cliente'>
										</div>
									</div>
									<div class='ui divider'></div>
									<div class='three fields'>
										<div id='articulo_search' class='inline field ui search'>
											<label class='big'> Articulo </label>
											<input type='text' id='input_articulo' name='input_articulo' class='prompt' placeholder='Articulo'>
											<div class='results'></div>
										</div>
										<div class='inline field'>
											<div class='inline field'>
												<button class='ui primary button' onclick='agregar_articulo_lista()'> <i class='add circle icon'></i> Agregar articulo </button>
											</div>
										</div>
									</div>
									<div class='ui divider'></div>
									<div class='field'>
										<table class='ui celled striped table'>
											<thead>
												<tr>
													<th style='background: #2186cf; color: white;'> Descripción del articulo </th>
													<th style='background: #2186cf; color: white;'> Modelo </th>
													<th style='background: #2186cf; color: white; width: 10%;'> <center> Cantidad </center> </th>
													<th style='background: #2186cf; color: white; text-align: right;'> Precio </th>
													<th style='background: #2186cf; color: white; text-align: right;'> Importe </th>
													<th style='background: #2186cf; color: white; width: 5%;'> </th>
												</tr>
											</thead>
											<tbody id='tbody1'>
											</tbody>
										</table>
									</div>
									<div class='ui divider'></div>
									<div class='field'>
										<div class='ui four column grid'>
											<div class='column'> </div>
											<div class='column'> </div>
											<div class='column' style='text-align: right;'> <div class='ui large label'> Enganche: </div> </div>
											<div class='column ui transparent input' style='text-align: center;'> <input type='text' id='enganche_venta' name='enganche_venta' readonly> </div>
										</div>
										<div class='ui four column grid'>
											<div class='column'> </div>
											<div class='column'> </div>
											<div class='column ui transparent input' style='text-align: right;'> <div class='ui large label'> Bonificación de Enganche: </div> </div>
											<div class='column ui transparent input' style='text-align: center;'> <input type='text' id='bonificacion_venta' name='bonificacion_venta' readonly> </div>
										</div>
										<div class='ui four column grid'>
											<div class='column'> </div>
											<div class='column'> </div>
											<div class='column' style='text-align: right;'> <div class='ui large label'> Total: </div> </div>
											<div class='column ui transparent input' style='text-align: center;'> <input type='text' id='total_venta' name='total_venta' readonly> </div>
										</div>
									</div>
									<div class='ui divider'></div>
									<div id='section_abonos' class='field' style='display: none;'>
										<table class='ui celled striped table'>
											<thead>
												<tr>
													<th colspan='5' style='background: #2186cf; color: white; text-align: center;'> <h3 class='ui header'> ABONOS MENSUALES </h3> </th>
												</tr>
											</thead>
											<tbody id='tbody2'>
												<div class='grouped fields'>
													<tr id='abonos_3'>
													</tr>
													<tr id='abonos_6'>
													</tr>
													<tr id='abonos_9'>
													</tr>
													<tr id='abonos_12'>
													</tr>
												</div>
											</tbody>
										</table>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			";
			$codigo["footer"] = "
				<div id='button1' class='ui green deny left labeled icon button'>
					<i class='remove icon'></i>
					Cancelar
				</div>
				<div id='button2' onclick='validar_siguiente()' class='ui green right labeled icon button'>
					Siguiente
					<i class='checkmark icon'></i>
				</div>
				<div id='button3' onclick='set_agregar_venta()' class='ui green right labeled icon button' style='display: none;'>
					Guardar
					<i class='checkmark icon'></i>
				</div>
			";
		}

		return $codigo;
	}

	function get_informacion_cliente($data){
		$codigo = array();
		$executer = new Ventas();
		$response = $executer->get_cliente_by_nombre($data["nombre"]);
		$cliente = $response["data"];
		if(isset($cliente["id"])){
			$codigo["id"] = $cliente["id"];
			$codigo["rfc"] = $cliente["rfc"];
			$codigo["error"] = 0;
		}
		else{
			$codigo["message"] = "Ocurrio un error al obtener la información del cliente.";
			$codigo["error"] = 1;
		}
		return $codigo;
	}

	function get_informacion_articulo($data){
		$codigo = array();
		$executer = new Ventas();
		$executer_configuracion = new Configuracion();
		$response = $executer_configuracion->get_configuraciones();
		$configuraciones = $response["data"];
		$response = $executer->get_articulo_by_nombre($data["nombre"]);
		$cliente = $response["data"];
		if(isset($cliente["id"])){
			$codigo["id"] = $cliente["id"];
			$codigo["descripcion"] = $cliente["descripcion"];
			$codigo["modelo"] = $cliente["modelo"];
			$codigo["precio"] = $cliente["precio"];
			$codigo["existencia"] = $cliente["existencia"];
			$codigo["error"] = 0;
		}
		else{
			$codigo["message"] = "Ocurrio un error al obtener la información del articulo.";
			$codigo["error"] = 1;
		}
		return $codigo;
	}

	function get_informacion_articulo_by_id($data){
		$codigo = array();
		$executer = new Ventas();
		$response = $executer->get_articulo_by_id($data["id"]);
		$cliente = $response["data"];
		if(isset($cliente["id"])){
			$codigo["id"] = $cliente["id"];
			$codigo["descripcion"] = $cliente["descripcion"];
			$codigo["modelo"] = $cliente["modelo"];
			$codigo["precio"] = $cliente["precio"];
			$codigo["existencia"] = $cliente["existencia"];
			$codigo["error"] = 0;
		}
		else{
			$codigo["message"] = "Ocurrio un error al obtener la información del articulo.";
			$codigo["error"] = 1;
		}
		return $codigo;
	}

	function set_agregar_venta($data_enviada){
		$codigo = array();
		$codigo["error"] = 0;
		$codigo["message"] = "";
		$data = json_decode($data_enviada["data"], true);
		if(!isset($data["folio"])){
			$codigo["message"] = "Ocurrio un error al realizar el registro de la venta.";
			$codigo["error"] = 1;
		}
		else if(trim($data["folio"]) == "" OR trim($data["folio"]) == 0){
			$codigo["message"] = "Ocurrio un error al realizar el registro de la venta.";
			$codigo["error"] = 1;
		}
		else if(!isset($data["id_cliente"])){
			$codigo["message"] = "Debe seleccionar el cliente.";
			$codigo["error"] = 1;
		}
		else if(trim($data["id_cliente"]) == "" OR $data["id_cliente"] == 0){
			$codigo["message"] = "Debe seleccionar el cliente.";
			$codigo["error"] = 1;
		}
		else if(!isset($data["tasa"])){
			$codigo["message"] = "Error: tasa no especificada.";
			$codigo["error"] = 1;
		}
		else if(trim($data["tasa"]) == ""){
			$codigo["message"] = "Error: tasa no especificada.";
			$codigo["error"] = 1;
		}
		else if(!isset($data["enganche"])){
			$codigo["message"] = "Error: enganche no especificado.";
			$codigo["error"] = 1;
		}
		else if(trim($data["enganche"]) == ""){
			$codigo["message"] = "Error: enganche no especificado.";
			$codigo["error"] = 1;
		}
		else if(!isset($data["mensualidad_abono"])){
			$codigo["message"] = "Error: tipo de mensualidad no especificada.";
			$codigo["error"] = 1;
		}
		else if(trim($data["mensualidad_abono"]) == ""){
			$codigo["message"] = "Error: tipo de mensualidad no especificada.";
			$codigo["error"] = 1;
		}
		else if(!isset($data["articulos"])){
			$codigo["message"] = "Debe agregar al menos un articulo a la lista.";
			$codigo["error"] = 1;
		}
		else if(count($data["articulos"]) == 0){
			$codigo["message"] = "Debe agregar al menos un articulo a la lista.";
			$codigo["error"] = 1;
		}
		else{
			for($i = 0; $i < count($data["articulos"]); $i++){
				$a = $data["articulos"][$i];
				if($a["cantidad"] <= 0){
					$codigo["message"] = "Debe agregar al menos una unidad a la cantidad del articulo.";
					$codigo["error"] = 1;
					break;
				}
			}

			if($codigo["error"] == 0){
				$executer = new Ventas();
				$response = $executer->insert_venta();
				$response = $executer->update_venta_by_id($data["folio"], 
					$data["id_cliente"], 
					$data["total_venta"], 
					$data["tasa"], 
					$data["enganche"], 
					$data["enganche_venta"], 
					$data["bonificacion_venta"], 
					$data["plazo_maximo"], 
					(($data["total_venta"] - $data["enganche_venta"] - $data["bonificacion_venta"]) - (($data["total_venta"] - $data["enganche_venta"] - $data["bonificacion_venta"]) / (1 + (($data["tasa"] * $data["plazo_maximo"]) / 100)) * (1 + (($data["tasa"] * $data["mensualidad_abono"]) / 100)))), 
					$data["mensualidad_abono"]);
				if($response["error"] == "SI"){
					$codigo["message"] = "Ocurrio un error al guardar la información.";
					$codigo["error"] = 1;
				}
				else{
					for($i = 0; $i < count($data["articulos"]); $i++){
						$a = $data["articulos"][$i];
						$response = $executer->insert_venta_articulo($data["folio"], $a["id_articulo"], $a["precio"]);
						$response = $executer->bajar_existencia($a["id_articulo"], $a["cantidad"]);
					}
					$codigo["message"] = "Bien hecho, la venta ha sido registrada correctamente.";
					$codigo["error"] = 0;
				}
			}
		}
		
		return $codigo;
	}

?>