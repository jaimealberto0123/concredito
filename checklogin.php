<?php
	
	#error_reporting(E_ALL);
	#ini_set('display_errors', '1');
	include_once("callback_aux.php");
	
	if(!isset($_REQUEST["password"])){
		header("location: index.php?error=2");
	}
	else if(!isset($_REQUEST["login"])){
		header("location: index.php?error=3");
	}
	else if(trim($_REQUEST["password"]) == ""){
		header("location: index.php?error=2");
	}
	else if(trim($_REQUEST["login"]) == ""){
		header("location: index.php?error=3");
	}
	else{
		$user = validate_user($_REQUEST);
		
		if(isset($user["id"])){
			if(trim($user["pass"]) == trim($user["pass2"])){
				get_session($user["id"]);
				header("location: empresa/main.php");
			}
		}
		else{
			header("location: index.php?error=5");
		}
		
	}

?>