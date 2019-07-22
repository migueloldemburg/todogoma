<?php
class Piezas
{
   var $Id;			 // int 10
   var $Id_proveedor;// int 10
   var $Oem;		 // varchar 30
   var $Ref;		 // varchar 30
   var $Marca;		 // varchar 30
   var $Nombre;		 // varchar 100
   var $Descripcion; // text
   var $Componente;	 // varchar 50
   var $Direccion;	 // varchar 30
   var $Imagen;		 // text
   var $Img_esquema; // text
   
//*********************************************************************************************************//
   
   function Piezas()
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
   
   function registrar($id_proveedor, $oem, $ref, $marca, $nombre, $descripcion, $componente, $direccion, $imagen, $img_esquema)
   {
	   $ref = strtoupper($ref);
	   $marca = strtoupper($marca);
	   $nombre = strtoupper($nombre);
	   $descripcion = strtoupper($descripcion);
	   $componente = strtoupper($componente); 
	   $direccion = strtoupper($direccion);
	   	   
	   $insert="INSERT INTO pieza(id_proveedor, oem, ref, marca, nombre, descripcion, componente, direccion, imagen, img_esquema) VALUES (
	   ".$id_proveedor.",
	   '".$oem."',
	   '".$ref."',
	   '".$marca."',
	   '".$nombre."',
       '".$descripcion."',
	   '".$componente."',
	   '".$direccion."',
	   '".$imagen."',
	   '".$img_esquema."')";
	    
	    $this->conexion->set_charset("utf8");
		if($insert_sql=$this->conexion->query($insert) )
		{			
			$id = $this->getId();
			$id = $id-1;
			
			$tiendas = new Tiendas;
			$tiendas->cargarTabla();
			$precio = 0.00;
			$cant = 0;
			
			while($array = $tiendas->sql->fetch_assoc())
			{
				$insert="INSERT INTO pieza_tienda(id_tienda, id_pieza, precio, cant) VALUES (
				".$array['id'].",
				".$id.",
				".$precio.",
				".$cant.")";
				
				$insert_sql=$this->conexion->query($insert);
			}
						
			echo "<script language='javascript'>alert('Articulo Registrado Exitosamente');
					location.href='reg_pieza2.php?id=".$id."';</script>";
					
		}else{
			echo "<script>alert('Problemas al Registrar Articulo')</script>";
		}
	   
   }
   
//*********************************************************************************************************//

   function editar($id, $id_proveedor, $oem, $ref, $marca, $nombre, $descripcion, $componente, $direccion, $imagen, $img_esquema)
   {
	   
	   $ref = strtoupper($ref);
	   $marca = strtoupper($marca);
	   $nombre = strtoupper($nombre);
	   $descripcion = strtoupper($descripcion);
	   $componente = strtoupper($componente);
	   $direccion = strtoupper($direccion);
	      
	   $update = "UPDATE pieza SET
	   id_proveedor = ".$id_proveedor.",
	   oem = '".$oem."',
	   ref = '".$ref."',
	   marca = '".$marca."',
	   nombre = '".$nombre."',
	   descripcion = '".$descripcion."',
	   componente = '".$componente."',
	   direccion = '".$direccion."',
	   imagen = '".$imagen."',
	   img_esquema = '".$img_esquema."'
	   WHERE id = ".$id."";
 
		if($insert_sql=$this->conexion->query($update) )
		{
			
			echo '<script language="javascript">
			alert("Articulo modificado exitosamente!");
			location.href="adm_piezas.php";</script>';
		}else{
			echo "<script>alert('Problemas al editar el articulo')</script>";
		}
	   
   }
   
//********************************************************************************************************//

function getPieza($id)
	{
	   $insert = "SELECT * FROM pieza WHERE id = '".$id."'";
	   $insert_sql = $this->conexion->query ($insert);
	   $contador = $insert_sql->num_rows;
	   
	   if($contador>0){
		   $array = $insert_sql->fetch_assoc();
		   $this->Id = $array['id'];
		   $this->Id_proveedor = $array['id_proveedor'];
		   $this->Oem = $array['oem'];
		   $this->Ref = $array['ref'];
		   $this->Marca = $array['marca'];
		   $this->Nombre = $array['nombre'];
		   $this->Descripcion = $array['descripcion'];
		   $this->Componente = $array['componente'];
		   $this->Direccion = $array['direccion'];
		   $this->Imagen = $array['imagen'];
		   $this->Img_esquema = $array['img_esquema'];

	   }else{
		   $this->error = 'El articulo '.$id.' no existe en Base de Datos';
	   } 
	   
   }
   
//*********************************************************************************************************// 
 
   function getId()
  {
	 $insert = "SELECT id FROM pieza ORDER BY id desc";
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
	    $insert='SELECT * FROM pieza ORDER BY id';
	    $insert_sql = $this->conexion->query($insert);
		
		$this->sql = $insert_sql;		
	}
	
