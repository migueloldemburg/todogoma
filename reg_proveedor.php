<?php
 include('security2.php');
 
 if(isset($_POST['guardar']))
 {
 	 $rif = $_POST['rif1'].$_POST['rif2'];
 
	 $proveedor = new Proveedores;
	 $proveedor->registrar($rif, $_POST['razon_social'], $_POST['direccion'], $_POST['telefono1'], $_POST['telefono2']);	 	 
 }
 
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registrar Proveedor</title>
    <?php require('libs.php'); ?>
    
	 <script type="text/javascript">
	 	$().ready(function() {
	 		$('#reg_proveedor').ketchup();
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
				<h3>Registro Nuevo  Proveedor</h3>
				<form action="" name="reg_proveedor" id="reg_proveedor" method="post" enctype="application/x-www-form-urlencoded">
				<label>Proveedor N&ordm;: <?php $id = new Proveedores; echo $id = $id->getId(); ?> </label>
				
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<select id="rif1" name="rif1">
								<option value="J">J</option>
                                <option value="V">V</option>
                                <option value="E">E</option>
							</select>
						</div>
						<input class="form-control" type="text" id="rif2" name="rif2" maxlength="10" data-validate="validate(required,minlength(7))">
					</div>
				</div>

				<div class="form-group">
					<label for="razon_social">Razon Social:</label>
					<input class="form-control" type="text" name="razon_social" id="razon_social" maxlength="50" placeholder="Raz&oacute;n Social" style="text-transform:uppercase" data-validate="validate(required)">
				</div>

				<div class="form-group">
					<label for="direccion">Direcci&oacute;n:</label>
                    <textarea class="form-control" style="text-transform:uppercase" type="text" name="direccion" id="direccion" placeholder="Direcci&oacute;n" data-validate="validate(required)"></textarea>
				</div>

				<div class="form-group">
					<label for="telefono1">Tel&eacute;fono #1:</label>
					<input class="form-control" type="text" name="telefono1" id="telefono1" maxlength="30" placeholder="(0000) - (000 00 00)" data-validate="validate(required)">
				</div>
                
                <div class="form-group">
					<label for="telefono2">Tel&eacute;fono  #2:</label>
					<input class="form-control" type="text" name="telefono2" id="telefono2" maxlength="30" placeholder="(0000) - (000 00 00)">
				</div>

				<br><br>
				<div>
					<div class="form-class pull-left">
						<button class="btn btn-danger" type="button" onFocus="location.href='adm_proveedores.php'">Cancelar</button>
					</div>
					<div class="form-class pull-right">
						<button class="btn btn-primary" type="submit" name="guardar" id="guardar">Guardar</button>
					</div>
				</div>
				<br><br><br>
				</form>
			</div>
			
			
		</div>
	</section>
</body>
</html>