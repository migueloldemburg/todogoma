<?php
	class Tasas{
		var $id;
		var $tasa;
		var $fecha;

		function __construct(){
			$this->conectar();
		}

		function __destruct(){
			$this->desconectar();
		}

		private function conectar(){
			require('conexion.php');
	   		$this->conexion = $conexion;
		}

		private function desconectar(){
			$this->conexion->close();
		}

		public function find($id, $last = FALSE){
			if($last===TRUE){
				$select = "SELECT * FROM tasa ORDER BY id DESC LIMIT 1";
			}else{
				$select = "SELECT * FROM tasa WHERE id = ".intval($id);	
			}
			
			$sql = $this->conexion->query($select);
			if($sql->num_rows > 0){
				$arr = $sql->fetch_assoc();
				$this->id = $arr['id'];
				$this->tasa = $arr['tasa'];
				$this->tasa_formatted = number_format($arr['tasa'], 2, ',', '.');
				$this->fecha = $this->formatDate($arr['fecha']);
				return true;
			}else{
				return false;
			}
		}

		public function save(){
			$insert = "INSERT INTO tasa (tasa) VALUES (".$this->tasa.")";
			$sql_insert = $this->conexion->query($insert);
			if($sql_insert===true){
				$this->id = $this->conexion->insert_id;
			}else{
				return false;
			}
		}

		public function getHistory(){
			$select = "SELECT id FROM tasa ORDER BY id DESC";
			$sql = $this->conexion->query($select);
			if($sql->num_rows > 0){
				$arr = array();
				while($row = $sql->fetch_assoc()){
					$tasa = new Tasas();
					$tasa->find($row['id']);
					$arr[] = $tasa;
				}
				return $arr;
			}else{
				return false;
			}
		}

		/**
		* @return {object} Tasa object with last inserted record
		**/
		public function getLast(){
			return $this->find(0, true);
		}

		public function convertPricetoBolivares($price){
			//Init $this->find() to get current rate before executing this function, otherwise all prices will be shown as zeros
			$this->precio = $price * $this->tasa;
			$this->precio_formatted = number_format($price * $this->tasa, 2, ',', '.');
		}

		private function formatDate($timestamp){
			return date("d/m/Y h:iA", strtotime($timestamp));
		}
	}
?>