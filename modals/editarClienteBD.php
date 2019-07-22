<?php
	include('../class/Clientes.php');
	$cliente = new Clientes();
	$cliente->editarCliente($_POST['newCedula0'], $_POST['oldCedula0'], $_POST['nombre0'], $_POST['apellido0'], $_POST['direccion0'], $_POST['telefono0']);
?>	