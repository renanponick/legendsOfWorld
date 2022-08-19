<?php
	include "auxi/ff_security_auxi.php";

	//$conexao = new PDO();
	//$dsn = "pgsql:host=$servidor;port=5432;dbname=$banco;user=$usuario;password=$senha";
	
	$dsn = "pgsql:host=" . $servidor . ";port=" . $porta .";dbname=" . $banco . ";user=" . $usuario . ";password=" . $senha . ";";
	echo $dsn;
	//create a pdo instance
	$conexao = new PDO($dsn, $usuario, $senha);
	$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
	$conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
	$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if(!$conexao){
		die("Não foi possivel se conectar com o Banco de Dados - "+ $conexao);
	}
	$conexao -> set_charset('utf8');
?>