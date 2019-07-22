<?php
	session_start();
	function __autoload($nombre_clase)
	{
		require_once '../../class/'.$nombre_clase.'.php';
	}

	$operacion = $_GET['ope'];


	if($_GET['ope']=='sumar')
	{
		if(isset($_SESSION['detalle']) && isset($_GET['id']))
		{
			$id = $_GET['id'];
			$stock = $_GET['stock'];
			if($_SESSION['detalle'][$id]['Cant']<$stock)
			{
				$_SESSION['detalle'][$id]['Cant'] =  $_SESSION['detalle'][$id]['Cant'] + 1;
			}
			echo $_SESSION['detalle'][$id]['Cant'];
		}
	}elseif($_GET['ope']=='restar')
	{
		if(isset($_SESSION['detalle']) && isset($_GET['id']))
		{
			$id = $_GET['id'];
			if($_SESSION['detalle'][$id]['Cant']!=1)
			{
				$_SESSION['detalle'][$id]['Cant'] =  $_SESSION['detalle'][$id]['Cant'] - 1;
			}
			echo $_SESSION['detalle'][$id]['Cant'];
		}
	}else{
		echo '0';
	}

?>