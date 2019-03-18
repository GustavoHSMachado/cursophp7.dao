<?php

	/* Codigo para conexão com Banco de Dados, mais alguns metodos para trabalhar com o Banco de Dados */
	
	class Sql extends PDO {
	
		private $conn;
		
		/* Método construtor para fazer a conexão com o Banco de Dados */
		
		public function __construct() {
		
			$this -> conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
		
		}
		
		/* Método para passar varios paramentros */
		
		private function setParams($statment, $parameters = array()){
		
			foreach($parameters as $key => $value) {
			
				$this -> setParam($key, $value);
			
			}
		
		}
		
		/* Método para passar apenas 1 paramentro */
		
		private function setParam($statment, $key, $value) {
		
			$statment -> bindParam($key, $value);
		
		}
		
		/* Método para passar a query "comando sql" */
		
		public function query($rawQuery, $params = array()){
		
			$stmt = $this -> conn -> prepare($rawQuery);
			
			$this -> setParams($stmt, $params);
			
			$stmt -> execute();
			
			return $stmt;
		
		}
		
		/* Método para listar a query sql select */
		
		public function select($rawQuery, $params = array()):array {
		
			$stmt = $this -> query($rawQuery, $params);
			
			return $stmt -> fetchAll(PDO::FETCH_ASSOC);
		
		}
	
	}

?>
