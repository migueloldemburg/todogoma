<?php include("security.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Check Client</title>
	<?php require('libs.php'); ?>
	<style>
		.dataTables_paginate {
			min-width: 40px;
		}
	</style>
	<script>
		function showDiv(div){
			$('#'+div).fadeIn();
		}

		function hideDiv(div){
			$('#'+div).fadeOut();
		}
		
		$( document ).ready(function() {
		    var subtotal = $("#subtotal").text();
		    $("#subtotal2").text(subtotal);
		    $("#subtotal3").text(subtotal);

		    document.onkeypress = function()
			{
				var tecla;
				tecla = (document.all) ? event.keyCode : event.which;
				if(tecla == 13)
				{document.getElementById('botonBuscar').onclick();}
			}

		});

		function generarFactura(id)
		{
			if(!$("#"+id).hasClass("disabled"))
			{			
				alertify.confirm("Desea confirmar esta compra?.",
				  function(){
				  	var cliente = $('#cedulaN').val();
				  	var refPago = $('#refPago').val();
				  	var comentario = $('#comentario').val();
				    location.href='reg_factura.php?cliente='+cliente+'&refPago='+refPago+"&comentario="+comentario;
				  },
				  function(){
				    //
				  });
				$('div.ajs-header').empty().text("Confirmar");
				$(".ajs-dialog").css("max-width", "300px");
			}
			
		}
	</script>
</head>
<body>
	<?php include("modals/modalRegistrarCliente.php");?>
	<?php include("modals/modalEditarCliente.php");?>
	<?php
		$carrito = true;
		include('zBarraBuscar.php'); 
	?>
	
	<section class="main container-fluid" style="min-height:780px;">
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
				<button class="btn btn-primary pull-right" onClick="location.href='checkCart.php'">
                	<span class="glyphicon glyphicon-shopping-cart" style="font-size:20px;"></span> Carrito <span class="badge"><?php echo count($_SESSION['detalle']);?></span>
                </button>
			</section>
		</div>
		
		<div class="row" style="margin-top:20px;">
		
			<section class="col-md-3">
				<div class="lateral">	
					
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
				<div style="min-height:720px; border-radius:6px"> <!--contenedor 1-->
				<?php 
					if(count($_SESSION['detalle'])>0)
					{
				?>
					<div style="float:right; margin-right:70px; min-width:280px;" id="procesarDivSuperior">
						<table class="table">
							<tr>
								<th width="120px">Subtotal:</th>
								<td id="subtotal2"></td>
							</tr>
							<tr>
								<th>Total</th>
								<td id="subtotal3" style="font-weight:bold;"></td>
							</tr>
						</table>
						<div class="form-group">
                            <label for="refPago">#Ref. Pago</label>
                            <input class="form-control" type="text" id="refPago" name="refPago" disabled="disabled" maxlength="80" value="">
                        </div>
                        <div class="form-group">
							<label for="mensaje">Comentario:</label>
							<textarea style="text-transform:uppercase;" class="form-control" id="comentario" placeholder="comentario" rows="2" disabled="disabled"></textarea>
						</div>

						<button type="button" class="btn btn-primary pull-right disabled" id="botonProcesar1" onClick="generarFactura(this.id)">
                        	Procesar orden <span class="glyphicon glyphicon-menu-right"></span>
                        </button>

					</div>
                 <?php
             		}
                 ?>
					<div class="div_cliente">
						<h4>Cliente</h4>
                        <div class="form-group">
                            <div class="input-group">
                                <input class="form-control" type="text" style="height:34px; text-transform:uppercase;" placeholder="C&eacute;dula o rif" id="cedulaBuscar" name="cedulaBuscar" >
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" id="botonBuscar" onClick="buscarCliente(document.getElementById('cedulaBuscar').value)"><span class="glyphicon glyphicon-search"></span></button>
                                </span>
                            </div>
                        </div>
                        <div id="cargar_cliente"><!-- se carga dinamicamente en buscarCliente.php-->
	               			<div style="padding-left:10px"> <!-- inciio 2 -->
	                            <div class="form-group">
	                                <label for="cedula">C&eacute;dula:</label>
	                                <input class="form-control" type="text" name="cedulaN" readonly value="">
	                            </div>
	                            <div class="form-group">
	                                <label for="cliente">Cliente:</label>
	                                <input class="form-control" type="text" name="cliente" readonly value="">
	                            </div>
	                            <div class="form-group">
	                                <label for="direccion">Direcci&oacute;n:</label>
	                                <input class="form-control" type="text" name="direccion" readonly value="">
	                            </div>
	                            <div class="form-group">
	                                <label for="telefono">Tel&eacute;fono:</label>
	                                <input class="form-control" type="text" name="telefono" readonly value="">
	                            </div>
				   		    </div> 							<!--fin 2 -->
				   		</div>  
					</div><!--Fin div cliente-->

					<div  style="min-height:520px; border-radius:6px" id="tabla_carrito">
					<?php  if(isset($_SESSION['productosAA']))
							{
					?>
								<div class="alert alert-danger">
					  			<strong>¡Disculpe!</strong> la existencia de los siguientes articulos en el inventario es m&aacute;s baja de lo que intenta procesar:
					  			<table class="table">
					  				<thead>
					  					<tr>
					  						<th>Producto</th>
					  						<th>Cantidad en existencia</th>
					  					</tr>
					  				</thead>
					  				<tbody>
									<?php
										echo $_SESSION['productosAA'];
									?>
					  				</tbody>
					  			</table>
								</div>
					<?php
							}
						//unset($_SESSION['detalle']);
						$total = 0;
						if(count($_SESSION['detalle'])>0)
						{
					?>
						<!--TABLA DE PRODUCTOS-->
						<table class="table table-stripped" border="0">
							<thead>
								<tr>
									<th width="10px">N#</th>
									<th width="10px"></th>
									<th>Art&iacute;culo(s)</th>
									<th>Cantidad</th>
									<th>Precio (Bf.)</th>
									<th>Total (Bf.)</th>
								</tr>
							</thead>
							<tbody>
							<?php
								
							foreach($_SESSION['detalle'] as $key=>$carrito)
							{
								    //echo 'Id:'.$carrito['Id'].'-Pieza:'.$carrito['Pieza'].'-Cant:'.$carrito['Cant'].'<br>';
									$pieza = new Piezas;
									$pieza->getPieza($carrito['Pieza']);
							?>
								<tr>
									<td><?php echo $carrito['Id']?></td>
									<td><span class="glyphicon glyphicon-remove border" style="cursor:pointer" onClick="eliminarCarritoItem('<?php echo $carrito['Id']?>')"></span></td>
									<td>
										<div class="img_producto">
											<?php
		                                    if($pieza->Imagen ==''){
		                                        echo "<img src=\"images/noimage.jpg \"></a>";
		                                    }else{
		                                        echo "<img src=\"images/piezas/".$pieza->Imagen." \"></a>";
		                                    }
		                                    ?>
										</div>
										<p class="nom_producto"><?php echo $pieza->Nombre ?></p>
										<p class="ref_producto"><?php echo $pieza->Ref; ?></p>
									</td>
									<td>
										<?php
											$pieza = new Piezas;
											$pieza->checkStock($carrito['Pieza'], $_SESSION['tienda_']);

											//Iniciar objeto tasa para colocar los precios.
							                $tasa = new Tasas();
							                $tasa->getLast();
							                $tasa->convertPricetoBolivares($pieza->precio); 
							                /* 
							                llamando a este método con el precio de parámetro, y llamando previamente al método getLast() se puede obtener los precios en BS según la ultima tasa registrada.
							                $tasa->precio / $tasa->precio_formatted
							                */
										?>
										<span class="glyphicon glyphicon-minus border controllers" onClick="sumarRestarItem('<?php echo $carrito['Id'] ?>','restar','<?php echo $pieza->cant ?>')"></span>
										<span class="cantidad" id="cantidad<?php echo $carrito['Id'] ?>"><?php echo $carrito['Cant'];?></span>
										<span class="glyphicon glyphicon-plus border controllers" onClick="sumarRestarItem('<?php echo $carrito['Id'] ?>','sumar','<?php echo $pieza->cant ?>')">
										</span>
										<h6 style="color:blue">stock (<?php echo $pieza->cant; ?>)</h6>
									</td>
									<td>
										<div data-toggle="tooltip" title="<?php echo $pieza->precio ?>"><?php echo $tasa->precio_formatted; ?></div>
									</td>
									<td><?php $totalxPieza = $tasa->precio * $carrito['Cant']; echo number_format($totalxPieza,2,",","."); ?></td>
								</tr>
								
							</tbody>
							<?php
								$total = $total + $totalxPieza ;
								}
							?>
						</table>
						<!--TABLA DE PRODUCTOS-->

						<div style="float:right; margin-right:70px">
							<table class="table">
								<tr>
									<th width="120px">Subtotal:</th>
									<td id="subtotal"><?php echo number_format($total,2,",", ".") ?></td>
								</tr>
								<tr>
									<th>Total</th>
									<td><strong><?php echo number_format($total,2,",", ".") ?></strong></td>
								</tr>
							</table>
							<button type="button" class="btn btn-primary pull-right disabled" id="botonProcesar2" onClick="generarFactura(this.id)">
	                        	Procesar <span class="glyphicon glyphicon-menu-right"></span>
	                        </button>
						</div>

					<?php
						}else{
							echo "<p>No hay productos agregados</p>";
						}
					?>
					</div>
					
				</div> <!--Fin contenedor 1-->
			</section>

		</div>
	</section>
	<?php
		include('zFooter.php');
	?>
</body>
</html>