<?php
session_start();
 function __autoload($nombre_clase)
 {
		require_once '../../class/'.$nombre_clase.'.php';
 }
 
 $principalId = $_GET['principalId'];
 $piezaId = $_GET['piezaId'];
 $idsChecked = $_GET['idsChecked']; //idsChecked todos los modelos asignados a la pieza
 $idsUnchecked = $_GET['idsUnchecked'];//todos los modelos NO asignados a la pieza
 $arrayIdsChecked = explode(",", $idsChecked);
 $arrayIdsUnchecked = explode(",", $idsUnchecked); 
 $asignar = true;
 $desasignar = true;
 
 if($principalId!='' && $piezaId!=''){
		
	foreach($arrayIdsChecked as $modeloIdChecked)
	{
		//echo "checked Modelo: ".$modeloIdChecked."-- principal: ".$principalId." \n ";
		
		if($modeloIdChecked!='' && $modeloIdChecked!=' '){
			$piezaModeloChecked = new Piezas;
			$asignar = $piezaModeloChecked->AsignarModelo($piezaId, $modeloIdChecked, $principalId);
		}
	}	
	
	foreach($arrayIdsUnchecked as $modeloIdUnchecked)
	{
		//echo "Unchecked Modelo: ".$modeloIdUnchecked." \n ";
		
		if($modeloIdUnchecked!='' && $modeloIdUnchecked!=' '){
			$piezaModeloUnchecked = new Piezas;
			$desasignar = $piezaModeloUnchecked->DesasignarModelo($piezaId, $modeloIdUnchecked, $principalId);
		}
	
	}
	
	if(!$asignar){
		echo "Error101 - Problemas al marcar modelo \n ";
	}
	
	if(!$desasignar){
		echo "Error102 - Problemas al desmarcar modelo \n ";
	}
	
	if($asignar && $desasignar){
		echo "true";
	}
 
 }else{
	echo "Error100 - Problemas al identificar la pieza \n ";
 }         
?>
