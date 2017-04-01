<link rel="stylesheet" href="../css/styles_main.css">

<script type="text/javascript" src="../js/opciones_menu.js"></script>
<script type="text/javascript" src="../js/ventas.js"></script>
<script type="text/javascript" src="../js/articulos.js"></script>
<script type="text/javascript" src="../js/clientes.js"></script>
<script type="text/javascript" src="../js/configuracion.js"></script>

<style type="text/css">
	.background_modal{
		background-image: url(../img/bg_modal.png);
	}
</style>


<?php
	include_once("../lib/Time.php");
	include_once("../lib/functions_aux.php");
	$executer = new Time();
	$response = $executer->get_date_today();
	$time = $response["data"];

	$codigo = "
		<div class='ui top attached menu inverted'>
			<div class='ui dropdown icon item'>
				Inicio
				<div class='menu'>
					<div id='ventas' class='item'>
						Ventas
					</div>
					<div class='divider'></div>
					<div id='clientes' class='item'>
						Clientes
					</div>
					<div id='articulos' class='item'>
						Articulos
					</div>
					<div id='configuracion' class='item'>
						Configuración
					</div>
				</div>
			</div>
			<div class='right menu'>
				<a class='ui item'>
					".formato_fecha_master($time["today_date"])."
				</a>
			</div>
		</div>
	";
	
	echo $codigo;
	
?>