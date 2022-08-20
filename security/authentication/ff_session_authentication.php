<?php
	//sessao iniciada
	session_start();
	//verificar se ele N�o esta logado
	if(!isset($_SESSION['idSessao'])){
	//limpa o URL e dps redireciona
		header("Location: https://legends-of-world.herokuapp.com/");
		//sai,encerra
		exit;
	}else if($_SESSION['idSessao']!=session_id()){
			header("Location: https://legends-of-world.herokuapp.com/");
			//sai,encerra
			exit;
		}
?>