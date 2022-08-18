<?php
	include "auxi/ff_security_auxi.php";

	$conexao = pg_connect("host=$servidor port=$porta dbname=$bancoDeDados " +
		"user=$usuario password=$senha");
	
	if(!$conexao){
		die("Não foi possivel se conectar com o Banco de Dados - "+ $conexao);
	}
	$conexao -> set_charset('utf8');
?>