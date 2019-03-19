<?php
	
	/* Codigo para testar se arquivo de Conexão com o Banco de Dados(BD) e o arquivo que Chama a conexão com BD estão funcioinando
	 * Também para testar os metodos das classe Usuario. */
	
	require_once("config.php");
	
	/* 
	// Usando o Metodo select da class Sql do arquivo de Conexão com BD para listar a tabela do BD \\
	  
	$sql = new Sql();
	
	$usuarios = $sql -> select("SELECT * FROM tb_usuarios");
	
	echo json_encode($usuarios); 
	*/ 
	
	
	/* 
	// Usando Metodo loadById para Carregar um usuário \\
	
	$root = new Usuario();
	
	$root -> loadById(3);
	
	echo $root; 
	*/
	
	/*
	// Usando Metodo getList para Carregar uma lista de Usuarios \\
	
	$lista = Usuario::getList();
	echo json_encode($lista);
	*/
	
	/*
	// Usando Metodo search para Carregar uma lista de usuários buscando pelo login  \\
	
	$search = Usuario::search("jo");
	echo json_encode($search);
	*/
	
	/*
	// Usando Método login para Carregar um usuário usando o login e a senha \\
	
	$usuario = new Usuario();
	
	$usuario -> login("root", "!@#$");
	
	echo $usuario;
	*/
	
	/*
	// Usando Método para Inserir informações no Banco de Dados (Criando um novo usuaário) \\
	
	$aluno = new Usuario("aluno", "@lun0");
	
	$aluno -> insert();
	
	echo $aluno;
	*/
	
	/*
	// Usando Método update para Atualizar(alterando) os Dados no BD, identificando os dados a serem atulizados pelo ID \\
	
	$usuario = new Usuario();
	
	$usuario -> loadById(8);
	
	$usuario -> update("professor", "!@#$%¨&*");
	
	echo $usuario;
	*/
	
	// Usando Método delete para Apagar dados no Banco de Dados \\
	
	$usuario = new Usuario();
	
	$usuario -> loadById(7);
	
	$usuario -> delete();
	
	echo $usuario;

?>
