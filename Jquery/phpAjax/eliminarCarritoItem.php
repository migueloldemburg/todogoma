<?php
	session_start();
	function __autoload($nombre_clase)
	{
		require_once '../../class/'.$nombre_clase.'.php';
	}

	$operacion = isset($_GET['operacion']) ? $_GET['operacion']: '';
	
	if($operacion=='quitar')
	{
		if(isset($_GET['id']))
		{
			unset($_SESSION['detalle'][$_GET['id']]);
			echo "<script>alertify.success('Articulo eliminado');actualizarShoppingCart(".count($_SESSION['detalle']).")</script>";
		}
	}
?>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
<?php
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
			$total = 0;
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
			<button type="button" class="btn btn-primary pull-right" onClick="location.href='checkClient.php'">
            	Procesar <span class="glyphicon glyphicon-menu-right"></span>
            </button>
		</div>

	<?php
		}else{
			echo "<p>No hay productos agregados</p>";
			?>
			<script type="text/javascript">
				$(document).ready(function(){
					$('#procesarDivSuperior').text('');
				});
			</script>
			<?php
		}
	?>