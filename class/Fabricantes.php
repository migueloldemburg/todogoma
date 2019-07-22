<?php
class Fabricantes{
var $Id;		// int 10
var $Nombre;	// varchar 50
var $Imagen;	// text
//*********************************************************************************************************//

function Fabricantes(){
	$this->conectar();
}

function conectar(){
	require('conexion.php');
	$this->conexion = $conexion;
}

function desconectar(){
	$this->conexion->close();
}

//*********************************************************************************************************//

function registrar($nombre, $imagen){
	$nombre = strtoupper($nombre);

	$insert="INSERT INTO fabricante(id, nombre, imagen) VALUES (
	'".$id."',
	'".$nombre."',
	'".$imagen."')";

	if($this->conexion->query($insert))
	{
		echo '<script language="javascript">alert("Fabricante Registrado Exitosamente");
		location.href="adm_fabricantes.php";</script>';
	}else{
		echo "<script>alert('Problemas al Registrar Fabricante')</script>";
	}

}

//*********************************************************************************************************//

function editar($id, $nombre, $imagen){   

	$update = "UPDATE fabricante SET 
	nombre = '".$nombre."',
	imagen = '".$imagen."'
	WHERE id = ".$id."";

	if($this->conexion->query($update))
	{
		echo '<script language="javascript">
		alert("Fabricante modificado exitosamente!");
		location.href="adm_fabricantes.php";</script>';
	}else{
		echo "<script>alert('Problemas al editar fabricante')</script>";
	}

}

//********************************************************************************************************//

function getFabricante($id){
	$insert = "SELECT * FROM fabricante WHERE id = ".$id."";
	$insert_sql=$this->conexion->query($insert);
	$cant = $insert_sql->num_rows;

	if($cant>0){
		$arreglo = $insert_sql->fetch_assoc();
		$this->Id = $arreglo['id'];
		$this->Nombre = $arreglo['nombre'];
		$this->Imagen = $arreglo['imagen'];
	}
}

//*********************************************************************************************************//

function getId(){
	$insert = "SELECT id FROM fabricante ORDER BY id desc";
	$insert_sql=$this->conexion->query($insert);
	$cant = $insert_sql->num_rows;

	if($cant>0){
		$arreglo = $insert_sql->fetch_assoc();
		$codigo = $arreglo['id'];
		$codigo = $codigo+1;

		return $codigo;

	}else{
		return '1';
	}
}

//*********************************************************************************************************//

function cargarTabla(){
	$insert='SELECT * FROM fabricante';
	//$insert='SELECT * FROM usuario GROUP BY id_tienda';
	$insert_sql = $this->conexion->query($insert);
	$contador = $insert_sql->num_rows;

	$this->sql = $insert_sql;		
}

//*********************************************************************************************************//


}//Fin Clase Fabricantes
?>