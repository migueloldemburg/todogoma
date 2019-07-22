<?php
 include('security2.php');
 if(isset($_POST['guardar']))
 {
	 $nombre = strtoupper($_POST['nombre']);
	 $apellido = strtoupper($_POST['apellido']);
	 $usu = strtoupper($_POST['usuario']);
	 $clave =strtoupper($_POST['clave1']);
	 $id_tienda = strtoupper($_POST['id_tienda']);
     $estado = 1;
 	 $nivel = strtoupper($_POST['nivel']);

	 $usuario = new Usuarios;
	 $usuario->registrar($usu, $clave, $nombre, $apellido, $id_tienda, $estado, $nivel);
 }
 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registrar Usuario</title>
	<?php require('libs.php'); ?>
	
	<script type="text/javascript">
	 	$().ready(function() {
	 		$('#reg_usuario').ketchup();
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
				<h3>Registro Nuevo Usuario</h3>
				<form class="form-horizontal" name="reg_usuario" id="reg_usuario" action="" enctype="application/x-www-form-urlencoded" method="post">	
                    <label>Usuario N&ordm;: <?php $count = new Usuarios; echo $num = $count->contarUsuarios();  ?></label>
                    
                    <div class="form-group">
                       <label for="nombre" class="control-label col-md-2">Nombre:</label>
                       <div class="col-md-10">
                        <input class="form-control" type="text" name="nombre" id="nombre" maxlength="30" style="text-transform:uppercase" placeholder="NOMBRE DEL USUARIO" data-validate="validate(required)">
                       </div>
                    </div>
                    
                    <div class="form-group">
                       <label for="apellido" class="control-label col-md-2">Apellido:</label>
                       <div class="col-md-10">
                        <input class="form-control" type="text" name="apellido" id="apellido" maxlength="30"  style="text-transform:uppercase" placeholder="APELLIDO DEL USUARIO" data-validate="validate(required)">
                       </div>
                    </div>
  					<br><br>
                    <div class="form-group">
                       <label for="usuario" class="control-label col-md-2">Usuario:</label>
                       <div class="col-md-10">
                        <input class="form-control" type="text" name="usuario" id="usuario" maxlength="8" style="text-transform:uppercase" placeholder="USUARIO" data-validate="validate(required, minlength(8))">
                       </div>
                    </div>
                                    
                    <div class="form-group">
                        <label for="nivel" class="control-label col-md-2">Nivel: </label>
                        <div class="col-md-10">
                            <select class="form-control" id="nivel" name="nivel">
                                <option value="SIMPLE">SIMPLE</option>
                                <option value="ADM">ADM</option>
                                <option value="SUPER-U">SUPER-U</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_tienda" class="control-label col-md-2">Tienda: </label>
                        <div class="col-md-10">
                            <select class="form-control" id="id_tienda" name="id_tienda" data-validate="validate(select(tienda))">
                            	<option value="">--SELECCIONE--</option>
                               <?php
		                            $tienda = new Tiendas;
		                            $tienda->cargarTabla();
		                            $i=1;
		                            while($array = $tienda->sql->fetch_assoc())
		                            {
		                        ?>
		                            <option value="<?php echo $array['id'] ?>"><?php echo $i++.' : '.$array['nombre'].'-'.$array['ciudad'] ?></option>
		                        <?php
		                            }
		                        ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <div class="input-group">
                            <div class="input-group-addon">Clave&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                            <input style="z-index:0" class="form-control" id="clave1" name="clave1" maxlength="8" type="password" data-validate="validate(required,rangelength(6,8),verificarClave1())" />
                        </div>
                    </div>
    
                    <div class="form-group col-md-12">
                        <div class="input-group">
                            <div class="input-group-addon">Repetir Clave</div>
                            <input class="form-control" id="clave2" name="clave2" maxlength="8" type="password" data-validate="validate(required, rangelength(6,8),verificarClave2())" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-class col-md-6 pull-left">
                            <button class="btn btn-danger" name="cancelar" id="cancelar" type="button" onClick="location.href='adm_usuarios.php'">Cancelar</button>
                        </div>
                        <div class="form-class col-md-6 pull-right">
                            <button class="btn btn-primary" name="guardar" id="guardar" type="submit">Guardar</button>
                        </div>
                    </div>
             				
                </form>
			</div>
            
		</div> <!--CIERRA ROW-->
	</section>
</body>
</html>