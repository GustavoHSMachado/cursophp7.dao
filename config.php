<?php

	/* Codigo para ver se exsite e chamar o arquivo de conexão com o Banco de Dados */

	spl_autoload_register(function($class_name)	{
	
		$filename = "class" . DIRECTORY_SEPARATOR . $class_name . ".php";
		
		if(file_exists(($filename))) {
		
			require_once($filename);
			
		}
	
	});

?>
