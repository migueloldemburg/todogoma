<?php
session_start();
 function __autoload($nombre_clase)
 {
		require_once '../../class/'.$nombre_clase.'.php';
 }
 
?>
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
