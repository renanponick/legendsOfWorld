	<?php
	// Recebendo dados \\
		$g_id = $_GET['id'];
	//Variavel auxiliar
		$msg ="";
		$imagem = "warning.png";
	//Criando Sintaxe
		$tabela="bandas";
		$condicao="id='".$g_id."'";
		$resultado=deletar($tabela, $condicao);
	//Verificando se ocorreu tudo certo
		if($resultado){
			$msg = depositoMensagens(6);
			$imagem = "ok.png";
		}else{
			$msg = depositoMensagens(9).$conexao->error;
		}
	?>
	<!-- Mensagem final -->
	<fieldset>
		<legend>Aviso</legend>
		<img src="../../layout/images/<?php echo $imagem;?>">
		<p><?php echo $msg;?></p>
		<a href="?folder=bands&file=ff_fmins_band&ext=php"><button type="button">Retornar</button></a>
	</fieldset>
	<!-- Fim -->