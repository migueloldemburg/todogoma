<?php
 include('security2.php');
 
 if(isset($_POST['guardar']))
 {
	 $nombre = strtoupper($_POST['nombre']);
	 
 	 if($nombre!='' && $nombre!=' ' || $_FILES['imagen']['tmp_name']!='')
	 {
		 $imagen1 = new Imagenes;
		 //Se crea la imagen (#FILE, #directorio, #nombre de imagen)
		 $imagen1->init($_FILES['imagen'],"images/fabricantes/",$nombre);	 
		 
		 if($imagen1->_r == "") {
			 $fabricante = new Fabricantes;
			 $fabricante->registrar($_POST['nombre'], $imagen1->imagen_ruta);
		 
		 } else {
			 echo "<script>alert('$imagen1->_r');</script>";
		 }
	 }
 }
 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registrar Fabricante</title>
	<?php require('libs.php'); ?>
    
	 <script type="text/javascript">
	 	$().ready(function() {
	 		$('#reg_fabricante').ketchup();
			
			$('#reg_fabricante').bind('fieldIsValid', function(event, form, el) {
				el.css("borderColor", "green");
			})
			$('#reg_fabricante').bind('fieldIsInvalid', function(event, form, el) {
				el.css("borderColor", "red");
			})
		});
		
		$.ketchup.validation('imagen', 'Debe seleccionar una imagen.', function(form, el, value, word1) {
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
				<h3>Registro Nuevo Fabricante de Carro</h3>
				<form action="" name="reg_fabricante" id="reg_fabricante" method="post" enctype="multipart/form-data">
				<label>Fabricante N&ordm;: <?php $id = new Fabricantes; echo $id = $id->getId(); ?> </label>
				<div class="form-group">
					<label for="nombre">Nombre:</label>
					<input style="text-transform:uppercase;" class="form-control" type="text" name="nombre" id="nombre" placeholder="NOMBRE DE FABRICANTE" data-validate="validate(required)">
				</div>
				
				<br>
				<div class="form-class">
					<label for="imagen">Imagen de la marca:</label>
					<input type="file" name="imagen" id="imagen" data-validate="validate(imagen())">
					<p class="help-block">Maximo 150MB</p>
				</div>
		
				<br><br>
				<div>
					<div class="form-class pull-left">
						<button class="btn btn-danger" name="cancelar" id="cancelar" type="button" onClick="location.href='adm_fabricantes.php'">Cancelar</button>
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