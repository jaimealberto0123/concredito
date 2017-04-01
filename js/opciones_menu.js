
	$(document).ready(function(){
		
		$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
			event.preventDefault(); 
			event.stopPropagation(); 
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});

		$('.dropdown-submenu a.test').on("click", function(e){
			$(this).next('ul').toggle();
			e.stopPropagation();
			e.preventDefault();
		});

		$("#div-menu").slideDown("slow");


		if($("#articulos").length){
			$("#articulos").click(function(){
				get_pantalla_articulos();
			});
		}

		if($("#clientes").length){
			$("#clientes").click(function(){
				get_pantalla_clientes();
			});
		}

		if($("#configuracion").length){
			$("#configuracion").click(function(){
				get_modal_formulario_configuracion();
			});
		}

		if($("#ventas").length){
			$("#ventas").click(function(){
				get_pantalla_ventas();
			});
		}

		$("#div-cargando").fadeOut("fast");

	});

	function cerrar_capas(){
		var i = 10;
		while(i > 1){
			if(i > 1){
				$("#div-0"+i).slideUp("slow", function(){
					$("#div-0"+i).html("");
				});
				i--;
			}
			else{
				alert("cerrar_capas();");
				break;
			}
		}
	}

	function has_only_numeric(cadena){
	    var patt = new RegExp("[^0-9]");
	    var res = patt.test(cadena);
		return !res;
	}

	function is_void(cadena){
		var bandera = true;
		if(cadena == "undefined"){
			bandera = false;
		}
		else{
			if(cadena.trim() != ""){
				bandera = false;
			}
		}
		return bandera;
	}

	function email_is_correct(email){
		var bandera = true;
		var expreg = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/);
		if(!expreg.test(email)){
			bandera = false;
		}
    	return bandera;
	}

	function curp_is_correct(curp){
		var bandera = true;
		var expreg = new RegExp(/^([a-zA-Z]{4})([0-9]{6})([a-zA-Z]{6})([0-9]{2})$/i);
		if(!expreg.test(curp)){
			bandera = false;
		}
    	return bandera;
	}

	//-----------------------------------------------------------------------------------------------------

	function message_alert_modal_small_aviso(message){
		$("#modal03-title").html("<i class='fa fa-exclamation-circle' aria-hidden='true'></i>");
		$("#modal03-body").html(message);
		$("#modal03-footer").html("<center> <button type='button' class='btn btn-default' data-dismiss='modal'> Aceptar </button> </center>");
		$("#modal03").modal("show");
	}

	function message_alert_modal_small_exito(message){
		$("#modal03-title").html("<i class='fa fa-exclamation-circle' aria-hidden='true'></i>");
		$("#modal03-body").html(message);
		$("#modal03-footer").html("<center> <button type='button' class='btn btn-default' data-dismiss='modal'> Aceptar </button> </center>");
		$("#modal03").modal("show");
	}

	function message_alert_modal_small_error(message){
		$("#modal03-title").html("<i class='fa fa-exclamation-circle' aria-hidden='true'></i>");
		$("#modal03-body").html(message);
		$("#modal03-footer").html("<center> <button type='button' class='btn btn-default' data-dismiss='modal'> Aceptar </button> </center>");
		$("#modal03").modal("show");
	}

	function message_alert_modal(size, type_message, header, message, footer){

		if(size == "small"){
			size = "03";
		}
		else if(size == "medium"){
			size = "01";
		}
		else /*(size == "large")*/{
			size = "02";
		}

		if(type_message == "alert"){
			type_message = "<i class='fa fa-exclamation-circle' aria-hidden='true'></i>";
		}
		else if(type_message == "error"){
			type_message = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>";
		}
		else if(type_message == "success"){
			type_message = "<i class='fa fa-check-circle' aria-hidden='true'></i>";
		}
		else if(type_message == "info"){
			type_message = "<i class='fa fa-info-circle' aria-hidden='true'></i>";
		}
		else{
			type_message = "<i class='fa fa-exclamation' aria-hidden='true'></i>";
		}

		$("#modal"+size+"-title").html("<i class='fa fa-exclamation-circle' aria-hidden='true'></i>  "+header);
		$("#modal"+size+"-body").html(message);
		if(size == "03"){
			$("#modal"+size+"-footer").html("<center> "+footer+" </center>");
		}
		else{
			$("#modal"+size+"-footer").html(footer);
		}
		$("#modal"+size).modal("show");
	}

	function alert_success(message1, message2){
		var html = "";
		html += "<div class='row' style='padding-right: 10px; padding-left: 10px; padding-top: 5px; padding-bottom: 5px;'>";
		html += "	<div class='alert alert-success' role='alert'>";
		html += "		<div class='row'>";
		html += "			<div class='col-xs-4 col-sm-4 col-md-2 col-lg-2'>";
		html += "				<i class='fa fa-check-circle fa-3x' aria-hidden='true'></i>";
		html += "			</div>";
		html += "			<div class='col-xs-8 col-sm-8 col-md-10 col-lg-10'>";
		html += "				<strong> "+message1+" </strong> "+message2;
		html += "			</div>";
		html += "		</div>";
		html += "	</div>";
		html += "</div>";
		return html;
	}

	function alert_error(message1, message2){
		var html = "";
		html += "<div class='row' style='padding-right: 10px; padding-left: 10px; padding-top: 5px; padding-bottom: 5px;'>";
		html += "	<div class='alert alert-danger' role='alert'>";
		html += "		<div class='row'>";
		html += "			<div class='col-xs-4 col-sm-4 col-md-2 col-lg-2'>";
		html += "				<i class='fa fa-times-circle fa-3x' aria-hidden='true'></i>";
		html += "			</div>";
		html += "			<div class='col-xs-8 col-sm-8 col-md-10 col-lg-10'>";
		html += "				<strong> "+message1+" </strong> "+message2;
		html += "			</div>";
		html += "		</div>";
		html += "	</div>";
		html += "</div>";
		return html;
	}