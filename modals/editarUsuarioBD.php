<?php
	session_start();
	include('../class/Usuarios.php');
	$usu = new Usuarios();
	$usu->editarPerfil($_SESSION['usuario_'], $_POST['nombreE'], $_POST['apellidoE']);
?>	