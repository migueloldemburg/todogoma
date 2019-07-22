<?php include("security.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Todogoma</title>
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
		$inicio = true;
		include('zBarraBuscar.php'); 
	?>
	<section class="jumbotron">
		<div class="container">
			<h1>Seleccione la marca del veh&iacute;culo</h1>
		</div>
	</section>
	
	<section class="main container-fluid">
		
        <div class="row">
			<section class="col-md-10">
				<div class="miga-de-pan">
					<ol class="breadcrumb">
						<li class="active">Inicio</li>
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
                $catalogo->listarMarcas();
                $i = 0;
                
                
                while($arreglo = $catalogo->sql->fetch_assoc())
                {
            ?>
                <div class="marcas_div" onClick="location.href='breadcrumbs.php?fab=<?php echo $arreglo['id'] ?>'">
                    <div id="div<?php echo $i ?>" class="divName"><?php echo ucwords(strtolower($arreglo['nombre'])); ?></div>
                    <img src="images/fabricantes/<?php echo $arreglo['imagen']?>" onmouseover="showDiv('div<?php echo $i ?>')" onmouseout="hideDiv('div<?php echo $i ?>')">
                </div>
            <?php
                	$i = $i + 1;
                }
            ?>
			</section>
			
		</div>
	</section>
	 
	<?php include('zFooter.php') ?>
</body>
</html>