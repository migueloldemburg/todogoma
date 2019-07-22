<?php
 include('security2.php');
 
 if($_GET['id']!=''){
	 $pieza = new Piezas;
	 $pieza->getPieza($_GET['id']);
 }
  
 if(isset($_POST['guardar']))
 {
	 if($_FILES['imagen']['tmp_name']!=''){
		 $img_pieza = new Imagenes;
		 //Se crea la imagen (#FILE, #directorio, #nombre de imagen)
		 $img_pieza->init($_FILES['imagen'], "images/piezas/item".$pieza->Id."/", "p-".$pieza->Id);
		 $pieza_ruta = "item".$pieza->Id."/".$img_pieza->imagen_ruta;
	 }else{
		 $pieza_ruta = $pieza->Imagen;
	 }
	 
	 if($_FILES['img_esquema']['tmp_name']!=''){ 
		 $img_esquema = new Imagenes;
		 $img_esquema->init($_FILES['img_esquema'], "images/piezas/item".$pieza->Id."/", "e-".$pieza->Id);
		 $esquema_ruta = "item".$pieza->Id."/".$img_esquema->imagen_ruta;
	 }else{
		 $esquema_ruta = $pieza->Img_esquema;
	 }

	 $error = false;
	 if(isset($img_pieza)){
	 	if(isset($img_pieza->_r) && !$img_pieza->_r == "")
	 		$error = true;
	 }
	 if(isset($img_esquema)){
	 	if(isset($img_esquema->_r) && !$img_esquema->_r == "")
	 		$error = true;
	 }
	 
	 if(!$error){
		 $piezaB = new Piezas;
		 $piezaB->editar($pieza->Id, $_POST['id_proveedor'], $_POST['oem'], $_POST['ref'], $_POST['marca'], $_POST['nombre'], $_POST['descripcion'], $_POST['componente'],  $_POST['direccion'], $pieza_ruta, $esquema_ruta);
		 
	 } else {
		 echo "<script>alert('$img_pieza->_r \n $img_esquema->_r');</script>";
	 }
 }
  
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Modificar Pieza</title>
	<?php require('libs.php'); ?>
    
	 <script type="text/javascript">
	 	$().ready(function() {
	 		$('#edit_pieza').ketchup();
		});
		
		$.ketchup.validation('select', 'Debe seleccionar una {arg1}.', function(form, el, value, word1) {
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
				<h3>Modificaci&oacute;n Art&iacute;culo</h3>
				<form action="" name="edit_pieza" id="edit_pieza" method="post" enctype="multipart/form-data">
				<label>Art&iacute;culo N&ordm;: <?php echo $pieza->Id ?> </label>
                
                <div class="form-group">
                <?php
					$proveedor = new Proveedores;
					$proveedor->cargarTabla();							
                ?>
					<label for="id_proveedor">Proveedor: </label>
					<select class="form-control" id="id_proveedor" name="id_proveedor" data-validate="validate(select(proveedor))">
						<option value="">-- seleccione --</option>
						<?php
						$i=1;
							while($arreglo = $proveedor->sql->fetch_assoc())
							{
						?>
                        	<option value="<?php echo $arreglo['id']; ?>" <?php if($arreglo['id']==$pieza->Id_proveedor) echo 'selected' ?>><?php echo $i++.' - '.$arreglo['razon_social'] ?></option>
                       <?php } ?>
					</select>
				</div>
                
				<div class="form-group">
					<label for="oem">#OEM</label>
					<input class="form-control" type="text" name="oem" id="oem" value="<?php echo $pieza->Oem ?>" placeholder="OEM" data-validate="validate(required)">
				</div>
                
                <div class="form-group">
					<label for="ref">Referencia</label>
					<input class="form-control" type="text" name="ref" id="ref" value="<?php echo $pieza->Ref ?>" style="text-transform:uppercase" placeholder="REFERENCIA" data-validate="validate(required)">
				</div>
                
                <div class="form-group">
					<label for="nombre">Nombre de la pieza:</label>
					<input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $pieza->Nombre ?>" placeholder="NOMBRE" style="text-transform:uppercase" data-validate="validate(required)">
				</div>

				 <div class="form-group">
					<label for="descripcion">Descripci&oacute;n:</label>
					<textarea class="form-control" type="text" name="descripcion" id="descripcion" style="text-transform:uppercase" placeholder="DESCRIPCI&Oacute;N"><?php echo $pieza->Descripcion ?></textarea>
				</div>
                                
                <div class="form-group">
					<label for="marca">Marca: </label>
					<select class="form-control" id="marca" name="marca" data-validate="validate(select(marca))">
						<option value="">-- seleccione --</option>
						<option value="FEBEST" <?php if($pieza->Marca=='FEBEST') echo 'selected' ?>>FEBEST</option>
						<option value="JAFERPA" <?php if($pieza->Marca=='JAFERPA') echo 'selected' ?>>JAFERPA</option>
						<option value="DANAPAC" <?php if($pieza->Marca=='DANAPAC') echo 'selected' ?>>DANAPAC</option>
						<option value="KEYBOL" <?php if($pieza->Marca=='KEYBOL') echo 'selected' ?>>KEYBOL</option>
						<option value="MOPAR" <?php if($pieza->Marca=='MOPAR') echo 'selected' ?>>MOPAR</option>
						<option value="ASHIMORI" <?php if($pieza->Marca=='ASHIMORI') echo 'selected' ?>>ASHIMORI</option>
						<option value="TNK" <?php if($pieza->Marca=='TNK') echo 'selected' ?>>TNK</option>
						<option value="CIC" <?php if($pieza->Marca=='CIC') echo 'selected' ?>>CIC</option>
						<option value="MOTORCRAF" <?php if($pieza->Marca=='MOTORCRAF') echo 'selected' ?>>MOTORCRAF</option>
						<option value="INR" <?php if($pieza->Marca=='INR') echo 'selected' ?>>INR</option>
						<option value="ELGIN" <?php if($pieza->Marca=='ELGIN') echo 'selected' ?>>ELGIN</option>
						<option value="TITANIUM" <?php if($pieza->Marca=='TITANIUM') echo 'selected' ?>>TITANIUM</option>
						<option value="T-ALLEN" <?php if($pieza->Marca=='T-ALLEN') echo 'selected' ?>>T-ALLEN</option>
						<option value="WHEEL PRO" <?php if($pieza->Marca=='WHEEL PRO') echo 'selected' ?>>WHEEL PRO</option>
						<option value="UNICA" <?php if($pieza->Marca=='UNICA') echo 'selected' ?>>UNICA</option>
						<option value="NAKAYAMA" <?php if($pieza->Marca=='NAKAYAMA') echo 'selected' ?>>NAKAYAMA</option>
						<option value="HELLIN-MOTORS" <?php if($pieza->Marca=='HELLIN-MOTORS') echo 'selected' ?>>HELLIN-MOTORS</option>
						<option value="GABRIELS" <?php if($pieza->Marca=='GABRIELS') echo 'selected' ?>>GABRIELS</option>
						<option value="METALCAR" <?php if($pieza->Marca=='METALCAR') echo 'selected' ?>>METALCAR</option>
						<option value="BAKO STAR" <?php if($pieza->Marca=='BAKO STAR') echo 'selected' ?>>BAKO STAR</option>
						<option value="DAI" <?php if($pieza->Marca=='DAI') echo 'selected' ?>>DAI</option>
						<option value="NAVCAR" <?php if($pieza->Marca=='NAVCAR') echo 'selected' ?>>NAVCAR</option>
						<option value="FGV" <?php if($pieza->Marca=='FGV') echo 'selected' ?>>FGV</option>
						<option value="TORFLEX" <?php if($pieza->Marca=='TORFLEX') echo 'selected' ?>>TORFLEX</option>
						<option value="HARRIS" <?php if($pieza->Marca=='HARRIS') echo 'selected' ?>>HARRIS</option>
					</select>
				</div>

				<div class="form-group">
					<label for="componente">Componente: </label>
					<select class="form-control" id="componente" name="componente" data-validate="validate(select(componente))">
						<option value="">-- seleccione --</option>
<option value="SUSPENCION DELANTERA" <?php if($pieza->Componente=='SUSPENCION DELANTERA') echo 'selected'; ?>>SUSPENCION DELANTERA</option>
<option value="SUSPENCION TRASERA" <?php if($pieza->Componente=='SUSPENCION TRASERA') echo 'selected'; ?>>SUSPENCION TRASERA</option>
<option value="SOPORTES DE MOTOR" <?php if($pieza->Componente=='SOPORTES DE MOTOR') echo 'selected'; ?>>SOPORTES DE MOTOR</option>
<option value="KITS DE TIEMPO" <?php if($pieza->Componente=='KITS DE TIEMPO') echo 'selected'; ?>>KITS DE TIEMPO</option>
<option value="KITS DE CROCHE" <?php if($pieza->Componente=='KITS DE CROCHE') echo 'selected'; ?>>KITS DE CROCHE</option>
<option value="KITS DE CAJA" <?php if($pieza->Componente=='KITS DE CAJA') echo 'selected'; ?>>KITS DE CAJA</option>
<option value="AMORTIGUADOR" <?php if($pieza->Componente=='AMORTIGUADOR') echo 'selected'; ?>>AMORTIGUADOR</option>
<option value="ESPIRALES" <?php if($pieza->Componente=='ESPIRALES') echo 'selected'; ?>>ESPIRALES</option>
<option value="BASES" <?php if($pieza->Componente=='BASES') echo 'selected'; ?>>BASES</option>
<option value="GOMAS VARIAS" <?php if($pieza->Componente=='GOMAS VARIAS') echo 'selected'; ?>>GOMAS VARIAS</option>
<option value="VARIOS"<?php if($pieza->Componente=='VARIOS') echo 'selected'; ?>>VARIOS</option>
					</select>
				</div>
								
				<div class="form-class">
					<label for="direccion">Direcci&oacute;n</label>
					<select class="form-control" id="direccion" name="direccion">
						<option value="N" <?php if($pieza->Direccion=='N') echo 'selected'; ?>>N/M</option>
						<option value="A" <?php if($pieza->Direccion=='A') echo 'selected'; ?>>AUTOM&Aacute;TICO</option>
						<option value="S" <?php if($pieza->Direccion=='S') echo 'selected'; ?>>SINCR&Oacute;NICO</option>
					</select>
				</div>
				<br>
				<div class="form-class">
					<label for="imagen">Imagen de pieza: <p class="help-block" style="color:#F00"><?php echo $pieza->Imagen; ?></p></label>
					<input id="imagen" name="imagen" type="file">
                    <p class="help-block">Maximo 50MB</p>
				</div>

				<div class="form-class">
					<label for="img_esquema">Imagen de esquema: <p class="help-block" style="color:#F00"><?php echo $pieza->Img_esquema; ?></p></label>
					<input id="img_esquema" name="img_esquema" type="file">
					<p class="help-block">Maximo 50MB</p>
				</div>
				<a class="btn btn-xs btn-default" href="reg_pieza2.php?id=<?php echo $pieza->Id; ?>">Modelos compatibles</a>   
				<br><br>
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