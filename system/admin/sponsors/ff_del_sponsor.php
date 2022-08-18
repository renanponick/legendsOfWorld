	<?php
		// Recebendo dados \\
		$g_id=$_GET['id'];
		//Variavel auxiliar
		$msg="";
		$imagem="warning.png";
		//Entrando em contato com o banco Através de uma sintaxe
			$tabela='patrocinadores';
			$condicao = "id = '".$g_id."'";
			$resultado = deletar($tabela, $condicao);
			
		// .-. Verifica se deu certo ou não .-. \\
		if($resultado){
			$imagem="ok.png";
			$msg="Excluido com Sucesso";
		}else{
			$msg="Erro ao efetuar a exclusão.".$conexao->error;
		}
		?>
	<!-- Mensagem final -->
	<fieldset>
		<legend>Aviso</legend>
		<img src="../../layout/images/<?php echo $imagem;?>">
		<p><?php echo $msg;?></p>
		<a href="?folder=sponsors&file=ff_fmins_sponsor&ext=php"><button type="button">Retornar</button></a>
	</fieldset>
	<!-- Fim -->
		