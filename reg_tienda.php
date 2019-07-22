<?php
 include('security2.php');
 
 if(isset($_POST['guardar']))
 {
	 $tienda = new Tiendas;
	 $tienda->registrar($_POST['nombre'], $_POST['estado'], $_POST['ciudad'], $_POST['ubicacion'], $_POST['telefono']);
 }
 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registrar Tienda</title>
	<?php require('libs.php'); ?>
    
	 <script type="text/javascript">
	 	$().ready(function() {
	 		$('#reg_tienda').ketchup();
		});
		
		$.ketchup.validation('select', 'Debe seleccionar un {arg1}.', function(form, el, value, word1) {
		  if(value != '') {
			return true;
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
				<h3>Registro Nueva Tienda</h3>
				<form action="" name="reg_tienda" id="reg_tienda" method="post" enctype="application/x-www-form-urlencoded">
				<label>Tienda N&ordm;: <?php $id = new Tiendas; echo $id = $id->getId(); ?></label>
				<div class="form-group">
					<label for="nombre">Nombre de la Tienda:</label>
					<input class="form-control" type="text" name="nombre" id="nombre" style="text-transform:uppercase" placeholder="NOMBRE DE TIENDA" data-validate="validate(required)">
				</div>

				<div class="form-group">
					<label for="estado">Estado: </label>
					<select class="form-control" id="estado" name="estado" data-validate="validate(select(estado))">
                   		<option value="">--SELECIONE--</option>
                        <option value="NUEVA ESPARTA">NUEVA ESPARTA</option>
                        <option value="ZULIA">ZULIA</option>
                        <option style="color:#CCC" value="">_________________________</option>
						<option value="AMAZONAS">AMAZONAS</option>
						<option value="ANZOATEGUI">ANZOATEGUI</option>
						<option value="APURE">APURE</option>
						<option value="ARAGUA">ARAGUA</option>
                        <option value="BARINAS">BARINAS</option>
                        <option value="BOLIVAR">BOL&Iacute;VAR</option>
                        <option value="CARABOBO">CARABOBO</option>
                        <option value="COJEDES">COJEDES</option>
                        <option value="DELTA AMACURO">DELTA AMACURO</option>
                        <option value="FALCON">FALC&Oacute;N</option>
                        <option value="GUARICO">GU&Aacute;RICO</option>
                        <option value="LARA">LARA</option>
                        <option value="MERIDA">M&Eacute;RIDA</option>
                        <option value="MIRANDA">MIRANDA</option>
                        <option value="MONAGAS">MONAGAS</option>
                        <option value="PORTUGUESA">PORTUGUESA</option>
                        <option value="SUCRE">SUCRE</option>
                        <option value="TACHIRA">T&Aacute;CHIRA</option>
                        <option value="TRUJILLO">TRUJILLO</option>
                        <option value="VARGAS">VARGAS</option>
                        <option value="YARACUY">YARACUY</option>
                        <option value="DISTRITO CAPITAL">DISTRITO CAPITAL</option>
					</select>
				</div>
				
				<div class="form-group">
					<label for="ciudad">Ciudad:</label>
					<input class="form-control" type="text" style="text-transform:uppercase" name="ciudad" id="ciudad" placeholder="CIUDAD" data-validate="validate(required)">
				</div>
                
                <div class="form-group">
					<label for="ubicacion">Ubicaci&oacute;n:</label>
					<input class="form-control" type="text" style="text-transform:uppercase" name="ubicacion" id="ubicacion" placeholder="UBICACI&Oacute;N" data-validate="validate(required)">
				</div>

				<div class="form-group">
					<label for="telefono">Tel&eacute;fono:</label>
					<input class="form-control" type="text" name="telefono" id="telefono" placeholder="(0000) - (000 00 00)">
				</div>

				<br><br>
				<div>
					<div class="form-class pull-left">
						<button class="btn btn-danger" type="button" name="cancelar" id="cancelar" onClick="location.href='adm_tiendas.php'">Cancelar</button>
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
