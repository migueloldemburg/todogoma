<?php
session_start();
 function __autoload($nombre_clase)
 {
		require_once '../../class/'.$nombre_clase.'.php';
 }
 
 if($_GET['id_fab']!=''){
	$fabricanteN = new Fabricantes;
	$fabricanteN->getFabricante($_GET['id_fab']);
	$modeloN = new Modelos;
}
?>
	<label for="modelo">Modelo:</label>
    <select class="form-control modelo_principal" id="modelo" name="modelo">
    	<option value="">- SELECCIONE -</option>
    <?php
        $modeloN->cargarModeloxMarca($_GET['id_fab']);
        
        while($modelosN=$modeloN->sql->fetch_assoc())
        {
    ?>
      		<option value="<?php echo $modelosN['id'] ?>"><?php echo $modelosN['nombre'].' '.$modelosN['ano'] ?></option>
    
    <?php
        }
    ?>
    </select>
    
