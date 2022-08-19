<?php
	include "auxi/ff_security_auxi.php";

	$conexao = new mysqli($servidor, $usuario, $senha, $banco);

	if($conexao -> connect_errno > 0){
		die("Não foi possivel se conectar com o Banco de Dados : ".$conexao -> connect_error);
	}
	
	$conexao -> set_charset('utf8');
	
?>