<?php
	session_start();
	include('../class/Piezas.php');
	$data = array();
	$data['error'] = false;
	$data['msg'] = "";
	
	//pasa por post id de pieza
	if(!empty($_POST['id'])){
		$pieza = new Piezas;
    	$res = $pieza->cargarPiezaData($_POST['id'], $_SESSION['tiendaId_']);
    	if(count($res)>0){
    		$res['precio'] = number_format($res['precio'], 2, ",", ".");
    		$data['pieza'] = $res;
    	}else{
    		$data['error'] = true;
			$data['msg'] = "No se encuentra el id especificado";	
    	}
    }else{
    	$data['error'] = true;
		$data['msg'] = "No se ha recibido el id";
    }

    echo json_encode($data);
?>	