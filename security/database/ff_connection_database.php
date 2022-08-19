<?php
	include "auxi/ff_security_auxi.php";

	//$conexao = new PDO();
	$dsn = "pgsql:host=$servidor;port=5432;dbname=$banco;user=$usuario;password=$senha";
	echo $dsn;
	$conexao = new PDO(
		$dsn
	);

	if(!$conexao){
		die("Não foi possivel se conectar com o Banco de Dados - "+ $conexao);
	}
	$conexao -> set_charset('utf8');
?>