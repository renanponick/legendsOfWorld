<?php
	include "auxi/ff_security_auxi.php";

	// Ativar duas dlls em C:\xampp\php\php.init
	// extension=php_pdo_pgsql.dll
	// extension=php_pgsql.dll
	$dsn = "pgsql:port=$porta;dbname=$banco;user=$usuario;password=$senha;host=$servidor";
	$teste = new PDO($dsn);
	$conexao = $teste 
	// $sql = 'SELECT * FROM users';
	// $stmt = $conexao->prepare($sql);
	// $stmt->execute();
	// $rowCount = $stmt->rowCount();
	// $details = $stmt->fetch();
	// print_r ($details);

	if(!$conexao){
		die("Não foi possivel se conectar com o Banco de Dados - "+ $conexao);
	}
?>