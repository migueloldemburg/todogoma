<?php include("security.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Todogoma</title>
	<?php require('libs.php'); ?>
	
    <script>
		/* Open */
		function openNav(img) {
			document.getElementById("myNav").style.height = "100%";
			document.getElementById("myImg").src = "images/modelos/"+img;
		}
		
		/* Close */
		function closeNav() {
			document.getElementById("myNav").style.height = "0%";
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
			<h1>Seleccione el modelo del veh&iacute;culo</h1>
		</div>
	</section>
	
	<section class="main container-fluid">
		<div class="row">
			<section class="col-md-10">
				<div class="miga-de-pan">
					<ol class="breadcrumb">
						<li><a href="catalogueA.php">Inicio</a></li>
						<li>
                        	<a href="catalogueB.php"><?php echo ucwords(strtolower($_SESSION['fabricanteNombre_'])) ?></a>
                        </li>
                        <li  class="active"><?php echo ucwords(strtolower($_SESSION['modeloNombre_'])) ?></li>
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
				$catalogo->listarModelos($_SESSION['fabricanteId_'], $_SESSION['modeloNombre_']);
				$i = 0;
				
				if($catalogo->counter > 0) {
				while($arreglo = $catalogo->sql->fetch_assoc()){
			?>	
                <div class="modelos_div">
    				<!-- The overlay to zoom in the pic-->
                    <div id="myNav" class="overlay">
                      <!-- Button to close the overlay navigation -->
                      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                      <!-- Overlay content -->
                      <div class="overlay-content">
                        <img id="myImg">
                      </div>
                    </div>
                    
                    <div class="img_container" onClick="location.href='breadcrumbs.php?mod_id=<?php echo $arreglo['id'] ?>'">
						<img src="images/modelos/<?php echo $arreglo['imagen'] ?>">
                  	</div>
                    <button class="btn btn-default btn-xs pull-right" style="margin:4px; margin-right:0" onClick="openNav('<?php echo $arreglo['imagen'] ?>')">
                    	<span class="glyphicon glyphicon-zoom-in"></span>
                    </button>
                    <p class="modelo_nom" onClick="location.href='breadcrumbs.php?mod_id=<?php echo $arreglo['id'] ?>'"><?php echo $arreglo['nombreFabricante'].' '.$arreglo['nombre'].' '.$arreglo['ano'] ?></p>
				</div>
			<?php
					$i = $i + 1;
				}
				}else{
					echo "No existe modelo en la Base de Datos para este fabricante";
				}
			?>
			</section>
		</div>
	</section>
	 
	<?php include('zFooter.php') ?>
</body>
</html>