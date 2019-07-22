<?php
session_start();
 function __autoload($nombre_clase)
 {
		require_once '../../class/'.$nombre_clase.'.php';
 }

?>

 <label for="fabricante">Marca:</label>
 	<select class="form-control" id="fabricante" name="fabricante" onChange="cargarModelo('Jquery/phpAjax/cargarModelo.php', this.value)"> 
    	<option value=""></option>
		<?php
        $fabri = new Fabricantes;
        $fabri->cargarTabla();
            
		while($fabris=$fabri->sql->fetch_assoc())
        {
        ?>
        	<option value="<?php echo $fabris['id'] ?>"><?php echo $fabris['nombre'] ?></option>
        <?php
        }
        ?>
   </select>