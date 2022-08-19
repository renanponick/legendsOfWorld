	<?php
		$g_id=$_GET['id'];
		//Variavel auxiliar
		$msg="";
		$imagem="warning.png";
		
		$sql_sel_ingressos="SELECT datas_id FROM ingressosdisponiveis WHERE datas_id='".$g_id."'";
		$sql_sel_ingressos_resultado=$conexao->prepare($sql_sel_ingressos);
		
		$sql_sel_bandas="SELECT datas_id FROM bandas WHERE datas_id='".$g_id."'";
		$sql_sel_bandas_resultado=$conexao->prepare($sql_sel_bandas);
		$sql_sel_bandas_resultado->execute();
		if(($sql_sel_ingressos_resultado->rowCount() > 0)||($sql_sel_bandas_resultado->rowCount() > 0)){
			$msg="Não é possivel deletar esta data<br>MOTIVO<br>Há Ingressos Disponiveis e/ou Bandas canastrados nela.<br>SOLUÇÃO<br>Deletar todas as bandas desta data<br>Deletar Ingressos Disponiveis da mesma";
		}else{
			$tabela = "datas";
			$condicao = "id='".$g_id."'";
			//Executando Sintaxe
			$resultado = deletar($tabela, $condicao);
			//Verificando se deu certo ou se deu erro
				if($resultado){
					$imagem="ok.png";
					$msg=depositoMensagens(6);
				}else{
					$msg=depositoMensagens(9).$conexao->error;
				}
		}
	?>
	<fieldset>
		<legend>Aviso</legend>
		<img src="../../layout/images/<?php echo $imagem;?>">
		<p><?php echo $msg;?></p>
		<a href="?folder=dates&file=ff_fmins_date&ext=php"><button type="button">Retornar</button></a>
	</fieldset>