<!DOCTYPE html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<?php
			include_once("definiciones.php");
		?>
		
		<title> <?php echo nombre_plataforma; ?> </title>
		<?PHP
			session_start();
			ob_start();
		?>
		
		<script src='../js/jquery-ui-1.11.4.base/external/jquery/jquery.js'></script>
		<script src='../js/jquery-ui-1.11.4.base/jquery-ui.js'></script>
		<script src='../js/datatables/media/js/jquery.dataTables.js'></script>
		<script src='../js/Chart.js-master/Chart.js'></script>
		<link rel='stylesheet' href='../js/datatables/media/css/jquery.dataTables.min.css'>
		<link href='../js/jquery-ui-1.11.4.base/jquery-ui.css' rel='stylesheet'>
		<link rel='stylesheet' href='../css/font-awesome-4.6.3/css/font-awesome.min.css'>
		<link rel="stylesheet" type="text/css" href="../css/semantic-master/dist/semantic.css">
		<script src="../css/semantic-master/dist/semantic.js"></script>
		
		
		
		
		<style type="text/css">

			.bg-banner-main{
				padding: 5px 5px;
				color: rgba(255,255,255,.8);
				background-color: rgb(213,43,30);
			}
			
			body{
				padding-left: 10px;
				padding-right: 10px;
			}

			.empresa{
				background: #30c785;
				color: #000000;
				padding-top: 30px;
				padding-bottom: 20px;
				border-radius: 10px;
			}
			
			.subtitle_empresa{
				background: #30c785;
				color: #000000;
			}
			
			.radius_border_20{
				border-radius: 20px;
			}

			.border_ancho{
				border-style: solid;
				border-width: 10px;
				border-color: #F4EEDD;
			}

			.margin_row{
				margin-top: 10px;
				margin-bottom: 10px;
			}

			.margin_row2{
				margin-top: 20px;
				margin-bottom: 20px;
			}

			.marginBottom-0 {margin-bottom:0;}

			.dropdown-submenu{position:relative;}
			.dropdown-submenu>.dropdown-menu{top:0;left:100%;margin-top:-6px;margin-left:-1px;-webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;}
			.dropdown-submenu>a:after{display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;border-left-color:#cccccc;margin-top:5px;margin-right:-10px;}
			.dropdown-submenu:hover>a:after{border-left-color:#555;}
			.dropdown-submenu.pull-left{float:none;}
			.dropdown-submenu.pull-left>.dropdown-menu{left:-100%;margin-left:10px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px;}
			
		</style>


	</head>
	<body>

		<?php
			include_once("../modales.php");
			include_once("../session.php");
		?>
		
		<div id="div-menu" style='display: none; padding-bottom: 80px;'>
			<?php
				include_once("../menu.php");
			?>
		</div>
		
		
		<div id="div-02" style='display: none; padding: 20px;'>
		</div>

		<div id="div-03" style='display: none; padding: 20px;'>
		</div>

		<div id="div-04" style='display: none; padding: 20px;'>
		</div>

		<div id="div-cargando">
			<div class="row" style='padding-left: 30%; padding-right: 30%;'>
				<center> 
					<h1> <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i> </h1>
				</center>
			</div>
		</div>

	</body>
</html>

<script>
	$(document).ready(function(){
		$(".ui.dropdown").dropdown();
	});
</script>
