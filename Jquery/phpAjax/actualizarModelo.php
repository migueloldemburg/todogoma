<?php
session_start();
 function __autoload($nombre_clase)
 {
		require_once '../../class/'.$nombre_clase.'.php';
 }
 
 if($_GET['id_f']!='' && $_GET['id_m']!=''){
	$fabricanteM = new Fabricantes;
	$fabricanteM->getFabricante($_GET['id_f']);

	$_SESSION['fabricanteId_'] = $fabricanteM->Id;
	$_SESSION['fabricanteNombre_'] = $fabricanteM->Nombre;	
////*******************************************************////
	$modeloM = new Modelos;
	$modeloM->getModelo($_GET['id_m']);
	
	$_SESSION['modeloId_'] = $modeloM->Id;
	echo 'true';
}else{
	echo 'false';
}

?>
