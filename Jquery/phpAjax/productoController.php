<?php
	session_start();
	function __autoload($nombre_clase)
	{
		require_once '../../class/'.$nombre_clase.'.php';
	}

	$operacion = $_GET['operacion'];
	
	if($operacion=='agregar' && isset($_GET['pieza']) && isset($_GET['cant']) && isset($_SESSION['tienda_']))
	{
		
		$piezaId = $_GET['pieza'];
		$cant = $_GET['cant'];
		$tienda = $_SESSION['tienda_'];
		
		if(count($_SESSION['detalle'])>0)
		{
			$ultimo = end($_SESSION['detalle']);
			$count = $ultimo['Id']+1;
		}else{
			$count = count($_SESSION['detalle'])+1;
		}

		$_SESSION['detalle'][$count] =  array ('Id'=>$count, 'Pieza'=>$piezaId, 'Cant'=>$cant);
		echo "<script>alertify.success('Agregado Exitosamente');actualizarShoppingCart(".count($_SESSION['detalle']).")</script>";	
	}
?>