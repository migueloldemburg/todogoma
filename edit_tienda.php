<?php
 include('security2.php');
 
 if($_GET['id']!=''){
	 $tienda = new Tiendas;
	 $tienda->getTienda($_GET['id']);
 }
 
 if(isset($_POST['guardar']))
 {
	 $tienda1 = new Tiendas;
	 $tienda1->editar($tienda->Id, $_POST['nombre'], $_POST['estado'], $_POST['ciudad'], $_POST['ubicacion'], $_POST['telefono']);
 }
 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Editar Tienda</title>
	<?php require('libs.php'); ?>
    
	 <script type="text/javascript">
	 	$().ready(function() {
	 		$('#edit_tienda').ketchup();
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
				<h3>Editar Tienda</h3>
				<form action="" name="edit_tienda" id="edit_tienda" method="post" enctype="application/x-www-form-urlencoded">
				<label>Tienda N&ordm;: <?php echo $tienda->Id ?></label>
				<div class="form-group">
					<label for="nombre">Nombre de la Tienda:</label>
					<input class="form-control" type="text" name="nombre" id="nombre" style="text-transform:uppercase" placeholder="NOMBRE DE TIENDA" value="<?php echo $tienda->Nombre ?>" data-validate="validate(required)">
				</div>

				<div class="form-group">
					<label for="estado">Estado: </label>
<select class="form-control" id="estado" name="estado" data-validate="validate(select(estado))">
    <option value="">*SELECIONE*</option>
    <option <?php if($tienda->Estado=='NUEVA ESPARTA') echo 'selected'; ?> value="NUEVA ESPARTA">NUEVA ESPARTA</option>
    <option <?php if($tienda->Estado=='ZULIA') echo 'selected'; ?> value="ZULIA">ZULIA</option>
    <option style="color:#CCC" value="">___________________________________________</option>
    <option <?php if($tienda->Estado=='AMAZONAS') echo 'selected'; ?> value="AMAZONAS">AMAZONAS</option>
    <option <?php if($tienda->Estado=='ANZOATEGUI') echo 'selected'; ?> value="ANZOATEGUI">ANZOATEGUI</option>
    <option <?php if($tienda->Estado=='APURE') echo 'selected'; ?> value="APURE">APURE</option>
    <option <?php if($tienda->Estado=='ARAGUA') echo 'selected'; ?> value="ARAGUA">ARAGUA</option>
    <option <?php if($tienda->Estado=='BARINAS') echo 'selected'; ?> value="BARINAS">BARINAS</option>
    <option <?php if($tienda->Estado=='BOLIVAR') echo 'selected'; ?> value="BOLIVAR">BOL&Iacute;VAR</option>
    <option <?php if($tienda->Estado=='CARABOBO') echo 'selected'; ?> value="CARABOBO">CARABOBO</option>
    <option <?php if($tienda->Estado=='COJEDES') echo 'selected'; ?> value="COJEDES">COJEDES</option>
    <option <?php if($tienda->Estado=='DELTA AMACURO') echo 'selected'; ?> value="DELTA AMACURO">DELTA AMACURO</option>
    <option <?php if($tienda->Estado=='FALCON') echo 'selected'; ?> value="FALCON">FALC&Oacute;N</option>
    <option <?php if($tienda->Estado=='"GUARICO') echo 'selected'; ?> value="GUARICO">GU&Aacute;RICO</option>
    <option <?php if($tienda->Estado=='LARA') echo 'selected'; ?> value="LARA">LARA</option>
    <option <?php if($tienda->Estado=='MERIDA') echo 'selected'; ?> value="MERIDA">M&Eacute;RIDA</option>
    <option <?php if($tienda->Estado=='MIRANDA') echo 'selected'; ?> value="MIRANDA">MIRANDA</option>
    <option <?php if($tienda->Estado=='MONAGAS') echo 'selected'; ?> value="MONAGAS">MONAGAS</option>
    <option <?php if($tienda->Estado=='PORTUGUESA') echo 'selected'; ?> value="PORTUGUESA">PORTUGUESA</option>
    <option <?php if($tienda->Estado=='SUCRE') echo 'selected'; ?> value="SUCRE">SUCRE</option>
    <option <?php if($tienda->Estado=='TACHIRA') echo 'selected'; ?> value="TACHIRA">T&Aacute;CHIRA</option>
    <option <?php if($tienda->Estado=='TRUJILLO') echo 'selected'; ?> value="TRUJILLO">TRUJILLO</option>
    <option <?php if($tienda->Estado=='VARGAS') echo 'selected'; ?> value="VARGAS">VARGAS</option>
    <option <?php if($tienda->Estado=='YARACUY') echo 'selected'; ?> value="YARACUY">YARACUY</option>
   <option <?php if($tienda->Estado== 'DISTRITO CAPITAL') echo 'selected'; ?> value="DISTRITO CAPITAL">DISTRITO CAPITAL</option>
</select>
				</div>
				
				<div class="form-group">
					<label for="ciudad">Ciudad:</label>
					<input class="form-control" type="text" style="text-transform:uppercase" name="ciudad" id="ciudad" placeholder="CIUDAD" value="<?php echo $tienda->Ciudad ?>" data-validate="validate(required)">
				</div>
                
                <div class="form-group">
					<label for="ubicacion">Ubicaci&oacute;n:</label>
					<input class="form-control" type="text" style="text-transform:uppercase" name="ubicacion" id="ubicacion" placeholder="UBICACI&Oacute;N" value="<?php echo $tienda->Ubicacion ?>" data-validate="validate(required)">
				</div>

				<div class="form-group">
					<label for="telefono">Tel&eacute;fono:</label>
					<input class="form-control" type="text" name="telefono" id="telefono" placeholder="(0000) - (000 00 00)" value="<?php echo $tienda->Telefono ?>">
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