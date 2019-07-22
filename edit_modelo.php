<?php
 include('security2.php');
 
 if($_GET['id']!=''){
	 $modelo = new Modelos;
	 $modelo->getModelo($_GET['id']);	 
 }
 
 if(isset($_POST['guardar']))
 {
	 $nombre = strtoupper($_POST['nombre']);
	 $ano = $_POST['ano1']."-".$_POST['ano2'];
	 
	 $fabricante = new Fabricantes;
	 $fabricante->getFabricante($_POST['fabricante']);
	 
	 if($_FILES['imagen']['tmp_name']!=''){
		
		 //Eliminamos la imagen anterior (Si la hay)
		 $modelo_img = "images/modelos/".$modelo->Imagen;
		 if(file_exists($modelo_img)){
			 $file = $modelo_img;
			 if(unlink($file)){
			 //do if failed
			 }
		 }
		 
		 //Se crea la imagen (#FILE, #directorio, #nombre de imagen)	 
		 $imagen1 = new Imagenes;
		 $imagen1->init($_FILES['imagen'], "images/modelos/".$fabricante->Nombre.'/', $fabricante->Nombre."-".$nombre."-".$ano."-".$id);
		 $imagen_ruta = $fabricante->Nombre.'/'.$imagen1->imagen_ruta;
	 }else{
		 $imagen_ruta = $modelo->Imagen;
	 } 

	 if($imagen1->_r == "") {
		 $modelo1 = new Modelos;
		 $modelo1->editar($modelo->Id, $_POST['fabricante'], $nombre, $ano, $imagen_ruta);
		 	 
	 }else{
		 echo "<script>alert('$imagen1->_r');</script>";
	}
 }
 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Modificar Modelo de Carro</title>
	<?php require('libs.php'); ?>
    
	 <script type="text/javascript">
	 	$().ready(function() {
	 		$('#reg_modelo').ketchup();
		});
		
		$.ketchup.validation('fabricante', 'Debe seleccionar una fabricante.', function(form, el, value) {
		  if(value != '') {
			return true;
		  } else {
			return false;
		  }
		});
		
		$.ketchup.validation('select2', 'Seleccion el rango de a\u00f1o.', function(form, el, value) {
		  if(value != '') {
			return true;
		  } else {
			return false;
		  }
		});
		
		/****************VALIDAR AÑO*******************/
		function cargarSelect2(valor)
		{		
			if(valor=='')
			{
				// desactivamos el segundo select
				document.getElementById("ano2").disabled=true;
			}else{
				// eliminamos todos los posibles valores que contenga el select2
				document.getElementById("ano2").options.length=0;
		 
				// añadimos los nuevos valores al select2
				var anio = (new Date).getFullYear();
				var cont = 0;
			
				if(anio == parseInt(valor)){
					document.getElementById("ano2").options[cont]=new Option('--','');
				}
				
				valor = parseInt(valor)+1;
				for(i=valor;i<=anio;i++)
				{
					document.getElementById("ano2").options[cont]=new Option(i,i);
					cont = cont + 1;
				}
		 
				// habilitamos el segundo select
				document.getElementById("ano2").disabled=false;
			}
		}
		/****************VALIDAR AÑO*******************/
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
				<h3>Modificaci&oacute;n Modelo de Carro</h3>
				<form action="" name="reg_modelo" id="reg_modelo" method="post" enctype="multipart/form-data">
				<label>Modelo N&ordm;: <?php echo $modelo->Id; ?> </label>
				<div class="form-group">
					<label for="fabricante">Fabricante: </label>
					<select class="form-control" id="fabricante" name="fabricante" data-validate="validate(fabricante())"> 
						<option value="">-- seleccione --</option>
						<?php
							$fabri = new Fabricantes;
							$fabri->cargarTabla();
 							
							while($fabris=$fabri->sql->fetch_assoc())
							{
						?>
						<option value="<?php echo $fabris['id'] ?>" <?php if($modelo->Id_marca==$fabris['id']) echo 'selected'; ?>><?php echo $fabris['nombre'] ?></option>
                        <?php
							}
						?>
					</select>
				</div>

				<div class="form-group">
					<label for="nombre">Nombre:</label>
					<input style="text-transform:uppercase" class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $modelo->Nombre ?>" placeholder="NOMBRE DEL MODELO" data-validate="validate(required)">
				</div>

                <div class="row">
                  <div class="col-xs-5">
                    <div class="form-group">
                    	<label for="ano1">A&ntilde;o</label
                        ><select class="form-control" id="ano1" name="ano1"  onChange="cargarSelect2(this.value)">
                        	<?php
                            $ano1 = substr($modelo->Ano,0,4);
							for($i=1960;$i<=date("Y");$i++){ ?>
                            	<option value="<?php echo $i ?>" <?php if($i==$ano1) echo 'selected' ?>><?php echo $i ?></option>
                          	<?php } ?>
                        </select>
                    </div>
                  </div>
                  <div class="col-xs-1">
                      <br><br>
                      -
                  </div>
                  <div class="col-xs-5">
                    <div class="form-group">
                        <label for="ano2" style="color:#F2F1EF">A</label>
                        <select class="form-control" id="ano2" name="ano2" data-validate="validate(select2())">
      <option value="<?php echo substr($modelo->Ano,5) ?>"><?php echo substr($modelo->Ano,5) ?></option>
                        </select>
                    </div>
                  </div>
                </div> 
                                                
                <div style="min-height:300px;  background:#FFF; width:100%; border:#000">
                <img style="width:100%; height:auto;" class="thumbnail" src="<?php echo 'images/modelos/'.$modelo->Imagen; ?>">
                </div>
				
				<div class="form-class">
					<label for="imagen">Imagen del modelo: <p class="help-block" style="color:#F00"><?php echo 'modelos/'.$modelo->Imagen; ?></p></label>
					<input type="file" name="imagen" id="imagen">
					<p class="help-block">Maximo 150MB</p>
				</div>
		        <strong></strong>
<div>
			<div class="form-class pull-left">
						<button class="btn btn-danger" name="cancelar" id="cancelar" type="button" onClick="location.href='adm_modelos.php'">Cancelar</button>
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