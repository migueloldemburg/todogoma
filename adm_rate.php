<?php include('security2.php'); 

    $tasa = new Tasas();
    if($tasa->getLast()){
        $tasa_actual_formateada = $tasa->tasa_formatted;
    }else{
        $tasa_actual_formateada = "";
    }


    if(isset($_POST['save'])){
        
        if($_POST['rate'] !=  $tasa_actual_formateada){
            $obj = new Tasas();
            $obj->tasa = str_replace(",", ".", str_replace(".", "", $_POST['rate']));
            $obj->save(); // Guardamos nueva tasa

            //** recuperamos le valor de la nueva tasa **//
            $tasa_actual_formateada = $_POST['rate'];
        }
    }
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Tasa del Dia</title>
    <?php require('libs.php'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>
<body background="images/background-car.jpg">

    <header>
        <div class="container">
            <h2 class="text-center">TODOGOMA</h2>
        </div>
    </header>

    <section class="container-fluid White">
        <br>
        <button class="btn btn-primary" onclick="location.href='inicio.php'">
            <span class="glyphicon glyphicon-arrow-left"></span> Menú
        </button>
        <div class="row">
            <br>
            <div class="col-md-5">
                <form class="form-inline" method="post" action="">
                    <h4>Ingrese la tasa actualizada para el dolar</h4>
                    <div class="form-group">
                        <label for="rate">Tasa</label>
                        <input type="text" name="rate" value="<?php echo $tasa_actual_formateada ?>" class="form-control currency" required>
                    </div>
                    <button class="btn btn-primary" type="submit" name="save">Registrar</button>
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-10">
                <table class="table table-condensed table-striped" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tasa (BsF.)</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $obj = new Tasas();
                            $arr = $obj->getHistory();
                            if($arr > 0){
                                foreach($arr as $rate){
                                    echo "<tr>";
                                    echo " <td>".$rate->id."</td>";
                                    echo " <td>".$rate->tasa_formatted."</td>";
                                    echo " <td>".$rate->fecha."</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br/><br/><br/>

        <script type="text/javascript">
            $(document).ready( function () {
                $('#table').DataTable({
                    "order": [[ 0, "desc" ]],
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                    }
                });

                $(".currency").maskMoney({prefix:'BsF. ', allowNegative: false, thousands:'.', decimal:',', affixesStay: false});

            } );
        </script>
    </section>

    <?php include('zAdmFooter.php') ?>

</body>
</html>