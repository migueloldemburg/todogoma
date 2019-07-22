<?php 
session_start();
function __autoload($nombre_clase)
{
	require_once 'class/'.$nombre_clase.'.php';
}

$cliente = $_GET['cliente'];
$refPago = $_GET['refPago'];
$comentario = $_GET['comentario'];

$factura = new Facturas();
$compra = $factura->generarFactura($cliente, $refPago, $comentario);

if($compra){
	echo "<script>location.href='checkSuccess.php?cod=".$factura->codigo."'</script>";
}else{
	echo "<script>location.href='checkClient.php'</script>";
}

?>