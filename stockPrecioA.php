<?php
    include('security2.php');
    
    if(isset($_POST['aceptar'])){
        if($_POST['tienda']!=''){
            $_SESSION['tiendaId_'] = $_POST['tienda'];
            echo "<script>location.href='stockPrecioB.php'</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="es"><head>
    <title>Control de precio e Inventario</title>
    <?php require('libs.php'); ?>
  
</script>
</head>
<body background="images/background-car.jpg">

	<section class="container-fluid White">
   
    	<div class="row" style="margin-top:10px;">
        	<div class="col-md-1">
                <button class="btn btn-primary" onClick="location.href='inicio.php'">
                    <span class="glyphicon glyphicon-arrow-left"></span> Men&uacute;
                </button>
            </div>
             
            <div class="col-md-4">
				<div class="miga-de-pan">
					<ol class="breadcrumb">
						<li class="active">Tienda</li>
					</ol>
				</div>
			</div>      
        </div>
        
        <div class="row">
       	  <div class="col-xs-6">
			 <h3>Control de precios</h3>
		  </div>
        </div>
        
        <div class="row">
       		<div class="col-md-4" style="height:450px">
            	
                <form class="form-horizontal" action="" enctype="application/x-www-form-urlencoded" method="post">
                <div class="form-group">
                	<label for="tienda" class="control-label col-md-2">Tienda:</label>
                    <div class="col-md-10">
                        <select class="form-control" name="tienda" id="tienda" onChange="document.getElementById('aceptar').disabled=false">
                        	<option value="">- SELECCIONE -</option>
                        <?php
                            $tienda = new Tiendas;
                            $tienda->cargarTabla();
                            $i=1;
                            while($array = $tienda->sql->fetch_assoc())
                            {
                        ?>
                            <option value="<?php echo $array['id'] ?>"><?php echo $i++.' : '.$array['nombre'].'-'.$array['ciudad'] ?></option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                	<div class="col-md-2 col-md-offset-2">
	                	<button class="btn btn-success btn-sm" name="aceptar" id="aceptar" disabled="true">
    	                	Aceptar <span class="glyphicon glyphicon-ok"></span>
        	            </button>
                    </div>
                </div>
                </form>
                
            </div>
        </div>

	</section>
	
	<?php include('zAdmFooter.php') ?>

</body>
</html>