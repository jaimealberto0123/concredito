<?php

	function get_pantalla_articulos($data){
		$executer = new Articulos();
		$response = $executer->get_articulos();
		$arreglo = $response["data"];
		$codigo = array();
		$codigo["codigo"] = "
			<div class='ui container'>
				<h1 class='ui dividing header'> Articulos Registrados </h1>
				<div class='ui grid'>
					<div class='column' style='text-align: right'>
						<button class='ui primary button' onclick='get_modal_formulario_agregar_articulo()'> <i class='add circle icon'></i>  Nuevo Articulo </button>
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
							<th style='background: #2186cf; color: white;'> Descripción </th>
							<th style='background: #2186cf; color: white;'> Precio </th>
							<th style='background: #2186cf; color: white;'> <center> Existencia </center> </th>
							<th style='background: #2186cf; color: white;'> <center> Fecha de Registro </center> </th>
							<th style='background: #2186cf; color: white;'>  </th>
						</tr>
					</thead>
					<tbody>
			";
			for($i = 0; $i < count($arreglo); $i++){
				$obj = $arreglo[$i];
				$codigo["codigo"] .= "<tr id='tr_".$obj["id"]."'>".get_tr_table_articulo($obj)."</tr>";
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
							<th style='background: #2186cf; color: white;'> Descripción </th>
							<th style='background: #2186cf; color: white;'> Precio </th>
							<th style='background: #2186cf; color: white;'> <center> Existencia </center> </th>
							<th style='background: #2186cf; color: white;'> <center> Fecha de Registro </center> </th>
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

	function get_tr_table_articulo($obj){
		$html = "
				<td> <center> ".get_code_numeric($obj["id"])." </center> </td>
				<td> ".$obj["descripcion"]." </td>
				<td> $ ".$obj["precio"]." </td>
				<td> <center> ".$obj["existencia"]." </center> </td>
				<td> <center> ".formato_fecha_master($obj["fecha_registro"])." </center> </td>
				<td class='center aligned'> <button class='circular ui icon button' onclick='get_modal_formulario_modificar_articulo(".$obj["id"].")'> <i class='large write square icon'></i> </button> </td>
		";
		return $html;
	}

	function get_actualizar_fila_articulo($data){
		$codigo = array();
		$executer = new Articulos();
		$response = $executer->get_articulo_by_id($data["id"]);
		$articulo = $response["data"];
		if($response["error"] == "SI"){
			$codigo["message"] = "Ocurrio un error al obtener la información del articulo.";
			$codigo["error"] = 1;
		}
		else{
			$codigo["codigo"] = get_tr_table_articulo($articulo);
			$codigo["error"] = 0;
		}
		return $codigo;
	}

	function get_modal_formulario_agregar_articulo($data){
		$executer = new Articulos();
		$response = $executer->get_ultimo_elemento();
		$ultimo = $response["data"];
		$insert_id = 0;
		if(isset($ultimo["id"])){
			$insert_id = $ultimo["id"] + 1;
		}
		else{
			$insert_id = 1;
		}
		$codigo = array();
		$codigo["error"] = 0;
		$codigo["title"] = "<i class='add circle icon'></i> Nuevo Articulo";
		$codigo["body"] = "
			<div class='ui container'>
				<h3 class='ui dividing header'> Clave: ".get_code_numeric($insert_id)." </h3>
				<div class='ui grid'>
					<div class='column'>
						<form id='formulario_articulos' name='formulario_articulos'>
							<input id='id' name='id' type='hidden' value='".$insert_id."'>
							<div class='ui form'>
								<div class='field'>
									<div class='field'>
										<label> Descripción: </label>
										<input type='text' id='descripcion' name='descripcion' placeholder='Descripción'>
									</div>
								</div>
								<div class='field'>
									<div class='field'>
										<label> Modelo: </label>
										<input type='text' id='modelo' name='modelo' placeholder='Modelo'>
									</div>
								</div>
								<div class='three fields'>
									<div class='field'>
										<label> Precio: </label>
										<input type='text' id='precio' name='precio' placeholder='Precio'>
									</div>
								</div>
								<div class='three fields'>
									<div class='field'>
										<label> Existencia: </label>
										<input type='text' id='existencia' name='existencia' placeholder='Existencia'>
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
			<div onclick='set_agregar_articulo()' class='ui green right labeled icon button'>
				Guardar
				<i class='checkmark icon'></i>
			</div>
		";
		return $codigo;
	}

	function set_agregar_articulo($data){
		$codigo = array();
		if(!isset($data["descripcion"])){
			$codigo["message"] = "Debe especificar el descripcion del articulo.";
			$codigo["error"] = 1;
		}
		else if(trim($data["descripcion"]) == ""){
			$codigo["message"] = "Debe especificar el descripcion del articulo.";
			$codigo["error"] = 1;
		}
		else if(!isset($data["precio"])){
			$codigo["message"] = "Debe especificar el precio del articulo.";
			$codigo["error"] = 1;
		}
		else if(trim($data["precio"]) == ""){
			$codigo["message"] = "Debe especificar el precio del articulo.";
			$codigo["error"] = 1;
		}
		else if(!is_numeric($data["precio"])){
			$codigo["message"] = "El precio del articulo debe ser numerico.";
			$codigo["error"] = 1;
		}
		else if(!isset($data["existencia"])){
			$codigo["message"] = "Debe especificar el existencia del articulo.";
			$codigo["error"] = 1;
		}
		else if(trim($data["existencia"]) == ""){
			$codigo["message"] = "Debe especificar el existencia del articulo.";
			$codigo["error"] = 1;
		}
		else if(!is_numeric($data["existencia"])){
			$codigo["message"] = "La existencia del articulo debe ser numerica.";
			$codigo["error"] = 1;
		}
		else{
			$data["descripcion"] = trim($data["descripcion"]);
			if(strlen($data["descripcion"]) > 200){
				$data["descripcion"] = substr(trim($data["descripcion"]), 0, 199);
			}
			if(!isset($data["modelo"])){
				$data["modelo"] = "";
			}
			else{
				$data["modelo"] = trim($data["modelo"]);
			}
			if(strlen($data["modelo"]) > 50){
				$data["modelo"] = substr(trim($data["modelo"]), 0, 49);
			}
			$executer = new Articulos();
			$response = $executer->insert_articulo();
			$response = $executer->update_articulo_by_id($data["id"], $data["descripcion"], $data["modelo"], $data["precio"], $data["existencia"]);
			if($response["error"] == "SI"){
				$codigo["message"] = "Ocurrio un error al guardar la información.";
				$codigo["error"] = 1;
			}
			else{
				$codigo["message"] = "Bien Hecho. El Articulo ha sido registrado correctamente.";
				$codigo["error"] = 0;
			}
		}
		
		return $codigo;
	}

	function get_modal_formulario_modificar_articulo($data){
		$codigo = array();
		$executer = new Articulos();
		$response = $executer->get_articulo_by_id($data["id"]);
		$articulo = $response["data"];
		if(isset($articulo["id"])){
			$codigo["error"] = 0;
			$codigo["title"] = "<i class='write square icon'></i> Modificar Articulo: ";
			$codigo["body"] = "
				<div class='ui container'>
					<h3 class='ui dividing header'> Clave: ".get_code_numeric($data["id"])." </h3>
					<div class='ui grid'>
						<div class='column'>
							<form id='formulario_articulos' name='formulario_articulos'>
								<input id='id' name='id' type='hidden' value='".$data["id"]."'>
								<div class='ui form'>
									<div class='field'>
										<div class='field'>
											<label> Descripción: </label>
											<input type='text' id='descripcion' name='descripcion' placeholder='Descripción' value='".$articulo["descripcion"]."'>
										</div>
									</div>
									<div class='field'>
										<div class='field'>
											<label> Modelo: </label>
											<input type='text' id='modelo' name='modelo' placeholder='Modelo' value='".$articulo["modelo"]."'>
										</div>
									</div>
									<div class='three fields'>
										<div class='field'>
											<label> Precio: </label>
											<input type='text' id='precio' name='precio' placeholder='Precio' value='".$articulo["precio"]."'>
										</div>
									</div>
									<div class='three fields'>
										<div class='field'>
											<label> Existencia: </label>
											<input type='text' id='existencia' name='existencia' placeholder='Existencia' value='".$articulo["existencia"]."'>
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
				<div onclick='set_modificar_articulo()' class='ui green right labeled icon button'>
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
								<p> <i class='warning circle icon'></i> No fue posible encontrar la información del articulo. </p>
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

	function set_modificar_articulo($data){
		$codigo = array();
		if(!isset($data["descripcion"])){
			$codigo["message"] = "Debe especificar el descripcion del articulo.";
			$codigo["error"] = 1;
		}
		else if(trim($data["descripcion"]) == ""){
			$codigo["message"] = "Debe especificar el descripcion del articulo.";
			$codigo["error"] = 1;
		}
		else if(!isset($data["precio"])){
			$codigo["message"] = "Debe especificar el precio del articulo.";
			$codigo["error"] = 1;
		}
		else if(trim($data["precio"]) == ""){
			$codigo["message"] = "Debe especificar el precio del articulo.";
			$codigo["error"] = 1;
		}
		else if(!is_numeric($data["precio"])){
			$codigo["message"] = "El precio del articulo debe ser numerico.";
			$codigo["error"] = 1;
		}
		else if(!isset($data["existencia"])){
			$codigo["message"] = "Debe especificar el existencia del articulo.";
			$codigo["error"] = 1;
		}
		else if(trim($data["existencia"]) == ""){
			$codigo["message"] = "Debe especificar el existencia del articulo.";
			$codigo["error"] = 1;
		}
		else if(!is_numeric($data["existencia"])){
			$codigo["message"] = "La existencia del articulo debe ser numerica.";
			$codigo["error"] = 1;
		}
		else{
			$data["descripcion"] = trim($data["descripcion"]);
			if(strlen($data["descripcion"]) > 200){
				$data["descripcion"] = substr(trim($data["descripcion"]), 0, 199);
			}
			if(!isset($data["modelo"])){
				$data["modelo"] = "";
			}
			else{
				$data["modelo"] = trim($data["modelo"]);
			}
			if(strlen($data["modelo"]) > 50){
				$data["modelo"] = substr(trim($data["modelo"]), 0, 49);
			}
			$executer = new Articulos();
			$response = $executer->update_articulo_by_id($data["id"], $data["descripcion"], $data["modelo"], $data["precio"], $data["existencia"]);
			if($response["error"] == "SI"){
				$codigo["message"] = "Ocurrio un error al guardar la información.";
				$codigo["error"] = 1;
			}
			else{
				$codigo["message"] = "Bien Hecho. El Articulo ha sido modificado correctamente.";
				$codigo["id_fila"] = $data["id"];
				$codigo["error"] = 0;
			}
		}
		
		return $codigo;
	}
	
	function actualizar_tr_table_articulos($data){
		$codigo = array();
		$executer = new articulos();
		$response = $executer->get_articulo_by_id($data["id"]);
		$obj = $response["data"];
		if(isset($obj["id"])){
			$codigo["error"] = 0;
			$codigo["codigo"] = get_tr_table_articulo($obj);
		}
		else{
			$codigo["error"] = 1;
			$codigo["message"] = "";
		}
		return $codigo;
	}

	

?>