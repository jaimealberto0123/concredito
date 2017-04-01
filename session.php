<?php
	#session_start();
	#$_SESSION["session"] = 1;
	if($_SESSION["session"] == ""){
		header("location: ../index.php?error=6");
	}
	else{
		echo "
			<div style='display: none;'>
				<form id='session' name='session'>
					<input type='hidden' id='data-session' name='data-session' value='".$_SESSION["session"]."'>
				</form>
			</div>
		";
		session_destroy();
	}
	
?>