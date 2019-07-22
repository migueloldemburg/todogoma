<?php
session_start();
require('../../class/conexion.php');
sleep(0);

$update = "UPDATE usuario SET estado = ".$_GET['estado']." WHERE usuario = '".$_GET['usuario']."'";



if($insert_sql=$this->conex->query($update))
{
	echo 'ok';
}else{
	echo 'Problemas al actualizar';
}
?>