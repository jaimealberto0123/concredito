	
	function get_pantalla_clientes(){
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
				data: "principal="+$("#data-session").val()+"&main=OH30K0007",
				success: function(response){
					$("#div-02").html(response.codigo);
					$("form").submit(function(){
						return false;
					});
					/*
					$("#nombre").keyup(function(event){
						if(event.which == 13){
							get_table_clientes();
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

	function get_modal_formulario_agregar_cliente(id){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=OH30K0008&id="+id,
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

	function set_agregar_cliente(){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=OH30K0009&"+$("#formulario_clientes").serialize(),
			success: function(response){
				if(response.error == 1){
					alert(response.message);
				}
				else{
					alert(response.message);
					get_pantalla_clientes();
					$('#modal01').modal("hide");
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);
			}
		});
	}

	function get_modal_formulario_modificar_cliente(id){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=OH30K0010&id="+id,
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

	function set_modificar_cliente(){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=OH30K0011&"+$("#formulario_clientes").serialize(),
			success: function(response){
				if(response.error == 1){
					alert(response.message);
				}
				else{
					alert(response.message);
					update_tr_table_clientes(response.id_fila);
					$('#modal01').modal("hide");
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);
			}
		});
	}

	function update_tr_table_clientes(id){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=OH30K0012&id="+id,
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