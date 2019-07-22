<?php
class Clientes
{
   var $Cedula;	   // varchar 12
   var $Nombre;	   // varchar 50
   var $Apellido;  // varchar 50
   var $Direccion; // text
   var $Telefono;  // varchar 20

//*********************************************************************************************************//
  
   function Clientes()
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
   
   function registrarCliente($cedula, $nombre, $apellido, $direccion, $telefono)
   {
   		$cedula = strtoupper($cedula);
   		$nombre = strtoupper($nombre);
   		$apellido = strtoupper($apellido);
   		$direccion = strtoupper($direccion);

  		if (empty($cedula)){
			$errors[] = "Cédula vacía";
		} else if (empty($nombre)){
			$errors[] = "Nombre vacío";
		} else if (empty($apellido)){
			$errors[] = "Apellido vacío";
		} else if (empty($telefono)){
			$errors[] = "Tel&eacute;fono vacío";
		} else if (	!empty($cedula) && !empty($nombre))
		{
			$insert="INSERT INTO cliente (cedula, nombre, apellido, direccion, telefono) VALUES (
	       '".$cedula."',
		   '".$nombre."',
		   '".$apellido."',
		   '".$direccion."',
		   '".$telefono."')";
			
			$sql_insert = $this->conexion->query($insert);
			if ($sql_insert){
				$messages[] = "Los datos han sido guardados satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente. ". $this->conexion->error;
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors))
		{		
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
					?>
			</div>
			<?php
		}

		if (isset($messages))
		{
			
			?>
			<div class="alert alert-success" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>¡Bien hecho!</strong>
					<?php
						foreach ($messages as $message) {
								echo $message;
							}
						?>
			</div>
			<?php
		}	   
   }
   
//*********************************************************************************************************//

   function editarCliente( $newCedula, $oldCedula, $nombre, $apellido, $direccion, $telefono)
   {   
   		$newCedula = strtoupper($newCedula);
   		$oldCedula = strtoupper($oldCedula);
   		$nombre = strtoupper($nombre);
   		$apellido = strtoupper($apellido);
   		$direccion = strtoupper($direccion);
       /*Inicia validacion del lado del servidor*/
		if (empty($newCedula)) {
           $errors[] = "C&eacute;dula vacía";
        } else if (empty($nombre)){
			$errors[] = "Nombre vacío";
		} else if (empty($apellido)){
			$errors[] = "Apellido vacío";
		} else if (empty($telefono)){
			$errors[] = "Telefono vacío";
		}   else if (
			!empty($newCedula) &&
			!empty($nombre) && 
			!empty($apellido) &&
			!empty($telefono)
			
		){
	
		$update="UPDATE cliente SET
			cedula = '".$newCedula."',
			nombre = '".$nombre."',
			apellido = '".$apellido."',
			direccion = '".$direccion."',
			telefono = '".$telefono."'
			WHERE cedula = '".$oldCedula."'";
		//echo $update;
		$sql_update = $this->conexion->query($update);
			if ($sql_update){
				$messages[] = "Los datos han sido actualizados satisfactoriamente.";
			} else{
				//MYSQL_CODE_DUPLICATE_KEY 1062
				if (mysql_errno() == 1062) {
				    $errors []= "Ya se encuentra un cliente con este n&uacute;mero de c&eacute;dula.";
				}else{
					$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysql_error($this->conexion);
				}
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
	   
   }
   
//********************************************************************************************************//

	function getCliente($cedula)
	{
	   $select = "SELECT * FROM cliente WHERE cedula = '".$cedula."'";
	   $query_select = $this->conexion->query($select);
	   $contador = $query_select->num_rows;
	   
	   if($contador>0){
		   $array = $query_select->fetch_assoc();
		   $this->Cedula = $array['cedula'];
		   $this->Nombre = $array['nombre'];
		   $this->Apellido = $array['apellido'];
		   $this->Direccion = $array['direccion'];
		   $this->Telefono = $array['telefono'];
		   
	   }else{
		   $this->error = 'Cliente sin registro';
	   } 
	   
   }
   
//*********************************************************************************************************// 

}//Fin Clase Usuarios
?>