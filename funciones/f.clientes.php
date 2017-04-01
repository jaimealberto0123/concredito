<?php

	function get_pantalla_clientes($data){
		$executer = new Clientes();
		$response = $executer->get_clientes();
		$arreglo = $response["data"];
		$codigo = array();
		$codigo["codigo"] = "
			<div class='ui container'>
				<h1 class='ui dividing header'> Clientes Registrados </h1>
				<div class='ui grid'>
					<div class='column' style='text-align: right'>
						<button class='ui primary button' onclick='get_modal_formulario_agregar_cliente()'> <i class='add circle icon'></i>  Nuevo Cliente </button>
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
							<th style='background: #2186cf; color: white;'> <center> Clave </center> </th>
							<th style='background: #2186cf; color: white;'> Nombre </th>
							<th style='background: #2186cf; color: white;'> Apellido Paterno </th>
							<th style='background: #2186cf; color: white;'> Apellido Paterno </th>
							<th style='background: #2186cf; color: white;'> RFC </th>
							<th style='background: #2186cf; color: white;'>  </th>
						</tr>
					</thead>
					<tbody>
			";
			for($i = 0; $i < count($arreglo); $i++){
				$obj = $arreglo[$i];
				$codigo["codigo"] .= "<tr id='tr_".$obj["id"]."'>".get_tr_table_cliente($obj)."</tr>";
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
							<th style='background: #2186cf; color: white;'> <center> Clave </center> </th>
							<th style='background: #2186cf; color: white;'> Nombre </th>
							<th style='background: #2186cf; color: white;'> Apellido Paterno </th>
							<th style='background: #2186cf; color: white;'> Apellido Paterno </th>
							<th style='background: #2186cf; color: white;'> RFC </th>
							<th style='background: #2186cf; color: white;'>  </th>
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

	function get_tr_table_cliente($obj){
		$html = "
				<td> <center> ".get_code_numeric($obj["id"])." </center> </td>
				<td> ".$obj["nombre"]." </td>
				<td> ".$obj["apellido1"]." </td>
				<td> ".$obj["apellido2"]." </td>
				<td> ".$obj["rfc"]." </td>
				<td class='center aligned'> <button class='circular ui icon button' onclick='get_modal_formulario_modificar_cliente(".$obj["id"].")'> <i class='large write square icon'></i> </button> </td>
		";
		return $html;
	}

	function get_actualizar_fila_cliente($data){
		$codigo = array();
		$executer = new Clientes();
		$response = $executer->get_cliente_by_id($data["id"]);
		$cliente = $response["data"];
		if($response["error"] == "SI"){
			$codigo["message"] = "Ocurrio un error al obtener la información del cliente.";
			$codigo["error"] = 1;
		}
		else{
			$codigo["codigo"] = get_tr_table_cliente($cliente);
			$codigo["error"] = 0;
		}
		return $codigo;
	}

	function get_modal_formulario_agregar_cliente($data){
		$executer = new Clientes();
		$codigo = array();
		$response = $executer->get_ultimo_elemento();
		$ultimo = $response["data"];
		$insert_id = 0;
		if(isset($ultimo["id"])){
			$insert_id = $ultimo["id"] + 1;
		}
		else{
			$insert_id = 1;
		}
		$codigo["error"] = 0;
		$codigo["title"] = "<i class='add circle icon'></i> Nuevo Cliente";
		$codigo["body"] = "
			<div class='ui container'>
				<h3 class='ui dividing header'> Clave: ".get_code_numeric($insert_id)." </h3>
				<div class='ui grid'>
					<div class='column'>
						<form id='formulario_clientes' name='formulario_clientes'>
							<input id='id' name='id' type='hidden' value='".$insert_id."'>
							<div class='ui form'>
								<div class='field'>
									<div class='field'>
										<label> Nombre: </label>
										<input type='text' id='nombre' name='nombre' placeholder='Nombre'>
									</div>
								</div>
								<div class='field'>
									<div class='field'>
										<label> Apellido Paterno: </label>
										<input type='text' id='apellido1' name='apellido1' placeholder='Apellido Paterno'>
									</div>
								</div>
								<div class='three fields'>
									<div class='field'>
										<label> Apellido Materno: </label>
										<input type='text' id='apellido2' name='apellido2' placeholder='Apellido Materno'>
									</div>
								</div>
								<div class='three fields'>
									<div class='field'>
										<label> RFC: </label>
										<input type='text' id='rfc' name='rfc' placeholder='RFC'>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		";
		$codigo["footer"] = "
			<div class='ui red deny left labeled icon button'>
				<i class='remove icon'></i>
				Cancelar
			</div>
			<div onclick='set_agregar_cliente()' class='ui green right labeled icon button'>
				Guardar
				<i class='checkmark icon'></i>
			</div>
		";
		return $codigo;
	}

	function set_agregar_cliente($data){
		$codigo = array();
		if(!isset($data["nombre"])){
			$codigo["message"] = "Debe especificar el nombre del cliente.";
			$codigo["error"] = 1;
		}
		else if(trim($data["nombre"]) == ""){
			$codigo["message"] = "Debe especificar el nombre del cliente.";
			$codigo["error"] = 1;
		}
		else if(!isset($data["apellido1"])){
			$codigo["message"] = "Debe especificar el apellido paterno del cliente.";
			$codigo["error"] = 1;
		}
		else if(trim($data["apellido1"]) == ""){
			$codigo["message"] = "Debe especificar el apellido paterno del cliente.";
			$codigo["error"] = 1;
		}
		else if(!isset($data["rfc"])){
			$codigo["message"] = "Debe especificar el rfc del cliente.";
			$codigo["error"] = 1;
		}
		else if(trim($data["rfc"]) == ""){
			$codigo["message"] = "Debe especificar el rfc del cliente.";
			$codigo["error"] = 1;
		}
		else{
			$data["nombre"] = trim($data["nombre"]);
			if(strlen($data["nombre"]) > 50){
				$data["nombre"] = substr(trim($data["nombre"]), 0, 49);
			}
			$data["apellido1"] = trim($data["apellido1"]);
			if(strlen($data["apellido1"]) > 50){
				$data["apellido1"] = substr(trim($data["apellido1"]), 0, 49);
			}
			$data["apellido2"] = trim($data["apellido2"]);
			if(strlen($data["apellido2"]) > 50){
				$data["apellido2"] = substr(trim($data["apellido2"]), 0, 49);
			}
			$data["rfc"] = strtoupper(trim($data["rfc"]));
			if(strlen($data["rfc"]) > 50){
				$data["rfc"] = substr(trim($data["rfc"]), 0, 49);
			}
			
			$executer = new Clientes();
			$response = $executer->insert_cliente();
			$response = $executer->update_cliente_by_id($data["id"], $data["nombre"], $data["apellido1"], $data["apellido2"], $data["rfc"]);
			if($response["error"] == "SI"){
				$codigo["message"] = "Ocurrio un error al guardar la información.";
				$codigo["error"] = 1;
			}
			else{
				$codigo["message"] = "Bien Hecho. El Cliente ha sido registrado correctamente.";
				$codigo["error"] = 0;
			}
		}
		
		return $codigo;
	}

	function get_modal_formulario_modificar_cliente($data){
		$codigo = array();
		$executer = new Clientes();
		$response = $executer->get_cliente_by_id($data["id"]);
		$cliente = $response["data"];
		if(isset($cliente["id"])){
			$codigo["error"] = 0;
			$codigo["title"] = "<i class='write square icon'></i> Modificar Cliente: ";
			$codigo["body"] = "
				<div class='ui container'>
					<h3 class='ui dividing header'> Clave: ".$data["id"]." </h3>
					<div class='ui grid'>
						<div class='column'>
							<form id='formulario_clientes' name='formulario_clientes'>
								<input id='id' name='id' type='hidden' value='".$data["id"]."'>
								<div class='ui form'>
									<div class='field'>
										<div class='field'>
											<label> Nombre: </label>
											<input type='text' id='nombre' name='nombre' placeholder='Nombre' value='".$cliente["nombre"]."'>
										</div>
									</div>
									<div class='field'>
										<div class='field'>
											<label> Apellido Paterno: </label>
											<input type='text' id='apellido1' name='apellido1' placeholder='Apellido Paterno' value='".$cliente["apellido1"]."'>
										</div>
									</div>
									<div class='three fields'>
										<div class='field'>
											<label> Apellido Materno: </label>
											<input type='text' id='apellido2' name='apellido2' placeholder='Apellido Materno' value='".$cliente["apellido2"]."'>
										</div>
									</div>
									<div class='three fields'>
										<div class='field'>
											<label> RFC: </label>
											<input type='text' id='rfc' name='rfc' placeholder='RFC' value='".$cliente["rfc"]."'>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			";
			$codigo["footer"] = "
				<div class='ui red deny left labeled icon button'>
					<i class='remove icon'></i>
					Cancelar
				</div>
				<div onclick='set_modificar_cliente()' class='ui green right labeled icon button'>
					Guardar
					<i class='checkmark icon'></i>
				</div>
			";
		}
		else{
			$codigo["error"] = 0;
			$codigo["title"] = "<i class='warning icon'></i>";
			$codigo["body"] = "
				<div class='ui container'>
					<div class='ui grid'>
						<div class='column'>
							<div class='ui floating message'>
								<p> <i class='warning circle icon'></i> No fue posible encontrar la información del cliente. </p>
							</div>
						</div>
					</div>
				</div>
			";
			$codigo["footer"] = "
				<div class='ui deny button'>
					Regresar
				</div>
			";
		}
		return $codigo;
	}

	function set_modificar_cliente($data){
		$codigo = array();
		if(!isset($data["nombre"])){
			$codigo["message"] = "Debe especificar el nombre del cliente.";
			$codigo["error"] = 1;
		}
		else if(trim($data["nombre"]) == ""){
			$codigo["message"] = "Debe especificar el nombre del cliente.";
			$codigo["error"] = 1;
		}
		else if(!isset($data["apellido1"])){
			$codigo["message"] = "Debe especificar el apellido paterno del cliente.";
			$codigo["error"] = 1;
		}
		else if(trim($data["apellido1"]) == ""){
			$codigo["message"] = "Debe especificar el apellido paterno del cliente.";
			$codigo["error"] = 1;
		}
		else if(!isset($data["rfc"])){
			$codigo["message"] = "Debe especificar el rfc del cliente.";
			$codigo["error"] = 1;
		}
		else if(trim($data["rfc"]) == ""){
			$codigo["message"] = "Debe especificar el rfc del cliente.";
			$codigo["error"] = 1;
		}
		else{
			$data["nombre"] = ucwords(strtolower(trim($data["nombre"])));
			if(strlen($data["nombre"]) > 50){
				$data["nombre"] = substr(trim($data["nombre"]), 0, 49);
			}
			$data["apellido1"] = ucwords(strtolower(trim($data["apellido1"])));
			if(strlen($data["apellido1"]) > 50){
				$data["apellido1"] = substr(trim($data["apellido1"]), 0, 49);
			}
			$data["apellido2"] = ucwords(strtolower(trim($data["apellido2"])));
			if(strlen($data["apellido2"]) > 50){
				$data["apellido2"] = substr(trim($data["apellido2"]), 0, 49);
			}
			$data["rfc"] = strtoupper(trim($data["rfc"]));
			if(strlen($data["rfc"]) > 50){
				$data["rfc"] = substr(trim($data["rfc"]), 0, 49);
			}

			$executer = new Clientes();
			$response = $executer->update_cliente_by_id($data["id"], $data["nombre"], $data["apellido1"], $data["apellido2"], $data["rfc"]);
			if($response["error"] == "SI"){
				$codigo["message"] = "Ocurrio un error al guardar la información.";
				$codigo["error"] = 1;
			}
			else{
				$codigo["message"] = "Bien Hecho. El Cliente ha sido modificado correctamente.";
				$codigo["id_fila"] = $data["id"];
				$codigo["error"] = 0;
			}
		}
		
		return $codigo;
	}
	
	function actualizar_tr_table_clientes($data){
		$codigo = array();
		$executer = new clientes();
		$response = $executer->get_cliente_by_id($data["id"]);
		$obj = $response["data"];
		if(isset($obj["id"])){
			$codigo["error"] = 0;
			$codigo["codigo"] = get_tr_table_cliente($obj);
		}
		else{
			$codigo["error"] = 1;
			$codigo["message"] = "";
		}
		return $codigo;
	}

	

?>