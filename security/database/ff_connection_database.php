<?php
	include "auxi/ff_security_auxi.php";
	//Estabelecendo Conexão
	//PARÂMETROS (endereço do servidor, Nome do usuário de acesso(quem vai trabalha com o bd),senha do utilizador(padrão vazio),nome do banco)
	$conexao = new mysqli($servidor, $usuario, $senha, $banco);
	/*
		Variavel conexão é a ponte pro php achar todas as propriedades do MYSQLI(todos os arquivos) (q foi indicado ali)
			se connect_errno(numero do codigo do erro) for maior q 0 é q deu algum erro,
		connect_error descreve o erro que aconteceu
		DIE corta a execução do codigo caso(if) der errado
	*/
	if($conexao -> connect_errno > 0){
		die("Não foi possivel se conectar com o Banco de Dados : ".$conexao -> connect_error);
	}
	
	$conexao -> set_charset('utf8');
	//formatar para utf-8 para arrumar a linguagem.
	
?>