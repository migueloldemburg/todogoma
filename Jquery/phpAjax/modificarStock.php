<?php
session_start();
function __autoload($nombre_clase){
	require_once '../../class/'.$nombre_clase.'.php';
}
 
$datos = array();
$datos["error"] = false;
$datos["msg"] = "";


if(!isset($_POST['piezaId']) || !isset($_POST['nuevoPrecio']) || !isset($_POST['nuevaCant'])){
	$datos["error"] = true;
	$datos["msg"] = "Inconsistencia de datos.";
	echo json_encode($datos);
	exit(0);
}

//*** QUITA PUNTOS y el BSF. DE EL MONTO ASIGNADO POR MASCARA**/////

$precio = str_replace('.', '', $_POST['nuevoPrecio']);
$precio = str_replace(',', '.', $precio);
 
$pieza = new Piezas;
$modificaStock = $pieza->modificarStock($_SESSION['tiendaId_'], $_POST['piezaId'], $precio, $_POST['nuevaCant']);

if($modificaStock){
	$res = $pieza->cargarPiezaData($_POST['piezaId'], $_SESSION['tiendaId_']);
	if(count($res) > 0){
		$datos["cantidad"] = $res["cant"];
	}
	$datos["precio"] = $_POST['nuevoPrecio'];
	$datos["msg"] = "Datos actualizados";
	$datos["id"] = $_POST['piezaId'];
	echo json_encode($datos);
}else{
	$datos["error"] = true;
	$datos["msg"] = "Problemas al actualizar";
	echo json_encode($datos);
}

exit(0);
?>

