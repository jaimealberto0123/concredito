	
	function get_pantalla_articulos(){
		$("#div-cargando").fadeIn("slow");
		cerrar_capas();
		$("#div-02").fadeOut("slow", function(){
			$.ajax({
				timeout: 200000,
				cache: false,
				async: false,
				type: "POST",
				dataType: "JSON",
				url: "callback.php",
				data: "principal="+$("#data-session").val()+"&main=OH30K0001",
				success: function(response){
					$("#div-02").html(response.codigo);
					$("form").submit(function(){
						return false;
					});
					/*
					$("#nombre").keyup(function(event){
						if(event.which == 13){
							get_table_articulos();
						}
					});
					*/
					$("#div-cargando").fadeOut("slow", function(){
						$("#div-02").fadeIn("slow");
					});
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(jqXHR.responseText);
				}
			});
		});
	}

	function get_modal_formulario_agregar_articulo(id){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=OH30K0002&id="+id,
			success: function(response){
				if(response.error == 0){
					$("#modal01-title").html(response.title);
					$("#modal01-body").html(response.body);
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

	function set_agregar_articulo(){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=OH30K0003&"+$("#formulario_articulos").serialize(),
			success: function(response){
				if(response.error == 1){
					alert(response.message);
				}
				else{
					alert(response.message);
					get_pantalla_articulos();
					$('#modal01').modal("hide");
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);
			}
		});
	}

	function get_modal_formulario_modificar_articulo(id){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=OH30K0004&id="+id,
			success: function(response){
				if(response.error == 0){
					$("#modal01-title").html(response.title);
					$("#modal01-body").html(response.body);
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

	function set_modificar_articulo(){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=OH30K0005&"+$("#formulario_articulos").serialize(),
			success: function(response){
				if(response.error == 1){
					alert(response.message);
				}
				else{
					alert(response.message);
					update_tr_table_articulos(response.id_fila);
					$('#modal01').modal("hide");
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);
			}
		});
	}

	function update_tr_table_articulos(id){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=OH30K0006&id="+id,
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

	/*
	function get_table_articulos(){
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
						data: "principal="+$("#data-session").val()+"&main=KSDJANASDF0002&"+$("#formulario_busqueda").serialize(),
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

	

	function validar_formulario_articulos(){
		var bandera = true;
		var message = "";

		if(!validar_nombre_articulo()){
			bandera = false;
		}
		
		if(bandera){
			set_modificar_articulo();
		}
	}

	function validar_nombre_articulo(){
		var bandera = true;
		if(is_void($("#nombre").val().trim()) || $("#nombre").val().trim() == 0){
			bandera = false;
			alert("Debe especificar el nombre del articulo.");
		}
		return bandera;
	}

	function set_modificar_articulo(){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=KSDJANASDF0004&"+$("#formulario_modificacion_articulo").serialize(),
			success: function(response){
				if(response.error == 1){
					alert(response.message);
				}
				else{
					alert(response.message);
					update_tr_table_articulos(response.id);
					$('#modal01').modal("hide");
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);
			}
		});
	}

	

	function get_modal_formulario_agregar_articulo(){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=KSDJANASDF0006",
			success: function(response){
				if(response.error == 0){
					$("#modal01-title").html(response.title);
					$("#modal01-body").html(response.body);
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

	function validar_formulario_articulos2(){
		var bandera = true;
		var message = "";

		if(!validar_nombre_articulo()){
			bandera = false;
		}
		
		if(bandera){
			set_agregar_articulo();
		}
	}

	
	*/