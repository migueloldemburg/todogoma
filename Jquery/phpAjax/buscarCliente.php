<?php
session_start();
 function __autoload($nombre_clase)
 {
		require_once '../../class/'.$nombre_clase.'.php';
 }

 $cedula = $_GET['ced'];
 
 if ($cedula!="")
 {
	$cliente = new Clientes;
	$cliente->getCliente($cedula);

	if($cliente->Cedula!="")
	{
	?>
    <script>
        $("#botonProcesar1").removeClass('disabled');
        $("#botonProcesar2").removeClass('disabled');
        $("#comentario").removeAttr('disabled').focus();
        $("#refPago").removeAttr('disabled').focus();
        
    </script>
	<div style="padding-left:10px"> <!-- inciio 2 -->
        <div class="form-group">
            <label for="cedula">C&eacute;dula:</label>
            <input class="form-control" type="text" name="cedulaN" id="cedulaN" readonly value="<?php echo $cliente->Cedula ?>">
        </div>
        <div class="form-group">
            <label for="cliente">Cliente:</label>
            <input class="form-control" type="text" name="cliente" readonly value="<?php echo $cliente->Nombre.' '.$cliente->Apellido ?>">
        </div>
        <div class="form-group">
            <label for="direccion">Direcci&oacute;n:</label>
            <input class="form-control" type="text" name="direccion" readonly value="<?php echo $cliente->Direccion ?>">
        </div>
        <div class="form-group">
            <label for="telefono">Tel&eacute;fono:</label>
            <input class="form-control" type="text" name="telefono" readonly value="<?php echo $cliente->Telefono ?>">
        </div>
        <div class="form-group">
            <button class="btn btn-sm btn-default" data-toggle='modal' data-cedula="<?php echo $cliente->Cedula; ?>" data-nombre="<?php echo $cliente->Nombre ?>" data-apellido="<?php echo $cliente->Apellido ?>" data-direccion="<?php echo $cliente->Direccion ?>" data-telefono="<?php echo $cliente->Telefono ?>" data-target='#editarCliente'>Editar</button>
        </div>
    </div>

	<?php
	}else{
		echo '¡No se encuentra registrado!<br>';
		echo "<button class='btn btn-sm btn-primary' data-toggle='modal' data-target='#registrarCliente'>Registrar Cliente</button>";
        ?>
        <script>
            $("#botonProcesar1").addClass('disabled');
            $("#botonProcesar2").addClass('disabled');
            $("#refPago").attr('disabled','disabled');
        </script>
        <?php
	}	
 }

?>

