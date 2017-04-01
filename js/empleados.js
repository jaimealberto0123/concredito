	
	function get_formulario_consulta_empleados(){
		$("#div-cargando").fadeIn("fast");
		cerrar_capas();
		$("#div-02").slideUp("fadeOut", function(){
			$.ajax({
				timeout: 200000,
				cache: false,
				async: false,
				type: "POST",
				dataType: "JSON",
				url: "callback.php",
				data: "principal="+$("#data-session").val()+"&main=AQTWR0001",
				success: function(response){
					$("#div-02").html(response);
					$("form").submit(function(){
						return false;
					});
					$("#nombre").keyup(function(event){
						if(event.which == 13){
							get_table_empleados();
						}
					});
					$("#div-02").slideDown("slow");
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(jqXHR.responseText);
				}
			});
		});
		$("#div-cargando").fadeOut("fast");
	}

	function get_table_empleados(){
		$("#div-cargando").fadeIn("fast", function(){
			$("#div-04").slideUp("slow", function(){
				$("#div-04").html("");
				$("#div-03").slideUp("fadeOut", function(){
					$.ajax({
						timeout: 200000,
						cache: false,
						async: false,
						type: "POST",
						dataType: "JSON",
						url: "callback.php",
						data: "principal="+$("#data-session").val()+"&main=AQTWR0002&"+$("#formulario_busqueda").serialize(),
						success: function(response){
							$("#div-03").html(response);
							if($("#table1").length){ $("#table1").DataTable(); }
							$("#div-03").slideDown("fadeIn");
						},
						error: function(jqXHR, textStatus, errorThrown){
							alert(jqXHR.responseText);
						}
					});
				});
				$("#div-cargando").fadeOut("fast");
			});
		});
	}

	function get_modal_formulario_modificar_empleado(id){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=AQTWR0003&id="+id,
			success: function(response){
				if(response.error == 0){
					$("#modal01-title").html(response.title);
					$("#modal01-body").html(response.body);
					$("#fecha_nacimiento").datepicker({
						dateFormat: "yy-mm-dd",
						changeMonth: true,
						changeYear: true
					});
					$("#modal01-footer").html(response.footer);
					$('#modal01').modal("show");
				}
				else{
					message_alert_modal_small_aviso(response.message);
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);
			}
		});
	}

	function validar_formulario_empleados(){
		var bandera = true;
		var message = "";

		if(!validar_empleado()){
			bandera = false;
		}
		
		if(bandera){
			set_modificar_empleado();
		}
	}

	function validar_empleado(){
		var bandera = true;
		if(is_void($("#nombre").val().trim()) || $("#nombre").val().trim() == 0){
			bandera = false;
			alert("Debe especificar el nombre del empleado.");
		}
		else if(is_void($("#apellido1").val().trim()) || $("#apellido1").val().trim() == 0){
			bandera = false;
			alert("Debe especificar el apellido paterno del empleado.");
		}
		else if(is_void($("#fecha_nacimiento").val().trim()) || $("#fecha_nacimiento").val().trim() == 0){
			bandera = false;
			alert("Debe especificar la fecha de nacimiento del empleado.");
		}
		else if(is_void($("#id_departamento").val().trim()) || $("#id_departamento").val().trim() == 0){
			bandera = false;
			alert("Debe especificar el departamento al cual pertenece el empleado.");
		}
		return bandera;
	}

	function set_modificar_empleado(){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=AQTWR0004&"+$("#formulario_modificacion_empleado").serialize(),
			success: function(response){
				if(response.error == 1){
					alert(response.message);
				}
				else{
					alert(response.message);
					update_tr_table_empleados(response.id);
					$('#modal01').modal("hide");
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);
			}
		});
	}

	function update_tr_table_empleados(id){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=AQTWR0005&id="+id,
			success: function(response){
				if(response.error == 0){
					$("#tr_"+id).html(response.codigo);
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);
			}
		});
	}

	function get_modal_formulario_agregar_empleado(){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=AQTWR0006",
			success: function(response){
				if(response.error == 0){
					$("#modal01-title").html(response.title);
					$("#modal01-body").html(response.body);
					$("#fecha_nacimiento").datepicker({
						dateFormat: "yy-mm-dd",
						changeMonth: true,
						changeYear: true
					});
					$("#modal01-footer").html(response.footer);
					$('#modal01').modal("show");
				}
				else{
					message_alert_modal_small_aviso(response.message);
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);
			}
		});
	}

	function validar_formulario_empleados2(){
		var bandera = true;
		var message = "";

		if(!validar_empleado()){
			bandera = false;
		}
		
		if(bandera){
			set_agregar_empleado();
		}
	}

	function set_agregar_empleado(){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=AQTWR0007&"+$("#formulario_modificacion_empleado").serialize(),
			success: function(response){
				if(response.error == 1){
					alert(response.message);
				}
				else{
					alert(response.message);
					get_table_empleados();
					$('#modal01').modal("hide");
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);
			}
		});
	}
