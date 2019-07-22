<?php
include("security.php");
unset($_SESSION['detalle']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Check Cart</title>
	<?php require('libs.php'); ?>
    
	<script>
		function showDiv(div){
			$('#'+div).fadeIn();

		}

		function hideDiv(div){
			$('#'+div).fadeOut();
		}
	</script>
</head>
<body>
	<?php
		$carrito = true;
		include('zBarraBuscar.php'); 
	?>
	
	<section class="main container-fluid" style="min-height:780px;">
		<!--1 row-->
        <div class="row">		
            <section class="col-md-10">
            <?php
            	if(isset($_SESSION['fabricanteNombre_']))
            	{
            ?>
				<div class="miga-de-pan">
					<ol class="breadcrumb">
						<li><a href="catalogueA.php">Inicio</a></li>
						<li>
                            <a href="catalogueB.php"><?php echo ucwords(strtolower($_SESSION['fabricanteNombre_']));?> </a>
                        </li>
                        <li><a href="catalogueC.php"><?php echo ucwords(strtolower($_SESSION['modeloNombre_'])) ?></a></li>
						<li class="active">
							<?php
                                $modeloxS = new Modelos;
                                $modeloxS->getModelo($_SESSION['modeloId_']);
                                echo ucwords(strtolower($modeloxS->Nombre.' '.$modeloxS->Ano));
                            ?>
                        </li>
					</ol>
				</div>
			<?php
				}else{
					$_SESSION['fabricanteId_'] = '1';
					$modeloxS = new Modelos;
                    $modeloxS->getModelo(5);
				}
			?>
			</section>
			
			<section class="col-md-2" onClick="location.href='checkCart.php'">
				<button class="btn btn-primary pull-right"><span class="glyphicon glyphicon-shopping-cart" style="font-size:20px;"></span> Carrito <span class="badge"><?php echo count($_SESSION['detalle']);?></span></button>
			</section>
		</div>
		
		<div class="row" style="margin-top:20px;">
		
			<section class="col-md-3">
			
            	<div  class="lateral">	
					<div class="contenedor">
   							<div class="form-group">
								<label for="marca">Marca:</label>
                                <select class="form-control" id="fabricante" name="fabricante" onChange="cargarModelo('Jquery/phpAjax/cargarModelo.php', this.value)"> 
                                    <?php
                                        $fabri = new Fabricantes;
                                        $fabri->cargarTabla();
                                        
                                        while($fabris=$fabri->sql->fetch_assoc())
                                        {
                                    ?>
                                            <option value="<?php echo $fabris['id'] ?>" <?php if($modeloxS->Id_marca==$fabris['id']) echo 'selected'; ?>><?php echo $fabris['nombre'] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
							</div>
							<div class="form-group" id="cargarModelo">
								<label for="modelo">Modelo:</label>
								<select class="form-control" id="modelo" name="modelo">
									<?php
                                        $modeloxS->cargarModeloxMarca($_SESSION['fabricanteId_']);
                                        
                                        while($modelos=$modeloxS->sql->fetch_assoc())
                                        {
                                    ?>
                                            <option value="<?php echo $modelos['id'] ?>" <?php if($modeloxS->Id==$modelos['id']) echo 'selected';?> ><?php echo $modelos['nombre'].' '.$modelos['ano'] ?></option>
                                    <?php
                                        }
                                    ?>
								</select>
							</div>
                            <div class="form-group">
                            	<button type="button" class="btn btn-xs btn-primary" id="actualizarModelo" name="actualizarModelo" onClick="actualizarModelo('Jquery/phpAjax/actualizarModelo.php','catalogueD.php')">Buscar</button> 
                            </div>								
					</div>
					
					<div class="contenedor imagen">
                    	<img src="images/modelos/<?php echo $modeloxS->Imagen ?>">
					</div>
					
					<!--<div class="contenedor">tercer contenedor
					</div>-->
				</div><!--Cierra lateral-->
			</section>
			
			<section class="col-md-9">
				<div class="checkSuccess">
					<h4 class="titulo">¡Compra realizada exitosamente!</h4>
					<h5 class="codigo">Transacci&oacute;n N° <?php echo $_GET['cod']; ?></h5>
				</div>
			</section>
			
		</div>
	</section>

	<?php include('zFooter.php') ?>
</body>
</html>