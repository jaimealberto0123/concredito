

	function get_modal_formulario_configuracion(){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=OH30K0013",
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

	function set_guardar_configuracion(){
		$.ajax({
			cache: false,
			async: false,
			type: "POST",
			dataType: "JSON",
			url: "callback.php",
			data: "principal="+$("#data-session").val()+"&main=OH30K0014&"+$("#formulario_configuracion").serialize(),
			success: function(response){
				if(response.error == 1){
					alert(response.message);
				}
				else{
					alert(response.message);
					$('#modal01').modal("hide");
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);
			}
		});
	}