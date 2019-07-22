<?php
session_start();
if($_SESSION['nivel_']=='ADM' || $_SESSION['nivel_']=='SUPER-U'){

 
?>
<!DOCTYPE html >
<html>
<head>
	<title>Inicio</title>
	<?php require('libs.php'); ?>
	
</head>
<body  background="images/background-car.jpg">

  <header>
    <div class="container">
	  <h2 class="text-center">TODOGOMA</h2>
    </div>
  </header>

  <section class="container">
    <div class="row">
      <div class="col-md-4">
      	<h4 class="Carrara">Administraci&oacute;n</h4>
		<div class="list-group">
			<a href="adm_piezas.php" class="list-group-item">Piezas</a>
			<a href="adm_fabricantes.php" class="list-group-item">Fabricantes</a>
			<a href="adm_modelos.php" class="list-group-item">Modelos</a>
			<a href="adm_proveedores.php" class="list-group-item">Proveedores</a>
			<a href="adm_tiendas.php" class="list-group-item">Tiendas</a>
			<a href="adm_usuarios.php" class="list-group-item">Usuarios</a>
            <a href="stockPrecioA.php" class="list-group-item">Control de precio e Inventario</a>
            <a href="adm_rate.php" class="list-group-item">Tasa del día</a>
		</div>
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
