<?php
 session_start();
 function __autoload($nombre_clase)
 {
		require_once '../../class/'.$nombre_clase.'.php';
 }
  $pieza = new Piezas;
  $pieza->cargarActualizacionStockPieza($_GET['piezaId'], $_SESSION['tiendaId_']);
  $arreglo = $pieza->sql->fetch_assoc();
?>

<?php if(isset($_GET['precio']) && $_GET['precio']==1){ ?>
        <td id="tdPrecio<?php echo $_GET['piezaId'] ?>" width="110px">
            <input type="text" disabled="true" class="form-control" value="<?php echo number_format($arreglo['precio'],2,",",".") ?>" onBlur="this.disabled=true">
        </td>
<?php
	  }
      if(isset($_GET['cant']) && $_GET['cant']==1){
?>
        <td id="tdCant<?php echo $_GET['piezaId'] ?>" width="70px">
            <input type="text" disabled="true" <?php if($arreglo['cant']<=10) echo "style='border:2px solid red;'" ?>  class="form-control" value="<?php echo $arreglo['cant'] ?>" onBlur="this.disabled=true">
        </td>
<?php
	  }
?>