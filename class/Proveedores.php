<?php
class Proveedores
{
   var $Id;			// int 10
   var $Rif;		   // varchar 10
   var $Razon_social;// varchar 50
   var $direccion;  // text
   var $telefono1;	// varchar30
   var $telefono2;	// varchar30

//*********************************************************************************************************//
   
   function Proveedores()
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
   
   function registrar($rif, $razon_social, $direccion, $telefono1, $telefono2)
   {
   	   $razon_social = strtoupper($razon_social);
	   $direccion = strtoupper($direccion);
	   	   	   
	   $insert="INSERT INTO proveedor(rif, razon_social, direccion, telefono1, telefono2) VALUES (
       '".$rif."',
	   '".$razon_social."',
	   '".$direccion."',
	   '".$telefono1."',
	   '".$telefono2."')";
		
		if($insert_sql=$this->conexion->query($insert) )
		{
			echo "<script language='javascript'>alert('Proveedor Registrado Exitosamente');
					location.href='adm_proveedores.php'</script>";
		}else{
			echo "<script>alert('Problemas al Registrar Proveedor')</script>";
		}
	   
   }
   
//********************************************************************************************************//

	function editar($id, $rif, $razon_social, $direccion, $telefono1, $telefono2)
   {   
   
	   $update = "UPDATE proveedor SET 
	   rif = '".$rif."',
	   razon_social = '".$razon_social."',
	   direccion = '".$direccion."',
	   telefono1 = '".$telefono1."',
       telefono2 = '".$telefono2."'
	   WHERE id = ".$id."";
		
		if($insert_sql=$this->conexion->query($update) )
		{
				 echo '<script language="javascript">
				 alert("Proveedor modificado exitosamente!");
				 location.href="adm_proveedores.php";</script>';
		}else{
			echo "<script>alert('Problemas al editar proveedor')</script>";
		}
	   
   }
   
//********************************************************************************************************//

	function getProveedor($id)
	{
	   $insert = "SELECT * FROM proveedor WHERE id = ".$id."";
	   $insert_sql = $this->conexion->query ($insert);
	   $contador = $insert_sql->num_rows;
	   
	   if($contador>0){
		   $array = $insert_sql->fetch_assoc();
		   $this->Id = $array['id'];
		   $this->Rif = $array['rif'];
		   $this->Razon_social = $array['razon_social'];
		   $this->Direccion = $array['direccion'];
		   $this->Telefono1 = $array['telefono1'];
		   $this->Telefono2 = $array['telefono2'];
		   
	   }else{
		   $this->error = 'El proveedor '.$id.' no existe en Base de Datos';
	   } 
	   
   }
   
//*********************************************************************************************************// 

 function getId()
  {
	 $insert = "SELECT id FROM proveedor ORDER BY id desc";
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
	    $insert='SELECT * FROM proveedor';
		//$insert='SELECT * FROM usuario GROUP BY id_tienda';
	    $insert_sql = $this->conexion->query($insert);
	 	$contador = $insert_sql->num_rows;

		$this->sql = $insert_sql;		
	}
	
//*********************************************************************************************************//


}//Fin Clase Proveedor
?>