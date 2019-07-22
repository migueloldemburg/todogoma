<?php
class Tiendas
{
   var $Id;			// int 10
   var $Nombre;		// varchar 100
   var $Estado;		// varchar 30
   var $Ciudad;		// varchar 30
   var $Ubicacion;  // text
   var $Telefono;	// varchar30

//*********************************************************************************************************//
   function Tiendas()
   {
	   $this->conectar();
   }
	
   function conectar()
   {
	  require('conexion.php');
	  $this->conexion = $conexion;
   }
   
   function desconectar()
   {
	   $this->conexion->close();
   }
//*********************************************************************************************************//
   
   function registrar($nombre, $estado, $ciudad, $ubicacion, $telefono)
   {
	   $nombre = strtoupper($nombre);
	   $ciudad = strtoupper($ciudad);
	   $ubicacion = strtoupper($ubicacion);
	   	   	   
	   $insert="INSERT INTO tienda (nombre, estado, ciudad, ubicacion, telefono) VALUES (
       '".$nombre."',
	   '".$estado."',
   	   '".$ciudad."',
	   '".$ubicacion."',
	   '".$telefono."')";
		
		if($insert_sql=$this->conexion->query($insert) )
		{
			echo "<script language='javascript'>alert('Tienda Registrada Exitosamente');
					location.href='adm_tiendas.php';</script>";
		}else{
			echo "<script>alert('Problemas al Registrar Tienda')</script>";
		}
	   
   }
   
//********************************************************************************************************//

   function editar($id, $nombre, $estado, $ciudad, $ubicacion, $telefono)
   {   
   		   
	   $update = "UPDATE tienda SET 
	   nombre = '".$nombre."',
	   estado = '".$estado."',
	   ciudad = '".$ciudad."',
	   ubicacion = '".$ubicacion."',
	   telefono = '".$telefono."'
	   WHERE id = ".$id."";
		
		if($insert_sql=$this->conexion->query($update) )
		{
				 echo '<script language="javascript">
				 alert("Tienda modificada exitosamente!");
				 location.href="adm_tiendas.php";</script>';
		}else{
			echo "<script>alert('Problemas al editar tienda')</script>";
		}
	   
   }
   
//********************************************************************************************************//

	function getTienda($id)
	{
	   $insert = "SELECT * FROM tienda WHERE id = ".$id."";
	   $insert_sql = $this->conexion->query ($insert);
	   $contador = $insert_sql->num_rows;
	   
	   if($contador>0){
		   $array = $insert_sql->fetch_assoc();
		   $this->Id = $array['id'];
		   $this->Nombre = $array['nombre'];
		   $this->Estado = $array['estado'];
		   $this->Ciudad = $array['ciudad'];
		   $this->Ubicacion = $array['ubicacion'];
		   $this->Telefono = $array['telefono'];

	   }else{
		   $this->error = 'La tienda'.$id.' no existe en Base de Datos';
	   } 
	   
   }
   
//*********************************************************************************************************// 

  function getId()
  {
	 $insert = "SELECT id FROM tienda ORDER BY id desc";
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
   
	function cargarTabla()
	{
	    $insert="SELECT * FROM tienda";
		//$insert='SELECT * FROM usuario GROUP BY id_tienda';
	    $insert_sql = $this->conexion->query($insert);
	 	$contador = $insert_sql->num_rows;

		$this->sql = $insert_sql;
	}
	
//*********************************************************************************************************//


}//Fin Clase Tiendas
?>