<?php
  require_once('../class/Facturas.php');
  $facturaDetalle = new Facturas();
  $facturaDetalle->getFactura($_GET['codigo']);
?>
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="exampleModalLabel">Visualizar Factura</h4>
    </div>
    <div class="modal-body" style="font-size:10px;">
		  <h4>Tienda: <strong><?php echo $facturaDetalle->TiendaNombre.'-'.$facturaDetalle->TiendaCiudad ?></strong></h4>
      <h4>C&oacute;digo: <strong><?php echo $facturaDetalle->Codigo; ?></strong></h4>
      <h4>Fecha: <strong><?php echo date('d-m-Y', strtotime($facturaDetalle->Fecha))?></strong></h4>
      <h4>Cliente: <strong><?php echo $facturaDetalle->ClienteNombre.' '.$facturaDetalle->ClienteApellido.' / '.$facturaDetalle->ClienteCedula.' / '.$facturaDetalle->ClienteTelefono;?></strong></h4>
     
        <table class="table table-condensed table-bordered" style="font-size:12px;">
          <thead>
            <tr>
              <th>N°</th>
              <th>Descripci&oacute;n Pieza</th>
              <th>Cantidad</th>
              <th>Precion Unt(Bs)</th>
              <th>Total(Bs)</th>
            </tr>
          </thead>
          <tbody>
          <?php
              $facturaDet = new Facturas();
              $facturaDet->detallarFactura($facturaDetalle->Codigo);
              $pieza = new Piezas();
              $i=1;
              $total=0;
              $totalProducto=0;
              while($f=$facturaDet->sql->fetch_assoc())
              {
                $pieza->getPieza($f['id_pieza']);
                $totalProducto = $f['cantidad'] * $f['precio'];
                $total = $total + $totalProducto;
          ?>
            <tr>
              <td><?php echo $i ?></td>
              <td><?php echo $pieza->Ref.' '.$pieza->Nombre; ?></td>
              <td><?php echo $f['cantidad'];?></td>
              <td><?php echo number_format($f['precio'],2,',', '.');?></td>
              <td><?php echo number_format($totalProducto,2,',', '.');?></td>
            </tr>
          <?php
                $i++;
              }
          ?>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>Total:</td>
              <td><?php  echo number_format($total,2,',', '.'); ?></td>
            </tr>
          </tbody>
        </table>
        
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>
