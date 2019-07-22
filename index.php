<?php
session_start();
function __autoload($nombre_clase)
{
	require_once 'class/'.$nombre_clase.'.php';
}

$usu = "";
if(isset($_POST['iniciar']))
{	 
	$usu = strtoupper($_POST['usuario']);
	$pass = $_POST['clave'];
	
	if ($usu=="" || $usu==" " || $pass=="" || $pass==" "){
		echo "<script>alert('Debe llenar todos los campos');</script>";
	}else{
		$usuario = new Usuarios;
		$usuario->verificarUsuario($usu, $pass);

		if($usuario->error > 0){
			echo "<script>alert('".$usuario->_error."')</script>"; 
		}else{
			$_SESSION['usuario_']  = $usuario->info['usuario'];
			$_SESSION['nombre_']   = $usuario->info['nombre'];
			$_SESSION['apellido_'] = $usuario->info['apellido'];
			$_SESSION['tienda_'] = $usuario->info['id_tienda'];
			$_SESSION['nivel_'] = $usuario->info['nivel'];
			header('Location:catalogueA.php');
			exit;
		}
	}
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio de Sesión</title>
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
			<div class="col-md-12">
				<div id="relleno" style="height:30px;"></div>
				<div class="login" id="login">
					<form class="form-horizontal" action="" method="post" name="login" id="login" enctype="application/x-www-form-urlencoded">
						<h4 class="text-center">Inicio de sesión</h4>						
						<div class="form-group">
							<label for="usuario" class="control-label col-md-2">Usuario:</label>
							<div class="col-md-10">
								<input class="form-control" style="text-transform:uppercase" type="text" id="usuario" name="usuario" maxlength="8" value="<?php echo $usu ?>" placeholder="USUARIO">
							</div>
						</div>
						<div class="form-group">
							<label for="clave" class="control-label col-md-2">Clave:</label>
							<div class="col-md-10">
								<input class="form-control" maxlength="8" id="clave" name="clave" type="password" placeholder="CLAVE">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-10 col-md-offset-2">
								<button style="width:100%;" class="btn btn-primary" type="submit" name="iniciar" id="iniciar">Iniciar Sesi&oacute;n</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!--
			<div class="col-md-3">
				<div class="menu">
					<div onclick="show()">Adiministraci&oacute;n</div>
					<div>Busqueda de Repuestos</div>
					<div>Reportes</div>
				</div>
			</div>
		-->	

	</div>
</section>
</body>
</html>