<?php
session_start();
 if($_SESSION['nivel_']=='ADM' || $_SESSION['nivel_']=='SUPER-U'){
 function __autoload($nombre_clase)
 {
		require_once 'class/'.$nombre_clase.'.php';
 }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Administrar Usuarios</title>
  <?php require('libs.php'); ?>
  
  
  <script type="text/javascript">
    $().ready(function() {
		$('#datos').dataTable( {
		  "sPaginationType": "full_numbers"
	  	} );
    });

	function confirmar(id, nombre){ 
	confirmar=confirm("\u00bfRealmente desea eliminar el fabricante "+nombre+"?"); 
	if (confirmar) 
	 	eliminar_id(id,'Jquery/phpAjax/eliminar_id.php', 'fabricante')
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
                <button class="btn btn-primary pull-right" style="margin-top:17px;" onClick="location.href='reg_fabricante.php'">
                	<span class="glyphicon glyphicon-plus"></span> Nuevo Fabric.
                </button>
            </div>
        </div>
		
        <div class="row">
			<div class="col-xs-12">
				<h3>Adm Fabricantes</h3>
			</div>
        </div>
        
        <div class="row White" style="margin-bottom:120px;">
			<div class="col-xs-5">
				<table class="display table table-striped table-hover table-condensed" border="0" id="datos">
                  <thead>
					<tr>
						<th width="1px">Id</th>
						<th width="100px;">Nombre</th>
						<th>Imagen</th>
                        <th>Ruta</th>
                        <th>Opciones</th>
					</tr>
                  </thead>
                  <tbody>
                  <?php 
				  		$fabricante = new Fabricantes;
						$fabricante->cargarTabla();
						while($arreglo = $fabricante->sql->fetch_assoc())
						{
				  ?>
					<tr>
                    	<td align="center"><?php  echo $arreglo['id'] ?></td>
                        <td><?php  echo $arreglo['nombre'] ?></td>
                        <td>
							<img class="img-thumbnail img-rounded" style="width:100px; height:auto;" src="<?php echo 'images/fabricantes/'.$arreglo['imagen']; ?>">
                        </td>
                        <td><?php  echo $arreglo['imagen'] ?></td>
                        <td>
     <button class="btn btn-success btn-xs" onClick="location.href='edit_fabricante.php?id=<?php echo $arreglo["id"]?>'">
     	<span class="glyphicon glyphicon-pencil" style="font-size:12px"></span>
     </button>
     <button class="btn btn-danger btn-xs" onClick="confirmar('<?php echo $arreglo['id'] ?>', '<?php echo $arreglo['nombre'] ?>')">
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
<?php
}else{
   echo '<script language="javascript">
      alert("\u00A1Debe iniciar sesi\u00F3n!");
      location.href="index.php";</script>';
}
?>