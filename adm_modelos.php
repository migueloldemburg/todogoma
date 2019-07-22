<?php include('security2.php'); ?>

<!DOCTYPE html>
<html lang="es"><head>
  <title>Administrar Piezas</title>
  <?php require('libs.php'); ?>
  
  <script type="text/javascript">
    $().ready(function() {
		$('#datos').dataTable( {
		  "sPaginationType": "full_numbers",
      "stateSave": "true"
	  	} );
    });

	function confirmar(id){ 
	confirmar=confirm("\u00bfRealmente desea eliminar el modelo "+id+"?"); 
	if (confirmar) 
	 	eliminar_id(id,'Jquery/phpAjax/eliminar_id.php','modelo');
	} 

	
</script>
</head>
<body background="images/background-car.jpg">
	
	<header>
		<div class="container">
			<h2 class="text-center">TODOGOMA</h2>
		</div>
	</header>
	
	<section class="container-fluid White">
    	<div class="row">
        	<div class="col-md-6">
            	<br>
                <button class="btn btn-primary" onClick="location.href='inicio.php'">
                    <span class="glyphicon glyphicon-arrow-left"></span> Men&uacute;
                </button>
             </div>
             <div class="col-md-6">
                <button class="btn btn-primary pull-right" style="margin-top:17px;" onClick="location.href='reg_modelo.php'">
                	<span class="glyphicon glyphicon-plus"> </span> Nuevo Modelo
                </button>
            </div>
        </div>
		
        <div class="row">
			<div class="col-xs-12">
				<h3>Adm Modelos</h3>
			</div>
        </div>
        
        <div class="row White" style="margin-bottom:220px;">
			<div class="col-xs-8">
				<table class="display table table-striped table-hover table-condensed" border="0" id="datos">
                  <thead>
					<tr>
						<th width="10px">N&deg;</th>
						<th width="180px">Marca</th>
						<th>Nombre</th>
						<th width="120px">A&ntilde;o</th>
                        <th>imagen</th>
                        <th width="50px" style="text-align:center">Opciones</th>
					</tr>
                  </thead>
                  <tbody>
                  <?php 
				  		$modelo = new Modelos;
						$modelo->cargarTabla();
						$i=1;
						while($arreglo = $modelo->sql->fetch_assoc())
						{
				  ?>
					<tr>
                    	<td><?php echo $i; ?></td>
                        <td>
							<?php
                            	$fabricante= new Fabricantes;
								$fabricante->getFabricante($arreglo['id_marca']);
								echo $fabricante->Nombre;
                            ?>
                        </td>
                        <td><?php  echo $arreglo['nombre'] ?></td>
                        <td><?php  echo $arreglo['ano'] ?></td>
                        <td><?php  echo $arreglo['imagen'] ?></td>
                        <td style="text-align:center">
                      <button class="btn btn-success btn-xs" onClick="location.href='edit_modelo.php?id=<?php echo $arreglo["id"]?>'">
                            	<span class="glyphicon glyphicon-pencil" style="font-size:12px"></span>
                            </button>
                            <button class="btn btn-danger btn-xs" onClick="confirmar(<?php echo $arreglo['id'] ?>)">
                            	<span class="glyphicon glyphicon-remove" style="font-size:12px"></span>
                            </button>
                        </td>
                    </tr>
                    <?php $i=$i+1; } ?>
                    
                  </tbody>            
                  
				</table>
			</div>            
		</div>
        
	</section>
	<?php include('zAdmFooter.php') ?>

</body>
</html>