<?php include("security.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Todogoma</title>
	<?php require('libs.php'); ?>
     
</head>
<body>
	<?php
		$inicio = true;
		include('zBarraBuscar.php'); 
	?>
	<section class="jumbotron">
		<div class="container">
			<h1>Seleccione el modelo del veh&iacute;culo</h1>
		</div>
	</section>
	
	<section class="main container-fluid">
		<div class="row">
			<section class="col-md-10">
				<div class="miga-de-pan">
					<ol class="breadcrumb">
						<li><a href="catalogueA.php">Inicio</a></li>
						<li class="active">
						<?php echo ucwords(strtolower($_SESSION['fabricanteNombre_'])) ?>
                        </li>
					</ol>
				</div>
			</section>
			
			<section class="col-md-2">
				<button class="btn btn-primary pull-right" onClick="location.href='checkCart.php'"><span class="glyphicon glyphicon-shopping-cart" style="font-size:20px;"></span> Carrito <span class="badge" id="shoppingCart"><?php if(isset($_SESSION['detalle'])){ echo count($_SESSION['detalle']); }else{ echo "0"; };?></span></button>
			</section>			
		</div>
		
		<div class="row">

			<section class="col-md-12 text-center">
			<?php
				$catalogo = new Catalogos;
				$catalogo->listarNombreModelos($_SESSION['fabricanteId_']);
				$i = 0;
				
				if($catalogo->counter > 0) {
				while($arreglo = $catalogo->sql->fetch_assoc()){
			?>	
                <div class="modelos_names" onClick="location.href='breadcrumbs.php?mod=<?php echo $arreglo['nombre'] ?>'">
                    <p><?php echo $arreglo['nombre']?></p>
				</div>
			<?php
					$i = $i + 1;
				}
				}else{
					echo "No existe modelo para este fabricante";
				}
			?>
			</section>
		</div>
	</section>
	 
	<?php include('zFooter.php') ?>
</body>
</html>