<?php
	//sessao iniciada
	session_start();
	//verificar se ele Não esta logado
	if(!isset($_SESSION['idSessao'])){
	//limpa o URL e dps redireciona
		header("Location: //127.0.0.1/saude_e_movimento");
		//sai,encerra
		exit;
	}else if($_SESSION['idSessao']!=session_id()){
			header("Location: //127.0.0.1/saude_e_movimento");
			//sai,encerra
			exit;
		}
?>