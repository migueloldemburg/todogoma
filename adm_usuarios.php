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

	function confirmar(usuario){ 
	confirmar=confirm("\u00bfRealmente desea deshabilitar a "+usuario+"?"); 
		if (confirmar){
			
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
                <button class="btn btn-primary pull-right" style="margin-top:17px;" onClick="location.href='reg_usuario.php'">
                	<span class="glyphicon glyphicon-plus"></span> Nuevo Usuario
                </button>
            </div>
        </div>
		
        <div class="row">
			<div class="col-xs-12">
				<h3>Adm Usuarios</h3>
			</div>
        </div>
        
        <div class="row White" style="margin-bottom:220px;">
			<div class="col-xs-9">
				<table class="display table table-striped table-hover table-condensed" border="0" id="datos">
                  <thead>
					<tr>
						<th width="1px">E</th>
						<th width="250px;">Usuario</th>
						<th>Id</th>
						<th>Tienda</th>
                        <th>Nivel</th>
                        <th width="150px">Opciones</th>
					</tr>
                  </thead>
                  <tbody>
                  <?php 
				  		$usuario = new Usuarios;
						$usuario->cargarTabla();
						while($arreglo = $usuario->sql->fetch_assoc())
						{
				  ?>
					<tr>
                    	<td align="center">
						<?php
                        	if($arreglo['estado'] == 0){
									echo "<img src='images/off.png'> ";
								}else{
									echo "<img src='images/on.png'> ";
								}
						?>                        
                        </td>
                        <td><?php  echo $arreglo['nombre']." ".$arreglo['apellido']; ?></td>
                        <td><?php  echo $arreglo['usuario'] ?></td>
                        <td>
							<?php 
									$tiendita = new Tiendas;
									$tiendita->getTienda($arreglo['id_tienda'] );
									echo $tiendita->Nombre.'-'.$tiendita->Estado.'-'.$tiendita->Ciudad;
							?>
						</td>
                        <td><?php  echo $arreglo['nivel'] ?></td>
                        <td>
<button class="btn btn-default btn-xs" onClick="location.href='edit_usuario.php?xlmn=<?php echo $arreglo["usuario"]?>'">
	<span class="glyphicon glyphicon-pencil" style="font-size:12px"></span>
</button>
                        <?php
								if($arreglo['estado'] == 1){?>
<button class="btn btn-default btn-xs" onClick="cambiar_estado('Jquery/phpAjax/cambiar_estado.php', '<?php echo $arreglo["usuario"]?>', '0')">Deshabilitar
</button>
						  <?php }else{ ?>
<button class="btn btn-default btn-xs" onClick="cambiar_estado('Jquery/phpAjax/cambiar_estado.php', '<?php echo $arreglo["usuario"]?>', '1')">Habilitar
</button>
						  <?php } ?>                           
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