<?php
    session_start();
    if(isset($_SESSION['tiendaId_'])){
        function __autoload($nombre_clase)
        {
            require_once 'class/'.$nombre_clase.'.php';
        }
        ?>

        <!DOCTYPE html>
        <html lang="es"><head>
            <title>Control de precios e inventario</title>

            <?php require('libs.php'); ?>

            <link rel="stylesheet" type="text/css" href="Jquery/DataTables-1.10.12/media/css/jquery.dataTables.css">
            <link rel="stylesheet" type="text/css" href="Jquery/DataTables-1.10.12/media/css/dataTables.bootstrap.css">
            <script type="text/javascript" charset="utf8" src="Jquery/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
            <script type="text/javascript" charset="utf8" src="Jquery/DataTables-1.10.12/media/js/dataTables.bootstrap.js"></script>
            <style>
                .dataTables_wrapper .dataTables_paginate .paginate_button {
                    padding: 0;
                }
                .dataTables_wrapper { font-size: 12px }
                .ui-widget-header {
                    border: 1px solid #e78f08;
                    background: #f6a828 url('images/ui-bg_gloss-wave_35_f6a828_500x100.png') 50% 50% repeat-x;
                    color: #ffffff;
                    font-weight: bold;
                    font-size:12px;
                }
                .ui-widget-content {
                    background:#fff;
                }
                .form-control{
                    height:25px;
                }
                .form-horizontal .form-group{
                    margin-left: 15px !important;
                    margin-right: 15px !important;
                }
                .table tr td{
                    font-size:12px;
                    color:#333;
                    min-width:10px;
                }
                @media (min-width: 768px){
                    .form-inline .form-control{
                        height:25px;
                        width:100%;
                    }
                }
            </style>

            <script type="text/javascript">
                $(function() {
                    $( "#tabs" ).tabs({
                        collapsible: false
                    });


                    $('.display').DataTable({
                        "order": [[ 2, "asc" ]],
                        "stateSave": "true",
                        "language": {
                            "lengthMenu": "Mostrar _MENU_ resultados por p&aacute;gina",
                            "zeroRecords": "Sin resultados",
                            "info": "Mostrando p&aacute;gina _PAGE_ de _PAGES_",
                            "infoEmpty": "No hay resultados disponibes",
                            "infoFiltered": "(filtered from _MAX_ total records)",
                            "search": "Buscar:",
                            "oPaginate": {
                                "sFirst":    "Primero",
                                "sLast":     "Último",
                                "sNext":     "Siguiente",
                                "sPrevious": "Anterior"
                            },
                        }
                    });


                    $(".currency").maskMoney({prefix:'USD ', allowNegative: false, thousands:'.', decimal:',', affixesStay: false, allowZero: true});
                });
            </script>

        </head>

        <body background="images/background-car.jpg">

            <section class="container-fluid White">

                <div class="row" style="margin-top:10px;">
                    <div class="col-md-1">
                        <button class="btn btn-primary" onClick="location.href='stockPrecioA.php'">
                            <span class="glyphicon glyphicon-arrow-left"></span>
                        </button>
                    </div>

                    <div class="col-md-4">
                        <div class="miga-de-pan">
                            <ol class="breadcrumb">
                                <li><a href="stockPrecioA.php">Tienda</a></li>
                                <li class="active">
                                    <?php
                                    $tienda = new Tiendas;
                                    $tienda->getTienda($_SESSION['tiendaId_']);
                                    echo $tienda->Nombre.'-'.$tienda->Ciudad;
                                    ?>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6">
                        <h3>Control de precios e Inventario</h3>
                    </div>
                </div>

                <!---  **************************************************************************************** -->
                <div class="row White" style="margin-top:15px;">
                    <div class="col-xs-12" style="margin-bottom:10px; min-height:450px">
                        <div id="tabs">
                            <ul>
                                <li><a href="#tabs-1">FEBEST</a></li>
                                <li><a href="#tabs-2">JAFERPA</a></li>
                                <li><a href="#tabs-3">DANAPAC</a></li>
                                <li><a href="#tabs-4">KEYBOL</a></li>
                                <li><a href="#tabs-5">MOPAR</a></li>
                                <li><a href="#tabs-6">ASHIMORI</a></li>
                                <li><a href="#tabs-7">TNK</a></li>
                                <li><a href="#tabs-8">CIC</a></li>
                                <li><a href="#tabs-9">MOTORCRAF</a></li>
                                <li><a href="#tabs-10">INR</a></li>
                                <li><a href="#tabs-11">ELGIN</a></li>
                                <li><a href="#tabs-12">TITANIUM</a></li>
                                <li><a href="#tabs-13">T-ALLEN</a></li>
                                <li><a href="#tabs-14">WHEEL PRO</a></li>
                                <li><a href="#tabs-15">UNICA</a></li>
                                <li><a href="#tabs-16">NAKAYAMA</a></li>
                                <li><a href="#tabs-17">HELLIN-MOTORS</a></li>
                                <li><a href="#tabs-18">GABRIELS</a></li>
                                <li><a href="#tabs-19">METALCAR</a></li>
                                <li><a href="#tabs-20">BAKO STAR</a></li>
                                <li><a href="#tabs-21">DAI</a></li>
                                <li><a href="#tabs-22">NAVCAR</a></li>
                                <li><a href="#tabs-23">FGV</a></li>
                                <li><a href="#tabs-24">TORFLEX</a></li>
                                <li><a href="#tabs-25">HARRIS</a></li>
                            </ul>
                            <?php 
                            //ASIGNA ID a los  TAB-1 dinamicamente
                            for($i=1; $i<=25; $i++){
                            ?>
                                <div id="tabs-<?php echo $i ?>">

                                    <!--DATA TABLE-->
                                    <table cellspacing="0" width="100%" class="compact display table table-hover">
                                        <thead>
                                            <tr>
                                                <th>OEM</th>
                                                <th>#Ref.</th>
                                                <th>Nombre</th>
                                                <th>Modelo</th>
                                                <th>Dir.</th>
                                                <th>Proveedor</th>
                                                <th>Precio (Bs.)</th>
                                                <th>Cantidad</th>
                                                <th>...</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $pieza = new Piezas;
                                            $pieza->cargarPiezasxMarca_Tienda($_SESSION['tiendaId_'], $i);

                                            while($arreglo = $pieza->sql->fetch_assoc()){ 
                                                ?>
                                                <tr id="tr_<?php echo $arreglo['id'] ?>">
                                                    <td><?php echo $arreglo['oem'] ?></td>
                                                    <td><?php echo $arreglo['ref'] ?></td>
                                                    <td><?php echo $arreglo['nombre'] ?></td>
                                                    <td>
                                                        <?php
                                                        $modelo = new Modelos;
                                                        $modelo->getModeloPrincipal($arreglo['id']);

                                                        if($modelo->contador>0)
                                                        {
                                                            echo strtoupper($modelo->NombreMarca.' '.$modelo->Nombre.' - '.$modelo->Ano);
                                                        }else{
                                                            echo strtoupper($modelo->error);
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $arreglo['direccion'] ?></td>
                                                    <td><?php echo $arreglo['razon_social'] ?></td>

                                                    <td width="110px">
                                                        <input type="text" disabled="true" <?php if($arreglo['precio']<=10) echo "style='border:2px solid red;'" ?> class="form-control" value="<?php echo number_format($arreglo['precio'],2,",",".") ?>" onBlur="this.disabled=true" name="precio">
                                                    </td>

                                                    <td width="70px">
                                                        <input type="text" disabled="true" <?php if($arreglo['cant']<=10) echo "style='border:2px solid red;'" ?>  class="form-control" value="<?php echo $arreglo['cant'] ?>" onBlur="this.disabled=true" name="cantidad">
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalCambiarPrecioyCantidad" data-piezaid="<?php echo $arreglo['id'];?>">
                                                            <span class="glyphicon glyphicon-pencil"></span>
                                                        </button>
                                                    </td>                                    
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <!--******************************************* DATA TABLE ******************************-->

                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
<!--************************************************************************************-->
</section>

<?php include('modals/modalCambiarPrecioyCantidad.php'); ?>

<script src="modals/js/app.js?v=3"></script>

<?php include('zAdmFooter.php'); ?>

</body>
</html>
<?php
}else{
    echo "<script>location.href='stockPrecioA.php'</script>";
}
?>