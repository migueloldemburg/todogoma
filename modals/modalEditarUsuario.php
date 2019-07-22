<?php
  include("class/Usuarios.php");

  $usuario = new Usuarios();
  $usuario->getUsuario($_SESSION['usuario_']);
?>
<form id="editarUsuarioBD" class="form-horizontal">
  <div class="modal fade" id="editarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Perfil del Usuario:</h4>
        </div>
        <div class="modal-body">
  			  <div id="datos_ajax"></div>
          <div class="form-group">
              <label for="usuario" class="control-label col-sm-4">Usuario:</label>
                <div class="col-sm-8">
                  <input type="text" style="text-transform:uppercase;" class="form-control" readonly="readonly" name="usuarioE" maxlength="8" value="<?php echo $usuario->Usuario;?>">
                </div>                
          </div>
          <div class="form-group">
                <label for="nombre" class="control-label col-sm-4">Nombre:</label>
                <div class="col-sm-8">
                  <input type="text" style="text-transform:uppercase;" class="form-control" name="nombreE" maxlength="30" value="<?php echo $usuario->Nombre;?>">
                </div> 
          </div>
          <div class="form-group">
                <label for="apellido" class="control-label col-sm-4">Apellido:</label>
                <div class="col-sm-8">
                  <input type="text" style="text-transform:uppercase;" class="form-control" name="apellidoE" maxlength="30" value="<?php echo $usuario->Apellido;?>">
                </div> 
          </div>
          <div class="form-group">
              <label for="tienda" class="control-label col-sm-4">Tienda:</label>
              <div class="col-sm-8">
                    <select class="form-control" name="tienda" disabled>
                      <option value="">--SELECCIONE--</option>
                     <?php
                      $tienda = new Tiendas;
                      $tienda->cargarTabla();
                      $i=1;
                      while($array = $tienda->sql->fetch_assoc())
                      {
                      ?>
                        <option value="<?php echo $array['id'] ?>" <?php if($usuario->Id_tienda==$array['id']) echo 'selected'; ?> > <?php echo $i++.' : '.$array['nombre'].'-'.$array['ciudad'] ?>
                        </option>
                      <?php
                      }
                      ?>
                  </select>
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