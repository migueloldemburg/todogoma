<?php
session_start();
function __autoload($nombre_clase)
{
	require_once 'class/'.$nombre_clase.'.php';
}
 
if(isset($_GET['fab']) && $_GET['fab']!=''){
	$fabricanteS = new Fabricantes;
	$fabricanteS->getFabricante($_GET['fab']);
	
	$_SESSION['fabricanteId_'] = $fabricanteS->Id;
	$_SESSION['fabricanteNombre_'] = $fabricanteS->Nombre;
	echo "<script>location.href='catalogueB.php'</script>";
}

if(isset($_GET['mod']) && $_GET['mod']!=''){
	$_SESSION['modeloNombre_'] = $_GET['mod'];
	echo "<script>location.href='catalogueC.php'</script>";
}

if(isset($_GET['mod_id']) && $_GET['mod_id']!=''){
	$modeloS = new Modelos;
	$modeloS->getModelo($_GET['mod_id']);

	$_SESSION['modeloId_'] = $modeloS->Id;
	echo "<script>location.href='catalogueD.php'</script>";
}


?>