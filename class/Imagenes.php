<?php
/*
Clase para subir imágenes al servidor
Permite asignar un tamaño máximo
Desarrollada por Sebastián Álvarez Riquelme 
http://web.nord.cl
sebastian@nord.cl
Publicada bajo licencia Creative Commons Atribución-LicenciarIgual 3.0 Unported.
*/

class Imagenes{
	# Variables #
	private $_exts = array("image/jpg", "image/jpeg", "image/png", "image/gif"); // Tipos de archivos soportados
	private $_width = 640; // Ancho máximo por defecto
	private $_height = 420; // Alto máximo por defecto
	private $_size = 5000000; // Peso máximo. MAX_FILE_SIZE sobrescribe este valor
	private $_name = "imagen"; // Nombre por defecto 
	private $_dest = "";//Este variable ya no la utilizo. la envio por parametro al crear el objeto Imagen() init
	private $_img;
	private $_ext;
	private $_r = "";
	# Métodos mágicos #
	public function __set($var, $value) {
		$this->$var = $value; 
	}
	public function __get($var) {
		return $this->$var;
	}
	
	# Métodos propios #
	//Se crea la imagen (#FILE, #DIRECTORIO, #NOMBRE DE IMG)
	public function init($img, $img_path, $img_name) {
		$this->_img = $img;	
		$this->img_name = $img_name;
		// Vemos si no pesa más que el máximo definido en $_size
		if ($this->_img['size'] <= $this->_size) {
			// Vemos si hay error
			$error = $this->_img['error'];
			switch($error) {
				case 0:
					// Verificamos que el tipo de archivo sea válido, de ser así, subimos
					if ($this->validaTipo()) {
						// Vemos si el usuario no cambió el nombre por defecto
						// Si $_name == imagen, asignamos el nombre con formato f
						if ($this->_name == "imagen") $this->asignaNombre();
						// Vemos si es mayor al tamaño por defecto
						$tamano = list($ancho_orig, $alto_orig) = getimagesize($this->_img['tmp_name']);
						$origen = $this->_img['tmp_name'];
						// Verificamos que exista el destino, si no, lo creamos
						if ($img_path != "" and !is_dir($img_path)) {
							mkdir($img_path, 0775, true);
						}
						
						$destino = $img_path.$this->_name;
						$this->imagen_ruta = $this->_name;
						
						
						$ancho_max = $this->_width;
						$alto_max = $this->_height;
						if ($ancho_orig > $ancho_max or $alto_orig > $alto_max) {
							$ratio_orig = $ancho_orig/$alto_orig;
							if ($ancho_max/$alto_max > $ratio_orig) {
							   $ancho_max = $alto_max*$ratio_orig;
							} else {
							   $alto_max = $ancho_max/$ratio_orig;
							}
							// Redimensionar
							$canvas = imagecreatetruecolor($ancho_max, $alto_max);
							switch($this->_img['type']) {
								case "image/jpg":
								case "image/jpeg":
									$image = imagecreatefromjpeg($origen);
									imagecopyresampled($canvas, $image, 0, 0, 0, 0, $ancho_max, $alto_max, $ancho_orig, $alto_orig);
									imagejpeg($canvas, $destino, 100);
								break; 
								case "image/gif":
									$image = imagecreatefromgif($origen);
									imagecopyresampled($canvas, $image, 0, 0, 0, 0, $ancho_max, $alto_max, $ancho_orig, $alto_orig);
									imagegif($canvas, $destino);
								break; 
								case "image/png":
									$image = imagecreatefrompng($origen);
									imagecopyresampled($canvas, $image, 0, 0, 0, 0, $ancho_max, $alto_max, $ancho_orig, $alto_orig);
									imagepng($canvas, $destino, 0);
								break; 
							}
							/***************GUARDAR LA IMAGEN************************/
							
											
						} else {
							
							move_uploaded_file($origen, $destino);						
  						   /***************GUARDAR LA IMAGEN************************/
							
						}
					} else {
						$this->_r = 'Tipo de archivo no valido \n Formatos admitidos: jpg/jpeg/png/gif';	
					}
				break;
				case 1:
				case 2:
				$this->_r = "[".$error."] La imagen excede el tamaño máximo soportado.";
				break;
				case 3:
				$this->_r = "[".$error."] La imagen no se subió correctamente.";
				break;	
				case 4:
				$this->_r = "[".$error."] Se debe seleccionar un archivo.";
				break;	
			}
		} else {
				$this->_r = "La imagen es muy pesada. ".$this->_img['size'];
		}
	}
	public function asignaNombre() { 
		// Asignamos la extensión según el tipo de archivo
		switch($this->_img['type']) {
			case "image/jpg":
			case "image/jpeg":
			$this->_ext = "jpg";
			break; 
			case "image/gif":
			$this->_ext = "gif";
			break; 
			case "image/png":
			$this->_ext = "png";
			break;
		}
		// ASIGNAMOS EL NOMBRE DE LA IMAGEN Y LA EXTENSION
		$this->_name = $this->img_name.".".$this->_ext;
	}
	
	public function validaTipo() {
		// Verifica que la extensión sea permitida, según el arreglo $_exts
		if (in_array(strtolower($this->_img['type']), $this->_exts)) return true;
	}
	
	/*public function getImage($user_id)
	{
		$conexion = mysql_connect("localhost","root","1234") or die (mysql_error());
					mysql_select_db("php1");
					
		$query = "SELECT `foto` FROM usuario WHERE user_id ='".$user_id."' ";
		$result =mysql_query($query);
		if($row = mysql_fetch_array($result))
		  {
			 $direccion= $row['foto'];
			 return $direccion;
		  }
	}*/

}
?>