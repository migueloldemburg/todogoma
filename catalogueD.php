<?php include("security.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Todogoma</title>
	<?php require('libs.php'); ?>
    
    <script>
		/* Open */
		function openNav(id) {
			document.getElementById(id).style.width = "100%";
		}
		
		/* Close */
		function closeNav(id) {
			document.getElementById(id).style.width = "0%";
		}
        $(document).ready(function(){
            buscarPiezaxComponente('TODAS');
        });
	</script>

</head>
<body>
	<?php
		$inicio = true;
		include('zBarraBuscar.php'); 
	?>
	
	<section class="main container-fluid" style="min-height:780px;">
		<!-- Abre row 1-->
        <div class="row">		
            <section class="col-md-10">
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
			</section>
			
			<section class="col-md-2">
                <button class="btn btn-primary pull-right" onClick="location.href='checkCart.php'"><span class="glyphicon glyphicon-shopping-cart" style="font-size:20px;"></span> Carrito <span class="badge" id="shoppingCart"><?php if(isset($_SESSION['detalle'])){ echo count($_SESSION['detalle']); }else{ echo "0"; };?></span></button>
			</section>
            
		</div>
		<!--Cierra row 1-->
        
        <!--Abre row 2-->
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
                            	<button type="button" class="btn btn-xs btn-primary" id="actualizarModelo" name="actualizarModelo" onClick="actualizarModelo('Jquery/phpAjax/actualizarModelo.php','')">Actualizar</button> 
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
				<div  style="min-height:720px; border-radius:6px;">
                	<!--Row para titulo y busqueda de componente-->
					<section class="row">
                    	<div class="col-md-5">
                        	<p class="modelo_p"><?php echo $modeloxS->Nombre.' ('.$modeloxS->Ano.')'; ?></p>
                        </div>
                        <div class="col-md-7">
                        	<form class="form-horizontal" action="">
                            <div class="form-group">
                                <label for="componente" class="control-label col-md-3">Componente: </label>
                                <div  class="col-md-9">
                                    <select class="form-control" id="componente" name="componente" onChange="buscarPiezaxComponente(this.value)">
                                        <option value="TODAS"> TODAS </option>
                                        <option value="SUSPENCION_DELANTERA">SUSPENCION DELANTERA</option>
                                        <option value="SUSPENCION_TRASERA">SUSPENCION TRASERA</option>
                                        <option value="SOPORTES_DE_MOTOR">SOPORTES DE MOTOR</option>
                                        <option value="KITS_DE_TIEMPO">KITS DE TIEMPO</option>
                                        <option value="KITS_DE_CROCHE">KITS DE CROCHE</option>
                                        <option value="KITS_DE_CAJA">KITS DE CAJA</option>
                                        <option value="AMORTIGUADOR">AMORTIGUADOR</option>
                                        <option value="ESPIRALES">ESPIRALES</option>
                                        <option value="BASES">BASES</option>
                                        <option value="GOMAS_VARIAS">GOMAS VARIAS</option>
                                        <option value="VARIOS">VARIOS</option>
                                    </select>
                                </div>
                            </div>
                            </form>
                        </div>
                    </section>
                  	<!--Cierra Row para titulo y busqueda de componente-->
					
                    <div id="cargar_busqueda" style="min-height:500px;">
					</div>	

                    <div id="agregar">

                    </div>
                    			
					<nav>
                    	<div class="center-block text-center"  style="margin-top:20px;">
                        	<ul class="pagination">
                                <li class="disabled"><a href="#">&laquo; <span class="sr-only">Anterior</span></a></li>
                                <li class="active"><a style="z-index:0" href="#">1</a></li>
                                <li class="disabled"><a href="#">&raquo; <span class="sr-only">Siguiente</span></a></li>
                            </ul>
                        </div>
					</nav>
                    
				</div>
			</section>
		</div>
        <!--Cierra row 2-->
	</section>
	 
	<?php include('zFooter.php'); ?>
</body>
</html>