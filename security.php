<?php
	session_start();
 	
 	if(isset($_SESSION['nivel_'])){
	 	function __autoload($nombre_clase){
			require_once 'class/'.$nombre_clase.'.php';
	 	}
	 }else{
	 	echo '<script language="javascript">alert("\u00A1Debe iniciar sesi\u00F3n!");location.href="index.php";</script>';
	 	exit(0);
	 }
?>