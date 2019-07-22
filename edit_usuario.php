<?php
 include('security2.php');

 if($_GET['xlmn']!=''){
	 $usuario = new Usuarios;
	 $usuario->getUsuario($_GET['xlmn']);	 
 }
 
 if(isset($_POST['guardar']))
 {
	 $nombre = strtoupper($_POST['nombre']);
	 $apellido = strtoupper($_POST['apellido']);
	 $usu = strtoupper($usuario->Usuario);
	 $clave =strtoupper($_POST['clave1']);
 	 $nivel = strtoupper($_POST['nivel']);

	 $usuario = new Usuarios;
	 $usuario->editar($usu, $clave, $nombre, $apellido, $nivel);
 }
 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registrar Usuario</title>
    <?php require('libs.php'); ?>
    
	<script type="text/javascript">
	 	$().ready(function() {
	 		$('#edit_usuario').ketchup();
		});
		
		$.ketchup.validation('select', 'Debe seleccionar una {arg1}.', function(form, el, value, word1) {
		  if(value != '') {
			return true;
		  } else {
			return false;
		  }
		});
		
		$.ketchup.validation('verificarClave1', 'Las claves no coinciden.', function(form, el, value) {
		  if(value!= '' || value!=' ') {
			  var pass = document.getElementById('clave2').value;
			  if(pass=='' || pass==' '){
				  return true;
			  }else{
				  if(value!=pass){
					  return false;
				   }else{
					   return true;
				   }
			  }
		  } else {
			return false;
		  }
		});
		
		$.ketchup.validation('verificarClave2', 'Las claves no coinciden.', function(form, el, value) {
		  if(value!= '' || value!=' ') {
			  var pass = document.getElementById('clave1').value;
			  if(pass=='' || pass==' '){
				  return true;
			  }else{
				  if(value!=pass){
					  return false;
				  }else{
					   return true;
				   }
			  }
		  } else {
			return false;
		  }
		});
	</script> 
</head>
<body background="images/background-car.jpg">
	
	<header>
		<div class="container">
			<h2 class="text-center">TODOGOMA</h2>
		</div>
	</header>
	
	<section class="container">
		<div class="row">
			<div class="col-md-4 Madang">
				<h3>Editar Usuario</h3>
				<form class="form-horizontal" id="edit_usuario" name="edit_usuario" action="" enctype="application/x-www-form-urlencoded" method="post">	
                    
                    <div class="form-group">
                       <label for="nombre" class="control-label col-md-2">Nombre:</label>
                       <div class="col-md-10">
                        <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $usuario->Nombre; ?>" maxlength="30" style="text-transform:uppercase" placeholder="NOMBRE DEL USUARIO" data-validate="validate(required)">
                       </div>
                    </div>
                    
                    <div class="form-group">
                       <label for="apellido" class="control-label col-md-2">Apellido:</label>
                       <div class="col-md-10">
                        <input class="form-control" type="text" name="apellido" id="apellido" value="<?php echo $usuario->Apellido; ?>" maxlength="30"  style="text-transform:uppercase" placeholder="APELLIDO DEL USUARIO" data-validate="validate(required)">
                       </div>
                    </div>
  					<br><br>
                    <div class="form-group">
                       <label for="usuario" class="control-label col-md-2">Usuario:</label>
                       <div class="col-md-10">
                        <input class="form-control" type="text" name="usuario" id="usuario" value="<?php echo $usuario->Usuario; ?>" maxlength="8" style="text-transform:uppercase" disabled placeholder="USUARIO" data-validate="validate(required)">
                       </div>
                    </div>
                                    
                    <div class="form-group">
                        <label for="nivel" class="control-label col-md-2">Nivel: </label>
                        <div class="col-md-10">
                          <select class="form-control" id="nivel" name="nivel">
                            <option value="SIMPLE" <?php if($usuario->Nivel=='SIMPLE') echo 'selected'; ?>>SIMPLE</option>
                            <option value="ADM" <?php if($usuario->Nivel=='ADM') echo 'selected'; ?>>ADM</option>
                            <option value="SUPER-U" <?php if($usuario->Nivel=='SUPER-U') echo 'selected'; ?>>SUPER-U</option>
                          </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="id_tienda" class="control-label col-md-2">Tienda: </label>
                        <div class="col-md-10">
							<?php
								$tiendas = new Tiendas;
								$tiendas->cargarTabla();							
                            ?>
                            <select class="form-control" id="id_tienda" name="id_tienda" data-validate="validate(select(tienda))" disabled>
                            	<option value="">--SELECCIONE--</option>
                            	<?php
									while($arreglo = $tiendas->sql->fetch_assoc())
									{
								?>
                                <option value="<?php echo $arreglo['id']; ?>" <?php if($usuario->Id_tienda==$arreglo['id']) echo 'selected'; ?>><?php echo $arreglo['id']."-".$arreglo['nombre']."-".$arreglo['ciudad'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <div class="input-group">
                            <div class="input-group-addon">Clave&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                            <input class="form-control" id="clave1" name="clave1" maxlength="8" type="password" data-validate="validate(required,rangelength(6,8),verificarClave1())" value="<?php echo $usuario->Clave ?>" />
                        </div>
                    </div>
    
                    <div class="form-group col-md-12">
                        <div class="input-group">
                            <div class="input-group-addon">Repetir Clave</div>
                            <input class="form-control" id="clave2" name="clave2" maxlength="8" type="password" data-validate="validate(required,rangelength(6,8),verificarClave2())" value="<?php echo $usuario->Clave ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-class col-md-6 pull-left">
                            <button class="btn btn-danger" name="cancelar" id="cancelar" type="button" onClick="location.href='adm_usuarios.php'">Cancelar</button>
                        </div>
                        <div class="form-class col-md-6 pull-right">
                            <button class="btn btn-primary" name="guardar" id="guardar">Guardar</button>
                        </div>
                    </div>
             				
                </form>
			</div>
            
		</div> <!--CIERRA ROW-->
	</section>
</body>
</html>