//*********************************************************************************************************//

	function AsignarModelo($pieza, $modelo, $principal)
	{
		//Seleccionamos de la BD a ver si existe la relacion Modelo-Pieza
		$select = "SELECT principal, id_modelo FROM pieza_modelo WHERE id_pieza = ".$pieza." AND id_modelo = ".$modelo."";

		if($query_select = $this->conexion->query($select))
		{
			$count = $query_select->num_rows;
			
			if($count>0)
			{
				//Existe la relacion Modelo-Pieza en BD,
				//echo "Ya este modelo estaba registrado \n ";
				$array = $query_select->fetch_assoc();
				
				if($array['principal']!=$principal)
				{
					if($array['principal']==1 && $principal==0)
					{
						//estamos tildando un modelo secundario que es modelo principal, no pasa nada.
						//echo "Modelo Secundario que es Principal tambien";
						return 'true';
					}else{
						if($array['principal']==0  && $principal==1)
						{
							//Convertimos un modelo secundario a principal. Se actualiza el principal a 1
							//Primero chequeamos si ya habia un modelo principal, si habia se vuelve 0, sino
							// guardamos el nuevo

							$select = "SELECT id_modelo FROM pieza_modelo WHERE id_pieza=".$pieza." AND principal = 1";
							$query_select = $this->conexion->query($select);
							$count = $query_select->num_rows;
							$array = $query_select->fetch_assoc();
							
							if($count>0){
								//echo "Hubo uno antes \n";
								$update = "UPDATE pieza_modelo SET principal = 0 WHERE id_pieza = ".$pieza." AND id_modelo = ".$array['id_modelo']."";
								
								if($query_update = $this->conexion->query($update))
								{
									$update = "UPDATE pieza_modelo SET principal = 1 WHERE id_pieza = ".$pieza." and id_modelo = ".$modelo."";
									
									if($query_update = $this->conexion->query($update))
									{
										//echo "Se actualizo el modelo:".$modelo." a la pieza:".$pieza." con principal:".$principal." \n";
										return 'true';
									}else{
										return 'false';
									}
								}else{
									return 'false';
								}
							}else{
								//echo "No habia un modelo principal asignado antes";
								$update = "UPDATE pieza_modelo SET principal = 1 WHERE id_pieza = ".$pieza." and id_modelo = ".$modelo."";
									
									if($query_update = $this->conexion->query($update))
									{
										//echo "Se actualizo el modelo:".$modelo." a la pieza:".$pieza." con principal:".$principal." \n";
										return 'true';
									}else{
										return 'false';
									}
							}
						}
					}
										
				}else{
					//echo "El principal es el mismo \n";					
					if($array['principal']=1 && $principal==1 && $array['id_modelo']!=$modelo)
					{
					}
					
					return 'true';					
				}
				
			}else{
							
				//El modelo no esta asignado a ninguna pieza
				if($principal==1)
				{
					///////
					//Se esta asignando un modelo principal, no existia relacion para este modelo antes
					//Primero chequeamos si ya habia un modelo principal, si habia se vuelve 0, sino
					// guardamos el nuevo

					$select = "SELECT id_modelo FROM pieza_modelo WHERE id_pieza=".$pieza." AND principal = 1";
					$query_select = $this->conexion->query($select);
					$count = $query_select->num_rows;
					$array = $query_select->fetch_assoc();
					
					if($count>0){
						//echo "Hubo uno antes \n";
						$update = "UPDATE pieza_modelo SET principal = 0 WHERE id_pieza = ".$pieza." AND id_modelo = ".$array['id_modelo']."";
						
						if($query_update = $this->conexion->query($update))
						{
							$insert = "INSERT INTO pieza_modelo(id_pieza, id_modelo, principal) VALUES(
							".$pieza.",
							".$modelo.",
							".$principal.")";
							
							if($query_insert = $this->conexion->query($insert))
							{
								//echo "Se registro el modelo:".$modelo." a la pieza:".$pieza." con principal:".$principal." \n";
								return 'true';
							}else{
								return 'false';
							}
						}else{
							return 'false';
						}
					}else{
						//echo "No habia un modelo principal asignado antes";
						$insert = "INSERT INTO pieza_modelo(id_pieza, id_modelo, principal) VALUES(
						".$pieza.",
						".$modelo.",
						".$principal.")";
						
						if($query_insert = $this->conexion->query($insert))
						{
							//echo "Se registro el modelo:".$modelo." a la pieza:".$pieza." con principal:".$principal." \n";
							return 'true';
						}else{
							return 'false';
						}
					}
						
				///////
				}else{
					$insert = "INSERT INTO pieza_modelo(id_pieza, id_modelo, principal) VALUES(
					".$pieza.",
					".$modelo.",
					".$principal.")";
					
					if($query_insert = $this->conexion->query($insert))
					{
						//echo "Se registro el modelo:".$modelo." a la pieza:".$pieza." con principal:".$principal." \n";
						return 'true';
					}else{
						return 'false';
					}
				}
			}
			
		}else{
			return 'false';
		}
	
	}
	
