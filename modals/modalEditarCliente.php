<form id="editarClienteBD" class="form-horizontal">
<div class="modal fade" id="editarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Editar Cliente:</h4>
      </div>
      <div class="modal-body">
			   <div id="datos_ajax"></div>

         <div class="form-group">
            <label for="cedula" class="control-label col-sm-4">C&eacute;dula / Rif:</label>
              <div class="col-sm-8">
                <input type="text" style="text-transform:uppercase;" class="form-control" name="newCedula0" id="newCedula0" placeholder="V-   E-   P-    J-" maxlength="12" required>
                 <input type="hidden" style="text-transform:uppercase;" class="form-control" name="oldCedula0" id="oldCedula0" placeholder="V-   E-   P-    J-" maxlength="12" required>
              </div>                
         </div>
        <div class="form-group">
              <label for="nombre" class="control-label col-sm-4">Nombre:</label>
              <div class="col-sm-8">
                <input type="text" style="text-transform:uppercase;" class="form-control" name="nombre0" id="nombre0" maxlength="50" required>

              </div> 
        </div>
        <div class="form-group">
              <label for="apellido" class="control-label col-sm-4">Apellido:</label>
              <div class="col-sm-8">
                <input type="text" style="text-transform:uppercase;" class="form-control" name="apellido0" id="apellido0" maxlength="50">
              </div> 
        </div>
        <div class="form-group">
             <label for="direccion" class="control-label col-sm-4">Direcci&oacute;n:</label>
             <div class="col-sm-8">
                <textarea class="form-control" style="text-transform:uppercase;" name="direccion0" id="direccion0" placeholder="Direcci&oacute;n:"></textarea>
        </div>
        </div>
        <div class="form-group">
              <label for="telefono" class="control-label col-sm-4">Tel&eacute;fono:</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" name="telefono0" id="telefono0" maxlength="20">
              </div> 
        </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar datos</button>
      </div>
    </div>
  </div>
</div>
</form>