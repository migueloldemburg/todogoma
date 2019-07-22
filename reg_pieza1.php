<?php
 include('security2.php');
 
 $pieza = new Piezas;
 $num = $pieza->getId();
 
 if(isset($_POST['guardar']))
 {
	 $img_pieza = new Imagenes;
	 //Se crea la imagen (#FILE, #directorio, #nombre de imagen)
	 $img_pieza->init($_FILES['imagen'], "images/piezas/item".$num."/", "p-".$num);
	 
	 $img_esquema = new Imagenes;
	 $img_esquema->init($_FILES['img_esquema'], "images/piezas/item".$num."/", "e-".$num);
	 
	 if($img_pieza->_r == "" || $img_esquema->_r==""){
		 $piezaB = new Piezas;
		 $piezaB->registrar($_POST['id_proveedor'], $_POST['oem'], $_POST['ref'], $_POST['marca'], $_POST['nombre'], $_POST['descripcion'], $_POST['componente'],  $_POST['direccion'], "item".$num."/".$img_pieza->imagen_ruta, "item".$num."/".$img_esquema->imagen_ruta);
		 
	 } else {
		 echo "<script>alert('$imagen1->_r \n $imagen2->_r');</script>";
	 }
 }
  
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registrar Pieza</title>
	<?php require('libs.php'); ?>
    
	 <script type="text/javascript">
	 	$().ready(function() {
	 		$('#reg_pieza').ketchup();
		});
		
		$.ketchup.validation('select', 'Debe seleccionar {arg1}.', function(form, el, value, word1) {
		  if(value != '') {
			return true;
		  } else {
			return false;
		  }
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
				<h3>Registro de Art&iacute;culo</h3>
				<form action="" name="reg_pieza" id="reg_pieza" method="post" enctype="multipart/form-data">
				<label>Art&iacute;culo N&ordm;: <?php $id = new Piezas; echo $id = $id->getId(); ?> </label>
                
                <div class="form-group">
                <?php
					$proveedor = new Proveedores;
					$proveedor->cargarTabla();							
                ?>
					<label for="id_proveedor">Proveedor: </label>
					<select class="form-control" id="id_proveedor" name="id_proveedor" data-validate="validate(select(un proveedor))">
						<option value="">-- seleccione --</option>
						<?php
						$i=1;
							while($arreglo = $proveedor->sql->fetch_assoc())
							{
						?>
                        	<option value="<?php echo $arreglo['id']; ?>"><?php echo $i++.' - '.$arreglo['razon_social'] ?></option>
                       <?php } ?>
					</select>
				</div>
                
				<div class="form-group">
					<label for="oem">#OEM</label>
					<input class="form-control" type="text" name="oem" id="oem" placeholder="OEM" data-validate="validate(required)">
				</div>
                
                <div class="form-group">
					<label for="ref">Referencia</label>
					<input class="form-control" type="text" name="ref" id="ref" style="text-transform:uppercase" placeholder="REFERENCIA" data-validate="validate(required)">
				</div>
                
                <div class="form-group">
					<label for="nombre">Nombre de la pieza:</label>
					<input class="form-control" type="text" name="nombre" id="nombre" placeholder="NOMBRE" style="text-transform:uppercase" data-validate="validate(required)">
				</div>

                <div class="form-group">
					<label for="descripcion">Descripci&oacute;n:</label>
					<textarea class="form-control" type="text" name="descripcion" id="descripcion" style="text-transform:uppercase" data-validate="validate(required)" placeholder="DESCRIPCI&Oacute;N"></textarea>
				</div>
                
                <div class="form-group">
					<label for="marca">Marca: </label>
					<select class="form-control" id="marca" name="marca" data-validate="validate(select(una marca))">
						<option value="">-- seleccione --</option>
						<option value="FEBEST">FEBEST</option>
						<option value="JAFERPA">JAFERPA</option>
						<option value="DANAPAC">DANAPAC</option>
						<option value="KEYBOL">KEYBOL</option>
						<option value="MOPAR">MOPAR</option>
						<option value="ASHIMORI">ASHIMORI</option>
						<option value="TNK">TNK</option>
						<option value="CIC">CIC</option>
						<option value="MOTORCRAF">MOTORCRAF</option>
						<option value="INR">INR</option>
						<option value="ELGIN">ELGIN</option>
						<option value="TITANIUM">TITANIUM</option>
						<option value="a-ALLEN">T-ALLEN</option>
						<option value="WHEEL PRO">WHEEL PRO</option>
						<option value="UNICA">UNICA</option>
						<option value="NAKAYAMA">NAKAYAMA</option>
						<option value="HELLIN-MOTORS">HELLIN-MOTORS</option>
						<option value="GABRIELS">GABRIELS</option>
						<option value="METALCAR">METALCAR</option>
						<option value="BAKO STAR">BAKO STAR</option>
						<option value="DAI">DAI</option>
						<option value="NAVCAR">NAVCAR</option>
						<option value="FGV">FGV</option>
						<option value="TORFLEX">TORFLEX</option>
						<option value="HARRIS">HARRIS</option>
					</select>
				</div>

				<div class="form-group">
					<label for="componente">Componente: </label>
					<select class="form-control" id="componente" name="componente" data-validate="validate(select(componente))">
						<option value="">-- seleccione --</option>
						<option value="SUSPENCION DELANTERA">SUSPENCION DELANTERA</option>
						<option value="SUSPENCION TRASERA">SUSPENCION TRASERA</option>
						<option value="SOPORTES DE MOTOR">SOPORTES DE MOTOR</option>
						<option value="KITS DE TIEMPO">KITS DE TIEMPO</option>
                        <option value="KITS DE CROCHE">KITS DE CROCHE</option>
                        <option value="KITS DE CAJA">KITS DE CAJA</option>
                        <option value="AMORTIGUADOR">AMORTIGUADOR</option>
                        <option value="ESPIRALES">ESPIRALES</option>
                        <option value="BASES">BASES</option>
                        <option value="GOMAS VARIAS">GOMAS VARIAS</option>
                        <option value="VARIOS">VARIOS</option>
					</select>
				</div>
								
				<div class="form-class">
					<label for="direccion">Direcci&oacute;n</label>
					<select class="form-control" id="direccion" name="direccion">
						<option value="n">N/M</option>
						<option value="a">AUTOM&Aacute;TICO</option>
						<option value="s">SINCR&Oacute;NICO</option>
					</select>
				</div>
				<br>
				<div class="form-class">
					<label for="imagen">Imagen de pieza:</label>
					<input id="imagen" name="imagen" type="file" data-validate="validate(imagen())">
					<p class="help-block">Maximo 50MB</p>
				</div>

				<div class="form-class">
					<label for="img_esquema">Imagen de esquema:</label>
					<input id="img_esquema" name="img_esquema" type="file" data-validate="validate(imagen())">
					<p class="help-block">Maximo 50MB</p>
				</div>			
				
				<div>
					<div class="form-class pull-left">
						<button class="btn btn-danger" name="cancelar" id="cancelar" onClick="location.href='adm_piezas.php'" type="button">Cancelar</button>
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