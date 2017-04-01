<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>

	<title> La Vendimia </title>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="css/semantic-master/dist/semantic.css">
  	<script src="css/semantic-master/dist/semantic.js"></script>
	
	<style type="text/css">
		body {
			background-color: #FFF;
		}
		
		body > .grid {
			height: 100%;
		}

		.image {
			margin-top: -100px;
		}

		.column {
			max-width: 450px;
		}

		.empresa{
			padding-top: 30px;
			padding-bottom: 20px;
			border-radius: 10px;
		}
		
		.subtitle_empresa{
			margin-left: 20px;
			margin-right: 20px;
			padding-left: 20px;
			padding-right: 20px;
		}
		
	</style>

</head>
<body>
	<div id='area1' style='display: none; padding-top: 15px;' class='area1 logo'>
		<center> <img src='img/Sale-icon.png' alt='La Vendimia' class='img-rounded img-responsive' style='width: 20%; heigth: 14%;'> </center>
    </div>
    <br>
	<div id='area2' style='display: none;'>

		<div class="ui middle aligned center aligned grid">
			<div class="column">
				<form class="ui large form" method='POST' action='checklogin.php'>
					<div class="ui stacked segment">
						<div class="field">
							<div class="ui left icon input">
								<i class="user icon"></i>
								<input type="text" name="login" placeholder="Usuario">
							</div>
						</div>
						<div class="field">
							<div class="ui left icon input">
								<i class="lock icon"></i>
								<input type="password" name="password" placeholder="Password">
							</div>
						</div>
						<div class="ui fluid large blue submit button">Entrar</div>
					</div>
					
					<div class="ui error message"></div>
				
				</form>
				<?php
					if(isset($_REQUEST["error"])){
						echo "
							<div id='area3' style='display: none; class='row'>
								<div class='column'>
									<div class='ui message'>
										<h1 class='ui header'> ERROR: </h1>
										<p>
											".($_REQUEST["error"] == 2 ?
													"Debe especificar una contraseña."
												:
													($_REQUEST["error"] == 3 ?
														"Debe especificar un nombre de usuario."
													:
														($_REQUEST["error"] == 4 ?
															"Nombre de usuario y/o contraseña incorrectos."
														:
															"ERROR"
														)
													)
											)."
										</p>
									</div>
								</div>
							</div>
						";
					}

				?>

			</div>
		</div>
	</div>
	<br>
	

</body>
</html>
<script>

	$(document).ready(function(){

		$('.ui.form').form({
			fields: {
				login: {
					identifier  : 'login',
					rules: [
						{
							type   : 'empty',
							prompt : 'Por favor proporcione un usuario valido.'
						}
					]
				},
				password: {
					identifier  : 'password',
					rules: [
						{
							type   : 'empty',
							prompt : 'Por favor proporcione su contraseña.'
						}
					]
				}
			}
		});

		$('select.dropdown').dropdown();

		$("#area1").transition('fly up', function(){
			$("#area2").transition('fly left', function(){
				if($("#area3").length){
					$("#area3").transition('fly right', function(){
					});
				}
			});
		});
		
	});

</script>