<?php

	function get_modal_formulario_configuracion($data){
		$executer = new Configuracion();
		$response = $executer->get_configuraciones();
		$configuracion = $response["data"];
		$codigo = array();
		$codigo["error"] = 0;
		$codigo["title"] = "<i class='setting icon'></i> Configuración";
		$codigo["body"] = "
			<div class='ui container'>
				<div class='ui grid'>
					<div class='column'>
						<form id='formulario_configuracion' name='formulario_configuracion'>
							<div class='ui form'>
								<div class='three fields'>
									<div class='field'>
										<label> Tasa Financiamiento: </label>
										<input type='text' id='financiamiento' name='financiamiento' placeholder='Tasa Financiamiento' value='".$configuracion[0]["value"]."'>
									</div>
									<div class='field'>
										<label> % Enganche: </label>
										<input type='text' id='enganche' name='enganche' placeholder='% Enganche' value='".$configuracion[1]["value"]."'>
									</div>
									<div class='field'>
										<label> Plazo Maximo: </label>
										<input type='text' id='plazo' name='plazo' placeholder='Plazo Maximo' value='".$configuracion[2]["value"]."'>
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
			<div onclick='set_guardar_configuracion()' class='ui green right labeled icon button'>
				Guardar
				<i class='checkmark icon'></i>
			</div>
		";
		return $codigo;
	}

	function set_guardar_configuracion($data){
		$codigo = array();
		if(!isset($data["financiamiento"])){
			$codigo["message"] = "Debe especificar la tasa de financiamiento.";
			$codigo["error"] = 1;
		}
		else if(trim($data["financiamiento"]) == ""){
			$codigo["message"] = "Debe especificar la tasa de financiamiento.";
			$codigo["error"] = 1;
		}
		else if(!is_numeric(trim($data["financiamiento"]))){
			$codigo["message"] = "La tasa de financimiento debe ser un numero.";
			$codigo["error"] = 1;
		}
		else if(!isset($data["enganche"])){
			$codigo["message"] = "Debe especificar el procentaje de enganche.";
			$codigo["error"] = 1;
		}
		else if(trim($data["enganche"]) == ""){
			$codigo["message"] = "Debe especificar el procentaje de enganche.";
			$codigo["error"] = 1;
		}
		else if(!is_numeric(trim($data["enganche"]))){
			$codigo["message"] = "El porcentaje de enganche debe ser un numero.";
			$codigo["error"] = 1;
		}
		else if(!isset($data["plazo"])){
			$codigo["message"] = "Debe especificar el plazo maximo.";
			$codigo["error"] = 1;
		}
		else if(trim($data["plazo"]) == ""){
			$codigo["message"] = "Debe especificar el plazo maximo.";
			$codigo["error"] = 1;
		}
		else if(!is_numeric(trim($data["plazo"]))){
			$codigo["message"] = "El plazo maximo debe ser un numero.";
			$codigo["error"] = 1;
		}
		else{
			$data["financiamiento"] = trim($data["financiamiento"]);
			if(strlen($data["financiamiento"]) > 20){
				$data["financiamiento"] = substr(trim($data["financiamiento"]), 0, 19);
			}
			$data["enganche"] = trim($data["enganche"]);
			if(strlen($data["enganche"]) > 20){
				$data["enganche"] = substr(trim($data["enganche"]), 0, 19);
			}
			$data["plazo"] = trim($data["plazo"]);
			if(strlen($data["plazo"]) > 20){
				$data["plazo"] = substr(trim($data["plazo"]), 0, 19);
			}
			
			$executor = new Configuracion();
			$response = $executor->update_configuracion($data["financiamiento"], $data["enganche"], $data["plazo"]);
			if($response["error"] == "SI"){
				$codigo["message"] = "Ocurrio un error al guardar la información.";
				$codigo["error"] = 1;
			}
			else{
				$codigo["message"] = "Bien Hecho. La configuración ha sido registrada.";
				$codigo["error"] = 0;
			}
		}
		
		return $codigo;
	}

?>