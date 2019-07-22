<?php 
	session_start();
	include("../../class/Facturas.php");
	include("../../class/Clientes.php");
?>
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
	$factura1 = new Facturas();
	$factura1->cargarFacturasxRango($_GET['fecha1'], $_GET['fecha2'], $_SESSION['tienda_']);
	$i=0;
    $total=0;

	while($array=$factura1->sql->fetch_assoc())
	{
		$i++;
		$cliente1 = new Clientes();
		$cliente1->getCliente($array['id_cliente']);
?>
	<tr>
        <td><?php echo $i ?></td>
        <td><?php echo $array['codigo']?></td>
        <td><?php echo $array['id_usuario']?></td>
        <td><?php echo $cliente1->Nombre.' '.$cliente1->Apellido;?></td>
        <td><?php echo $cliente1->Cedula;?></td>
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