//*********************************************************************************************************//

	function DesasignarModelo($pieza, $modelo, $principal)
	{
		//Seleccionamos de la BD a ver si existe la relacion Modelo-Pieza (deberia, fue destildado, o nunc lo estuvo)
		$select = "SELECT principal, id_pieza, id_modelo FROM pieza_modelo WHERE id_pieza = ".$pieza." AND id_modelo = ".$modelo."";

		if($query_select = $this->conexion->query($select))
		{
			$count = $query_select->num_rows;
			
			if($count>0)
			{
				//existe la relacion Modelo-Pieza en BD,
				//tomamos el valor principal y comprobamos si es un modelo principal o solo compatible.
				//echo "existe ya registrado \n ";
				$array = $query_select->fetch_assoc();
				
				if($array['principal']==0)
				{
					//Si es 0 (solo compatible) se elimina
					//echo "se elimino modelo: ".$array['id_modelo']." \n ";
					$delete = "DELETE FROM pieza_modelo WHERE 
					id_pieza = ".$pieza." AND 
					id_modelo = ".$modelo." AND
					principal = 0";
					
					if($query_delete = $this->conexion->query($delete))
					{ return 'true';
					}else{ return 'false';
					}					
				}else{
					if($array['principal']==1)
					{
						//Si es 1 (modelo principal) se actualiza a 0 (modelo solo compatible) 
						//echo "se actualizo a 0 \n " ;
						$update = "UPDATE pieza_modelo SET
						principal = 0 WHERE
						id_pieza = ".$pieza." AND 
						id_modelo = ".$modelo."";
						
						if($query_update = $this->conexion->query($update))
						{ return 'true';
						}else{ return 'false';
						}	
					}
				}
							
			}else{
				//echo "No se hizo nada, unchecked \n ";
				return 'true';
			}
			
		}else{
			return 'false';
		}
	
	}
	
//*********************************************************************************************************//
	
	function MarcarCheckbox($pieza, $modelo)
	{
		$select = "SELECT principal FROM pieza_modelo WHERE id_pieza = ".$pieza." AND id_modelo = ".$modelo."";
		
		if( $insert_select = $this->conexion->query($select) )
		{
			$count = $insert_select->num_rows;
			
			if($count>0)
			{
				return true;
			}else{
				return false;
			}
		}else{
			//en caso de error de BD
		}
	}

//*********************************************************************************************************//

function checkModeloPrincipal($pieza)
	{
		$select = "SELECT pieza_modelo.* , modelo.id_marca FROM pieza_modelo INNER JOIN modelo WHERE modelo.id = pieza_modelo.id_modelo AND id_pieza = ".$pieza." AND principal =1";
		
		if( $insert_select = $this->conexion->query($select) )
		{
			$count = $insert_select->num_rows;
			
			if($count>0)
			{
				$arreglo = $insert_select->fetch_assoc();
				$this->Id_pieza = $arreglo['id_pieza'];
				$this->Id_modelo = $arreglo['id_modelo'];
				$this->Principal = $arreglo['principal'];
				$this->Id_marca = $arreglo['id_marca'];
				return true;
			}else{
				return false;
			}
		}else{
			//en caso de error de BD
		}
	}

//*********************************************************************************************************//

	function cargarPiezasxMarca_Tienda($id_tienda, $marca)
	{
		switch($marca)
		{
			case 1: $marca='FEBEST'; break;
			case 2: $marca='JAFERPA'; break;
			case 3: $marca='DANAPAC'; break;
			case 4: $marca='KEYBOL'; break;
			case 5: $marca='MOPAR'; break;
			case 6: $marca='ASHIMORI'; break;
			case 7: $marca='TNK'; break;
			case 8: $marca='CIC'; break;
			case 9: $marca='MOTORCRAF'; break;
			case 10: $marca='INR'; break;
			case 11: $marca='ELGIN'; break;
			case 12: $marca='TITANIUM'; break;
			case 13: $marca='T-ALLEN'; break;
			case 14: $marca='WHEEL PRO'; break;
			case 15: $marca='UNICA'; break;
			case 16: $marca='NAKAYAMA'; break;
			case 17: $marca='HELLIN-MOTORS'; break;
			case 18: $marca='GABRIELS'; break;
			case 19: $marca='METALCAR'; break;
			case 20: $marca='BAKO STAR'; break;
			case 21: $marca='DAI'; break;
			case 22: $marca='NAVCAR'; break;
			case 23: $marca='FGV'; break;
			case 24: $marca='TORFLEX'; break;
			case 25: $marca='HARRIS'; break;					
		}
		
		
		$select = "SELECT p.id, p.oem, p.ref, p.nombre, p.direccion, proveedor.razon_social, pt.precio, pt.cant
FROM pieza_tienda AS pt 
INNER JOIN pieza AS p ON pt.id_pieza = p.id 
INNER JOIN proveedor ON p.id_proveedor = proveedor.id 
WHERE pt.id_tienda = ".$id_tienda." AND p.marca = '".$marca."' ";
		
		
		
		$sql_select = $this->conexion->query($select);
		$counter = $sql_select->num_rows;
		
		$this->counter = $counter;
		$this->sql = $sql_select;
		
	}
