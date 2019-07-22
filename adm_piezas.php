<?php include('security2.php'); ?>

<!DOCTYPE html>
<html lang="es"><head>
  <title>Administrar Piezas</title>
  <?php require('libs.php'); ?>
  
  <script type="text/javascript">
    $().ready(function() {
		$('#datos').dataTable( {
		  "sPaginationType": "full_numbers"
	  	} );
    });

	function confirmar(id){ 
	confirmar=confirm("\u00bfRealmente desea eliminar el articulo "+id+"?"); 
	if (confirmar) 
	 	eliminar_id(id,'Jquery/phpAjax/eliminar_id.php', 'pieza')
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
                <button class="btn btn-primary pull-right" style="margin-top:17px;" onClick="location.href='reg_pieza1.php'">
                	<span class="glyphicon glyphicon-plus"></span> Nuevo Item
                </button>
            </div>
        </div>
		
        <div class="row">
			<div class="col-xs-12">
				<h3>Adm Piezas</h3>
			</div>
        </div>
        
        <div class="row White" style="margin-bottom:220px;">
			<div class="col-xs-12">
				<table class="display table table-striped table-hover table-condensed" border="0" id="datos">
                  <thead>
					<tr>
						<th>Id</th>
						<th>OEM</th>
						<th>#REF</th>
						<th>Nombre</th>
                        <th>Marca</th>
						<th>Componente</th>
						<th>Direcci&oacute;n</th>
                        <th>Pieza</th>
                        <th>Esquema</th>
                        <th width="50px">Opciones</th>
					</tr>
                  </thead>
                  <tbody>
                  <?php 
				  		$pieza = new Piezas;
						$pieza->cargarTabla();
						while($arreglo = $pieza->sql->fetch_assoc())
						{
				  ?>
					<tr>
                    	<td><?php  echo $arreglo['id'] ?></td>
                        <td><?php  echo $arreglo['oem'] ?></td>
                        <td><?php  echo $arreglo['ref'] ?></td>
                        <td><?php  echo $arreglo['nombre'] ?></td>
                        <td><?php  echo $arreglo['marca'] ?></td>
                        <td><?php  echo $arreglo['componente'] ?></td>
                        <td><?php  echo $arreglo['direccion'] ?></td>
                        <td><?php  echo $arreglo['imagen'] ?></td>
                        <td><?php  echo $arreglo['img_esquema'] ?></td>
                        <td>
     <button class="btn btn-success btn-xs" onClick="location.href='edit_pieza.php?id=<?php echo $arreglo["id"]?>'">
     	<span class="glyphicon glyphicon-pencil" style="font-size:12px"></span>
     </button>
     <button class="btn btn-danger btn-xs" onClick="confirmar(<?php echo $arreglo['id'] ?>)">
     	<span class="glyphicon glyphicon-remove" style="font-size:12px"></span>
     </button>
                        </td>
                    </tr>
                    <?php } ?>
                    
                  </tbody>            
                  
				</table>
			</div>            
		</div>
        
	</section>
	<?php include('zAdmFooter.php') ?>

</body>
</html>