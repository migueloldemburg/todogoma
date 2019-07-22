<?php include("security.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Todogoma</title>
	<?php require('libs.php'); ?>

	<link rel="stylesheet" type="text/css" href="Jquery/DataTables-1.10.12/media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="Jquery/DataTables-1.10.12/media/css/dataTables.bootstrap.css">
	<script type="text/javascript" charset="utf8" src="Jquery/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf8" src="Jquery/DataTables-1.10.12/media/js/dataTables.bootstrap.js"></script>
	
	<style>
		.dataTables_wrapper .dataTables_paginate .paginate_button {
			padding: 0;
		}
		.dataTables_wrapper { font-size: 12px }
	</style>
	
	<script type="text/javascript">
		$(function() {
			$( "#tabs" ).tabs({
				collapsible: false
			});
			
			$(".currency").maskMoney({prefix:'Bf. ', allowNegative: false, thousands:'.', decimal:',', affixesStay: false});		
		});

		$(document).ready(function() {
			$("table.display").DataTable({
				"stateSave": "true",
				"language": {
	            "lengthMenu": "Mostrar _MENU_ resultados por p&aacute;gina",
	            "zeroRecords": "Sin resultados",
	            "info": "Mostrando p&aacute;gina _PAGE_ de _PAGES_",
	            "infoEmpty": "No hay resultados disponibes",
	            "infoFiltered": "(filtered from _MAX_ total records)",
	            "search": "Buscar:",
	            "oPaginate": {
			        "sFirst":    "Primero",
			        "sLast":     "Último",
			        "sNext":     "Siguiente",
			        "sPrevious": "Anterior"
			      },
	    		 }
			});
		});

	</script>

</head>
<body>
	<?php
		$ventas = true;
		include('zBarraBuscar.php'); 
	?>
	<section class="jumbotron">
		<div class="container">
			<h1>Seleccione el rango de fecha:</h1>
		</div>
	</section>
	
	<section class="main container-fluid">
		
        <div class="row">
			<section class="col-md-10">
			</section>
			<section class="col-md-2">
				<button class="btn btn-primary pull-right" onClick="location.href='checkCart.php'"><span class="glyphicon glyphicon-shopping-cart" style="font-size:20px;"></span> Carrito <span class="badge"><?php echo count($_SESSION['detalle']);?></span></button>
			</section>			
		</div>
		
		<div class="row">

			<section class="col-md-12 text-center">
				<div id="tabs">
		            <ul>
		                <li><a href="#tabs-1">Por meses</a></li>
						<li><a href="#tabs-2">Por Rango de fechas</a></li>
		            </ul>

<!--*******************************************************Tab1***********************************************************-->						
		            <div id="tabs-1">
		                	<div class="form-group" style="width:400px;">
								<label for="mes">Seleccione el mes:</label>
	                            <select class="form-control" id="mesFactura" name="mesFactura">
								<?php 
								    $meses = array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
								    for($i=1; $i<=date('m');$i++)
								    {
								?>
	                            		<option <?php if(date('m')==$i) echo 'selected'; ?> value="<?php echo $i; ?>"><?php echo $meses[$i]; ?></option>
	                            <?php 
	                            	}
	                            ?>
	                            </select>
							</div> 

							<!--DATA TABLE-->
							<table id="datos1" class="display table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
								    	<th>N&deg;</th>
								        <th>C&oacute;digo</th>
								        <th>Usuario</th>
								        <th>Cliente</th>
								        <th>C&eacute;dula Cliente</th>
								        <th>Tienda</th>
								        <th>Fecha</th>
								        <th>Hora</th>
								        <th>Monto Total (Bs.)</th>
								        <th width="10px">Ver</th>
								    </tr>
								</thead>
								<tbody>
								<?php
									$factura = new Facturas();
									$factura->cargarFacturasxMes(date('m'), date('Y'), $_SESSION['tienda_']);
									$i=0;
									$total=0;

									while($array=$factura->sql->fetch_assoc())
									{
										$i++;
										$cliente = new Clientes();
										$cliente->getCliente($array['id_cliente']);
								?>
									<tr>
								        <td><?php echo $i ?></td>
								        <td><?php echo $array['codigo']?></td>
								        <td><?php echo $array['id_usuario']?></td>
								        <td><?php echo $cliente->Nombre.' '.$cliente->Apellido;?></td>
								        <td><?php echo $cliente->Cedula;?></td>
								        <td><?php echo $array['nombre'].'-'.$array['estado'].'-'.$array['ciudad']?></td>
								        <td><?php echo date('d-m-Y', strtotime($array['fecha']));?></td>
								        <td><?php echo date('h:m a', strtotime($array['fecha']));?></td>
								        <td>
								        <?php
								        	$facturaDet = new Facturas();
								        	$facturaDet->detallarFactura($array['codigo']);
								        	while($f=$facturaDet->sql->fetch_assoc())
								        	{
								        		$totalProducto = $f['cantidad'] * $f['precio'];
								        		$total = $total + $totalProducto;
								        	}
								        	echo number_format($total,2,',', '.');
								        	
								        ?>
								        </td>
								        <td>
								        	<button clas="btn btn-sm btn-default" data-toggle="modal" data-codigo="<?php echo $array['codigo']?>" data-target="#verFactura">
								        		<span class="glyphicon glyphicon-search"></span>
								        	</button>
								        </td>
								    </tr>

								<?php
										$total = 0;
								        $totalProducto = 0;
									}
								?>
								</tbody>
							</table>
							<!-- Data Table -->
							
		            </div>			        
<!--**********************************************************Tab1*************************************************************************-->		
<!--**********************************************************Tab2*************************************************************************-->		                	
		            <div id="tabs-2">
		            		<form class="form-inline">
	                			<div class="form-group">
	                				<label for="fecha1">Fecha Inicio:</label>
	                				<input type="text" id="fecha1" name="fecha1">
	                			</div>

	                			<div class="form-group">
	                				<label for="fecha2">Fecha Final:</label>
	                				<input type="text" id="fecha2" name="fecha2">
	                			</div>
	                			<div class="form-group">
	                				<button id="buscarFacturaRango" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-search"></span></button>
	                			</div>
	                		</form>
	                		
	                			<!--DATA TABLE-->
								<table id="datos2" class="display table table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
									    	<th>N&deg;</th>
									        <th>C&oacute;digo</th>
									        <th>Usuario</th>
									        <th>Cliente</th>
									        <th>C&eacute;dula Cliente</th>
									        <th>Tienda</th>
									        <th>Fecha</th>
									        <th>Hora</th>
									        <th>Monto Total (Bs.)</th>
									        <th width="10px">Ver</th>
									    </tr>
									</thead>
									<tbody>
									<?php
										$factura = new Facturas();
										$factura->cargarFacturasxRango(date('00-00-0000'), date('00-00-0000'), $_SESSION['tienda_']);
										$i=0;

										while($array=$factura->sql->fetch_assoc())
										{
											$i++;
											$cliente = new Clientes();
											$cliente->getCliente($array['id_cliente']);
									?>
										<tr>
									        <td><?php echo $i ?></td>
									        <td><?php echo $array['codigo']?></td>
									        <td><?php echo $array['id_usuario']?></td>
									        <td><?php echo $cliente->Nombre.' '.$cliente->Apellido;?></td>
									        <td><?php echo $cliente->Cedula;?></td>
									        <td><?php echo $array['nombre'].'-'.$array['estado'].'-'.$array['ciudad']?></td>
									        <td><?php echo date('d-m-Y', strtotime($array['fecha']));?></td>
									        <td><?php echo date('h:m a', strtotime($array['fecha']));?></td>
									        <td>
									        <?php
									        	$facturaDet = new Facturas();
									        	$facturaDet->detallarFactura($array['codigo']);
									        	while($f=$facturaDet->sql->fetch_assoc())
									        	{
									        		$totalProducto = $f['cantidad'] * $f['precio'];
									        		$total = $total + $totalProducto;
									        	}
									        	echo number_format($total,2,',', '.');
									        	
									        ?>
									        </td>
									        <td>
									        	<button clas="btn btn-sm btn-default" data-toggle="modal" data-codigo="<?php echo $array['codigo']?>" data-target="#verFactura">
									        		<span class="glyphicon glyphicon-search"></span>
									        	</button>
									        </td>
									    </tr>

									<?php
											$total = 0;
									        $totalProducto = 0;
										}
									?>
									</tbody>
								</table>
								<!-- Data Table -->
			            </div>
	            	</div>
<!--**********************************************************Tab2*************************************************************************-->		
	            </div><!--Tabs-->
			</section>
			
		</div>
	</section>
	 <form id="" class="form-horizontal">
		<div class="modal fade" id="verFactura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="exampleModalLabel">Visualizar Factura</h4>
		      </div>
		      <div class="modal-body">
					   <div id="datos_ajax"></div>

		         <div class="form-group">
		            <label for="cedula" class="control-label col-sm-4">C&eacute;dula / Rif:</label>
		            <div class="col-sm-8">
		                <input type="text" style="text-transform:uppercase;" class="form-control" name="cedula" id="cedula">
		            </div>
		        <div class="form-group">
		              <label for="nombre" class="control-label col-sm-4">Nombre:</label>
		              <div class="col-sm-8">
		                <input type="text" style="text-transform:uppercase;" class="form-control" name="nombre0" id="nombre0" maxlength="50" required>

		              </div> 
		        </div>
		        <div class="form-group">
		              <label for="apellido" class="control-label col-sm-4">Apellido:</label>
		              <div class="col-sm-8">
		                <input type="text" style="text-transform:uppercase;" class="form-control" name="apellido0" id="apellido0" maxlength="50">
		              </div> 
		        </div>
		        <div class="form-group">
		             <label for="direccion" class="control-label col-sm-4">Direcci&oacute;n:</label>
		             <div class="col-sm-8">
		                <textarea class="form-control" style="text-transform:uppercase;" name="direccion0" id="direccion0" placeholder="Direcci&oacute;n:"></textarea>
		        </div>
		        </div>
		        <div class="form-group">
		              <label for="telefono" class="control-label col-sm-4">Tel&eacute;fono:</label>
		              <div class="col-sm-8">
		                  <input type="text" class="form-control" name="telefono0" id="telefono0" maxlength="20">
		              </div> 
		        </div>
		          
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		        <button type="submit" class="btn btn-primary">Actualizar datos</button>
		      </div>
		    </div>
		  </div>
		</div>
		</form>
	<?php
		include('zFooter.php');
	?>
</body>
</html>