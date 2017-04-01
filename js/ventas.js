	
	function get_pantalla_ventas(){
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
				data: "principal="+$("#data-session").val()+"&main=OH30K0015",
				success: function(response){
					$("#div-02").html(response.codigo);
					$("form").submit(function(){
						return false;
					});
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

	function get_modal_formulario_agregar_venta(){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=OH30K0016",
			success: function(response){
				if(response.error == 0){
					$("#modal01-title").html(response.title);
					$("#modal01-body").html(response.body);
					$("#modal01-footer").html(response.footer);
					$("form").submit(function(){
						return false;
					});
					var content = new Array();
					for($i = 0; $i < response.arreglo_clientes.length; $i++){
						content[$i] = {title: response.arreglo_clientes[$i]};
					}
					$("#clientes_search").search({
						source: content,
						onSelect: function(result, response){
							get_info_cliente(result.title);
						}
					});
					content = new Array();
					for($i = 0; $i < response.arreglo_articulos.length; $i++){
						content[$i] = {title: response.arreglo_articulos[$i]};
					}
					$("#articulo_search").search({
						source: content
					});

					$('#modal01').modal('setting', 'closable', false).modal("show");
				}
				else{
					$("#modal01-title").html(response.title);
					$("#modal01-body").html(response.body);
					$("#modal01-footer").html(response.footer);
					$('#modal01').modal('setting', 'closable', false).modal("show");
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);
			}
		});
	}

	function get_info_cliente(nombre){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=OH30K0017&nombre="+nombre,
			success: function(response){
				if(response.error == 1){
					alert(response.error_message);
				}
				else{
					$("#rfc").html(response.rfc);
					$("#id_cliente").val(response.id);
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);
			}
		});
	}

	function agregar_articulo_lista(){
		if($("#input_articulo").val().trim() == ""){
			alert("No hay articulo seleccionado.");
		}
		else{
			$.ajax({
				cache: false,
				async: false,
				type: "POST",
				dataType: "JSON",
				url: "callback.php",
				data: "principal="+$("#data-session").val()+"&main=OH30K0018&nombre="+$("#input_articulo").val().trim(),
				success: function(response){
					if(response.error == 1){
						alert(response.error_message);
					}
					else{
						agregar_fila_articulo_lista(response);
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(jqXHR.responseText);
				}
			});
		}
	}

	function agregar_fila_articulo_lista(articulo){

		if(articulo.existencia == 0){
			alert("El artículo seleccionado no cuenta con existencia, favor de verificar.");
		}
		else{
			var bandera = true;
			$("[name*='articulo_']").each(function(){
				if($(this).val().trim() == articulo.id){
					alert("El producto ya fue ingresado en la orden con anterioridad.");
					bandera = false;
				}
			});
			if(bandera){
				var precio = (articulo.precio * (1 + ($("#tasa").val() * $("#plazo").val()) / 100)).toFixed(2);
				var cadena = "<tr>";
				cadena += "<input type='hidden' id='articulo_"+articulo.id+"' name='articulo_"+articulo.id+"' value='"+articulo.id+"'>";
				cadena += "<input type='hidden' id='precio_"+articulo.id+"' name='precio_"+articulo.id+"' value='"+precio+"'>";
				cadena += "<input type='hidden' id='importe_"+articulo.id+"' name='importe_"+articulo.id+"' value='"+precio+"'>";
				cadena += "<td> "+articulo.descripcion+" </td>"; 
				cadena += "<td> "+articulo.modelo+" </td>";
				cadena += "<td> <input type='text' id='cantidad_"+articulo.id+"' name='cantidad_"+articulo.id+"' value='1' onchange='cambiar_importe("+articulo.id+")'> </td>"
				cadena += "<td style='text-align: right;'> "+precio+" </td>";
				cadena += "<td id='td_importe_"+articulo.id+"' style='text-align: right;'> "+precio+" </td>";
				cadena += "<td style='text-align: center;'> <button name='delete_fila' type='button' class='ui primary button'> <i class='fa fa-times' aria-hidden='true'></i> </button> </td> </tr>";
				$("#tbody1").append(cadena);
				set_calcular_enganche();
				$("[name='delete_fila']").click(function(){
					$(this).parent().parent().remove();
					set_calcular_enganche();
				});
				$("#cantidad_"+articulo.id).focus();
			}
		}
	}

	function cambiar_importe(id){
		if(has_only_numeric($("#cantidad_"+id).val().trim())){
			$.ajax({
				cache: false,
				async: false,
				type: "POST",
				dataType: "JSON",
				url: "callback.php",
				data: "principal="+$("#data-session").val()+"&main=OH30K0019&id="+id,
				success: function(response){
					if(response.error == 1){
						alert(response.error_message);
					}
					else{
						if($("#cantidad_"+id).val().trim() <= response.existencia){
							var importe = $("#cantidad_"+id).val().trim()*$("#precio_"+id).val();
							$("#td_importe_"+id).html(importe);
							$("#importe_"+id).val(importe);
						}
						else{
							alert("El maximo de articulos existente es de: "+response.existencia);
							$("#cantidad_"+id).val(response.existencia);
							var importe = response.existencia * $("#precio_"+id).val();
							$("#td_importe_"+id).html(importe);
							$("#importe_"+id).val(importe);
						}
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(jqXHR.responseText);
				}
			});
		}
		else{
			$("#td_importe_"+id).html(0.0);
			$("#importe_"+id).val(0);
		}
		set_calcular_enganche();
	}

	function set_calcular_enganche(){
		var enganche = 0;
		$("[name*='importe_']").each(function(){
			enganche += ($("#enganche").val()/100) * parseFloat($(this).val());
		});
		$("#enganche_venta").val(enganche.toFixed(2));
		set_calcular_bonificacion();
	}

	function set_calcular_bonificacion(){
		var bonificacion = $("#enganche_venta").val() * (($("#tasa").val()*$("#plazo").val())/100);
		$("#bonificacion_venta").val(bonificacion.toFixed(2));
		set_calcular_total_adeudo();
	}

	function set_calcular_total_adeudo(){
		var importe = 0;
		$("[name*='importe_']").each(function(){
			importe += parseFloat($(this).val());
		});
		var total = importe - parseFloat($("#enganche_venta").val()) - parseFloat($("#bonificacion_venta").val());
		$("#total_venta").val(total.toFixed(2));
		set_calcular_abonos();
	}

	function set_calcular_abonos(){
		$("#abonos_3").html(get_row_abonos(3));
		$("#abonos_6").html(get_row_abonos(6));
		$("#abonos_9").html(get_row_abonos(9));
		$("#abonos_12").html(get_row_abonos(12));
	}

	function get_row_abonos(plazo){
		var row = "";
		var tasa = $("#tasa").val();
		var importe = 0;
		$("[name*='importe_']").each(function(){
			importe += parseFloat($(this).val());
		});
		var total_adeudo = importe - parseFloat($("#enganche_venta").val()) - parseFloat($("#bonificacion_venta").val());
		var precio_contado = total_adeudo / (1 + ((tasa * $("#plazo").val()/*PLAZO MAXIMO*/) / 100));
		var total_pagar = precio_contado * (1 + ((tasa * plazo) / 100));
		var importe_abono = total_pagar / plazo;
		var importe_ahorro = total_adeudo - total_pagar;
		row += "<td style='text-align: center;'> "+plazo+" ABONOS DE </td>";
		row += "<td style='text-align: center;'> $ "+importe_abono.toFixed(2)+" </td>";
		row += "<td style='text-align: center;'> TOTAL A PAGAR: "+total_pagar.toFixed(2)+" </td>";
		row += "<td style='text-align: center;'> SE AHORRA: "+importe_ahorro.toFixed(2)+" </td>";
		row += "<td style='text-align: center;'> <input type='radio' id='radio_abonos"+plazo+"' name='radio_abonos' checked='' tabindex='0' class='hidden' value='"+plazo+"'> </td>";
		return row;
	}

	function validar_existencia(){
		var obj = Object || {};
		obj.bandera = true;
		obj.message = "";
		if($("#id_cliente").val() == "" || $("#id_cliente").val() == "" || $("#id_cliente").val() == undefined){
			obj.bandera = false;
			obj.message = "Debe selecionar un cliente.";
		}
		else if($("[name*='articulo_']").length <= 0){
			obj.bandera = false;
			obj.message = "Debe agregar por lo menos un articulo a la lista.";
		}
		else if($("[name*='articulo_']").length <= 0){
			obj.bandera = false;
			obj.message = "Debe agregar por lo menos un articulo a la lista.";
		}
		else{
			$("[name*='cantidad_']").each(function(){
				if($(this).val().trim() <= 0){
					obj.bandera = false;
					obj.message = "La cantidad de los articulos debe ser por lo menos de 1.";
				}
			});
		}
		return obj;
	}

	function validar_siguiente(){
		var existencia = validar_existencia();
		if(existencia.bandera){
			$("#section_abonos").slideDown("slow");
			$("#button2").hide();
			$("#button3").show();
		}
		else{
			alert(existencia.message);
		}
	}

	function set_agregar_venta(){
		var obj = Object || {};
		obj.bandera = true;
		obj.message = "";
		if($("#id_cliente").val() == "" || $("#id_cliente").val() == "" || $("#id_cliente").val() == undefined){
			obj.bandera = false;
			obj.message = "Debe selecionar un cliente.";
		}
		else if($("[name*='articulo_']").length <= 0){
			obj.bandera = false;
			obj.message = "Debe agregar por lo menos un articulo a la lista.";
		}
		else if($("[name*='articulo_']").length <= 0){
			obj.bandera = false;
			obj.message = "Debe agregar por lo menos un articulo a la lista.";
		}
		else{
			$("[name*='cantidad_']").each(function(){
				if($(this).val().trim() <= 0){
					obj.bandera = false;
					obj.message = "La cantidad de los articulos debe ser por lo menos de 1.";
				}
			});
			if(obj.bandera){
				if($("#radio_abonos3").is(':checked') == false && 
					$("#radio_abonos6").is(':checked') == false && 
					$("#radio_abonos9").is(':checked') == false &&
					$("#radio_abonos12").is(':checked') == false){
					obj.bandera = false;
					obj.message = "Debe seleccionar un plazo para realizar el pago de su compra.";
				}
				else{
					var articulos = new Array();
					$("[name*='articulo_']").each(function(){
						var articulo = {
							id_articulo: $(this).val(),
							cantidad: $("#cantidad_"+$(this).val()).val().trim(),
							precio: $("#precio_"+$(this).val()).val().trim(),
							importe: $("#importe"+$(this).val()).val()
						};
						articulos.push(articulo);
					});
					var arreglo = {
						folio: $("#id").val().trim(),
						id_cliente: $("#id_cliente").val().trim(),
						tasa: $("#tasa").val().trim(),
						enganche: $("#enganche").val().trim(),
						plazo_maximo: $("#plazo").val().trim(),
						mensualidad_abono: $("input:radio[name='radio_abonos']:checked").val().trim(),
						enganche_venta: $("#enganche_venta").val().trim(),
						bonificacion_venta: $("#bonificacion_venta").val().trim(),
						total_venta: $("#total_venta").val().trim(),
						articulos: articulos
					};
					$.ajax({
						cache: false,
						async: false,
						type: "POST",
						dataType: "JSON",
						url: "callback.php",
						data: "principal="+$("#data-session").val()+"&main=OH30K0020&data="+JSON.stringify(arreglo),
						success: function(response){
							if(response.error == 1){
								alert(response.message);
							}
							else{
								alert(response.message);
								get_pantalla_ventas();
								$('#modal01').modal("hide");
							}
						},
						error: function(jqXHR, textStatus, errorThrown){
							alert(jqXHR.responseText);
						}
					});
				}
			}
			else{
				alert(obj.message);
			}
		}
	}

	/*
	

	function get_modal_formulario_modificar_venta(id){
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

	function set_modificar_venta(){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=OH30K0005&"+$("#formulario_ventas").serialize(),
			success: function(response){
				if(response.error == 1){
					alert(response.message);
				}
				else{
					alert(response.message);
					update_tr_table_ventas(response.id_fila);
					$('#modal01').modal("hide");
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);
			}
		});
	}

	function update_tr_table_ventas(id){
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
	function get_table_ventas(){
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

	

	function validar_formulario_ventas(){
		var bandera = true;
		var message = "";

		if(!validar_nombre_venta()){
			bandera = false;
		}
		
		if(bandera){
			set_modificar_venta();
		}
	}

	function validar_nombre_venta(){
		var bandera = true;
		if(is_void($("#nombre").val().trim()) || $("#nombre").val().trim() == 0){
			bandera = false;
			alert("Debe especificar el nombre del venta.");
		}
		return bandera;
	}

	function set_modificar_venta(){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=KSDJANASDF0004&"+$("#formulario_modificacion_venta").serialize(),
			success: function(response){
				if(response.error == 1){
					alert(response.message);
				}
				else{
					alert(response.message);
					update_tr_table_ventas(response.id);
					$('#modal01').modal("hide");
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);
			}
		});
	}

	

	function get_modal_formulario_agregar_venta(){
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

	function validar_formulario_ventas2(){
		var bandera = true;
		var message = "";

		if(!validar_nombre_venta()){
			bandera = false;
		}
		
		if(bandera){
			set_agregar_venta();
		}
	}

	
	*/