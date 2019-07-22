<?php
 include('security2.php');
 
 if($_GET['id']!=''){
	 $fabricante = new Fabricantes;
	 $fabricante->getFabricante($_GET['id']);
 }
  
 
 if(isset($_POST['guardar']))
 {
	 $nombre = strtoupper($_POST['nombre']);
	 
 	 if($nombre!='' && $nombre!=' ' || $_FILES['imagen']['tmp_name']!='')
	 {
		  if($_FILES['imagen']['tmp_name']!=''){
			 $imagen1 = new Imagenes;
			 //Se crea la imagen (#FILE, #directorio, #nombre de imagen)
			 $imagen1->init($_FILES['imagen'], "images/fabricantes/",$nombre);
			 $img_ruta = $imagen1->imagen_ruta;
		 }else{
			 $img_ruta = $fabricante->Imagen;
		 }
		 
		 if($imagen1->_r == "") {
			 $fabri = new Fabricantes;
			 $fabri->editar($fabricante->Id, $nombre, $img_ruta);
		 
		 } else {
			 echo "<script>alert('$imagen1->_r');</script>";
		 }
	 }
 }
 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Editar Fabricante</title>
	<?php require('libs.php'); ?>
    
	 <script type="text/javascript">
	 	$().ready(function() {
	 		$('#edit_fabricante').ketchup();
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
				<h3>Editar Fabricante de Carro</h3>
				<form action="" name="edit_fabricante" id="edit_fabricante" method="post" enctype="multipart/form-data">
				<label>Fabricante N&ordm;: <?php echo $fabricante->Id; ?> </label>
				<div class="form-group">
					<label for="nombre">Nombre:</label>
					<input style="text-transform:uppercase;" class="form-control" type="text" name="nombre" id="nombre" placeholder="NOMBRE DE FABRICANTE" data-validate="validate(required)" value="<?php echo $fabricante->Nombre; ?>">
				</div>
				
				<br>
				<div class="form-class">
					<label for="imagen">Imagen de la marca: <p class="help-block" style="color:#F00"><?php echo $fabricante->Imagen; ?></p></label>
					<input type="file" name="imagen" id="imagen">
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