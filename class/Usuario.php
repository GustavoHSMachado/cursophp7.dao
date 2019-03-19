<?php

	class Usuario {
	
		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;
		
		public function getIdusuario() {
		
			return $this -> idusuario;
		
		}
		public function setIdusuario($value) {
		
			$this -> idusuario = $value;
		
		}
		
		public function getDeslogin() {
		
			return $this -> deslogin;
		
		}
		public function setDeslogin($value) {
		
			$this -> deslogin = $value;
		
		}
		
		public function getDessenha() {
		
			return $this -> dessenha;
		
		}
		public function setDessenha($value) {
		
			$this -> dessenha = $value;
		
		}
		
		public function getDtcadastro() {
		
			return $this -> dtcadastro;
		
		}
		public function setDtcadastro($value) {
		
			$this -> dtcadastro = $value;
		
		}
		
		/* Metodo Criado para carregar as informações que vieram do BD por meio do campo ID que e a Chave Primaria, para o Objeto. */
		
		public function loadById($id) {
		
			$sql = new Sql();
			
			$results = $sql -> select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID" => $id));
			
			if (count ($results) > 0) {
			
				$this -> setData($results[0]);
			
			}
		}
		
		/* Método Criado para Carregar uma lista de Usuários */
		
		public static function getList() {
		
			$sql = new Sql();
			
			return $sql -> select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
		
		}
		
		/* Método Criado para Carregar uma lista de usuários buscando pelo login */
		
		public static function search($login) {
		
			$sql = new Sql();
			
			return $sql -> select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", 
									array(':SEARCH' => "%" . $login . "%"));
		
		}
		
		/* Método Criado para Carregar uma lista de usuários usando o login e a senha */
		
		public function login($login, $password) {
		
			$sql = new Sql();
			
			$results = $sql -> select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", 
										array(":LOGIN" => $login, ":PASSWORD" => $password));
			
			if (count ($results) > 0) {
			
				$this -> setData($results[0]);	
			
			} else {
			
				throw new Exception("Login e/ou senha inválidos.");
			
			}
		
		}
		
		/* Esse Método foi criado para melhorar o codigo para que não precise toda hora fazer os "$this -> set...", ai agora é só colocar 
		 * após  o: "if (count ($results) > 0) { $this -> setData($results[0]); }".  */
		
		public function setData($data) {
		
			$this -> setIdusuario($data['idusuario']);
			$this -> setDeslogin($data['deslogin']);
			$this -> setDessenha($data['dessenha']);
			$this -> setDtcadastro(new DateTime($data['dtcadastro']));
		
		}
		
		/* Método Criado para inserir dados no Banco de Dados por procedure(tem que ser criada dentro do BD) */
		
		public function insert() {
		
			$sql = new Sql();
			
			$results = $sql -> select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", 
										array(':LOGIN' => $this -> getDeslogin(), ':PASSWORD' => $this -> getDessenha()));
			
			if (count ($results) > 0) {
			
				$this -> setData($results[0]);	
			
			}
		
		}
		
		/* Método Construtor Criado para usar os setters de login e senha */
		
		public function __construct($login = "", $password = "") {
		
			$this -> setDeslogin($login);
			$this -> setDessenha($password);
		
		}
		
		/* Método Criado para Atulizar(alterar) Dados no BD, identificando os dados a serem atulizados pelo ID */
		
		public function update($login, $password) {
		
			$this -> setDeslogin($login);
			$this -> setDessenha($password);
			
			$sql = new Sql();
			
			$sql -> query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
							':LOGIN' => $this -> getDeslogin(), ':PASSWORD' => $this -> getDessenha(), ':ID' => $this -> getIdusuario()
			));
		
		}
		
		/* Método Criado para Deletar dados no Banco de Dados */
		
		public function delete() {
		
			$sql = new Sql();
			
			/* Apagando no linha da tabela no Banco de Dados (BD) */
			$sql -> query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(':ID' => $this -> getIdusuario()));
			
			/* Apagando(Limpando) os dados no Objeto */
			$this -> setIdusuario(0);
			$this -> setDeslogin("");
			$this -> setDessenha("");
			$this -> setDtcadastro(new DateTime());
		
		}
		
		/* Metodo Criado para imprimir as informações que foram passadas para o Objeto. */
			
		public function __toString() {
			
				return json_encode(array(
					
					"idusuario" => $this -> getIdusuario(),
					"deslogin" => $this -> getDeslogin(),
					"dessenha" => $this -> getDessenha(),
					"dtcadastro" => $this -> getDtcadastro() -> format("d/m/Y H:i:s")
					
				));
			
		}
		
		
	
	}

?>
