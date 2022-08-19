<?php
	include "auxi/ff_security_auxi.php";

	// Ativar duas dlls em C:\xampp\php\php.init
	// extension=php_pdo_pgsql.dll
	// extension=php_pgsql.dll
	$dsn = "pgsql:port=$porta;dbname=$banco;user=$usuario;password=$senha;host=$servidor";
	$conexao = new PDO($dsn);

	if(!$conexao){
		die("Não foi possivel se conectar com o Banco de Dados - "+ $conexao);
	}
?>