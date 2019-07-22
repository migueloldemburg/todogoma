<?php include("modals/modalEditarUsuario.php"); ?>
<header>
	<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
    	<div class="container-fluid">
        	<div class="navbar-header">
            	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacion-fm">
                    <span class="sr-only">Desplegar / Ocultar Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand">Todogoma</a>
            </div>
            
            <!-- INICIA MENU -->
            <div class="collapse navbar-collapse" id="navegacion-fm">
                <ul class="nav navbar-nav">
                    <li <?php if(isset($inicio)) echo 'class="active"' ?>><a href="catalogueA.php">Inicio</a></li>
                    <li <?php if(isset($carrito)) echo 'class="active"'?>><a href="checkCart.php">Carrito</a></li>
                    <li <?php if(isset($ventas)) echo 'class="active"' ?>><a href="verVentas.php">Ventas</a></li>
                    <!--<li <?php if(isset($pedidos)) echo 'class="active"'?>><a href="#">Pedidos</a></li>-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo $_SESSION['nombre_']?><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a role="item" href="#" data-toggle="modal" data-target="#editarUsuario">Ver perfil</a></li>
                            <li class="divider"></li>
                            <li><a role="item" href="salir.php">Cerrar sesi&oacute;n</a></li>
                        </ul>
                    </li>
                </ul>
                
                <form action="" class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" style="width:400px" placeholder="buscar">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</header>