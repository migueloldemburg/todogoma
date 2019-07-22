<?php
class Usuarios
{
   var $Nombre;		// varcar 30
   var $Apellido;	// varchar 30
   var $Usuario;	// varchar 8
   var $Clave;		// varchar 8
   var $Id_tienda;	// int 10
   var $Estado;		// int 1
   var $Nivel;		// varchar 10

//*********************************************************************************************************//
  
   function Usuarios()
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
   
   function registrar($usu, $clave, $nombre, $apellido, $id_tienda, $estado, $nivel)
   {
   		$usu = $this->conexion->real_escape_string(strip_tags(strtolower($usu),ENT_QUOTES));
		$clave = $this->conexion->real_escape_string(strip_tags(strtolower($clave),ENT_QUOTES));
		$nombre = $this->conexion->real_escape_string(strip_tags(strtolower($nombre),ENT_QUOTES));
		$apellido = $this->conexion->real_escape_string(strip_tags(strtolower($apellido),ENT_QUOTES));
		$id_tienda = $this->conexion->real_escape_string(strip_tags(strtolower($id_tienda),ENT_QUOTES));
		$estado = $this->conexion->real_escape_string(strip_tags(strtolower($estado),ENT_QUOTES));
		$nivel = $this->conexion->real_escape_string(strip_tags(strtolower($nivel),ENT_QUOTES));
  
		$insert="INSERT INTO usuario(usuario, clave, nombre, apellido, id_tienda, estado, nivel) VALUES (
       	'".$usu."',
	   	'".$clave."',
	   	'".$nombre."',
	   	'".$apellido."',
	   	".$id_tienda.",
	   	".$estado.",
	   	'".$nivel."')";
		
		if($insert_sql=$this->conexion->query($insert) )
		{
			echo "<script language='javascript'>alert('Usuario Registrado Exitosamente');
					location.href='adm_usuarios.php';</script>";
		}else{
			echo "<script>alert('Problemas al Registrar Usuario')</script>";
		}
	   
   }
   
//*********************************************************************************************************//

   function editar($usuario, $clave, $nombre, $apellido, $nivel)
   {   
   		//No editamos USUARIO, ID_TIENDA ni ESTADO. (EL Estado es por ajax)
   
	   $update = "UPDATE usuario SET 
	   clave = '".$clave."',
	   nombre = '".$nombre."',
	   apellido = '".$apellido."',
	   nivel = '".$nivel."'
	   WHERE usuario = '".$usuario."'";
		
		if($insert_sql=$this->conexion->query($update) )
		{
				 echo '<script language="javascript">
				 alert("Usuario modificado exitosamente!");
				 location.href="adm_usuarios.php";</script>';
		}else{
			echo "<script>alert('Problemas al editar usuario')</script>";
		}
	   
   }
   
//********************************************************************************************************//


function editarPerfil($usuario, $nombre, $apellido)
   {   
   		$nombre = strtoupper($nombre);
   		$apellido = strtoupper($apellido);
   		$usuario = strtoupper($usuario);
   	
       /*Inicia validacion del lado del servidor*/
		if (empty($nombre)) {
           $errors[] = "Nombre vacio";
        } else if (empty($apellido)){
			$errors[] = "Apellido vacío";
		} else if (empty($usuario)){
			$errors[] = "Sin poder reconocer el usuario";
		}   else if (
			!empty($nombre) && !empty($apellido) && !empty($usuario)			
		){
	
		$update="UPDATE usuario SET
				nombre = '".$nombre."',
				apellido = '".$apellido."'
				WHERE usuario = '".$usuario."'";
		
		$sql_update = $this->conexion->query($update);
			if ($sql_update){
				$messages[] = "Los datos han sido actualizados satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
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
	function getUsuario($user)
	{
	   $insert = "SELECT * FROM usuario WHERE usuario = '".$user."'";
	   $insert_sql = $this->conexion->query ($insert);
	   $contador = $insert_sql->num_rows;
	   
	   if($contador>0){
		   $array = $insert_sql->fetch_assoc();
		   $this->Nombre = $array['nombre'];
		   $this->Apellido = $array['apellido'];
		   $this->Usuario = $array['usuario'];
		   $this->Clave = $array['clave'];
		   $this->Id_tienda = $array['id_tienda'];
		   $this->Estado = $array['estado'];
		   $this->Nivel = $array['nivel'];

	   }else{
		   $this->error = 'El usuario '.$user.' no existe en Base de Datos';
	   } 
	   
   }
   
//*********************************************************************************************************// 

	function cambiarEstado($usuario, $estado)
   {
	   $update = "UPDATE usuario SET estado = '".$estado."' WHERE usuario = '".$usuario."'";
	   
	   if($insert_sql=$this->conexion->query($update))
	   {
		   return 'ok';
		}else{
			return 'Problemas al actualizar';
		}
	   
   }
   
//********************************************************************************************************//

function contarUsuarios()
  {
	 $insert = "SELECT * from usuario";
	 $insert_sql=$this->conexion->query($insert);
	 $cant = $insert_sql->num_rows;
	 
	 if($cant>0){
		 $cant = $cant + 1;
		 
 	     return $cant;
		 
	 }else{
		 return '1';
	 }
  }
  
//*********************************************************************************************************//
	
	function verificarUsuario($usuario, $clave)
	{
	    $redir_ifwrong = "index.php";
		$redir_ifright = "inicio.php";
 
		if ($usuario!='' && $clave!='')
		{
			$usuario = stripslashes($usuario);
			$clave =strtoupper($clave);// encriptamos el password en formato md5 irreversible
			
			$insert = "SELECT * FROM usuario WHERE usuario = '".$usuario."'";
			$insert_sql = $this->conexion->query ($insert);
		    $contador = $insert_sql->num_rows;
			
			$this->_error = '';
			$this->error = 0;
			if ($contador != 0)
			{
				$array = $insert_sql->fetch_assoc();

				if ($usuario != $array['usuario'])
				{					
					$this->_error = 'Usuario inv\u00e1lido';
					$this->error = 1;
				}
				
				if ($clave != $array['clave'])
				{
					$this->_error ='Clave inv\u00e1lida';
					$this->error = 2;
				}
				
				if($array['estado'] == 0)
				{
					$this->_error = 'este usuario se encuentra deshabilitado';
					$this->error = 3;
				}
				
			}else{
				$this->_error = 'Usuario o Clave inv\u00e1lida';
				$this->error = 4;
			}	
		    //******CERRAR BD*****//
			$this->desconectar();
			//********************//
			if ($this->error > 0) 
			{
				$this->usuario = $usuario;	
			}else{
				$this->info = $array;				
			}//fin IF
		}//fin IF		
	}
	
//********************************************************************************************************//
   
	function cargarTabla()
	{
	    $insert='SELECT * FROM usuario';
		//$insert='SELECT * FROM usuario GROUP BY id_tienda';
	    $insert_sql = $this->conexion->query($insert);
	 	$contador = $insert_sql->num_rows;

		$this->sql = $insert_sql;		
	}
	
//*********************************************************************************************************//


}//Fin Clase Usuarios
?>