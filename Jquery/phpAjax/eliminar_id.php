<?php
session_start();
require('../../class/conexion.php');
sleep(0);

$insert = "DELETE FROM ".$_GET['tipo']." WHERE id = ".$_GET['id']."";

if($insert_sql=$conexion->query($insert))
{
	echo 'ok';
}else{
	echo 'Esta opcion se ha deshabilitado temporalmente debido a que puede crear inconsistencia al querer hacer referencia a esta entidad en el futuro. Para mas informacion contacte al administrador de sistema';
}
?>