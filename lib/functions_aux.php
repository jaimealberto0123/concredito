<?php

	function formato_fecha($fecha){
		if(isset($fecha)){
			$data = explode("-", $fecha);
			$m = "";
			if($data[1] == 1){
				$m = "Enero";
			}
			else if($data[1] == 2){
				$m = "Febrero";
			}
			else if($data[1] == 3){
				$m = "Marzo";
			}
			else if($data[1] == 4){
				$m = "Abril";
			}
			else if($data[1] == 5){
				$m = "Mayo";
			}
			else if($data[1] == 6){
				$m = "Junio";
			}
			else if($data[1] == 7){
				$m = "Julio";
			}
			else if($data[1] == 8){
				$m = "Agosto";
			}
			else if($data[1] == 9){
				$m = "Septiembre";
			}
			else if($data[1] == 10){
				$m = "Octubre";
			}
			else if($data[1] == 11){
				$m = "Noviembre";
			}
			else if($data[1] == 12){
				$m = "Diciembre";
			}
			$fecha = $data[2]." de ".$m." de ".$data[0];
		}
		else{
			$fecha = "";
		}
		
		return $fecha;
	}

	function formato_fecha2($fecha){
		if(isset($fecha)){
			$data = explode("-", $fecha);
			$m = "";
			if($data[1] == 1){
				$m = "Enero";
			}
			else if($data[1] == 2){
				$m = "Febrero";
			}
			else if($data[1] == 3){
				$m = "Marzo";
			}
			else if($data[1] == 4){
				$m = "Abril";
			}
			else if($data[1] == 5){
				$m = "Mayo";
			}
			else if($data[1] == 6){
				$m = "Junio";
			}
			else if($data[1] == 7){
				$m = "Julio";
			}
			else if($data[1] == 8){
				$m = "Agosto";
			}
			else if($data[1] == 9){
				$m = "Septiembre";
			}
			else if($data[1] == 10){
				$m = "Octubre";
			}
			else if($data[1] == 11){
				$m = "Noviembre";
			}
			else if($data[1] == 12){
				$m = "Diciembre";
			}
			$fecha = $data[2]."/".$m."/".$data[0];
		}
		else{
			$fecha = "";
		}
		return $fecha;
	}

	function formato_fecha_master($fecha){
		if(isset($fecha)){
			$fecha = trim($fecha);
			$data1 = explode(" ", $fecha);
			if(count($data1) > 1){
				$fecha = $data1[0];
				$data = explode("-", $fecha);
				$m = "";
				if($data[1] == 1){
					$m = "Enero";
				}
				else if($data[1] == 2){
					$m = "Febrero";
				}
				else if($data[1] == 3){
					$m = "Marzo";
				}
				else if($data[1] == 4){
					$m = "Abril";
				}
				else if($data[1] == 5){
					$m = "Mayo";
				}
				else if($data[1] == 6){
					$m = "Junio";
				}
				else if($data[1] == 7){
					$m = "Julio";
				}
				else if($data[1] == 8){
					$m = "Agosto";
				}
				else if($data[1] == 9){
					$m = "Septiembre";
				}
				else if($data[1] == 10){
					$m = "Octubre";
				}
				else if($data[1] == 11){
					$m = "Noviembre";
				}
				else if($data[1] == 12){
					$m = "Diciembre";
				}
				$fecha = $data[2]."/".$m."/".$data[0]." ".$data1[1];
			}
			else{
				$fecha = $data1[0];
				$data = explode("-", $fecha);
				$m = "";
				if($data[1] == 1){
					$m = "Enero";
				}
				else if($data[1] == 2){
					$m = "Febrero";
				}
				else if($data[1] == 3){
					$m = "Marzo";
				}
				else if($data[1] == 4){
					$m = "Abril";
				}
				else if($data[1] == 5){
					$m = "Mayo";
				}
				else if($data[1] == 6){
					$m = "Junio";
				}
				else if($data[1] == 7){
					$m = "Julio";
				}
				else if($data[1] == 8){
					$m = "Agosto";
				}
				else if($data[1] == 9){
					$m = "Septiembre";
				}
				else if($data[1] == 10){
					$m = "Octubre";
				}
				else if($data[1] == 11){
					$m = "Noviembre";
				}
				else if($data[1] == 12){
					$m = "Diciembre";
				}
				$fecha = $data[2]."/".$m."/".$data[0];
			}
		}
		else{
			$fecha = "";
		}
		return $fecha;
	}
	
	function quitar_numeros_cadena($cadena, $num){
		$cadena = str_replace($num, "", $cadena);
		if($num != 9){
			$num++;
			$cadena = quitar_numeros_cadena($cadena, $num);
		}
		return $cadena;
	}

	function get_month_by_num($num){
		$m = "";
		if($num == 1){
			$m = "Enero";
		}
		else if($num == 2){
			$m = "Febrero";
		}
		else if($num == 3){
			$m = "Marzo";
		}
		else if($num == 4){
			$m = "Abril";
		}
		else if($num == 5){
			$m = "Mayo";
		}
		else if($num == 6){
			$m = "Junio";
		}
		else if($num == 7){
			$m = "Julio";
		}
		else if($num == 8){
			$m = "Agosto";
		}
		else if($num == 9){
			$m = "Septiembre";
		}
		else if($num == 10){
			$m = "Octubre";
		}
		else if($num == 11){
			$m = "Noviembre";
		}
		else if($num == 12){
			$m = "Diciembre";
		}
		else{
			$m = "No Definido";
		}
		return $m;
	}

	#COMBOBOX DE MESES
	function get_combobox_meses($nombre, $num){
		$codigo = "
			<select id='".$nombre."' name='".$nombre."' class='form-control input-sm'>
				<option value='' selected> Mes </option>
		";
		if($num == 1){
			$codigo .= "<option value='1' selected> Enero </option>";
		}
		else{
			$codigo .= "<option value='1'> Enero </option>";
		}
		if($num == 2){
			$codigo .= "<option value='2' selected> Febrero </option>";
		}
		else{
			$codigo .= "<option value='2'> Febrero </option>";
		}
		if($num == 3){
			$codigo .= "<option value='3' selected> Marzo </option>";
		}
		else{
			$codigo .= "<option value='3'> Marzo </option>";
		}
		if($num == 4){
			$codigo .= "<option value='4' selected> Abril </option>";
		}
		else{
			$codigo .= "<option value='4'> Abril </option>";
		}
		if($num == 5){
			$codigo .= "<option value='5' selected> Mayo </option>";
		}
		else{
			$codigo .= "<option value='5'> Mayo </option>";
		}
		if($num == 6){
			$codigo .= "<option value='6' selected> Junio </option>";
		}
		else{
			$codigo .= "<option value='6'> Junio </option>";
		}
		if($num == 7){
			$codigo .= "<option value='7' selected> Julio </option>";
		}
		else{
			$codigo .= "<option value='7'> Julio </option>";
		}
		if($num == 8){
			$codigo .= "<option value='8' selected> Agosto </option>";
		}
		else{
			$codigo .= "<option value='8'> Agosto </option>";
		}
		if($num == 9){
			$codigo .= "<option value='9' selected> Septiembre </option>";
		}
		else{
			$codigo .= "<option value='9'> Septiembre </option>";
		}
		if($num == 10){
			$codigo .= "<option value='10' selected> Octubre </option>";
		}
		else{
			$codigo .= "<option value='10'> Octubre </option>";
		}
		if($num == 11){
			$codigo .= "<option value='11' selected> Noviembre </option>";
		}
		else{
			$codigo .= "<option value='11'> Noviembre </option>";
		}
		if($num == 12){
			$codigo .= "<option value='12' selected> Diciembre </option>";
		}
		else{
			$codigo .= "<option value='12'> Diciembre </option>";
		}
		$codigo .= "
			</select>
		";
		return $codigo;
	}

	function limpiar_caracteres_especiales($String){
		$String = str_replace(array('á','à','â','ã','ª','ä'),"a",$String);
		$String = str_replace(array('Á','À','Â','Ã','Ä'),"A",$String);
		$String = str_replace(array('Í','Ì','Î','Ï'),"I",$String);
		$String = str_replace(array('í','ì','î','ï'),"i",$String);
		$String = str_replace(array('é','è','ê','ë'),"e",$String);
		$String = str_replace(array('É','È','Ê','Ë'),"E",$String);
		$String = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$String);
		$String = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$String);
		$String = str_replace(array('ú','ù','û','ü'),"u",$String);
		$String = str_replace(array('Ú','Ù','Û','Ü'),"U",$String);
		$String = str_replace(array('[','^','´','`','¨','~',']'),"",$String);
		$String = str_replace("ç","c",$String);
		$String = str_replace("Ç","C",$String);
		$String = str_replace("ñ","n",$String);
		$String = str_replace("Ñ","N",$String);
		$String = str_replace("Ý","Y",$String);
		$String = str_replace("ý","y",$String);
		$String = str_replace("&aacute;","a",$String);
		$String = str_replace("&Aacute;","A",$String);
		$String = str_replace("&eacute;","e",$String);
		$String = str_replace("&Eacute;","E",$String);
		$String = str_replace("&iacute;","i",$String);
		$String = str_replace("&Iacute;","I",$String);
		$String = str_replace("&oacute;","o",$String);
		$String = str_replace("&Oacute;","O",$String);
		$String = str_replace("&uacute;","u",$String);
		$String = str_replace("&Uacute;","U",$String);
		return $String;
	}

	function quitar_caracteres_especiales($arreglo){
		foreach ($arreglo AS $string){
			$string = trim($string);
			$string = str_replace("(", "", $string);
			$string = str_replace(")", "", $string);
			$string = str_replace("*", "", $string);
			$string = str_replace(";", "", $string);
			$string = str_replace("=", "", $string);
			$string = str_replace("!", "", $string);
			$string = str_replace("¡", "", $string);
			$string = str_replace('"', "", $string);
			$string = str_replace("'", "", $string);
			$string = str_replace("#", "", $string);
			$string = str_replace("$", "", $string);
			$string = str_replace("%", "", $string);
			$string = str_replace("&", "", $string);
			$string = str_replace("/", "", $string);
			$string = str_replace("?", "", $string);
			$string = str_replace("¿", "", $string);
			$string = str_replace("+", "", $string);
			$string = str_replace("-", "", $string);
			$string = str_replace("-", "", $string);
			$string = str_replace("localhost", "", $string);
			$string = str_replace("root", "", $string);
			$string = str_replace("terminal", "", $string);
			$string = str_replace("TERMINAL", "", $string);
			$string = str_replace("php", "", $string);
			$string = str_replace("PHP", "", $string);
		}
		return $arreglo;
	}

	function get_combobox($nombre, $arreglo){
		if(count($arreglo) > 0){
			$codigo = "
				<select id='".$nombre."' name='".$nombre."' class='form-control input-sm'>
					<option value='0'>  </option>
			";
			for($i = 0; $i < count($arreglo); $i++){
				$a = $arreglo[$i];
				$codigo .= "<option value='".$a["id"]."'> ".$a["nombre"]." </option>";
			}
			$codigo .= "
				</select>
			";
		}
		else{
			$codigo = "
				<div class='row'>
					<div class='alert alert-warning' role='alert'>
						<center>
							<h6> <strong> <i class='fa fa-exclamation' aria-hidden='true'></i> </strong> </h6>
							<h6> Ocurrio un error al tratar de obtener el combobox. </h6>
						</center>
					</div>
				</div>
			";
		}
		return $codigo;
	}

	function get_combobox_selected($nombre, $arreglo, $selected){
		if(count($arreglo) > 0){
			$codigo = "
				<select id='".$nombre."' name='".$nombre."' class='form-control input-sm'>
					<option value='0'>  </option>
			";
			for($i = 0; $i < count($arreglo); $i++){
				$a = $arreglo[$i];
				if($a["id"] == $selected){
					$codigo .= "<option value='".$a["id"]."' selected> ".$a["nombre"]." </option>";
				}
				else{
					$codigo .= "<option value='".$a["id"]."'> ".$a["nombre"]." </option>";
				}
			}
			$codigo .= "
				</select>
			";
		}
		else{
			$codigo = "
				<div class='row'>
					<div class='alert alert-warning' role='alert'>
						<center>
							<h6> <strong> <i class='fa fa-exclamation' aria-hidden='true'></i> </strong> </h6>
							<h6> Ocurrio un error al tratar de obtener el combobox. </h6>
						</center>
					</div>
				</div>
			";
		}
		return $codigo;
	}

	function get_combobox_proveedores_estatus($estatus){
		$arreglo = [
			["id" => 1, "nombre" => "Activo"],
			["id" => 0, "nombre" => "Baja"]
		];
		return get_combobox_selected("estatus", $arreglo, $estatus);
	}

	function get_combobox_regiones($id_region){
		$executer = new Regiones();
		$response = $executer->get_regiones("");
		$arreglo = $response["data"];
		return get_combobox_selected("id_region", $arreglo, $id_region);
	}

	function get_combobox_estados($id_estado){
		$executer = new Estados();
		$response = $executer->get_estados("");
		$arreglo = $response["data"];
		return get_combobox_selected("id_estado", $arreglo, $id_estado);
	}

	function get_options_estados_by_pais($data){
		$executer = new Estados();
		$codigo = array();
		if(!isset($data["id_pais"])){
			$codigo["error"] = 1;
			$codigo["code"] = "<option value='0'> </option>";
		}
		else if($data["id_pais"] == "" OR $data["id_pais"] == 0){
			$codigo["error"] = 1;
			$codigo["code"] = "<option value='0'> </option>";
		}
		else{
			$response = $executer->get_estados_by_idpais($data["id_pais"]);
			$arreglo = $response["data"];
			$codigo["code"] = "<option value=''> </option>";
			if(count($arreglo) > 0){
				for($i = 0; $i < count($arreglo); $i++){
					$s = $arreglo[$i];
					if(isset($data["id_estado"])){
						if($data["id_estado"] == $s["id"]){
							$codigo["code"] .= "<option value='".$s["id"]."' selected> ".$s["nombre"]." </option>";
						}
						else{
							$codigo["code"] .= "<option value='".$s["id"]."'> ".$s["nombre"]." </option>";
						}
					}
					else{
						$codigo["code"] .= "<option value='".$s["id"]."'> ".$s["nombre"]." </option>";
					}
				}
				$codigo["error"] = 0;
			}
			else{
				$codigo["error"] = 1;
				$codigo["code"] = "<option value='0'> NO HAY ESTADOS </option>";
			}
		}
		return $codigo;
	}

	function get_options_ciudades_by_estado($data){
		$executer = new Ciudades();
		$codigo = array();
		if(!isset($data["id_estado"])){
			$codigo["error"] = 1;
			$codigo["code"] = "<option value='0'> </option>";
		}
		else if($data["id_estado"] == "" OR $data["id_estado"] == 0){
			$codigo["error"] = 1;
			$codigo["code"] = "<option value='0'> </option>";
		}
		else{
			$response = $executer->get_ciudades_by_idestado($data["id_estado"]);
			$arreglo = $response["data"];
			$codigo["code"] = "<option value=''> </option>";
			if(count($arreglo) > 0){
				for($i = 0; $i < count($arreglo); $i++){
					$s = $arreglo[$i];
					if(isset($data["id_ciudad"])){
						if($data["id_ciudad"] == $s["id"]){
							$codigo["code"] .= "<option value='".$s["id"]."' selected> ".$s["nombre"]." </option>";
						}
						else{
							$codigo["code"] .= "<option value='".$s["id"]."'> ".$s["nombre"]." </option>";
						}
					}
					else{
						$codigo["code"] .= "<option value='".$s["id"]."'> ".$s["nombre"]." </option>";
					}
				}
				$codigo["error"] = 0;
			}
			else{
				$codigo["error"] = 1;
				$codigo["code"] = "<option value='0'> NO HAY CIUDADES </option>";
			}
		}
		return $codigo;
	}

	function get_combobox_empleados($id_empleado){
		$executer = new Empleados();
		$response = $executer->get_empleados("");
		$arreglo = $response["data"];
		return get_combobox_selected("id_encargado", $arreglo, $id_empleado);
	}
	
	function get_combobox_departamentos($id_departamento){
		$executer = new Departamentos();
		$response = $executer->get_departamentos("");
		$arreglo = $response["data"];
		return get_combobox_selected("id_departamento", $arreglo, $id_departamento);
	}

	function get_combobox_paises($id_pais){
		$executer = new Paises();
		$response = $executer->get_paises("");
		$arreglo = $response["data"];
		return get_combobox_selected("id_pais", $arreglo, $id_pais);
	}

	function get_combobox_categorias($id_categoria){
		$executer = new Categorias();
		$response = $executer->get_categorias_activas();
		$arreglo = $response["data"];
		return get_combobox_selected("id_categoria", $arreglo, $id_categoria);
	}

	function get_combobox_proveedores($id_proveedor){
		$executer = new Proveedores();
		$response = $executer->get_proveedores_activos();
		$arreglo = $response["data"];
		return get_combobox_selected("id_proveedor", $arreglo, $id_proveedor);
	}

	function get_combobox_mensajerias($id_mensajeria){
		$executer = new Mensajerias();
		$response = $executer->get_mensajerias("");
		$arreglo = $response["data"];
		return get_combobox_selected("id_mensajeria", $arreglo, $id_mensajeria);
	}

	function get_code_numeric($numero){
		if($numero <= 9){
			return "000".$numero;
		}
		else if($numero >= 10 AND $numero <= 99){
			return "00".$numero;
		}
		else if($numero >= 100 AND $numero <= 999){
			return "0".$numero;
		}
	}

?>
