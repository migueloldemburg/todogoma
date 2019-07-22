<?php
class Catalogos
{

//*********************************************************************************************************//

	function Catalogos()
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
	function listarMarcas()
	{
		$sql = 'SELECT * FROM fabricante ORDER BY nombre ASC';
		$insert_sql = $this->conexion->query($sql);
		$counter = $insert_sql->num_rows;
		$this->sql = $insert_sql;
	}


//*********************************************************************************************************//

	function listarNombreModelos($id_fab)
	{
		$sql = "SELECT DISTINCT SUBSTRING_INDEX( modelo.nombre,  ' ', 1 ) AS nombre, modelo.id_marca FROM modelo INNER JOIN fabricante ON fabricante.id = modelo.id_marca AND fabricante.id =".$id_fab." ORDER BY nombre";
		$insert_sql = $this->conexion->query($sql);
		$counter = $insert_sql->num_rows;
		$this->sql = $insert_sql;
		$this->counter = $counter;

	}

//*********************************************************************************************************//

	function listarModelos($id_fab, $nombreModelo)
	{
		$sql = "SELECT SUBSTRING_INDEX( modelo.ano,  '-', 1 ) AS anno, fabricante.nombre AS nombreFabricante, modelo. * FROM modelo INNER JOIN fabricante ON fabricante.id = modelo.id_marca AND SUBSTRING_INDEX( modelo.nombre,  ' ', 1 ) =  '".$nombreModelo."' WHERE fabricante.id = ".$id_fab." ORDER BY anno DESC";
		$insert_sql = $this->conexion->query($sql);
		$counter = $insert_sql->num_rows;
		$this->sql = $insert_sql;
		$this->counter = $counter;

	}

//*********************************************************************************************************//

}//Fin Clase Catalogos
?>