<?php
class Modelos
{
   var $Id;			// int 10
   var $Id_marca;	// int 10
   var $Nombre;		// varchar 100
   var $Ano;		// varchar 30
   var $Imagen;		// text
   
//*********************************************************************************************************//
   
   function Modelos()
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
   
   function registrar($id_marca, $nombre, $ano, $imagen)
   {
	   $nombre = strtoupper($nombre);
	   	   
	   $insert="INSERT INTO modelo(id, id_marca, nombre, ano, imagen) VALUES (
	   '".$id."',
	   '".$id_marca."',
	   '".$nombre."',
	   '".$ano."',
	   '".$imagen."')";
		
		if($insert_sql=$this->conexion->query($insert) )
		{
			echo '<script language="javascript">alert("Modelo de Carro Registrado Exitosamente");
					location.href="adm_modelos.php";</script>';
		}else{
			echo "<script>alert('Problemas al Registrar Modelode Carro')</script>";
		}
	   
   }
   
//*********************************************************************************************************//

 function editar($id, $id_marca, $nombre, $ano, $imagen)
   {   
	   $nombre = strtoupper($nombre);
   		   
	   $update = "UPDATE modelo SET 
	   id_marca = '".$id_marca."',
	   nombre = '".$nombre."',
	   ano = '".$ano."',
	   imagen = '".$imagen."'
	   WHERE id = ".$id."";
		
		if($insert_sql=$this->conexion->query($update) )
		{
				 echo '<script language="javascript">
				 alert("Modelo modificado exitosamente!");
				 location.href="adm_modelos.php";</script>';
		}else{
			echo "<script>alert('Problemas al editar modelo')</script>";
		}
	   
   }
   
//********************************************************************************************************//

	function getModelo($id)
	{
	   $insert = "SELECT * FROM modelo WHERE id = '".$id."'";
	   $insert_sql = $this->conexion->query($insert);
	   $contador = $insert_sql->num_rows;
	   
	   if($contador>0){
		   $array = $insert_sql->fetch_assoc();
		   $this->Id = $array['id'];
		   $this->Id_marca = $array['id_marca'];
		   $this->Nombre = $array['nombre'];
		   $this->Ano = $array['ano'];
		   $this->Imagen = $array['imagen'];

	   }else{
		   $this->error = 'El modelo '.$id.' no existe en Base de Datos';
	   } 
	   
   }
   
//*********************************************************************************************************//

function getModeloPrincipal($id_pieza)
	{
	   $insert = "SELECT pieza_modelo. * , modelo. * , fabricante.nombre AS nombreMarca FROM pieza_modelo INNER JOIN modelo ON pieza_modelo.id_modelo = modelo.id INNER JOIN fabricante ON fabricante.id = modelo.id_marca WHERE principal = 1 AND id_pieza = ".$id_pieza."";
	   $insert_sql = $this->conexion->query($insert);
	   $this->contador = $insert_sql->num_rows;
	   
	   if($this->contador>0){
		   $array = $insert_sql->fetch_assoc();
		   $this->Id = $array['id'];
		   $this->Id_marca = $array['id_marca'];
		   $this->NombreMarca = $array['nombreMarca'];
		   $this->Nombre = $array['nombre'];
		   $this->Ano = $array['ano'];
		   $this->Imagen = $array['imagen'];
		   $this->Principal = $array['principal'];

	   }else{
		   $this->error = 'Sin modelo princiapal';
	   } 
	   
   }
   
//*********************************************************************************************************// 

  function getId()
  {
	 $insert = "SELECT id FROM modelo ORDER BY id desc";
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
	    $insert='SELECT * FROM modelo ORDER BY id_marca, nombre ASC';
	    $insert_sql = $this->conexion->query($insert);
		
		$this->sql = $insert_sql;		
	}
	
//*********************************************************************************************************//

function cargarModeloxMarca($id_marca)
	{
	    $insert='SELECT * FROM modelo WHERE id_marca = '.$id_marca.' ORDER BY nombre ASC';
	    $insert_sql = $this->conexion->query($insert);
		
		$this->sql = $insert_sql;		
	}
	
//*********************************************************************************************************//

	function getModelos($piezaId)
	{
		$select = "SELECT pm.principal, f.nombre AS marca, m.nombre, m.ano
		FROM pieza_modelo AS pm, modelo AS m, fabricante AS f
		WHERE pm.id_pieza = ".$piezaId."
		AND pm.id_modelo = m.id
		AND m.id_marca = f.id
		ORDER BY principal DESC";

	    $query_select = $this->conexion->query($select);
		$count = $query_select->num_rows;

		if($count>0)
		{
			$arr = $query_select->fetch_assoc();
			$this->MPMarca = $arr['marca'];
			$this->MPNombre = $arr['nombre'];
			$this->MPAno = $arr['ano'];
			$this->sql = $query_select;
		}
	}
	
//*********************************************************************************************************//
   
}//Fin Clase Modelos
?>