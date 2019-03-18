<?php
	
	/* Codigo para testar se arquivo de Conexão com o Banco de Dados(BD) e o arquivo que Chama a conexão com BD estão funcioinando */
	
	require_once("config.php");
	
	$sql = new Sql();
	
	/* Usando o Metodo select da class Sql do arquivo de Conexão com BD para listar a tabela do BD */
	
	$usuarios = $sql -> select("SELECT * FROM tb_usuarios");
	
	echo json_encode($usuarios);

?>
