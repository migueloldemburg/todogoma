<?php
 include('security2.php');
 
if(isset($_GET['id'])){
	$pieza = new Piezas;
	$pieza->getPieza($_GET['id']);
}
 
 if(isset($_POST['guardar']))
 {
	 $img_pieza = new Imagenes;
	 //Se crea la imagen (#FILE, #directorio, #nombre de imagen)
	 $img_pieza->init($_FILES['imagen'], "images/piezas/item".$num."/", "p-".$num);
	 
	 $img_esquema = new Imagenes;
	 $img_esquema->init($_FILES['img_esquema'], "images/piezas/item".$num."/", "e-".$num);
	 
	 if($img_pieza->_r == "" || $img_esquema->_r==""){
		 $piezaB = new Piezas;
		 $piezaB->registrar($_POST['oem'], $_POST['ref'], $_POST['marca'], $_POST['nombre'], $_POST['componente'],  $_POST['direccion'], "item".$num."/".$img_pieza->imagen_ruta, "item".$num."/".$img_esquema->imagen_ruta);
		 
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
   
    <link href="Jquery/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="Jquery/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
    <script src="Jquery/funcionesAjax.js"></script>
	 <script type="text/javascript">
	 	$().ready(function() {
	 		//$('#reg_pieza').ketchup();
			
			$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
			$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
		});
	 </script> 

     <style>
		.ui-tabs-vertical { width: 55em; }
		.ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
		.ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
		.ui-tabs-vertical .ui-tabs-nav li a { display:block; }
		.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
		.ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 40em;}
	</style>
</head>
<body background="images/background-car.jpg">
	
	<header>
		<div class="container">
			<h2 class="text-center">TODOGOMA</h2>
		</div>
	</header>
	
	<section class="container-fluid Madang">
    	
        <div class="row">
             <div class="col-md-6">
                 <button class="btn btn-primary pull-left" style="margin-top:17px;" onClick="location.href='edit_pieza.php?id=<?php echo $pieza->Id; ?>'">
                    <span class="glyphicon glyphicon-arrow-left"></span> Volver
                </button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary pull-right" style="margin-top:17px;" onClick="location.href='adm_piezas.php'">
                	<span class="glyphicon glyphicon-list-alt"></span> Adm Piezas
                </button>
            </div>
        </div>
        
        
		<section class="row">
        	<div class="col-md-6">
                <h4 class="Madang">Informaci&oacute;n sobre la pieza:</h4>
            	<table class="table">
                	<tr>
                    	<th width="200px;">#OEM:</th><td><?php echo $pieza->Oem ?></td>
                    </tr>
                    <tr>
                    	<th>Ref.:</th><td><?php echo $pieza->Ref ?></td>
                    </tr>
                    <tr>
                    	<th>Nombre:</th><td><?php echo $pieza->Nombre ?></td>
                    </tr>
                    <tr>
                    	<th>Descripci&oacute;n:</th><td><?php echo $pieza->Descripcion ?></td>
                    </tr>
                    <tr>
                    	<th>Marca:</th><td><?php echo $pieza->Marca ?></td>
                    </tr>
                    <tr>
                    	<th>Componente:</th><td><?php echo $pieza->Componente ?></td>
                    </tr>
                    <tr>
                    	<th>Direcci&oacute;n:</th>
                        <td>
						<?php
								switch($pieza->Direccion)
								{
									case 'N': echo 'S/N'; break;
									case 'A': echo 'AUTOM&Aacute;TICO'; break;
									case 'S': echo 'SINCR&Oacute;nico'; break;
								}
						?></td>
                    </tr>
                    <tr>
                    	<th>Modelo Principal</th>
                        <td>
                        <?php
							$checkModelo = new Piezas;
							$modeloPr = $checkModelo->checkModeloPrincipal($pieza->Id);
							
							if($modeloPr) //Si existe un modelo principal se cargan los select
							{
						?> 
                                <div class="form-group modelo_principal" id="cargarMarca">
                                	<label for="fabricante">Marca:</label>
                                    <select class="form-control" id="fabricante" name="fabricante" onChange="cargarModelo('Jquery/phpAjax/cargarModelo.php', this.value);document.getElementById('cargarBotonA').disabled=false"> 
                                        <option value=""></option>
                                        <?php
                                        $fabri = new Fabricantes;
                                        $fabri->cargarTabla();
                                            
                                        while($fabris=$fabri->sql->fetch_assoc())
                                        {
                                        ?>
                                        <option value="<?php echo $fabris['id'] ?>" <?php if($checkModelo->Id_marca==$fabris['id']){ echo 'selected';} ?>><?php echo $fabris['nombre'] ?></option>
                                        <?php
                                        }
                                        ?>
                                   </select>
                                </div>
                                <div class="form-group modelo_principal" id="cargarModelo">
                                	<label for="modelo">Modelo:</label>
                                        <select class="form-control modelo_principal" id="modelo" name="modelo" onChange="document.getElementById('cargarBotonA').disabled=false">
                                            <option value="">- SELECCIONE -</option>
                                        <?php
											
											$modeloN = new Modelos;
                                            $modeloN->cargarModeloxMarca($checkModelo->Id_marca);
                                            
                                            while($modelosN=$modeloN->sql->fetch_assoc())
                                            {
                                        ?>
                                                <option value="<?php echo $modelosN['id'] ?>" <?php if($checkModelo->Id_modelo==$modelosN['id']) echo 'selected'; ?>><?php echo $modelosN['nombre'].' '.$modelosN['ano'] ?></option>
                                        
                                        <?php
                                            }
                                        ?>
                                        </select>
                                </div>
                                 <div id="cargarBoton">
                                    <button class="btn btn-xs btn-success" disabled="true" id="cargarBotonA" onClick="relacionPiezaModelo('Jquery/phpAjax/relacionPiezaModelo.php','<?php echo $pieza->Id ?>','No','1', 'tabs', 'false')">
                <span class="glyphicon glyphicon-floppy-saved"></span> Guardar
                                    </button>
                                    <button class="btn btn-xs btn-danger pull-right" onClick="relacionPiezaModelo('Jquery/phpAjax/RelacionPiezaModelo.php','<?php echo $pieza->Id ?>','No','1', 'tabs', 'true')">
                                    	<span class="glyphicon glyphicon-trash"></span>
                                    </button>
                       			 </div>
                         <?php
							}else{
						 ?>		                    
								 <button class="btn btn-xs btn-success pull-left" id="boton_agregar" onClick="cargarMarca('Jquery/phpAjax/cargarMarca.php')">
                                    <span class="glyphicon glyphicon-plus"></span> Agregar modelo
                                </button>
                                <div class="form-group modelo_principal" id="cargarMarca">
                                </div>
                                <div class="form-group modelo_principal" id="cargarModelo">
                                </div>
                                <div id="cargarBoton" style="display:none">
                                    <button class="btn btn-xs btn-success" style="margin-top:10px;"  onClick="relacionPiezaModelo('Jquery/phpAjax/relacionPiezaModelo.php','<?php echo $pieza->Id ?>','No','1', 'tabs', 'false')">
                <span class="glyphicon glyphicon-floppy-saved"></span> Guardar
                                    </button>
                       			 </div>
						 <?php
							}
						 ?>
                        </td>
                    </tr>
                   
                </table>
            </div>
            <div class="col-md-6">
            	<div class="img">
                	<p>Imagen de pieza</p>
                	<img src="images/piezas/<?php echo $pieza->Imagen ?>">
                </div>
                <div class="img">
                	<p>Esquema de pieza</p>
                	<img src="images/piezas/<?php echo $pieza->Img_esquema ?>">
                </div>
                
            </div>
		</section>
  		<section class="row">
        	<div class="col-md-12" style="margin-bottom:20px;">
            	<h4 class="Madang">Modelos compatibles con esta pieza:</h4>
                <div id="tabs">
                  <?php
				  	$fabricante = new Fabricantes;
					$fabricante->cargarTabla();
					
					?><ul><?php
					while($fabricantes1 = $fabricante->sql->fetch_assoc())
					{
				  ?>
                  		<li><a href="#tabs-<?php echo $fabricantes1['id']?>"><?php echo $fabricantes1['nombre'] ?></a></li>
                  <?php
					}
					?></ul><?php
					$fabricante->cargarTabla();
					while($fabricantes2 = $fabricante->sql->fetch_assoc())
					{
				  ?>
                      <div id="tabs-<?php echo $fabricantes2['id']?>">
                      	<h3><?php echo $fabricantes2['nombre'] ?></h3>
                        <?php
						$modelo = new Modelos;
						$modelo->cargarModeloxMarca($fabricantes2['id']);
						$hayRegistro = false;
						$i = 0;
						
						$id = $fabricantes2['id'];

						while($modelos = $modelo->sql->fetch_assoc())
						{
                        	  $hayRegistro = true;
						?>
                              <div class="checkbox">
                                <label>
                                 <input type="checkbox" 
                                 <?php
								 	$checkbox = new Piezas;
									$marcar = $checkbox->MarcarCheckbox($pieza->Id, $modelos['id']);
									if($marcar){ echo 'checked'; }
								  ?> 
                                 name="checkbox<?php echo $fabricantes2['id']?>"
                                 id="<?php echo $modelos['id']?>" onChange="document.getElementById('guardar<?php echo $fabricantes2['id']?>').disabled=false">
                                 <?php echo $modelos['nombre'].' - '.$modelos['ano'];?>
                                </label>
                              </div>
						<?php
						 	  $i++;
                        }
						if($hayRegistro)
						{

						?>
                            <div style="margin-top:20px">
                                <button class="btn btn-success" disabled="true" id="guardar<?php echo $fabricantes2['id']?>" name="guardar" onClick="relacionPiezaModelo('Jquery/phpAjax/relacionPiezaModelo.php','<?php echo $pieza->Id ?>','<?php echo $fabricantes2['id'] ?>','0', 'tabs<?php echo $fabricantes2['id'] ?>', 'false')">
                                	<span class="glyphicon glyphicon-floppy-saved"></span> Guardar
                                </button>
                            </div>
                        <?php
						}else{
							echo "No se ha registrado modelo de auto para esta marca.";
						}
						?>
                      </div>
                  <?php
					}
				  ?>
                </div>
            </div>
		</section>		
		
	</section>
</body>
</html>