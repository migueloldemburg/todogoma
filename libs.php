<!-- Unicode "utf-8" -->
<meta charset="UTF-8">


<!-- Permite solo hacer scroll down and up desde dispositivos moviles (Evita el zoom in and out)-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--<meta name="viewport" content="width=device-width, user-scalable=no, initial-scalable=1.0, maximum-scale=1.0, minimum-scale=1.0">-->

<link rel="apple-touch-icon" sizes="57x57" href="images/fav/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="images/fav/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/fav/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="images/fav/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/fav/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="images/fav/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="images/fav/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="images/fav/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="images/fav/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/fav/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="images/fav/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/fav/favicon-16x16.png">
<link rel="manifest" href="images/fav/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<!--Funcion Jquery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/bootstrap.js"></script>

<!-- Mis estilos -->
<link rel="stylesheet" href="css/estilos.css">
<link rel="stylesheet" href="css/stylesCatalogue.css">

<!-- JQuery DataTable -->
<link rel="stylesheet" href="Jquery/data-tables/media/css/demo_table.css"/>
<script type="text/javascript" src="Jquery/data-tables/media/js/jquery.dataTables.js"></script>

<!-- Ketchup Validation -->
<link rel="stylesheet" type="text/css" media="screen" href="Jquery/ketchup.0.3.2/css/jquery.ketchup.css" />
<script type="text/javascript" src="Jquery/ketchup.0.3.2/js/jquery.ketchup.all.min.js"></script>

<!--Alertify -->
<script src="Jquery/alertifyjs/alertify.min.js"></script>
<link rel="stylesheet" href="Jquery/alertifyjs/css/alertify.css">
<link rel="stylesheet" href="Jquery/alertifyjs/css/themes/bootstrap.css">

<!-- Funciones Ajax -->
<script language="javascript" type="text/javascript" src="Jquery/funcionesAjax.js?v=4"></script>
<script language="javascript" type="text/javascript" src="Jquery/funcionesJQuery.js"></script>

<!-- MoneyMask JQUERY -->
<script src="Jquery/moneymask/src/jquery.maskMoney.js" type="text/javascript"></script>

<!-- Validacion de datos JQUERY -->
<script type="text/javascript" src="Jquery/validation_type.js?v=1"></script>

<!--J QUERY TABS -->
<link href="Jquery/jquery-ui-1.11.4.custom/css/black-tie/jquery-ui-1.9.2.custom.css" rel="stylesheet">
<script src="Jquery/jquery-ui-1.11.4.custom/js/jquery-ui-1.9.2.custom.js"></script> 

<!--datapicker
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

<?php
if(!isset($_SESSION['detalle'])){
	$_SESSION['detalle'] = array();
}
?>