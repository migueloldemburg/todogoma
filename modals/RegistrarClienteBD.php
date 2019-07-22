<?php

	include('../class/Clientes.php');
	$cliente = new Clientes();
	$cliente->registrarCliente($_POST['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['telefono']);
?>	