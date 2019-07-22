<?php include('security2.php'); ?>

<!DOCTYPE html>
<html lang="es"><head>
  <title>Administrar Usuarios</title>
  <?php require('libs.php'); ?>
  
  <script type="text/javascript">
    $().ready(function() {
		$('#datos').dataTable( {
		  "sPaginationType": "full_numbers"
	  	} );
    });

	function confirmar(id, nombre){ 
	confirmar=confirm("\u00bfRealmente desea eliminar el proveedor "+nombre+"?"); 
	if (confirmar) 
	 	eliminar_id(id,'Jquery/phpAjax/eliminar_id.php', 'proveedor')
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
                <button class="btn btn-primary pull-right" style="margin-top:17px;" onClick="location.href='reg_proveedor.php'">
                	<span class="glyphicon glyphicon-plus"></span> Nuevo Proveedor
                </button>
            </div>
        </div>
		
        <div class="row">
			<div class="col-xs-12">
				<h3>Adm Proveedor</h3>
			</div>
        </div>
        
        <div class="row White" style="margin-bottom:220px;">
			<div class="col-xs-11">
				<table class="display table table-striped table-hover table-condensed" border="0" id="datos">
                  <thead>
					<tr>
						<th width="05px">Id</th>
						<th width="120px">RIF</th>
						<th width="250px">RS</th>
                        <th>Direcci&oacute;n</th>
                        <th>Tel&eacute;fonos</th>
                        <th>Opciones</th>
					</tr>
                  </thead>
                  <tbody>
                  <?php 
				  		$proveedor = new Proveedores;
						$proveedor->cargarTabla();
						while($arreglo = $proveedor->sql->fetch_assoc())
						{
				  ?>
					<tr>
                    	<td align="center"><?php  echo $arreglo['id'] ?></td>
                        <td><?php echo substr($arreglo['rif'],0,1).'-'.substr($arreglo['rif'],1); ?></td>
                        <td><?php  echo $arreglo['razon_social'] ?></td>
                        <td><?php  echo $arreglo['direccion'] ?></td>
                        <td><?php  echo $arreglo['telefono1'];if($arreglo['telefono2']!='') echo " / ".$arreglo['telefono2'] ?></td>
                        <td>
     <button class="btn btn-success btn-xs" onClick="location.href='edit_proveedor.php?id=<?php echo $arreglo["id"]?>'">
     	<span class="glyphicon glyphicon-pencil" style="font-size:12px"></span>
     </button>
     <button class="btn btn-danger btn-xs" onClick="confirmar('<?php echo $arreglo['id'] ?>', '<?php echo $arreglo['razon_social'] ?>')">
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