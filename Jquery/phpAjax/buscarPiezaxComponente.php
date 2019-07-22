<?php
session_start();
    function __autoload($nombre_clase)
    {
		require_once '../../class/'.$nombre_clase.'.php';
    }
 
    //sustituimos los pisos _ por espacios
    $componente = str_replace("_", " ", $_GET['componente']);


    $listarTodo = new Piezas;
    $listarTodo->buscarPieza($_SESSION['modeloId_'], $componente, $_SESSION['tienda_']);
        
    if($listarTodo->error=='')
    {
        if($listarTodo->message=='')
        {
            while($pieza = $listarTodo->sql->fetch_assoc())
            {
                //Iniciar objeto tasa para colocar los precios.
                $tasa = new Tasas();
                $tasa->getLast();
                $tasa->convertPricetoBolivares($pieza['precio']); 
                /* 
                llamando a este método con el precio de parámetro, y llamando previamente al método getLast() se puede obtener los precios en BS según la ultima tasa registrada.
                $tasa->precio / $tasa->precio_formatted
                */

?>
                <script>
                $(document).ready(function(){
                  $('[data-toggle="tooltip"]').tooltip(); 
                });
                </script>
                <!-- The overlay to zoom in the pic-->
                <div id="<?php echo $pieza['id']; ?>" class="overlay over2">
                    <!-- Button to close the overlay navigation -->
                    <a href="javascript:void()" class="closebtn" onclick="closeNav(<?php echo $pieza['id']; ?>)">&times;</a>
                    <!-- Overlay content -->
                    <div class="overlay-content">
                        <!--Abre Carousel-->
                        <div id="carousel-example-generic<?php echo $pieza['id']; ?>" data-interval="false" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic<?php echo $pieza['id']; ?>" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic<?php echo $pieza['id']; ?>" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic<?php echo $pieza['id']; ?>" data-slide-to="2"></li>
                            </ol>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <?php
                                    if($pieza['imagen']==''){
                                        echo "<img src=\"images/noimage.jpg \"></a>";
                                    }else{
                                        echo "<img src=\"images/piezas/".$pieza['imagen']." \"></a>";
                                    }
                                    ?>
                                    <div class="carousel-caption">
                                        <?php echo $pieza['nombre'];?>
                                    </div>
                                </div>
                                <div class="item">
                                    <?php
                                    if($pieza['imagen']==''){
                                        echo "<img src=\"images/noimage.jpg \"></a>";
                                    }else{
                                        echo "<img src=\"images/piezas/".$pieza['img_esquema']." \"></a>";
                                    }
                                    ?>
                                    <div class="carousel-caption">
                                        <?php echo 'Esquema';?>
                                    </div>
                                </div>
                                <!--Modelos compatibles-->
                                <div class="item">
                                    <div class="divModelosCompatibles">
                                        <?php 
                                            $modelo = new Modelos();
                                            $modelo->getModelos($pieza['id']);
                                        ?>
                                        <h5>Modelo Principal: <strong><?php echo $modelo->MPMarca.' '.$modelo->MPNombre.' '.$modelo->MPAno ?></strong></h5>
                                        <br>
                                        <h5>Modelos compatibles:</h5><br>
                                        <?php
                                            while($array = $modelo->sql->fetch_assoc())
                                            {
                                        ?>
                                            <h6><?php echo $array['marca'].' '.$array['nombre'].' '.$array['ano'] ?></h4>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic<?php echo $pieza['id']; ?>" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic<?php echo $pieza['id']; ?>" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!--Cierrra Carousel-->
                    </div>
                    <!--Cierra Overlay-Content-->
                    <div class="itemInfo">
                        <div class="info">
                            <h5 class="p">Nombre: <strong><?php echo $pieza['nombre'];?></strong></h5>
                            <h5 class="p">OEM: <strong><?php echo $pieza['oem'];?></strong></h5>
                            <h5 class="p">Ref.: <strong><?php echo $pieza['ref'];?></strong></h5>
                            <h5 class="p">Marca: <strong><?php echo $pieza['marca'];?></strong></h5>
                            <h5 class="p">Componente: <strong><?php echo $pieza['componente'];?></strong></h5>
                            <h5 class="p">Direcci&oacute;n: <strong>
                                                                    <?php
                                                                        if($pieza['direccion']=='N')
                                                                            echo 'N/A';
                                                                        elseif($pieza['direccion']=='A')
                                                                            echo 'AUTOM&Aacute;TICO';
                                                                         elseif($pieza['direccion']=='S')
                                                                            echo 'SINCR&Oacute;NICO';
                                                                    ?>
                                                            </strong></h5>
                        </div>
                        <div class="info">
                            <h5 class="p">Proveedor: <strong>
                                                            <?php
                                                                $proveedor = new Proveedores;
                                                                $proveedor->getProveedor($pieza['id_proveedor']);
                                                                echo $proveedor->Razon_social;
                                                            ?>
                                                    </strong></h5>
                            <h5 class="p" data-toggle="tooltip" title="<?php echo $pieza['precio'] ?>">Precio: <strong><?php echo $tasa->precio_formatted ?></strong></h5>
                            <h5 class="p">Descripci&oacute;n Pieza: 
                                <strong><?php echo $pieza['descripcion'];?></strong>
                            </h5>
                            
                        </div>
                        
                    </div>
                </div>
                
                <div class="caja_producto" <?php if($pieza['principal']==0) echo "style='border:1px #1E8BC3 solid;'"; ?>>
                    <div style="cursor:pointer;" class="img_cp" onClick="openNav(<?php echo $pieza['id']; ?>)" >
                        <?php
                        if($pieza['imagen']==''){
                            echo "<img src=\"images/noimage.jpg \"></a>";
                        }else{
                            echo "<img src=\"images/piezas/".$pieza['imagen']." \"></a>";
                        }
                        ?>
                    </div>
                    <h5 class="ref"><?php echo $pieza['ref'].' - '.$pieza['marca'];?></h5>
                    <h5 class="ref"><?php echo $pieza['oem'];?></h5>
                    <h5 class="nombre"><?php echo $pieza['nombre'];?></h5>
                    <h6 class="precio pull-left" data-toggle="tooltip" title="<?php echo $pieza['precio'] ?>"><?php echo $tasa->precio_formatted ?></h6>
                    <h6 class="stock pull-right">stock <span <?php if($pieza['cant']<=10) echo "style='color:red'" ?>>(<?php echo $pieza['cant'];?>)</span></h6>
                    
                    <div class="button_div" id="boton1" onClick="agregarCarrito('<?php echo $pieza['id'] ?>', '<?php echo $pieza['cant'] ?>')">
                        <button type="button" class="btn btn-success btn-xs">
                            <span class="glyphicon glyphicon-plus"></span> Añadir al carrito
                        </button>
                    </div>

                    

                </div>
<?php
            }
        }else{
            echo $listarTodo->message;
        }
    }else{
        echo $listarTodo->error;
    }
?>