//*********************************************************************************************************//

	function cargarPiezaData($id_pieza, $id_tienda)
	{
		//To get to know iformation about the stock of a PIECE, one must provide its ID + the STORE ID, since the same piece id may be associated with more than one store.
				
		$select = " SELECT p.id, p.oem, p.ref, p.nombre, p.direccion, pt.precio, pt.cant
					FROM pieza_tienda AS pt 
					INNER JOIN pieza AS p
					ON pt.id_pieza = p.id
					WHERE pt.id_tienda = $id_tienda AND pt.id_pieza = $id_pieza";
		$sql_select = $this->conexion->query($select);
		$counter = $sql_select->num_rows;

		$reponse = array();
		if($counter > 0){
			$reponse = $sql_select->fetch_assoc();
		}

		return $reponse;
	}
//*********************************************************************************************************//

	function modificarStock($tiendaId, $piezaId, $precio, $cant)
	{
		$update = "UPDATE pieza_tienda SET
		precio = ".$precio.",
		cant = cant+".$cant."
		WHERE id_tienda = ".$tiendaId." AND id_pieza = ".$piezaId."";
		
		if($query_update = $this->conexion->query($update))
		{
			return true;
		}else{
			return false;
		}
		
	}

//*********************************************************************************************************//

	function cargarActualizacionStockPieza($piezaId, $tiendaId)
	{
	    $select="SELECT * FROM pieza_tienda WHERE id_pieza = ".$piezaId." AND id_tienda = ".$tiendaId."";
	    $query_select = $this->conexion->query($select);
		
		$this->sql = $query_select;		
	}
	
//*********************************************************************************************************//

	function checkStock($piezaId, $tiendaId)
	{
	    $select="SELECT precio, cant, id_pieza FROM pieza_tienda WHERE id_pieza = ".$piezaId." AND id_tienda = ".$tiendaId."";
	    $query_select = $this->conexion->query($select);
		$count = $query_select->num_rows;

		if($count>0)
		{
			$arr = $query_select->fetch_assoc();
			$this->getPieza($arr['id_pieza']);
			$this->precio = $arr['precio'];
			$this->cant = $arr['cant'];
		}
	}
	
//*********************************************************************************************************//

	function buscarPieza($id_modelo, $componente, $tienda)
	{
		$this->error = "";
		$this->sql = "";
		$this->message = "";
		
		if($componente=='TODAS')
		{
			//Si el componente es TODAS tenemos una consulta de todas las piezas para el modelo de carro especificado
			$select =  "SELECT * 
			FROM  pieza_modelo as pm, pieza_tienda as pt, pieza as p 
			WHERE pm.id_modelo = ".$id_modelo." 
			AND pm.id_pieza = p.id 
			AND pt.id_tienda = ".$tienda." 
			AND pt.id_pieza = p.id
			ORDER BY principal DESC, nombre";
			
		}else{
			//Si el componente es ESPECIFICIO tenemos una consulta de todas las piezas para el modelo de carro especificado
			$select =  "SELECT * 
			FROM  pieza_modelo as pm, pieza_tienda as pt, pieza as p 
			WHERE pm.id_modelo = ".$id_modelo." 
			AND pm.id_pieza = p.id 
			AND pt.id_tienda = ".$tienda." 
			AND pt.id_pieza = p.id
			AND p.componente = '".$componente."'
			ORDER BY principal DESC, nombre";
		}
		
		if($query_select = $this->conexion->query($select))
		{
			//Contamos si hay registros afectados
			$counter = $query_select->num_rows;
			if($counter>0)
			{
				// Hay registros, se carga la consulta
				$this->sql = $query_select;
			}else{
				//No hay registros, se carga el mensaje
				$this->message = "Sin resultados";
			}
		}else{
			//Si tenemos problemas al consultar con mysql
			$this->error = "Ha ocurrido un problema con la Base de Datos. Contactar Administrador";
			
		}			
	}
	
//*********************************************************************************************************//
	
 
}// Fin Clase Piezas
?>