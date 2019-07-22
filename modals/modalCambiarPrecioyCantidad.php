<!--************************ Modal EDITAR ALMACEN *******************************-->
<form id="modalCambiarPrecioyCantidadBD" class="form-horizontal">
    <div class="modal fade" id="modalCambiarPrecioyCantidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Control de precio y stock</h4>
                </div>

                <div class="modal-body">

                    <h5>OEM: <strong id="oem"></strong></h5>
                    <h5>Ref: <strong id="ref"></strong></h5>
                    <h5>Art&iacute;culo: <strong id="nombre"></strong></h5>  

                    <div class="form-group" style="width:40%">
                        <label for="precio">Precio: </label>
                        <input size="20" onKeyUp="comprobar(this.id)" class="currency form-control" type="text" name="nuevoPrecio" id="nuevoPrecio">
                    </div>

                    <div class="form-group" style="width:40%">
                        <label for="cant">Cantidad a ingresar al stock:</label>
                        <input 
                            onKeyUp="comprobar2(this)" 
                            onkeypress="return validation_number(event)" 
                            class="form-control" 
                            type="text" 
                            name="nuevaCant" 
                            id="nuevaCant" 
                            value="">
                    </div>
                    <input type="hidden" id="curStock">
                    <input type="hidden" name="piezaId" id="piezaId">
                    <p style="color:#00F; font-weight:bold">Existencia <strong id='currentStockTxt'></strong></p>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--**************************/// Modal EDITAR ALMACEN*********************-->