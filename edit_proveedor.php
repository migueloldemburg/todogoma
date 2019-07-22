<?php
 include('security2.php');
 
 if($_GET['id']!=''){
	 $proveedor = new Proveedores;
	 $proveedor->getProveedor($_GET['id']);
 }
  
 
 if(isset($_POST['guardar']))
 {
 	 $rif = $_POST['rif1'].$_POST['rif2'];
 
	 $proveedorN = new Proveedores;
	 $proveedorN->editar($proveedor->Id, $rif, $_POST['razon_social'], $_POST['direccion'], $_POST['telefono1'], $_POST['telefono2']);
 }
 
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registrar Proveedor</title>
    <?php require('libs.php'); ?>
    
	 <script type="text/javascript">
	 	$().ready(function() {
	 		$('#edit_proveedor').ketchup();
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
				<form action="" name="edit_proveedor" id="edit_proveedor" method="post" enctype="application/x-www-form-urlencoded">
				<label>Proveedor N&ordm;: <?php echo $proveedor->Id ?> </label>
				
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<select id="rif1" name="rif1">
                            	<?php
									$rif1 = substr($proveedor->Rif, 0,1);
								?>
								<option value="J" <?php if($rif1=='J') echo 'selected'; ?>>J</option>
                                <option value="V" <?php if($rif1=='V') echo 'selected'; ?>>V</option>
                                <option value="E" <?php if($rif1=='E') echo 'selected'; ?>>E</option>
							</select>
						</div>
		<input class="form-control" type="text" id="rif2" name="rif2" maxlength="9" value="<?php $rifnd = substr($proveedor->Rif, 1); echo $rifnd ?>" data-validate="validate(required, minlength(7))">
					</div>
				</div>

				<div class="form-group">
					<label for="razon_social">Razon Social:</label>
					<input class="form-control" type="text" name="razon_social" id="razon_social" maxlength="50" placeholder="Raz&oacute;n Social" style="text-transform:uppercase" value="<?php echo $proveedor->Razon_social; ?>" data-validate="validate(required)">
				</div>

				<div class="form-group">
					<label for="direccion">Direcci&oacute;n:</label>
                    <textarea class="form-control" style="text-transform:uppercase" type="text" name="direccion" id="direccion" placeholder="Direcci&oacute;n" data-validate="validate(required)"><?php echo $proveedor->Direccion; ?></textarea>
				</div>

				<div class="form-group">
					<label for="telefono1">Tel&eacute;fono #1:</label>
					<input class="form-control" type="text" name="telefono1" id="telefono1" value="<?php echo $proveedor->Telefono1; ?>" maxlength="30" placeholder="(0000) - (000 00 00)" data-validate="validate(required)">
				</div>
                
                <div class="form-group">
					<label for="telefono2">Tel&eacute;fono  #2:</label>
					<input class="form-control" type="text" name="telefono2" id="telefono2" value="<?php echo $proveedor->Telefono2; ?>" maxlength="30" placeholder="(0000) - (000 00 00)">
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