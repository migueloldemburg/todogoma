<?php
require_once('Piezas.php');
require_once('Tasas.php');
class Facturas
{
   var $Codigo;		// int 11
   var $Id_cliente;	// varchar 12
   var $Id_usuario;	// varchar 8
   var $Id_tienda;	// int 10
   var $Fecha;		// date
   var $Referencia;	// varchar 80
   var $Comentario;	// text
 

//*********************************************************************************************************//
   function Facturas()
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
   
   function generarFactura($cliente, $refPago, $comentario)
   {	   	 

   	   
   	    //*** PROCESAR FECHA PARA FORMATO DE BASE DE DATOS **//
   		
   	   $fecha = date("d-m-Y h:i:s");
	   $fecha = date('Y-m-d h:i:s', strtotime($fecha));
   	   $tienda = $_SESSION['tienda_'];
   	   $usuario = $_SESSION['usuario_'];
   	   $comentario = strtoupper($comentario);

   	   $_SESSION['productosAA'] = '';
   	   $comprar = true;

   	   foreach($_SESSION['detalle'] as $key=>$carrito)
		{
			$pieza = new Piezas();
			$pieza->checkStock($carrito['Pieza'], $tienda);

			if($pieza->cant >= $carrito['Cant']){
				
			}else{
				$comprar = false;
				$_SESSION['productosAA'] = $_SESSION['productosAA']."<tr><td>".$pieza->Ref."</td><td>".$pieza->cant."<td></tr>";
			}
		}

		if($comprar)
		{
			if (isset($_SESSION['productosAA']))
			{
				unset($_SESSION['productosAA']);
			}
			$success = true;
			$insert = "INSERT INTO factura (id_cliente, id_usuario, id_tienda, fecha, refPago, comentario) VALUES (
		   '".$cliente."',
		   '".$usuario."',
	   	   ".$tienda.",
		   '".$fecha."',
		   '".$refPago."',
		   '".$comentario."')";
		   
			
			if($sql_insert=$this->conexion->query($insert) )
			{
				//para obtener la ultima factura (codigo)
				$rs = $this->conexion->query("SELECT MAX(codigo) AS codigo FROM factura");
				if ($row = $rs->fetch_assoc()) {
					$codigo = trim($row['codigo']); //ultimo codigo de factura
				}
				
				foreach($_SESSION['detalle'] as $key=>$carrito)
				{
					$pieza = new Piezas();
					$pieza->checkStock($carrito['Pieza'], $tienda);

					//Iniciar objeto tasa para colocar los precios.
	                $tasa = new Tasas();
	                $tasa->getLast();
	                $tasa->convertPricetoBolivares($pieza->precio);

					$insert2 = "INSERT INTO factura_detalle (id_factura, id_pieza, cantidad, precio) VALUES (
					".$codigo.",
					".$carrito['Pieza'].",
					".$carrito['Cant'].",
					".$tasa->precio.")";
					

					if($sql_insert2=$this->conexion->query($insert2))
					{
						//restamos del stock las que se estan comprando...
						$newStock = $pieza->cant - $carrito['Cant'];

						$update = "UPDATE pieza_tienda SET
									cant = ".$newStock."
									WHERE id_tienda = ".$tienda."
									AND id_pieza = ".$carrito['Pieza']."";
						
						if($sql_update=$this->conexion->query($update)){
							$this->codigo = $codigo;
						}else{
							$success=false;
						}
					}else{
						$success=false;
						$this->error = "Ha Ocurrido un error. Intentelo nuevamente.";
					}
				}

			}else{
				$this->error = "Ha ocurrido un problema, Intentelo de nuevo!";
				$success=false;
			}
			if($success){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
   }

//*********************************************************************************************************//

	function getFactura($codigo)
	{
	    $select="SELECT f.codigo, f.id_usuario, f.fecha, f.refPago, f.comentario, c.nombre AS clienteNombre, c.apellido AS clienteApellido, c.cedula AS clienteCedula, c.telefono AS clienteTelefono, t.nombre AS tiendaNombre, t.ciudad As tiendaCiudad
			FROM factura AS f
			INNER JOIN cliente AS c ON f.id_cliente = c.cedula
			INNER JOIN tienda AS t ON f.id_tienda = t.id
			AND f.codigo =".$codigo."";

	    $sql_select = $this->conexion->query($select);
		
		$arreglo = $sql_select->fetch_assoc();

	    $this->Codigo = $arreglo['codigo'];
	    $this->Id_usuario = $arreglo['id_usuario'];
	    $this->Fecha = $arreglo['fecha'];
	    $this->RefPago = $arreglo['refPago'];
	    $this->Comentario = $arreglo['comentario'];
	    $this->ClienteNombre = $arreglo['clienteNombre'];
	    $this->ClienteApellido = $arreglo['clienteApellido'];
	    $this->ClienteCedula = $arreglo['clienteCedula'];
	    $this->ClienteTelefono = $arreglo['clienteTelefono'];
	    $this->TiendaNombre = $arreglo['tiendaNombre'];
	    $this->TiendaCiudad= $arreglo['tiendaCiudad'];
		
	    
	}
   
//*********************************************************************************************************//

	function cargarFacturasxMes($mes, $ano, $tienda)
	{
	    $select="SELECT f.codigo, f.id_usuario,f.id_cliente, t.nombre, t.estado, t.ciudad, f.fecha, f.comentario
				 FROM factura AS f
				 LEFT JOIN tienda AS t ON t.id = f.id_tienda
				 WHERE  (MONTH(f.fecha)=".$mes." AND YEAR(f.fecha)=".$ano.") AND f.id_tienda = ".$tienda." ORDER BY f.codigo DESC";
				 //echo $select;
	    $sql_select = $this->conexion->query($select);
		
		$this->sql = $sql_select;		
	}

//*********************************************************************************************************//

	function cargarFacturasxRango($fecha1, $fecha2, $tienda)
	{
	    $select="SELECT f.codigo, f.id_usuario,f.id_cliente, t.nombre, t.estado, t.ciudad, f.fecha, f.comentario
				 FROM factura AS f
				 LEFT JOIN tienda AS t ON t.id = f.id_tienda
				 WHERE (CAST(f.fecha AS DATE) BETWEEN '".$fecha1."' AND '".$fecha2."') AND f.id_tienda = ".$tienda." ORDER BY f.codigo DESC";
				//echo $select;
	    $sql_select = $this->conexion->query($select);
		
		$this->sql = $sql_select;
	}

//********************************************************************************************************//

	function detallarFactura($codigo)
	{
	    $select="SELECT *
				 FROM factura_detalle
				 WHERE id_factura = ".$codigo."";
	    $sql_select = $this->conexion->query($select);
		
		$this->sql = $sql_select;		
	}

//********************************************************************************************************//

}//Fin Clase Tiendas
?>