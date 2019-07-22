<?php include('security2.php'); ?>

<!DOCTYPE html>
<html lang="es"><head>
  <title>Administrar Tiendas</title>
  <?php require('libs.php'); ?>
  
  <script type="text/javascript">
    $().ready(function() {
		$('#datos').dataTable( {
		  "sPaginationType": "full_numbers"
	  	} );
    });

	function confirmar(id, nombre){ 
		confirmar=confirm("\u00bfRealmente desea eliminar la tienda "+nombre+"? \n Al eliminar la tienda, se eliminan automaticamente todos los productos asociadas a la misma."); 
		if (confirmar){
			eliminar_id(id,'Jquery/phpAjax/eliminar_id.php', 'tienda')
		}
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
                <button class="btn btn-primary pull-right" style="margin-top:17px;" onClick="location.href='reg_tienda.php'">
                	<span class="glyphicon glyphicon-plus"></span> Nuevo Tienda
                </button>
            </div>
        </div>
		
        <div class="row">
			<div class="col-xs-12">
				<h3>Adm Tiendas</h3>
			</div>
        </div>
        
        <div class="row White" style="margin-bottom:220px;">
			<div class="col-xs-11">
				<table class="display table table-striped table-hover table-condensed" border="0" id="datos">
                  <thead>
					<tr>
						<th width="05px">Id</th>
						<th width="120px">Nombre</th>
						<th width="150px">Estado</th>
                        <th>Ciudad</th>
                        <th width="350px">Ubicaci&oacute;n</th>
                        <th width="200px">Tel&eacute;fono</th>
                        <th>Opciones</th>
					</tr>
                  </thead>
                  <tbody>
                  <?php 
				  		$tiendas = new Tiendas;
						$tiendas->cargarTabla();
						while($arreglo = $tiendas->sql->fetch_assoc())
						{
				  ?>
					<tr>
                    	<td align="center"><?php  echo $arreglo['id'] ?></td>
                        <td><?php echo $arreglo['nombre']; ?></td>
                        <td><?php echo $arreglo['estado'] ?></td>
                        <td><?php echo $arreglo['ciudad'] ?></td>
                        <td><?php echo $arreglo['ubicacion'] ?></td>
                        <td><?php echo $arreglo['telefono'] ?></td>
                        <td>
    <button class="btn btn-success btn-xs" onClick="location.href='edit_tienda.php?id=<?php echo $arreglo["id"]?>'">
    	<span class="glyphicon glyphicon-pencil" style="font-size:12px"></span>
    </button>
    <button class="btn btn-danger btn-xs" onClick="confirmar('<?php echo $arreglo['id'] ?>', '<?php echo $arreglo['nombre'].'-'.$arreglo['estado'].'-'.$arreglo['ciudad'] ?>')">
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