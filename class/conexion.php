<?php
	$db_server			= "localhost"; 
	$db_username		= "root"; 
	$db_password		= "root";
	$db_name			= "todogoma"; 

	// Credenciales de envio de correo
	$email = "";
    $password = "";

	$conexion = new mysqli($db_server, $db_username, $db_password, $db_name);

	$conexion->set_charset("utf8");
	date_default_timezone_set('America/Caracas');
	
	if($conexion->connect_error) {
	   die("Connection failed: ".$conexion->connect_error);
	}
?>