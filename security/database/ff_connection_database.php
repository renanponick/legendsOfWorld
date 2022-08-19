<?php
	include "auxi/ff_security_auxi.php";

	$dsn = "pgsql:port=$porta;dbname=$banco;user=$usuario;password=$senha;host=$servidor";
	$conexao = new PDO($dsn);

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